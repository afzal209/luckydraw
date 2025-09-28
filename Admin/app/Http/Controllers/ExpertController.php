<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Applicant;
use App\Models\Expert;
use App\Models\Paper;
use App\Models\Payment;
use App\Models\State;
use App\Models\District;
use App\Models\City;
use App\Models\Donor;
use Illuminate\Database\Eloquent\Collection;

class ExpertController extends Controller
{
    /**

     * Write code on Method

     *

     * @return response()

     */

     public function index()

     {
        $state = State::get();
         return view('add_expert',compact('state'));
 
     }  
     
     function district_list(Request $request){
        //  dd($request->id);
        
        $district = District::where('state_id',$request->id)->get();
        return response()->json($district);
     }
 
 
 
    function city_list(Request $request){
        $city = City::where('districtid',$request->id)->get();
        return response()->json($city);
    }
       
       
       
    function create(Request $request){
        // dd($request);
        $expert = new Expert();
        $expert->gender =$request->gender;
        $expert->first_name =$request->first_name;
        $expert->last_name =$request->last_name;
        $expert->qualification =$request->qualification;
        $expert->designation =$request->designation;
        $expert->position =$request->position;
        $expert->skill =$request->skill;
        $expert->interest =$request->interest;
        $expert->experiance_years =$request->experiance_years;
        // $expert->expertise_category =$request->expertise_category;
        $expert->email =$request->email;
        $expert->mobile_number =$request->mobile_number;
        $categories = implode(',', $request->expertise_category);
        // $url = 'dist/img/pan_photo';
        // $url1 = 'dist/img/aadhar_photo';
        // $url2 = 'dist/img/certificate';
        // $url3 = 'dist/img/photo';
        if ($request->hasFile("pan_photo")) {
                $filename = time() . "." . $request->pan_photo->extension();
                $request->pan_photo->move(public_path("dist/img/pan_photo"), $filename);
                 $expert->pan_photo = $filename;
               
            }
            if ($request->hasFile("aadhar_photo")) {
                $filename = time() . "." . $request->aadhar_photo->extension();
                $request->aadhar_photo->move(public_path("dist/img/aadhar_photo"), $filename);
                 $expert->aadhar_photo =$filename;
               
            }
            if ($request->hasFile("certificate")) {
                $filename = time() . "." . $request->certificate->extension();
                $request->certificate->move(public_path("dist/img/certificate"), $filename);
                 $expert->certificate =$filename;
               
            }
            if ($request->hasFile("photo")) {
                $filename = time() . "." . $request->photo->extension();
                $request->photo->move(public_path("dist/img/photo"), $filename);
                 $expert->photo =$filename;
               
            }
            $expert->expertise_category =  $categories;
        // $expert->pan_photo =$request->pan_photo;
        // $expert->aadhar_photo =$request->aadhar_photo;
        // $expert->certificate =$request->certificate;
        // $expert->photo =$request->photo;
        $expert->level1 =$request->level1;
        $expert->level2 =$request->level2;
        $expert->level3 =$request->level3;
        $expert->level4 =$request->level4;
        $expert->level5 =$request->level5;
        $expert->bank_account_number =$request->bank_account_number;
        $expert->bank_account_type =$request->bank_account_type;
        $expert->bank_name =$request->bank_name;
        $expert->bank_ifsc =$request->bank_ifsc;
        $expert->upi =$request->upi;
        $expert->address_line_1 =$request->address_line_1;
        $expert->address_line_2 =$request->address_line_2;
        $expert->state_id =$request->state;
        $expert->district_id =$request->district;
        $expert->city_id =$request->city;
        $expert->pincode =$request->pincode;
        $expert->dob =$request->dob;
        $expert->company_name =$request->company_name;
        $expert->save();
        
        
        return back()->with('success', 'Expert Has Been Add.');
    }
 
      function view(){
   $expert = Expert::where('status', 0)
        ->with(['city', 'district', 'state']) // Eager load related models
        ->orderBy('id', 'desc')
        ->paginate(10); // Adjust the number of records per page as needed

    return view('view_expert', compact('expert'));
      }
      
      function edit($id){
           $state = State::get();
           $expert = Expert::where('id', $id)
        ->with(['city', 'district', 'state']) // Eager load related models
        ->first(); // Adjust the number of records per page as needed
        // dd($expert);
        return view('add_expert',compact('state','expert'));
      } 
      function update(Request $request,$id){
        //   return $request;
          $expert = Expert::find($id);
           $expert->gender =$request->gender;
        $expert->first_name =$request->first_name;
        $expert->last_name =$request->last_name;
        $expert->qualification =$request->qualification;
        $expert->designation =$request->designation;
        $expert->position =$request->position;
        $expert->skill =$request->skill;
        $expert->interest =$request->interest;
        $expert->experiance_years =$request->experiance_years;
        $expert->email =$request->email;
        $expert->mobile_number =$request->mobile_number;
        $categories = implode(',', $request->expertise_category);
        $expert->expertise_category =  $categories;
        if ($request->hasFile("pan_photo")) {
            // dd('yes');
                $filename_pan_photo = time() . "." . $request->pan_photo->extension();
                $request->pan_photo->move(public_path("dist/img/pan_photo"), $filename_pan_photo);
                 $expert->pan_photo =$filename_pan_photo;
            //   dd($filename);
            }
            if ($request->hasFile("aadhar_photo")) {
                $filename_aadhar_photo = time() . "." . $request->aadhar_photo->extension();
                $request->aadhar_photo->move(public_path("dist/img/aadhar_photo"), $filename_aadhar_photo);
                 $expert->aadhar_photo =$filename_aadhar_photo;
               
            }
            if ($request->hasFile("certificate")) {
                $filename_certificate = time() . "." . $request->certificate->extension();
                $request->certificate->move(public_path("dist/img/certificate"), $filename_certificate);
                 $expert->certificate =$filename_certificate;
               
            }
            if ($request->hasFile("photo")) {
                $filename_photo = time() . "." . $request->photo->extension();
                $request->photo->move(public_path("dist/img/photo"), $filename_photo);
                 $expert->photo =$filename_photo;
               
            }
            
            $expert->level1 =$request->level1;
        $expert->level2 =$request->level2;
        $expert->level3 =$request->level3;
        $expert->level4 =$request->level4;
        $expert->level5 =$request->level5;
        $expert->bank_account_number =$request->bank_account_number;
        $expert->bank_account_type =$request->bank_account_type;
        $expert->bank_name =$request->bank_name;
        $expert->bank_ifsc =$request->bank_ifsc;
        $expert->upi =$request->upi;
        $expert->address_line_1 =$request->address_line_1;
        $expert->address_line_2 =$request->address_line_2;
        $expert->state_id =$request->state;
        $expert->district_id =$request->district;
        $expert->city_id =$request->city;
        $expert->pincode =$request->pincode;
        $expert->dob =$request->dob;
        $expert->company_name =$request->company_name;
        $expert->update();
        
        return redirect()->route('view_expert');
      }
     
}
