<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Country;
use App\Models\Region;
use App\Models\State;
use App\Models\City;
use Session;

class CountryController extends Controller
{
    /**

     * Write code on Method

     *

     * @return response()

     */

     public function index()

     {
         

        // $donors = Donor::get();
        
         $region = Region::where('status','=',1)->get();
         $country = Country::select('country.*', 'region.region_name')
    ->join('region', 'country.region_id', '=', 'region.id')->orderby('country.id','ASC')
    ->get();
         return view('country',compact('region','country'));
 
     }  
 
 
 
 function create(Request $request){
        // dd($request);
        
        
        $country = Country::where('country_name',$request->country_name)->exists();
        if($country){
             Session::put('error_count3', 'Same Country name is exists');
            return redirect('country')->with('error_count', 'Same Country name is exists');
        }
        else{
            session()->pull('error_count3');

            $Country = new Country();
         $Country->region_id =$request->region_id;
        $Country->country_name =$request->country_name;
        $Country->status = 1;
        $Country->save();
        
        $success = "Country Has Been Add.";
        return redirect('country')->with('country', 'success');
        }
        
        
    }
       
 
 function validation (Request $request){
    //  dd($request->all());
    $status = '';
    $action = array();
    $action1 = array();    
             if($request->action_status =='add'){
                $country_name = Country::where('country_name',$request->country_name)->first();
            
            
            if($country_name != null)
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
                 $country_name = Country::where('country_name',$request->country_name)->where('id','!=',$request->b_area_id)->first();
            
            
            if($country_name != null)
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
           
           $region = Region::where('status','=',1)->get();
           $country = Country::select('country.*', 'region.region_name')
    ->join('region', 'country.region_id', '=', 'region.id')
    ->where('region.status','=',1)
    ->where('country.status','=',1)
    ->get();
           $country_edit = Country::find($id);
        // dd($expert);
        return view('country',compact('region','country_edit','country'));
      } 
      
      
      function update(Request $request,$id){
           $Country = Country::find($id);
            $Country->region_id =$request->region_id;
        $Country->country_name =$request->country_name;
        // $Country->status = 1;
        $Country->update();
        //  return back()->with('success', 'Business Area Has Been Updated.');
         return redirect('country')->with('success', 'Country Area Has Been Updated');
      }
      
      
      function status($id,$actions){
        //   if($actions == 1){
        //       $Country = Country::find($id);
        //       $Country->status = 0;
        //       $Country->update();
        //   }
        //   else{
        //       $Country = Country::find($id);
        //       $Country->status = 1;
        //       $Country->update();
        //   }
        
         $country = Country::find($id);
          
              if($country){
                  if($actions == 1){
                                   $country->status = 0;
                                   $country->update();
                                  }
                                else{
                                  
                                   $country->status = 1;
                                   $country->update();
                                }
                  $state = State::where('country_id',$country->id)->get();    
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
          
        
           return redirect('country')->with('success', 'Suspend Has Been Updated');
      }
      
      function delete($id){
          $country = Country::find($id);
            $country->delete();
          
           return redirect('country')->with('success', 'Record has been Delete');
          
           
      
      }
     
     
     public function clear(Request $request)
{
    
    // dd('yes');
    // Option 1: Clear specific key
    session()->forget('error_count3');

    // Option 2: Clear all session data
    // session()->flush();

    return redirect()->back();
}

     
}
