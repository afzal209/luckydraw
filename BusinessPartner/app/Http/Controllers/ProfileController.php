<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Country;
use App\Models\Region;
use App\Models\State;
use App\Models\City;
use App\Models\Business_Partner;
use Hash;
use Illuminate\Support\Facades\Session;
class ProfileController extends Controller
{
    /**

     * Write code on Method

     *

     * @return response()

     */

     public function index()

     {
        $user = Session::get('user');
         $user_id = $user['id'];
        $business_partner = Business_Partner::find($user_id);
        $country = Country::get();
        // $donors = Donor::get();
        
         
         return view('profile',compact('business_partner','country'));
 
     }  
     
      function get_country(Request $request){
         $state = State::where('country_id',$request->country_id)->get();
        return response()->json($state);
     }
     
     function get_state(Request $request){
         $city = City::where('state_id',$request->state_id)->get();
        return response()->json($city);
     }
 
 
//     function get_country(Request $request){
//         // dd($request->country_id);
//         $city = State::where('country_id',$request->country_id)->get();
//         return response()->json($city);
//     } 
 
 
 function update(Request $request){
        // dd($request);
        $user = Session::get('user');
         $user_id = $user['id'];
         $business_partner = Business_Partner::find($user_id);
        $country = Country::get();
        $business_partner_update = Business_Partner::find($user_id);
       $business_partner_update->poc_first_name =$request->poc_first_name;
        $business_partner_update->poc_last_name =$request->poc_last_name;
        $business_partner_update->poc_email =$request->poc_email;
        $business_partner_update->poc_mobile =$request->poc_mobile;
        $business_partner_update->business_name =$request->business_name;
        $business_partner_update->address_line_1 =$request->address_line_1;    
        $business_partner_update->address_line_2 =$request->address_line_2;
        $business_partner_update->country_id =$request->country_id;
        $business_partner_update->state_id =$request->state_id;
        $business_partner_update->city_id =$request->city_id;
        $business_partner_update->zip_code =$request->zip_code;
        $business_partner_update->update();
        
        // $success = "City has been Added.";
        return redirect('profile')->with('success', 'Profile has been updated.')->with('business_partner',$business_partner)->with('country',$country);
    }
    
    function update_passord(Request $request){
        $user = Session::get('user');
         $user_id = $user['id'];
        $businessPartner = Business_Partner::find($user_id);
        if ($businessPartner && Hash::check($request->current_password, $businessPartner->open_password)) {
            if($request->new_password == $request->confirm_password ){
                $businessPartner->open_password = Hash::make($request->new_password);
                $businessPartner->update();
                 return redirect('profile')->with('success', 'Password Updated Successfuly');
            }
            else{
                 return redirect('profile')->with('error', 'New Password and Confirm Password Not Match.');
            }
        }
        else{
            return redirect('profile')->with('error', 'Current Password Did not match.');
        }
    }
       
 
 
//   function edit($id){
           
//           $country = Country::get();
//           $city = City::select('city.*', 'state.state_title', 'country.country_name')
//         ->join('state', 'city.state_id', '=', 'state.id') // Join city with state
//         ->join('country', 'city.country_id', '=', 'country.id') // Join city with country
//         ->get();
//           $city_edit = City::find($id);
//         // dd($city_edit);
//         return view('city',compact('city','city_edit','country'));
//       } 
      
      
//       function update(Request $request,$id){
//         //   dd($id);
//           $City = City::find($id);
//             $City->country_id =$request->country_id;
//              $City->state_id =$request->state_id;
//         $City->name =$request->name;
//         // $city->status = 1;
//         $City->update();
//         //  return back()->with('success', 'Business Area Has Been Updated.');
//          return redirect('city')->with('success', 'City Has Been Updated');
//       }
      
      
//       function status($id,$actions){
//           if($actions == 1){
//               $city = City::find($id);
//               $city->status = 0;
//               $city->update();
//           }
//           else{
//               $city = City::find($id);
//               $city->status = 1;
//               $city->update();
//           }
//           return redirect('city')->with('success', 'Suspend Has Been Updated');
//       }
      
//       function delete($id){
//           $city = City::find($id);
//           $city->delete();
//           return redirect('city')->with('success', 'Record has been Delete');
      
//       }
     
     
}
