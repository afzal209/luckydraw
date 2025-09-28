<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Hash;
use App\Models\Payment_Gateway;
use App\Models\General_Payment_Gateway;
use App\Models\SmtpMail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;



class SettingController extends Controller
{
    /**

     * Write code on Method

     *

     * @return response()

     */

     public function index()
     {
        $user = Session::get('user');
        $id = $user['id'];
        // $donors = Donor::get();
        $user = User::find($id);
        return view('settings/general_setting',compact('user'));
     }
     
     public function manage_smtp_mail()
     {
        $user = Session::get('user');
        $id = $user['id'];
        
                   

        // $donors = Donor::get();
        $Smtp_mail = SmtpMail::where('user_id',$id)->first();
        
        
      
        
        return view('settings/manage_smtp_mail',compact('Smtp_mail'));
     }
     
     
     
     public function sendSmtpTest(Request $request)
{
    // Validate input
    $request->validate([
        'smtp_from_address' => 'required|email',
        'smtp_from_name' => 'nullable|string',
        'smtp_from_message' => 'required|string',
    ]);

    // Get SMTP settings from your database
    $smtp = SmtpMail::first(); // Modify query as needed
    // dd($smtp);
    // Set mail config dynamically
    Config::set('mail.mailers.smtp', [
        'transport' => $smtp->smtp_mailer,
        'host' => $smtp->smtp_host,
        'port' => $smtp->smtp_port,
        'encryption' => $smtp->smtp_encryption,
        'username' => $smtp->smtp_username,
        'password' => 'aptech123',
        'timeout' => null,
        'auth_mode' => null,
    ]);
    Config::set('mail.from.address', $request->smtp_from_address);
    Config::set('mail.from.name', $request->smtp_from_name ?? 'No Name');

    // Send test mail
    try {
        // dd($request->all());
        Mail::raw($request->smtp_from_message, function ($message) use ($request) {
            $message->to($request->smtp_from_address)
                    ->subject('SMTP Test Mail');
        });

        return back()->with('success', 'Mail sent successfully!');
    } catch (\Exception $e) {
        // dd($e->getMessage());
        return back()->with('error', 'Failed to send mail: ' . $e->getMessage());
    }
}

     
     
     
     public function update(Request $request){
        $user = Session::get('user');
        $id = $user['id'];
        $user = User::find($id);
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->default_time_zone = $request->default_time_zone;
        $user->default_currency = $request->default_currency;
        $user->default_language = $request->default_language;
        $user->company_name = $request->company_name;
        $user->company_website = $request->company_website;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        if ($request->hasFile('profile_pic')) {
            $image = $request->file('profile_pic');
            // dd($image);
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            // dd('image/'.$imageName);
            $image->move('../../uploads/profile', $imageName);

        $user->profile_pic = '../../uploads/profile/'.$imageName;    
        }
        else{
          $user->profile_pic = $user->profile_pic;   
        }
        if ($request->hasFile('company_logo')) {
            $image = $request->file('company_logo');
            // dd($image);
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            // dd('image/'.$imageName);
            $image->move('../../uploads/profile', $imageName);

        $user->company_logo = '../../uploads/profile/'.$imageName;    
        }
        else{
          $user->company_logo = $user->company_logo;   
        }
        $user->update();
        return redirect('settings/general_setting')->with('success', 'Admin Profile has been updated.');
        //  dd($user['id']);
     }
     
