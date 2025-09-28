<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Country;
use App\Models\Region;
use App\Models\State;
use App\Models\City;
use Session;


class StateController extends Controller
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
         $state = state::select('state.*', 'country.country_name')
    ->join('country', 'state.country_id', '=', 'country.id')
 
    ->get();
         return view('state',compact('country','state'));
 
     }  
 
 
 
 function create(Request $request){
     $state = State::where('state_title',$request->state_title)->exists();
     if($state){
           Session::put('error_count4', 'Same State name is exists');
            return back()->with('error_count', 'Same State name is exists');
     }
     else{
           session()->pull('error_count4');
         $State = new State();
         $State->country_id =$request->country_id;
        $State->state_title =$request->state_title;
        $State->status = 1;
        $State->save();
        
        // $success = "Country Has Been Add.";
        return redirect('state')->with('success', 'State Has Been Add.');
     }
        // dd($request);
        
    }
       
 
 function validation (Request $request){
    //  dd($request->all());
    $status = '';
    $action = array();
    $action1 = array();    
    
    if($request->action_status == 'add'){
        $state_title = State::where('state_title',$request->state_title)->first();
            
            
            if($state_title != null)
                {
                    // dd('yes');
                    $action['field'] = 'name';   
                    $action['status']  = 1;
                }
                else{
                    $action['field'] = 'name';
                    $action['status']  = 0;
                }
                
                
                
        
    
    
    
        return response()->json(['action' => $action]);
    }
    else{
        $state_title = State::where('state_title',$request->state_title)->where('id','!=',$request->b_area_id)->first();
            
            
            if($state_title != null)
                {
                    // dd('yes');
                    $action['field'] = 'name';   
                    $action['status']  = 1;
                }
                else{
                    $action['field'] = 'name';
                    $action['status']  = 0;
                }
                
                
                
        
    
    
    
        return response()->json(['action' => $action]);
    }
             
        
        
       
 }
 
 
  function edit($id){
           
           $country = Country::where('status','=',1)->get();
           $state = state::select('state.*', 'country.country_name')
    ->join('country', 'state.country_id', '=', 'country.id')
    ->where('country.status','=',1)
    ->where('state.status','=',1)
    ->get();
           $state_edit = state::find($id);
        // dd($state_edit);
        return view('state',compact('state','state_edit','country'));
      } 
      
      
      function update(Request $request,$id){
        //   dd($id);
           $State = State::find($id);
            $State->country_id =$request->country_id;
        $State->state_title =$request->state_title;
        // $State->status = 1;
        $State->update();
        //  return back()->with('success', 'Business Area Has Been Updated.');
         return redirect('state')->with('success', 'State Has Been Updated');
      }
      
      
      function status($id,$actions){
          
          
          
             
                 $state = State::find($id); 
                
                    if($state){
                        if($actions == 1){
                                   $state->status = 0;
                                   $state->update();
                                  }
                                else{
                                  
                                   $state->status = 1;
                                   $state->update();
                                }
                        $city = City::where('country_id',$state->country_id)->where('state_id',$state->id)->get();
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
                   
                    
                    
                
              
          
          
        //   if($actions == 1){
        //       $State = State::find($id);
        //       $State->status = 0;
        //       $State->update();
        //   }
        //   else{
        //       $State = State::find($id);
        //       $State->status = 1;
        //       $State->update();
        //   }
           return redirect('state')->with('success', 'Suspend Has Been Updated');
      }
      
      function delete($id){
           $State = State::find($id);
           $State->delete();
           return redirect('state')->with('success', 'Record has been Delete');
      
      }
     
     
     public function clear(Request $request)
{
    
    // dd('yes');
    // Option 1: Clear specific key
    session()->forget('error_count4');

    // Option 2: Clear all session data
    // session()->flush();

    return redirect()->back();
}
     
}
