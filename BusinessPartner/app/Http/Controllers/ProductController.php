<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Business_Area;
use App\Models\Luckydraw;
use App\Models\Template_Manager;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
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
         $luckydraw_id = $user['luckydraw_id'];
         $idsArray = explode(',', $luckydraw_id);  // ["1", "2", "3", "4"]


        $luckydraw = DB::table('business_partners')
    ->join('luckydraws', function($join) {
        $join->on(DB::raw("FIND_IN_SET(luckydraws.id, business_partners.luckydraw_id)"), '>', DB::raw("0"));
    })
   
    ->where('business_partners.id', $user_id)
    ->select(
        
        'luckydraws.luckydraw_name',
        'luckydraws.frequency',
        'luckydraws.start_date',
        'luckydraws.end_date',
        'luckydraws.price'
    )
    ->get();
    // dd($luckydraw);
    $url = request()->getSchemeAndHttpHost();
  
        // $donors = Donor::get();
        
        
         return view('product',compact('luckydraw','url'));
 
     }  
 
 
 
//  function create(Request $request){
//         // dd($request);
//         $business_area = new Business_Area();
//          $business_area->area_name =$request->area_name;
//         $business_area->area_code =$request->area_code;
//         $business_area->status = 1;
//         $business_area->save();
        
        
//         return back()->with('success', 'Business Area Has Been Add.');
//     }
       
 
 
//   function edit($id){
           
//           $business_area_edit = Business_Area::where('id',$id)->first();
//           $business_area = Business_Area::get();
//         // dd($expert);
//         return view('business_area',compact('business_area_edit','business_area'));
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
