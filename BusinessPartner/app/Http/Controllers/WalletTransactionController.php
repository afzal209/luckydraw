<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Wallet;
use App\Models\Transaction;
use Hash;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Payment_Gateway;
use App\Models\Business_Partner;
use Srmklive\PayPal\Services\PayPal as PayPalClient;



class WalletTransactionController extends Controller
{
    
    private $provider;

    public function __construct()
    {
        // Fetch PayPal credentials from the database
        $credentials = Payment_Gateway::first();
        if (!$credentials) {
            throw new \Exception('PayPal credentials not found in the database.');
        }

        $this->provider = new PayPalClient;
        $this->provider->setApiCredentials([
            'mode' => $credentials->paypal_mode,
            $credentials->paypal_mode => [
                'client_id' => $credentials->paypal_live_client_id,
                'client_secret' => $credentials->paypal_live_client_secret,
                'app_id' => 'APP-80W284485P519543T', // Default sandbox app ID or replace with live app ID
            ],
            'payment_action' => env('PAYPAL_PAYMENT_ACTION', 'Sale'),
            'currency' => env('PAYPAL_CURRENCY', 'USD'),
            'notify_url' => env('PAYPAL_NOTIFY_URL', ''),
            'locale' => env('PAYPAL_LOCALE', 'en_US'),
            'validate_ssl' => env('PAYPAL_VALIDATE_SSL', true),
        ]);

        $this->provider->getAccessToken();
    }
    
    
    public function index()
    {
        $user = Session::get('user');
        $userid = $user['id'];
        $wallet = Wallet::where('bp_id',$userid)->get();
        $url = request()->getSchemeAndHttpHost();
        return view('wallet_transaction',compact('wallet','url'));
    }  
 
    public function wallet_create(){
        $Payment_Gateway = Payment_Gateway::get();
        return view('wallet',compact('Payment_Gateway'));
    }
 
    function wallet_add(Request $request){
        
        // $request->validate([
            
            
            
        //     'tx_id' => 'required_if:tx_type,2',
        //     'tx_date' => 'required_if:tx_type,2|date',
        //     'tx_proof' => 'required_if:tx_type,2|file|mimes:jpg,jpeg,png,pdf|max:2048',
        // ]);
        $user = Session::get('user');
        if (!$user || !isset($user['id'])) {
            return redirect()->back()->with('error', 'User not authenticated.');
        }
        $userid = $user['id'];
        
        // dd($request);
        $wallet = new Wallet();
        // $user = Session::get('user');
        // $userid = $user['id'];
        //  dd($request->all());
        if ($request->tx_type == 1 && $request->payment_gateway == 1) {
            // dd('yes');
            
            $response = $this->provider->createOrder([
                'intent' => 'CAPTURE',
                'purchase_units' => [
                    [
                        'amount' => [
                            'currency_code' => 'USD',
                            'value' => $request->amount,
                        ],
                        'description' => 'Wallet top-up',
                    ],
                ],
                'application_context' => [
                    'return_url' => route('wallet_transaction.success'),
                    'cancel_url' => route('wallet_transaction.cancel'),
                ],
            ]);
            // dd($response);
            if (isset($response['id']) && $response['status'] == 'CREATED') {
                $wallet->bp_id = $userid;
                $wallet->tx_date = date('Y-m-d');
                $wallet->amount = $request->amount;
                $wallet->tx_type = $request->tx_type; // 1 = Online
                $wallet->tx_mode = $request->payment_gateway; // 1 = PayPal
                $wallet->payment_id = $response['id']; // Store PayPal order ID
                $wallet->status = 0; // Pending
                $wallet->save();

                // Redirect to PayPal approval link
                foreach ($response['links'] as $link) {
                    if ($link['rel'] == 'approve') {
                        return redirect($link['href']);
                    }
                }
            }
            return redirect()->route('wallet_transaction.cancel')->with('error', $response['message'] ?? 'Failed to initiate PayPal payment.');
            
           
        }
        else{
            // dd('no');
            // dd($request->all());
            $wallet->tx_id = $request->tx_id;
        $wallet->bp_id = $userid;
        $wallet->tx_date = $request->tx_date;
        $wallet->amount = $request->amount_of;
        $wallet->tx_type = 2; //=Online and 2 Offline
        $wallet->tx_mode = 3; //1= Paypal, 2=Skrill, 3 Bank and 4 Others
        //tx_proof; File
        $wallet->status = 0;
        if ($request->file('tx_proof')) {
            $image = $request->file('tx_proof');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            // dd('image/'.$imageName);
            $image->move('../../uploads/businesspartners/payment_proofs', $imageName);

        $wallet->tx_proof = $imageName;    
        }
$wallet->save();
        return redirect()->back()->with('success', 'Offline payment request submitted. Awaiting approval.');
        }
        
        
        
        
    }
    
    public function success(Request $request)
    {
         $user = Session::get('user');
        $userid = $user['id'];
        $wallet = Wallet::where('bp_id',$userid)->get();
        $url = request()->getSchemeAndHttpHost();
        $paymentId = $request->input('token');
        $response = $this->provider->capturePaymentOrder($paymentId);

    $user = Session::get('user');
    $userid = $user['id'];
    $business_partner = Business_Partner::where('id',$userid)->first();
    $amount = $business_partner->wallet_amount;

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            // Update wallet entry
            $wallet = Wallet::where('payment_id', $paymentId)->first();
            
            if ($wallet) {
                
                $wallet_am = $wallet->amount;
            $total_amount = $amount + $wallet_am;
            
            $business_up = Business_Partner::where('id',$userid)->first();
            $business_up->wallet_amount = $total_amount;
            $business_up->update();    
                
                $wallet->payer_id = $response['payer']['payer_id'];
                $wallet->payer_email = $response['payer']['payer_info']['email_address'] ?? null;
                $wallet->status = 1; // Completed
                $wallet->save();

                // Optionally store in transactions table
                Transaction::create([
                    'payment_id' => $response['id'],
                    'payer_id' => $response['payer']['payer_id'],
                    'payer_email' => $response['payer']['payer_info']['email_address'] ?? null,
                    'amount' => $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'],
                    'currency' => $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'],
                    'payment_status' => $response['status'],
                ]);
                
        // return view('wallet_transaction',compact('wallet','url'));
                return redirect()->route('wallet_transaction')->with([
        'success' => 'Payment successful! Wallet updated.',
        'wallet' => $wallet,
        'url' => $url
    ]);

            }

            return redirect()->route('wallet_transaction.cancel')->with('error', 'Wallet entry not found.');
        }

        return redirect()->route('wallet_transaction.cancel')->with('error', 'Payment failed.');
    }
    
    public function cancel()
    {
        return view('cancel')->with('error', 'Payment was cancelled.');
    }

    public function status()
    {
        return view('status');
    }
}