<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Region;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Session;


class RegionController extends Controller
{
    /**

     * Write code on Method

     *

     * @return response()

     */

     public function index()

     {
         
        //  if(session()){
             
        //      session()->pull('error_count2');

        //     //  session()->pull('error_count2');
        // }
        
        // $donors = Donor::get();
        
         $region = Region::get();
         return view('region',compact('region'));
 
     }  
 
 
 
 function create(Request $request){
     
      $region_name = Region::where('region_name',$request->region_name)->exists();
      $region_code = Region::where('region_code',$request->region_code)->exists();
       if($region_name){
             Session::put('error_count2', 'Same region name is exists');
            return back()->with('error_count', 'Same region name is exists');
        }
        elseif($region_code){
             Session::put('error_count2', 'Same region Code is exists');
            return back()->with('error_count', 'Same region Code is exists');
        }
        else{
            session()->pull('error_count2');
        
            // dd($request);
        $region = new Region();
         $region->region_name =$request->region_name;
        $region->region_code =$request->region_code;
        $region->status = 1;
        $region->save();
        
        
        return back()->with('success', 'Region Has Been Add.');
        }
        
        
    }
       
 
 function validation (Request $request){
    //  dd($request->all());
    $status = '';
    $action = array();
    $action1 = array();    
    
    if($request->action_status == 'add'){
         $region_name = Region::where('region_name',$request->region_name)->first();
            
            
            if($region_name != null)
                {
                    // dd('yes');
                    $action['field'] = 'name';   
                    $action['status']  = 1;
                }
                else{
                    $action['field'] = 'name';
                    $action['status']  = 0;
                }
                
                
                $region_code = Region::where('region_code',$request->region_code)->first();
                
                if($region_code != null)
                {
                    $action1['field'] = 'code';   
                    $action1['status']  = 1;
                }
                else{
                    $action1['field'] = 'code';
                    $action1['status']  = 0;
                }
                
                
    
        // $multi = [
            
        //     'action'=> $action,
        //     // 'status' => $status,
        //     ];
        
    
    
    
        return response()->json(['action' => $action,'action1'=> $action1]);
    }
    else{
         $region_name = Region::where('region_name',$request->region_name)->where('id','!=',$request->b_area_id)->first();
            
            
            if($region_name != null)
                {
                    // dd('yes');
                    $action['field'] = 'name';   
                    $action['status']  = 1;
                }
                else{
                    $action['field'] = 'name';
                    $action['status']  = 0;
                }
                
                
                $region_code = Region::where('region_code',$request->region_code)->where('id','!=',$request->b_area_id)->first();
                
                if($region_code != null)
                {
                    $action1['field'] = 'code';   
                    $action1['status']  = 1;
                }
                else{
                    $action1['field'] = 'code';
                    $action1['status']  = 0;
                }
                
                
    
        // $multi = [
            
        //     'action'=> $action,
        //     // 'status' => $status,
        //     ];
        
    
    
    
        return response()->json(['action' => $action,'action1'=> $action1]);
    }
            
        
        
        // $Business_Area_code = Business_Area::where('area_code',$request->area_code)->first();
        // if($Business_Area_code != null)
        // {
        //     return back()->with('error', 'This code is already exist.');
        // }
    // $Business_Area_name_code = Business_Area::where('area_name',$request->area_name)->where('area_code',$request->area_code)->first();
 }
 
 
  function edit($id){
           
           $region_edit = Region::where('id',$id)->first();
           $region = Region::get();
        // dd($expert);
        return view('region',compact('region_edit','region'));
      } 
      
      
      function update(Request $request,$id){
           $region = Region::find($id);
            $region->region_name =$request->region_name;
        $region->region_code =$request->region_code;
        // $region->status = 1;
        $region->update();
        //  return back()->with('success', 'Business Area Has Been Updated.');
         return redirect('region')->with('success', 'Business Area Has Been Updated');
      }
      
      
      function status($id,$actions){
          $region = Region::find($id);
          if($region){
               if($actions == 1){
               
               $region->status = 0;
               $region->update();
          }
          else{
               
               $region->status = 1;
               $region->update();
          }
               $country = Country::where('region_id',$region->id)->get();
          foreach($country as $countrys){
              if($country){
                  if($actions == 1){
                                   $countrys->status = 0;
                                   $countrys->update();
                                  }
                                else{
                                  
                                   $countrys->status = 1;
                                   $countrys->update();
                                }
                  $state = State::where('country_id',$countrys->id)->get();    
                foreach($state as $states){
                    if($state){
                        if($actions == 1){
                                   $states->status = 0;
                                   $states->update();
                                  }
                                else{
                                  
                                   $states->status = 1;
                                   $states->update();
                                }
                        $city = City::where('country_id',$states->country_id)->where('state_id',$states->id)->get();
                    // dd($city);
                    foreach($city as $citys){
                            if($city){
                                if($actions == 1){
                                   $citys->status = 0;
                                   $citys->update();
                                  }
                                else{
                                  
                                   $citys->status = 1;
                                   $citys->update();
                                }
                            }
                        } 
                    }
                   
                    
                    
                }
              }
          
            //   dd($state);
          }
          }
         
          
          
        //   dd($country);
         
           return redirect('region')->with('success', 'Suspend Has Been Updated');
      }
      
      function delete($id){
           $region = Region::find($id);
           $region->delete();
           return redirect('region')->with('success', 'Record has been Delete');
      
      }
      
      public function clear(Request $request)
{
    
    // dd('yes');
    // Option 1: Clear specific key
    session()->forget('error_count2');

    // Option 2: Clear all session data
    // session()->flush();

    return redirect()->back();
}
     
     
}
