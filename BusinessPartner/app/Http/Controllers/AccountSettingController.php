<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Country;
use App\Models\Region;
use App\Models\State;
use App\Models\City;
use App\Models\Business_Partner;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AccountSettingController extends Controller
{
    /**

     * Write code on Method

     *

     * @return response()

     */

     public function index()

     {
        
        // $donors = Donor::get();
         $user = Session::get('user');
         $user_id = $user['id'];
         
         $Business_Partner = Business_Partner::find($user_id);
        //  dd($Business_Partner);
         return view('setting',compact('Business_Partner'));
 
     }  
 function create(Request $request){
    //  dd($request->all());
     $user = Session::get('user');
         $user_id = $user['id'];
        // dd($request);
        $Business_Partner = Business_Partner::find($user_id);
         $Business_Partner->discount_status =$request->discount_status == 'on' ? 1 : 0;;
         $Business_Partner->default_discount =$request->default_discount;
        $Business_Partner->tax_status =$request->tax_status == 'on' ? 1 : 0;
        $Business_Partner->default_tax =$request->default_tax;
        $Business_Partner->update();
        
        // $success = "City has been Added.";
        return redirect('setting')->with('success', 'Setting has been Added.');
    }
     
     
}
