<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Business_Area;
use App\Models\Template_Manager;
use App\Models\Region;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Business_Partner;
use App\Models\Support;
use App\Models\Support_Category;
use Hash;
use Session;
use Illuminate\Support\Facades\DB;
class SupportController extends Controller
{
    /**

     * Write code on Method

     *

     * @return response()

     */

     public function index()

     {
        $total_ticket = Support::count('id');
        $open_ticket = Support::where('status',0)->count('id');
        $under_process_ticket = Support::where('status',1)->count('id');
        $close_ticket = Support::where('status',2)->count('id');
        // $donors = Donor::get();
        $support_category_view =  DB::table('support')
    ->join('support_categories', 'support.categoryid', '=', 'support_categories.id')
    ->select('support.*', 'support_categories.name as category_name')
    ->get();
     $support_category = Support_Category::where('status',1)->get();
        // dd($support_category);
         return view('support',compact('support_category','total_ticket','open_ticket','under_process_ticket','close_ticket','support_category_view'));
 
     }  
     
     
       function create(Request $request){
            $support_category = Support_Category::where('status',1)->get();
           $user = Session::get('user');
        $userid = $user['id'];
        // dd($request);
        
        $support_data = Support::select('id')->latest('support_ticket_id')->first();
        // dd($support_data);
        if ($support_data) {
    $lastNumber = $support_data['id'];
    // $newNumber = $lastNumber++; 
    // dd($lastNumber++);
    $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT); // Increment and format
    // dd($newNumber);
} else {
    $newNumber = '0001'; // Start from 000001 if no records exist
};
        $ticket_no = 'ABC'.$newNumber;
    //   dd($ticket_no);
        $support = new Support();
        $support->support_ticket_id= $ticket_no;
        $support->raised_by_id = $userid;
        $support->raised_by = 1;
        $support->categoryid = $request->categoryid;
        $support->subject = $request->subject;
        $support->description = $request->description;
        $support->status  = 0;
        $support->save();
        return redirect('support')->with('success','Support Has been Add')->with('support_category',$support_category);
    }
 
    // public function view()

    //  {
         
         
    //     // dd($business_Partner);
    //     // $donors = Donor::get();
        
    //     //  $business_area = Business_Area::get();
    //      return view('sale.view_sale');
 
    //  }  
     
//      function get_region(Request $request){
//          $country = Country::where('region_id',$request->region_id)->get();
//         return response()->json($country);
//      }
     
//      function get_country(Request $request){
//          $state = State::where('country_id',$request->country_id)->get();
//         return response()->json($state);
//      }
     
//      function get_state(Request $request){
//          $city = City::where('state_id',$request->state_id)->get();
//         return response()->json($city);
//      }
 
 
//  function create(Request $request){
//         // dd($request);
        
        
//         $request->validate([
//         'prefix' => 'required',  // Required textbox
//         'poc_first_name' => 'required', // Required dropdown
//         'poc_last_name' => 'required', // Required dropdown
//         'poc_email' => 'required', // Required dropdown
//         'poc_mobile' => 'required', // Required dropdown
//         'business_area_id' => 'required', // Required dropdown
//         'business_name' => 'required', // Required dropdown
//         'region_id' => 'required', // Required dropdown
//         'country_id' => 'required', // Required dropdown
//         'state_id' => 'required', // Required dropdown
//         'city_id' => 'required', // Required dropdown
//         'zip_code' => 'required', // Required dropdown
//         'profile_image' => 'required', // Required dropdown
//         'initial_deposit' => 'required', // Required dropdown
//         'initial_tx_id' => 'required', // Required dropdown
//         'initial_tx_date' => 'required', // Required dropdown
//         'imageName_tx_image' => 'required', // Required dropdown
        
//     ]);
        
