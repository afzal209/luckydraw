<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Wallet;
use App\Models\Business_Partner;
class WalletTransactionController extends Controller
{
    public function index()
    {
        $wallet = Wallet::get();
        $url = request()->getSchemeAndHttpHost();
        return view('wallet_transaction',compact('wallet','url'));
    }  
 
    public function wallet_create(){
        $business_partner = Business_Partner::get();
        return view('wallet',compact('business_partner'));
    }
 
    function wallet_add(Request $request){
        // dd($request->all());
        $wallet = new Wallet();
        $wallet->bp_id = $request->business_id;
        $wallet->tx_id = $request->tx_id;
        $wallet->tx_date = $request->tx_date;
        $wallet->amount = $request->amount;
        $wallet->tx_type = $request->tx_type; //=Online and 2 Offline
        $wallet->tx_mode = $request->tx_mode; //1= Paypal, 2=Skrill, 3 Bank and 4 Others
        $wallet->remarks = $request->remarks;
        $wallet->status = $request->status;
        $wallet_amount= $request->amount;
        if ($request->file('tx_proof')) {
            $image = $request->file('tx_proof');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            // dd('image/'.$imageName);
            $image->move('../../uploads/businesspartners/payment_proofs', $imageName);
            $wallet->tx_proof = $imageName;
        }
        if($request->status == 1){
            $business_partner = Business_Partner::find($request->business_id);
            $business_wallet_amount = $business_partner->wallet_amount;
            $business_partner->wallet_amount = $business_wallet_amount + $wallet_amount;
            $business_partner->update();
        }
        $wallet->save();
        return redirect('wallet_transaction')->with('success', 'Wallet Amount is Updated');
    }
    
    function approve_wallet($id){
        $wallet = Wallet::find($id);
        $wallet->status = 1;
        $wallet->update();
        $business_partner = Business_Partner::find($wallet->bp_id);
        $business_wallet_amount = $business_partner->wallet_amount;
        $wallet_amount = $wallet->amount;
        $business_partner->wallet_amount = $business_wallet_amount + $wallet_amount;
        $business_partner->update();
        return redirect('wallet_transaction')->with('success', 'Wallet Has been Approved');
    }
    
    function reject_wallet(Request $request,$id){
        $wallet = Wallet::find($id);
        if($wallet){
            $wallet->remarks = $request->remarks;
            $wallet->status = 2;
            $wallet->update();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}