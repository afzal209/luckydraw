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
use App\Models\Luckydraw;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class DashboardController extends Controller
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
        
        $customer = Customer::where('bp_id',$user_id)->count('id');
        $tickets = Sale::where('partner_id',$user_id)->count('id');
        $wallet = Business_Partner::select('wallet_amount')->where('id',$user_id)->first();//Need to get the wallet_amount field value
        
       $luckydraw = Business_Partner::select(
    DB::raw("CASE WHEN luckydraw_id = '' OR luckydraw_id IS NULL 
                 THEN 0 
                 ELSE LENGTH(luckydraw_id) - LENGTH(REPLACE(luckydraw_id, ',', '')) + 1 END AS value_count")
)->where('id', $user_id)->first();

        
         $Sale = Sale::select(
        'customers.first_name',
        'customers.customer_id',
        'customers.mobile',
        'luckydraws.luckydraw_name',
        'luckydraws.ticket_id',
        'sales.created_at',
        'customers.profile_image'
    )
    ->join('customers', 'customers.customer_id', '=', 'sales.customer_id') // Join customers
    ->join('luckydraws', 'luckydraws.id', '=', 'sales.luckydraw_id') // Join luckydraws
    ->where('sales.winner_status', 1)
    ->where('sales.partner_id', $user_id)
    ->get();
    $url = request()->getSchemeAndHttpHost();
        // dd($Sale);
        // $luckydraw = Luckydraw::count('id');
        return view('dashboard',compact('customer','luckydraw','tickets','wallet','Sale','url'));
    }  
 
 
//     function get_country(Request $request){
//         // dd($request->country_id);
//         $city = State::where('country_id',$request->country_id)->get();
//         return response()->json($city);
//     } 
 
 
//  function create(Request $request){
//         // dd($request);
//         $City = new City();
//          $City->country_id =$request->country_id;
//          $City->state_id =$request->state_id;
//         $City->name =$request->name;
//         $City->status = 1;
//         $City->save();
        
//         // $success = "City has been Added.";
//         return redirect('city')->with('success', 'City has been Added.');
//     }
       
 
 
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