     public function payment_gateway(){
        $user = Session::get('user');
        $id = $user['id'];
        $General_Payment_Gateway = General_Payment_Gateway::where('user_id',$id)->first();
        $Payment_Gateway = Payment_Gateway::where('user_id',$id)->first();
        return view('settings/payment_gateway',compact('General_Payment_Gateway','Payment_Gateway'));
     }
     
     
     public function create_general_payment_gateway(Request $request){
        $user = Session::get('user');
        $id = $user['id'];
        if($request->action == 'save'){
        $general_payment = new General_Payment_Gateway();
        $general_payment->user_id = $id;
        $general_payment->default_time_zone = $request->default_time_zone;
        $general_payment->default_currency = $request->default_currency;
        $general_payment->site_global_currency = $request->site_global_currency;
        $general_payment->site_currency_symbol_position = $request->site_currency_symbol_position;
        
        $general_payment->site_inr_to_usd_exchange_rate = $request->site_inr_to_usd_exchange_rate;
        $general_payment->site_inr_to_idr_exchange_rate = $request->site_inr_to_idr_exchange_rate;
        $general_payment->site_inr_to_zar_exchange_rate = $request->site_inr_to_zar_exchange_rate;
        $general_payment->site_inr_to_brl_exchange_rate = $request->site_inr_to_brl_exchange_rate;
        $general_payment->site_inr_to_myr_exchange_rate = $request->site_inr_to_myr_exchange_rate;
        
        $general_payment->save();
        return redirect('settings/payment_gateway')->with('success', 'General Payment Gateway Added.');    
        }
        else{
            $general_payment = General_Payment_Gateway::where('user_id',$id)->first();
        
        $general_payment->default_time_zone = $request->default_time_zone;
        $general_payment->default_currency = $request->default_currency;
        $general_payment->site_global_currency = $request->site_global_currency;
        $general_payment->site_currency_symbol_position = $request->site_currency_symbol_position;
        
        $general_payment->site_inr_to_usd_exchange_rate = $request->site_inr_to_usd_exchange_rate;
        $general_payment->site_inr_to_idr_exchange_rate = $request->site_inr_to_idr_exchange_rate;
        $general_payment->site_inr_to_zar_exchange_rate = $request->site_inr_to_zar_exchange_rate;
        $general_payment->site_inr_to_brl_exchange_rate = $request->site_inr_to_brl_exchange_rate;
        $general_payment->site_inr_to_myr_exchange_rate = $request->site_inr_to_myr_exchange_rate;
        
        $general_payment->update();
        return redirect('settings/payment_gateway')->with('success', 'General Payment Gateway Update.');
        }
        
        
        //  dd($user['id']);
     }
     
     
     public function create_international_payment_gateway(Request $request){
            $user = Session::get('user');
        $id = $user['id'];
         
        if($request->action_payment == 'save'){
        $general_payment = new Payment_Gateway();
        $general_payment->user_id = $id;
            $general_payment->paypal_gateway = $request->paypal_gateway;
        $general_payment->paypal_mode = $request->paypal_mode;
        $general_payment->paypal_sandbox_client_id = $request->paypal_sandbox_client_id;
        $general_payment->paypal_sandbox_client_secret = $request->paypal_sandbox_client_secret;
        
        $general_payment->paypal_sandbox_app_id = $request->paypal_sandbox_app_id;
        $general_payment->paypal_live_client_id = $request->paypal_live_client_id;
        $general_payment->paypal_live_client_secret = $request->paypal_live_client_secret;
        $general_payment->paypal_live_app_id = $request->paypal_live_app_id;
        if ($request->hasFile('paypal_preview_logo')) {
            dd('yes');
            $image = $request->file('paypal_preview_logo');
            // dd($image);
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            // dd('image/'.$imageName);
            $image->move('../../uploads/payment', $imageName);

        $general_payment->paypal_preview_logo = '../../uploads/payment/'.$imageName;    
        }
       
        // $general_payment->paypal_preview_logo = $request->paypal_preview_logo;
         $general_payment->razorpay_gateway = $request->razorpay_gateway;
          $general_payment->razorpay_gateway = $request->razorpay_gateway;
           $general_payment->razorpay_api_key = $request->razorpay_api_key;
           $general_payment->razorpay_api_secret = $general_payment->razorpay_api_secret;
           if ($request->hasFile('razorpay_preview_logo')) {
            $image = $request->file('razorpay_preview_logo');
            // dd($image);
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            // dd('image/'.$imageName);
            $image->move('../../uploads/payment', $imageName);

        $general_payment->razorpay_preview_logo = '../../uploads/payment/'.$imageName;    
        }
       
            // $general_payment->razorpay_preview_logo = $request->razorpay_preview_logo;
             $general_payment->instamojo_gateway = $request->instamojo_gateway;
              $general_payment->instamojo_mode = $request->instamojo_mode;
               $general_payment->instamojo_client_id = $request->instamojo_client_id;
                $general_payment->instamojo_client_id = $request->instamojo_client_id;
                 $general_payment->instamojo_username = $request->instamojo_username;
                 
                  $general_payment->instamojo_password = $request->instamojo_password;
                  if ($request->hasFile('instamojo_preview_logo')) {
                        $image = $request->file('instamojo_preview_logo');
                        // dd($image);
                        $imageName = time() . '.' . $image->getClientOriginalExtension();
                        // dd('image/'.$imageName);
                        $image->move('../../uploads/payment', $imageName);
            
                    $general_payment->instamojo_preview_logo = '../../uploads/payment/'.$imageName;    
                    }
                //   $general_payment->instamojo_preview_logo = $request->instamojo_preview_logo;
                    $general_payment->stripe_gateway = $request->stripe_gateway;
                     $general_payment->stripe_mode = $request->stripe_mode;
                     $general_payment->stripe_public_key = $request->stripe_public_key;
                     if ($request->hasFile('stripe_preview_logo')) {
                        $image = $request->file('stripe_preview_logo');
                        // dd($image);
                        $imageName = time() . '.' . $image->getClientOriginalExtension();
                        // dd('image/'.$imageName);
                        $image->move('../../uploads/payment', $imageName);
            
                    $general_payment->stripe_preview_logo = '../../uploads/payment/'.$imageName;    
                    }
                    //  $general_payment->stripe_preview_logo = $request->stripe_preview_logo;
                     $general_payment->mollie_gateway = $request->mollie_gateway;
                     $general_payment->mollie_mode = $request->mollie_mode;
                     $general_payment->mollie_public_key = $request->mollie_public_key;
                     if ($request->hasFile('mollie_preview_logo')) {
                        $image = $request->file('mollie_preview_logo');
                        // dd($image);
                        $imageName = time() . '.' . $image->getClientOriginalExtension();
                        // dd('image/'.$imageName);
                        $image->move('../../uploads/payment', $imageName);
            
                    $general_payment->mollie_preview_logo = '../../uploads/payment/'.$imageName;    
                    }
                    //  $general_payment->mollie_preview_logo = $request->mollie_preview_logo;
                     $general_payment->flw_gateway = $request->flw_gateway;
                     $general_payment->flw_mode = $request->flw_mode;
                     $general_payment->flw_public_key = $request->flw_public_key;
                     $general_payment->flw_secret_key = $request->flw_secret_key;
                     $general_payment->flw_secret_hash = $request->flw_secret_hash;
                      if ($request->hasFile('flw_preview_logo')) {
                        $image = $request->file('flw_preview_logo');
                        // dd($image);
                        $imageName = time() . '.' . $image->getClientOriginalExtension();
                        // dd('image/'.$imageName);
                        $image->move('../../uploads/payment', $imageName);
            
                    $general_payment->flw_preview_logo = '../../uploads/payment/'.$imageName;    
                    }
                    //  $general_payment->flw_preview_logo = $request->flw_preview_logo;
                     $general_payment->authorizenet_gateway = $request->authorizenet_gateway;
                     $general_payment->authorizenet_mode = $request->authorizenet_mode;
                     $general_payment->authorizenet_merchant_login_id = $request->authorizenet_merchant_login_id;
                     $general_payment->authorizenet_merchant_transaction_id = $request->authorizenet_merchant_transaction_id;
                     if ($request->hasFile('authorizenet_preview_logo')) {
                        $image = $request->file('authorizenet_preview_logo');
                        // dd($image);
                        $imageName = time() . '.' . $image->getClientOriginalExtension();
                        // dd('image/'.$imageName);
                        $image->move('../../uploads/payment', $imageName);
            
                    $general_payment->authorizenet_preview_logo = '../../uploads/payment/'.$imageName;    
                    }
                    //  $general_payment->authorizenet_preview_logo = $request->authorizenet_preview_logo;
                     $general_payment->midtrans_gateway = $request->midtrans_gateway;
                     $general_payment->midtrans_mode = $request->midtrans_mode;
                     $general_payment->midtrans_merchant_id = $request->midtrans_merchant_id;
                     $general_payment->midtrans_server_key = $request->midtrans_server_key;
                     $general_payment->midtrans_client_key = $request->flw_preview_logo;
                     $general_payment->midtrans_environment = $request->midtrans_environment;
                     if ($request->hasFile('midtrans_preview_logo')) {
                        $image = $request->file('midtrans_preview_logo');
                        // dd($image);
                        $imageName = time() . '.' . $image->getClientOriginalExtension();
                        // dd('image/'.$imageName);
                        $image->move('../../uploads/payment', $imageName);
            
                    $general_payment->midtrans_preview_logo = '../../uploads/payment/'.$imageName;    
                    }
                    //  $general_payment->midtrans_preview_logo = $request->midtrans_preview_logo;
                     $general_payment->payfast_gateway = $request->payfast_gateway;
                     $general_payment->payfast_merchant_env = $request->payfast_merchant_env;
                     $general_payment->payfast_itn_url = $request->payfast_itn_url;
                     
                      if ($request->hasFile('payfast_preview_logo')) {
                        $image = $request->file('payfast_preview_logo');
                        // dd($image);
                        $imageName = time() . '.' . $image->getClientOriginalExtension();
                        // dd('image/'.$imageName);
                        $image->move('../../uploads/payment', $imageName);
            
                    $general_payment->payfast_preview_logo = '../../uploads/payment/'.$imageName;    
                    }
                    //  $general_payment->payfast_preview_logo = $request->payfast_preview_logo;
                    //  $general_payment->payfast_preview_logo = $request->payfast_preview_logo;
                     $general_payment->cashfree_mode = $request->cashfree_mode;
                     $general_payment->cashfree_app_id = $request->cashfree_app_id;
                     $general_payment->cashfree_secret_key = $request->cashfree_secret_key;
                      if ($request->hasFile('cashfree_preview_logo')) {
                        $image = $request->file('cashfree_preview_logo');
                        // dd($image);
                        $imageName = time() . '.' . $image->getClientOriginalExtension();
                        // dd('image/'.$imageName);
                        $image->move('../../uploads/payment', $imageName);
            
                    $general_payment->cashfree_preview_logo = '../../uploads/payment/'.$imageName;    
                    }
                    //  $general_payment->cashfree_preview_logo = $request->cashfree_preview_logo;
                     $general_payment->marcado_pago_gateway = $request->marcado_pago_gateway;
                     $general_payment->marcado_pago_mode = $request->marcado_pago_mode;
                     $general_payment->marcado_pago_client_id = $request->marcado_pago_client_id;
                     $general_payment->marcado_pago_client_secret = $request->marcadopago_preview_logo;
                      if ($request->hasFile('marcadopago_preview_logo')) {
                        $image = $request->file('marcadopago_preview_logo');
                        // dd($image);
                        $imageName = time() . '.' . $image->getClientOriginalExtension();
                        // dd('image/'.$imageName);
                        $image->move('../../uploads/payment', $imageName);
            
                    $general_payment->marcadopago_preview_logo = '../../uploads/payment/'.$imageName;    
                    }
                    //  $general_payment->marcadopago_preview_logo = $request->marcadopago_preview_logo;
                     $general_payment->squareup_gateway = $request->squareup_gateway;
                     $general_payment->squareup_mode = $request->squareup_mode;
                     $general_payment->squareup_access_token = $request->squareup_access_token;
                     $general_payment->squareup_location_id = $request->squareup_location_id;
                      if ($request->hasFile('squareup_preview_logo')) {
                        $image = $request->file('squareup_preview_logo');
                        // dd($image);
                        $imageName = time() . '.' . $image->getClientOriginalExtension();
                        // dd('image/'.$imageName);
                        $image->move('../../uploads/payment', $imageName);
            
                    $general_payment->squareup_preview_logo = '../../uploads/payment/'.$imageName;    
                    }
                     
                     $general_payment->flutterwave_gateway = $request->flutterwave_gateway;
                     $general_payment->flutterwave_mode = $request->flutterwave_mode;
                     $general_payment->flutterwave_client_id = $request->flutterwave_client_id;
                     $general_payment->flutterwave_client_secret = $request->flutterwave_client_secret;
                       if ($request->hasFile('flutterwave_preview_logo')) {
                        $image = $request->file('flutterwave_preview_logo');
                        // dd($image);
                        $imageName = time() . '.' . $image->getClientOriginalExtension();
                        // dd('image/'.$imageName);
                        $image->move('../../uploads/payment', $imageName);
            
                    $general_payment->flutterwave_preview_logo = '../../uploads/payment/'.$imageName;    
                    }
                    //  $general_payment->flutterwave_preview_logo = $request->flutterwave_preview_logo;
                $general_payment->paystack_gateway = $request->paystack_gateway;
                $general_payment->paystack_mode = $request->paystack_mode;
                $general_payment->paystack_client_id = $request->paystack_client_id;
                $general_payment->paystack_client_secret = $request->paystack_client_secret;
                  if ($request->hasFile('paystack_preview_logo')) {
                        $image = $request->file('paystack_preview_logo');
                        // dd($image);
                        $imageName = time() . '.' . $image->getClientOriginalExtension();
                        // dd('image/'.$imageName);
                        $image->move('../../uploads/payment', $imageName);
            
                    $general_payment->paystack_preview_logo = '../../uploads/payment/'.$imageName;    
                    }
                // $general_payment->paystack_preview_logo = $request->paystack_preview_logo;
                $general_payment->cinetpay_gateway = $request->cinetpay_gateway;
                $general_payment->cinetpay_mode = $request->cinetpay_mode;
                $general_payment->cinetpay_api_key = $request->cinetpay_api_key;
                $general_payment->cinetpay_site_id = $request->cinetpay_site_id;
                if ($request->hasFile('cinetpay_preview_logo')) {
                        $image = $request->file('cinetpay_preview_logo');
                        // dd($image);
                        $imageName = time() . '.' . $image->getClientOriginalExtension();
                        // dd('image/'.$imageName);
                        $image->move('../../uploads/payment', $imageName);
            
                    $general_payment->cinetpay_preview_logo = '../../uploads/payment/'.$imageName;    
                    }
                
                // $general_payment->cinetpay_preview_logo = $request->cinetpay_preview_logo;
                $general_payment->zitopay_gateway = $request->zitopay_gateway;
                $general_payment->zitopay_mode = $request->zitopay_mode;
                $general_payment->zitopay_username = $request->zitopay_username;
                $general_payment->zitopay_preview_logo = $request->zitopay_preview_logo;
                  if ($request->hasFile('zitopay_preview_logo')) {
                        $image = $request->file('zitopay_preview_logo');
                        // dd($image);
                        $imageName = time() . '.' . $image->getClientOriginalExtension();
                        // dd('image/'.$imageName);
                        $image->move('../../uploads/payment', $imageName);
            
                    $general_payment->zitopay_preview_logo = '../../uploads/payment/'.$imageName;    
                    }
                 $general_payment->save();
        return redirect('settings/payment_gateway')->with('success', 'General Payment Gateway Added.'); 
        }
        else{
            // dd($request->all());
            $general_payment = Payment_Gateway::where('user_id',$id)->first();
       
        $request->validate([
        'paypal_preview_logo' => 'nullable|image|mimes:jpeg,png|max:2048',
        'razorpay_preview_logo' => 'nullable|image|mimes:jpeg,png|max:2048',
        'instamojo_preview_logo' => 'nullable|image|mimes:jpeg,png|max:2048',
    ]);
        
            $general_payment->paypal_gateway = $request->paypal_gateway;
        $general_payment->paypal_mode = $request->paypal_mode;
        $general_payment->paypal_sandbox_client_id = $request->paypal_sandbox_client_id;
        $general_payment->paypal_sandbox_client_secret = $request->paypal_sandbox_client_secret;
        
        $general_payment->paypal_sandbox_app_id = $request->paypal_sandbox_app_id;
        $general_payment->paypal_live_client_id = $request->paypal_live_client_id;
        $general_payment->paypal_live_client_secret = $request->paypal_live_client_secret;
        $general_payment->paypal_live_app_id = $request->paypal_live_app_id;
        // if ($request->hasFile('paypal_preview_logo')) {
        //     // dd('Yes');
        //     $image1 = $request->file('paypal_preview_logo');
        //     // dd($image);
        //     $imageName1 = time() . '.' . $image1->getClientOriginalExtension();
        //     // dd('image/'.$imageName);
        //     $image1->move('../../uploads/payment', $imageName1);

        // $general_payment->paypal_preview_logo = '../../uploads/payment/'.$imageName1;    
        // }
        // else{
        //     // dd('NO');
        //     $general_payment->paypal_preview_logo = $general_payment->paypal_preview_logo;
        // }
        // // $general_payment->paypal_preview_logo = $request->paypal_preview_logo;
        //  $general_payment->razorpay_gateway = $request->razorpay_gateway;
        //   $general_payment->razorpay_gateway = $request->razorpay_gateway;
        //   $general_payment->razorpay_api_key = $request->razorpay_api_key;
        //   $general_payment->razorpay_api_secret = $general_payment->razorpay_api_secret;
        //   if ($request->hasFile('razorpay_preview_logo')) {
        //     $image2 = $request->file('razorpay_preview_logo');
        //     // dd($image);
        //     $imageName2 = time() . '.' . $image2->getClientOriginalExtension();
        //     // dd('image/'.$imageName);
        //     $image2->move('../../uploads/payment', $imageName2);

        // $general_payment->razorpay_preview_logo = '../../uploads/payment/'.$imageName2;    
        // }
        // else{
        //     // dd('NO');
        //     $general_payment->razorpay_preview_logo = $general_payment->razorpay_preview_logo;
        // }
        //     // $general_payment->razorpay_preview_logo = $request->razorpay_preview_logo;
        //      $general_payment->instamojo_gateway = $request->instamojo_gateway;
        //       $general_payment->instamojo_mode = $request->instamojo_mode;
        //       $general_payment->instamojo_client_id = $request->instamojo_client_id;
        //         $general_payment->instamojo_client_id = $request->instamojo_client_id;
        //          $general_payment->instamojo_username = $request->instamojo_username;
                 
        //           $general_payment->instamojo_password = $request->instamojo_password;
        //           if ($request->hasFile('instamojo_preview_logo')) {
        //                 $image3 = $request->file('instamojo_preview_logo');
        //                 // dd($image);
        //                 $imageName3 = time() . '.' . $image3->getClientOriginalExtension();
        //                 // dd('image/'.$imageName);
        //                 $image3->move('../../uploads/payment', $imageName3);
            
        //             $general_payment->instamojo_preview_logo = '../../uploads/payment/'.$imageName3;    
        //             }
        //             else{
        //     // dd('NO');
        //     $general_payment->instamojo_preview_logo = $general_payment->instamojo_preview_logo;
        // }
        
        if ($request->hasFile('paypal_preview_logo')) {
        $image = $request->file('paypal_preview_logo');
        $imageName = 'paypal_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move('../../uploads/payment', $imageName);
        $general_payment->paypal_preview_logo = '../../uploads/payment/' . $imageName;
    }  else{
        //     // dd('NO');
            $general_payment->paypal_preview_logo = $general_payment->paypal_preview_logo;
        }

    // Update Razorpay settings
    $general_payment->razorpay_gateway = $request->razorpay_gateway;
    $general_payment->razorpay_mode = $request->razorpay_mode;
    $general_payment->razorpay_api_key = $request->razorpay_api_key;
    $general_payment->razorpay_api_secret = $request->razorpay_api_secret;

    if ($request->hasFile('razorpay_preview_logo')) {
        $image = $request->file('razorpay_preview_logo');
        $imageName = 'razorpay_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move('../../uploads/payment', $imageName);
        $general_payment->razorpay_preview_logo = '../../uploads/payment/' . $imageName;
    } else{
        //     // dd('NO');
            $general_payment->razorpay_preview_logo = $general_payment->razorpay_preview_logo;
        }

    // Update Instamojo settings
    $general_payment->instamojo_gateway = $request->instamojo_gateway;
    $general_payment->instamojo_mode = $request->instamojo_mode;
    $general_payment->instamojo_client_id = $request->instamojo_client_id;
    $general_payment->instamojo_client_secret = $request->instamojo_client_secret;
    $general_payment->instamojo_username = $request->instamojo_username;
    $general_payment->instamojo_password = $request->instamojo_password;

    if ($request->hasFile('instamojo_preview_logo')) {
        $image = $request->file('instamojo_preview_logo');
        $imageName = 'instamojo_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move('../../uploads/payment', $imageName);
        $general_payment->instamojo_preview_logo = '../../uploads/payment/' . $imageName;
    } else{
        //     // dd('NO');
            $general_payment->instamojo_preview_logo = $general_payment->instamojo_preview_logo;
        }
        
        
                //   $general_payment->instamojo_preview_logo = $request->instamojo_preview_logo;
                    $general_payment->stripe_gateway = $request->stripe_gateway;
                     $general_payment->stripe_mode = $request->stripe_mode;
                     $general_payment->stripe_public_key = $request->stripe_public_key;
                     if ($request->hasFile('stripe_preview_logo')) {
                        //  dd('yes');
                        $image = $request->file('stripe_preview_logo');
                        // dd($image);
                        $imageName = 'strip_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                        // dd('image/'.$imageName);
                        $image->move('../../uploads/payment', $imageName);
            
                    $general_payment->stripe_preview_logo = '../../uploads/payment/'.$imageName;    
                    }
                    else{
            // dd('NO');
            $general_payment->stripe_preview_logo = $general_payment->stripe_preview_logo;
        }
                    //  $general_payment->stripe_preview_logo = $request->stripe_preview_logo;
                     $general_payment->mollie_gateway = $request->mollie_gateway;
                     $general_payment->mollie_mode = $request->mollie_mode;
                     $general_payment->mollie_public_key = $request->mollie_public_key;
                     if ($request->hasFile('mollie_preview_logo')) {
                        $image = $request->file('mollie_preview_logo');
                        // dd($image);
                        $imageName = 'mobile_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                        // dd('image/'.$imageName);
                        $image->move('../../uploads/payment', $imageName);
            
                    $general_payment->mollie_preview_logo = '../../uploads/payment/'.$imageName;    
                    }
                               else{
            // dd('NO');
            $general_payment->mollie_preview_logo = $general_payment->mollie_preview_logo;
        }
                    //  $general_payment->mollie_preview_logo = $request->mollie_preview_logo;
                     $general_payment->flw_gateway = $request->flw_gateway;
                     $general_payment->flw_mode = $request->flw_mode;
                     $general_payment->flw_public_key = $request->flw_public_key;
                     $general_payment->flw_secret_key = $request->flw_secret_key;
                     $general_payment->flw_secret_hash = $request->flw_secret_hash;
                      if ($request->hasFile('flw_preview_logo')) {
                        $image = $request->file('flw_preview_logo');
                        // dd($image);
                        $imageName = 'flw_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                        // dd('image/'.$imageName);
                        $image->move('../../uploads/payment', $imageName);
            
                    $general_payment->flw_preview_logo = '../../uploads/payment/'.$imageName;    
                    }
                                       else{
            // dd('NO');
            $general_payment->flw_preview_logo = $general_payment->flw_preview_logo;
        }
                    //  $general_payment->flw_preview_logo = $request->flw_preview_logo;
                     $general_payment->authorizenet_gateway = $request->authorizenet_gateway;
                     $general_payment->authorizenet_mode = $request->authorizenet_mode;
                     $general_payment->authorizenet_merchant_login_id = $request->authorizenet_merchant_login_id;
                     $general_payment->authorizenet_merchant_transaction_id = $request->authorizenet_merchant_transaction_id;
                     if ($request->hasFile('authorizenet_preview_logo')) {
                        $image = $request->file('authorizenet_preview_logo');
                        // dd($image);
                        $imageName = 'authorizenet_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                        // dd('image/'.$imageName);
                        $image->move('../../uploads/payment', $imageName);
            
                    $general_payment->authorizenet_preview_logo = '../../uploads/payment/'.$imageName;    
                    }
                                               else{
            // dd('NO');
            $general_payment->authorizenet_preview_logo = $general_payment->authorizenet_preview_logo;
        }
                    //  $general_payment->authorizenet_preview_logo = $request->authorizenet_preview_logo;
                     $general_payment->midtrans_gateway = $request->midtrans_gateway;
                     $general_payment->midtrans_mode = $request->midtrans_mode;
                     $general_payment->midtrans_merchant_id = $request->midtrans_merchant_id;
                     $general_payment->midtrans_server_key = $request->midtrans_server_key;
                     $general_payment->midtrans_client_key = $request->flw_preview_logo;
                     $general_payment->midtrans_environment = $request->midtrans_environment;
                     if ($request->hasFile('midtrans_preview_logo')) {
                        $image = $request->file('midtrans_preview_logo');
                        // dd($image);
                        $imageName = 'midtrans_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                        // dd('image/'.$imageName);
                        $image->move('../../uploads/payment', $imageName);
            
                    $general_payment->midtrans_preview_logo = '../../uploads/payment/'.$imageName;    
                    }
                        else{
            // dd('NO');
            $general_payment->midtrans_preview_logo = $general_payment->midtrans_preview_logo;
        }
                    //  $general_payment->midtrans_preview_logo = $request->midtrans_preview_logo;
                     $general_payment->payfast_gateway = $request->payfast_gateway;
                     $general_payment->payfast_merchant_env = $request->payfast_merchant_env;
                     $general_payment->payfast_itn_url = $request->payfast_itn_url;
                     
                      if ($request->hasFile('payfast_preview_logo')) {
                        $image = $request->file('payfast_preview_logo');
                        // dd($image);
                        $imageName = 'payfast_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                        // dd('image/'.$imageName);
                        $image->move('../../uploads/payment', $imageName);
            
                    $general_payment->payfast_preview_logo = '../../uploads/payment/'.$imageName;    
                    }
                  
                    //  $general_payment->payfast_preview_logo = $request->payfast_preview_logo;
                      else{
            // dd('NO');
            $general_payment->payfast_preview_logo = $general_payment->payfast_preview_logo;
        }
        //  $general_payment->payfast_preview_logo = $request->payfast_preview_logo;
                     $general_payment->cashfree_mode = $request->cashfree_mode;
                     $general_payment->cashfree_app_id = $request->cashfree_app_id;
                     $general_payment->cashfree_secret_key = $request->cashfree_secret_key;
                      if ($request->hasFile('cashfree_preview_logo')) {
                        $image = $request->file('cashfree_preview_logo');
                        // dd($image);
                        $imageName = 'cashfree_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                        // dd('image/'.$imageName);
                        $image->move('../../uploads/payment', $imageName);
            
                    $general_payment->cashfree_preview_logo = '../../uploads/payment/'.$imageName;    
                    }
                      else{
            // dd('NO');
            $general_payment->cashfree_preview_logo = $general_payment->cashfree_preview_logo;
        }
                    //  $general_payment->cashfree_preview_logo = $request->cashfree_preview_logo;
                     $general_payment->marcado_pago_gateway = $request->marcado_pago_gateway;
                     $general_payment->marcado_pago_mode = $request->marcado_pago_mode;
                     $general_payment->marcado_pago_client_id = $request->marcado_pago_client_id;
                     $general_payment->marcado_pago_client_secret = $request->marcadopago_preview_logo;
                      if ($request->hasFile('marcadopago_preview_logo')) {
                        $image = $request->file('marcadopago_preview_logo');
                        // dd($image);
                        $imageName = 'marcadopago_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                        // dd('image/'.$imageName);
                        $image->move('../../uploads/payment', $imageName);
            
                    $general_payment->marcadopago_preview_logo = '../../uploads/payment/'.$imageName;    
                    }
                       else{
            // dd('NO');
            $general_payment->marcadopago_preview_logo = $general_payment->marcadopago_preview_logo;
        }
                    //  $general_payment->marcadopago_preview_logo = $request->marcadopago_preview_logo;
                     $general_payment->squareup_gateway = $request->squareup_gateway;
                     $general_payment->squareup_mode = $request->squareup_mode;
                     $general_payment->squareup_access_token = $request->squareup_access_token;
                     $general_payment->squareup_location_id = $request->squareup_location_id;
                      if ($request->hasFile('squareup_preview_logo')) {
                        $image = $request->file('squareup_preview_logo');
                        // dd($image);
                        $imageName = 'squareup_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                        // dd('image/'.$imageName);
                        $image->move('../../uploads/payment', $imageName);
            
                    $general_payment->squareup_preview_logo = '../../uploads/payment/'.$imageName;    
                    }
                      else{
            // dd('NO');
            $general_payment->squareup_preview_logo = $general_payment->squareup_preview_logo;
        }
                     
                     $general_payment->flutterwave_gateway = $request->flutterwave_gateway;
                     $general_payment->flutterwave_mode = $request->flutterwave_mode;
                     $general_payment->flutterwave_client_id = $request->flutterwave_client_id;
                     $general_payment->flutterwave_client_secret = $request->flutterwave_client_secret;
                       if ($request->hasFile('flutterwave_preview_logo')) {
                        $image = $request->file('flutterwave_preview_logo');
                        // dd($image);
                        $imageName = 'flutterwave_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                        // dd('image/'.$imageName);
                        $image->move('../../uploads/payment', $imageName);
            
                    $general_payment->flutterwave_preview_logo = '../../uploads/payment/'.$imageName;    
                    }
                         else{
            // dd('NO');
            $general_payment->flutterwave_preview_logo = $general_payment->flutterwave_preview_logo;
        }
                    //  $general_payment->flutterwave_preview_logo = $request->flutterwave_preview_logo;
                $general_payment->paystack_gateway = $request->paystack_gateway;
                $general_payment->paystack_mode = $request->paystack_mode;
                $general_payment->paystack_client_id = $request->paystack_client_id;
                $general_payment->paystack_client_secret = $request->paystack_client_secret;
                  if ($request->hasFile('paystack_preview_logo')) {
                        $image = $request->file('paystack_preview_logo');
                        // dd($image);
                        $imageName = 'paystack_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                        // dd('image/'.$imageName);
                        $image->move('../../uploads/payment', $imageName);
            
                    $general_payment->paystack_preview_logo = '../../uploads/payment/'.$imageName;    
                    }
                         else{
            // dd('NO');
            $general_payment->paystack_preview_logo = $general_payment->paystack_preview_logo;
        }
                // $general_payment->paystack_preview_logo = $request->paystack_preview_logo;
                $general_payment->cinetpay_gateway = $request->cinetpay_gateway;
                $general_payment->cinetpay_mode = $request->cinetpay_mode;
                $general_payment->cinetpay_api_key = $request->cinetpay_api_key;
                $general_payment->cinetpay_site_id = $request->cinetpay_site_id;
                if ($request->hasFile('cinetpay_preview_logo')) {
                        $image = $request->file('cinetpay_preview_logo');
                        // dd($image);
                        $imageName = 'cinetpay_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                        // dd('image/'.$imageName);
                        $image->move('../../uploads/payment', $imageName);
            
                    $general_payment->cinetpay_preview_logo = '../../uploads/payment/'.$imageName;    
                    }
                         else{
            // dd('NO');
            $general_payment->cinetpay_preview_logo = $general_payment->cinetpay_preview_logo;
        }
                
                // $general_payment->cinetpay_preview_logo = $request->cinetpay_preview_logo;
                $general_payment->zitopay_gateway = $request->zitopay_gateway;
                $general_payment->zitopay_mode = $request->zitopay_mode;
                $general_payment->zitopay_username = $request->zitopay_username;
                
                  if ($request->hasFile('zitopay_preview_logo')) {
                        $image = $request->file('zitopay_preview_logo');
                        // dd($image);
                        $imageName = 'zitopay_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                        // dd('image/'.$imageName);
                        $image->move('../../uploads/payment', $imageName);
            
                    $general_payment->zitopay_preview_logo = '../../uploads/payment/'.$imageName;    
                    }
                     else{
            // dd('NO');
            $general_payment->zitopay_preview_logo = $general_payment->zitopay_preview_logo;
        }
        // dd($general_payment);
        
        
                 $general_payment->update();
        return redirect('settings/payment_gateway')->with('success', 'General Payment Gateway Updated.'); 
        }
        
        
         
     }
     
