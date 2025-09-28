<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Country;
use App\Models\Region;
use App\Models\State;
use App\Models\City;
use App\Models\Customer;
use App\Models\Customer_group;
use App\Models\Business_Partner;
use App\Models\Lottery;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use Illuminate\Support\Facades\File;
use Hash;

class ProfileController extends Controller
{
    /**

     * Write code on Method

     *

     * @return response()

     */

     public function index(){
        $user= Session::get('user');
        $customer = Customer::find($user['id']);
        $country = Country::get();
        return view('profile',compact('customer','country'));
     }
    
    public function updateAvatar(Request $request)
    {
        $user = session('user');
        if (!$user || !$request->hasFile('avatar')) {
            return back()->with('error', 'No file or user session found.');
        }
        
        $file = $request->file('avatar');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $customerId = $user['id'];
        $folder = "../../uploads/customer/profile_image/";
        
        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0755, true);
        }
        
        $file->move($folder, $filename);
        
        // Update image path in database (example)
        DB::table('customers')
        ->where('id', $customerId)
        ->update(['profile_image' => "$filename"]);
        return back()->with('success', 'Profile image updated!');
    }

    function get_country(Request $request){
        // dd($request->country_id);
        $city = State::where('country_id',$request->country_id)->get();
        return response()->json($city);
    }
    
    function get_state(Request $request){
        // dd($request->country_id);
        $city = City::where('state_id',$request->state_id)->get();
        return response()->json($city);
    } 
 
    public function update_personal(Request $request){
        $user= Session::get('user');
        $customers = Customer::find($user['id']);
        //dd($customers);
        //dd($request->all());
        //dd($request->prefix);
        // $customers = CUstomer::find($request->user_id);
        $customers->prefix = $request->prefix;
        $customers->first_name = $request->first_name;
        $customers->last_name = $request->last_name;
        $customers->dob = Carbon::parse($request->dob)->format('Y-m-d');
        $customers->email	=  $request->email;
        $customers->mobile = $request->mobile;
        $customers->national_id_number = $request->national_id_number;
        $customers->address_line_1 = $request->address_line_1;
        $customers->address_line_2 = $request->address_line_2;
        $customers->country_id = $request->country_id;
        $customers->state_id = $request->state_id;
        $customers->city_id = $request->city_id;
        $customers->zip_code = $request->zip_code;
        // $customers->status = $request->status;

        if ($request->hasFile("national_id_photo")) {
            $image = $request->file("national_id_photo");
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move("../../uploads/customer/national_id_photo/",$imageName);
            $customers->national_id_photo = $imageName;
        }

        if ($request->hasFile("profile_image")) {
            $image = $request->file("profile_image");
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move("../../uploads/customer/profile_image/",$imageName);
            $customers->profile_image = $imageName;
        }
        $customers->update();
        return redirect('profile');
    }
    
    public function update_email(Request $request){
        $customers = CUstomer::find($request->user_id);
        $customers->email = $request->email;
        $customers->update();
        return redirect('profile');
    }
    public function update_number(Request $request){
        $customers = CUstomer::find($request->user_id);
        $customers->mobile = $request->mobile;
        $customers->update();
        return redirect('profile');
    }
    
    public function update_password(Request $request){
         $customers = CUstomer::find($request->user_id);
        $customers->password = Hash::make($request->password);
        $customers->update();
        return redirect('profile');
    }

}
