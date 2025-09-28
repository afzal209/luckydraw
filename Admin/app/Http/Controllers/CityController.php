<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Country;
use App\Models\Region;
use App\Models\State;
use App\Models\City;
use Session;

class CityController extends Controller
{
    /**

     * Write code on Method

     *

     * @return response()

     */

     public function index()

     {
        
        // $donors = Donor::get();
        
         $country = Country::where('status','=',1)->get();
         $city = City::select('city.*', 'state.state_title', 'country.country_name')
        ->join('state', 'city.state_id', '=', 'state.id') // Join city with state
        ->join('country', 'city.country_id', '=', 'country.id') // Join city with country
        ->get();
         return view('city',compact('country','city'));
 
     }  
 
 
    function get_country(Request $request){
        // dd($request->country_id);
        $city = State::where('country_id',$request->country_id)->where('status','=',1)->get();
        return response()->json($city);
    } 
 
 
 function create(Request $request){
        // dd($request);
        $city = City::where('name',$request->name)->exists();
        if($city){
             Session::put('error_count5', 'Same City name is exists');
            return back()->with('error_count5', 'Same City name is exists');
        }
        else{
        $City = new City();
         $City->country_id =$request->country_id;
         $City->state_id =$request->state_id;
        $City->name =$request->name;
        $City->status = 1;
        $City->save();
        
        // $success = "City has been Added.";
        return redirect('city')->with('success', 'City has been Added.');    
        }
        
    }
    
    
    
    function validation (Request $request){
    //  dd($request->all());
    $status = '';
    $action = array();
    $action1 = array();    
    if($request->action_status == 'add'){
        $city_name = City::where('country_id',$request->country_id)->where('state_id',$request->state_id)->where('name',$request->name)->first();
            
            
            if($city_name != null)
                {
                    // dd('yes');
                    $action['field'] = 'name';   
                    $action['status']  = 1;
                }
                else{
                    $action['field'] = 'name';
                    $action['status']  = 0;
                }
                
                
                
                
    
        
    
    
    
        return response()->json(['action' => $action,'action1'=> $action1]);
    }
    else{
        $city_name = City::where('country_id',$request->country_id)->where('state_id',$request->state_id)->where('name',$request->name)->where('id','!=',$request->b_area_id)->first();
            
            
            if($city_name != null)
                {
                    // dd('yes');
                    $action['field'] = 'name';   
                    $action['status']  = 1;
                }
                else{
                    $action['field'] = 'name';
                    $action['status']  = 0;
                }
                
                
                
                
    
        
    
    
    
        return response()->json(['action' => $action,'action1'=> $action1]);
        
    }
             
        
        
    
 }   
 
 
  function edit($id){
           
           $country = Country::where('status','=',1)->get();
           $city = City::select('city.*', 'state.state_title', 'country.country_name')
        ->join('state', 'city.state_id', '=', 'state.id') // Join city with state
        ->join('country', 'city.country_id', '=', 'country.id') // Join city with country
        ->where('country.status','=',1)
        ->where('state.status','=',1)
        ->get();
           $city_edit = City::find($id);
        // dd($city_edit);
        return view('city',compact('city','city_edit','country'));
      } 
      
      
      function update(Request $request,$id){
        //   dd($id);
           $City = City::find($id);
            $City->country_id =$request->country_id;
             $City->state_id =$request->state_id;
        $City->name =$request->name;
        // $city->status = 1;
        $City->update();
        //  return back()->with('success', 'Business Area Has Been Updated.');
         return redirect('city')->with('success', 'City Has Been Updated');
      }
      
      
      function status($id,$actions){
          if($actions == 1){
               $city = City::find($id);
               $city->status = 0;
               $city->update();
          }
          else{
               $city = City::find($id);
               $city->status = 1;
               $city->update();
          }
           return redirect('city')->with('success', 'Suspend Has Been Updated');
      }
      
      function delete($id){
           $city = City::find($id);
           $city->delete();
           return redirect('city')->with('success', 'Record has been Delete');
      
      }
      
        public function clear(Request $request)
{
    
    // dd('yes');
    // Option 1: Clear specific key
    session()->forget('error_count5');

    // Option 2: Clear all session data
    // session()->flush();

    return redirect()->back();
}
     
     
}