      public function save_smtp(Request $request){
        $user = Session::get('user');
        $id = $user['id'];
        if($request->action == 'save'){
        $mail = new SmtpMail();
        $mail->user_id = $id;
        $mail->smtp_mailer = $request->smtp_mailer;
        $mail->smtp_host = $request->smtp_host;
        $mail->smtp_port = $request->smtp_port;
        $mail->smtp_username = $request->smtp_username;
        
        $mail->smtp_password = Hash::make($request->smtp_password);
        $mail->smtp_encryption = $request->smtp_encryption;
        
        
        $mail->save();
        return redirect('settings/manage_smtp_mail')->with('success', 'SMTP Added.');    
        }
        else{
            $mail = SmtpMail::where('user_id',$id)->first();
    
        $mail->smtp_mailer = $request->smtp_mailer;
        $mail->smtp_host = $request->smtp_host;
        $mail->smtp_port = $request->smtp_port;
        $mail->smtp_username = $request->smtp_username;
        
        $mail->smtp_password = Hash::make($request->smtp_password);
        $mail->smtp_encryption = $request->smtp_encryption;
        
        $mail->update();
        return redirect('settings/manage_smtp_mail')->with('success', 'SMTP Updated');
        }
        
        
        //  dd($user['id']);
     }
     
     
}