//         $business_partner = new Business_Partner();
//          $business_partner->prefix =$request->prefix;
//         $business_partner->poc_first_name =$request->poc_first_name;
//         $business_partner->poc_last_name =$request->poc_last_name;
//         $business_partner->poc_email =$request->poc_email;
//         $business_partner->poc_mobile =$request->poc_mobile;
//         $business_partner->business_area_id =$request->business_area_id;
//         $business_partner->business_name =$request->business_name;
//         $business_partner->address_line_1 =$request->address_line_1;    
//         $business_partner->address_line_2 =$request->address_line_2;
//         $business_partner->region_id =$request->region_id;
//         $business_partner->country_id =$request->country_id;
//         $business_partner->state_id =$request->state_id;
//         $business_partner->city_id =$request->city_id;
//         $business_partner->zip_code =$request->zip_code;
//         if ($request->file('profile_image')) {
//             $image = $request->file('profile_image');
//             $imageName_profile = time() . '.' . $image->getClientOriginalExtension();
//             // dd('image/'.$imageName);
//             $image->move(public_path('image/profile_image/'), $imageName_profile);

//         // $template_manager->template_image = 'image/'.$imageName;   
//         $business_partner->profile_image ='image/profile_image/'.$imageName_profile;
//         }
        
//         $business_partner->initial_deposit =$request->initial_deposit;  
//         $business_partner->initial_tx_id =$request->initial_tx_id;
//         $business_partner->initial_tx_date =$request->initial_tx_date;
//         if ($request->file('initial_tx_image')) {
//             $image = $request->file('initial_tx_image');
//             $imageName_tx_image = time() . '.' . $image->getClientOriginalExtension();
//             // dd('image/'.$imageName);
//             $image->move(public_path('image/tx_image/'), $imageName_tx_image);

//         // $template_manager->template_image = 'image/'.$imageName;   
//         // $business_partner->profile_image ='image/profile_image/'.$imageName_profile;
//         $business_partner->initial_tx_image ='image/tx_image/'.$imageName_tx_image;
//         }
//         $business_partner->open_password = Hash::make($request->poc_first_name);
//         $business_partner->save(); 
//         $business_Partner = Business_Partner::select('business_partners.*', 'region.region_name', 'country.country_name','business_area.area_name','state.state_title')
//         ->join('region', 'business_partners.region_id', '=', 'region.id') // Join city with state
//         ->join('country', 'business_partners.country_id', '=', 'country.id') // Join city with country
//         ->join('state', 'business_partners.state_id', '=', 'state.id')
//         ->join('business_area','business_partners.business_area_id','=','business_area.id')
//         ->get();
//         $success = 'Partner Has Been Add.';
//         return view('business_partners/partners',compact('success','business_Partner'));
//     }
       
 
 
//   function edit($id){
//             $business_area = Business_Area::get();
//           $region = Region::get();
//           $business_edit = Business_Partner::select('business_partners.*', 'region.region_name', 'country.country_name','business_area.area_name','state.state_title')
//         ->join('region', 'business_partners.region_id', '=', 'region.id') // Join city with state
//         ->join('country', 'business_partners.country_id', '=', 'country.id') // Join city with country
//         ->join('state', 'business_partners.state_id', '=', 'state.id')
//         ->join('business_area','business_partners.business_area_id','=','business_area.id')->where('business_partners.id',$id)->first();
//         // dd($business_edit);
//         return view('business_partners.partner',compact('business_area','region','business_edit'));
//       } 
      
      
//       function update(Request $request,$id){
          
//           $business_area = Business_Area::find($id);
//             $business_area->area_name =$request->area_name;
//         $business_area->area_code =$request->area_code;
//         // $business_area->status = 1;
//         $business_area->update();
//         //  return back()->with('success', 'Business Area Has Been Updated.');
//          return redirect('business_area')->with('success', 'Business Area Has Been Updated');
//       }
      
      
//       function status($id,$actions){
//           if($actions == 1){
//               $business_area = Business_Area::find($id);
//               $business_area->status = 0;
//               $business_area->update();
//           }
//           else{
//               $business_area = Business_Area::find($id);
//               $business_area->status = 1;
//               $business_area->update();
//           }
//           return redirect('business_area')->with('success', 'Suspend Has Been Updated');
//       }
      
//       function delete($id){
//           $business_area = Business_Area::find($id);
//           $business_area->delete();
//           return redirect('business_area')->with('success', 'Record has been Delete');
      
//       }
     
     
}
