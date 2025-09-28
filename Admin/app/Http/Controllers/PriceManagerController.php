<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Template_Manager;
use App\Models\Prize_Manager;
use App\Models\Luckydraw;
use Session;


class PriceManagerController extends Controller
{
    /**

     * Write code on Method

     *

     * @return response()

     */

     public function index()

     {
        
        // $donors = Donor::get();
        
        //  $template_manager = Template_Manager::get();
        $luckydraw= Luckydraw ::get();
        $prize_manager = Prize_Manager::select('prize_manager.*', 'luckydraws.luckydraw_name')
    ->join('luckydraws', 'prize_manager.template_id', '=', 'luckydraws.id')
    ->get();
         return view('price_manager',compact('prize_manager','luckydraw'));
 
     }  
 
 
 
 
 
 function create(Request $request){
      $prize_manager_name = Prize_Manager::where('prize_name',$request->prize_name)->exists();
        $prize_manager_code = Prize_Manager::where('prize_code',$request->prize_code)->exists();
        
        if($prize_manager_name){
             Session::put('error_count7', 'Same Prize Manager name is exists');
            return back()->with('error_count7', 'Same Prize Manager Name is exists');
        }
        elseif($prize_manager_code){
            Session::put('error_count7', 'Same Prize Manager name is exists');
            return back()->with('error_count7', 'Same Prize Manager code is exists');
        }
        else{
               $prize_manager = new Prize_Manager();
         $prize_manager->template_id =$request->template_id;
         $prize_manager->prize_name =$request->prize_name;
         $prize_manager->prize_code =$request->prize_code;
        
         $prize_manager->status = 1;
         if ($request->file('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            // dd('image/'.$imageName);
            $image->move(public_path('image'), $imageName);

        $prize_manager->prize_image = 'image/'.$imageName;    
        }
        
        
        $prize_manager->save();
        
        // $success = "Country Has Been Add.";
        return redirect('price_manager')->with('success', 'Price Manager Has Been Add.');
        }
        
        
     
    }
       
       
       
       function validation (Request $request){
    //  dd($request->all());
    $status = '';
    $action = array();
    $action1 = array();
    if($request->action_status == 'add'){
        $prize_name = Prize_Manager::where('prize_name',$request->prize_name)->first();
            
            
            if($prize_name != null)
                {
                    // dd('yes');
                    $action['field'] = 'name';   
                    $action['status']  = 1;
                }
                else{
                    $action['field'] = 'name';
                    $action['status']  = 0;
                }
                
                
                $prize_code = Prize_Manager::where('prize_code',$request->prize_code)->first();
                
                if($prize_code != null)
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
        $prize_name = Prize_Manager::where('prize_name',$request->prize_name)->where('id','!=',$request->b_area_id)->first();
            
            
            if($prize_name != null)
                {
                    // dd('yes');
                    $action['field'] = 'name';   
                    $action['status']  = 1;
                }
                else{
                    $action['field'] = 'name';
                    $action['status']  = 0;
                }
                
                
                $prize_code = Prize_Manager::where('prize_code',$request->prize_code)->where('id','!=',$request->b_area_id)->first();
                
                if($prize_code != null)
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
           
            //  $template_manager = Template_Manager::get();
             $luckydraw= Luckydraw ::get();
    //     $prize_manager = Prize_Manager::select('prize_manager.*', 'luckydraw_template.template_name')
    // ->join('luckydraw_template', 'prize_manager.template_id', '=', 'luckydraw_template.id')
    // ->get();
    $prize_manager = Prize_Manager::select('prize_manager.*', 'luckydraws.luckydraw_name')
    ->join('luckydraws', 'prize_manager.template_id', '=', 'luckydraws.id')
    ->get();
           $prize_manager_edit = Prize_Manager::find($id);
        // dd($prize_manager);
        return view('price_manager',compact('luckydraw','prize_manager','prize_manager_edit'));
      } 
      
      
      function update(Request $request,$id){
        //   dd($id);
           $prize_manager = Prize_Manager::find($id);
            $prize_manager->template_id =$request->template_id;
             $prize_manager->prize_name =$request->prize_name;
             $prize_manager->prize_code =$request->prize_code;
        if ($request->file('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('image'), $imageName);

        $prize_manager->prize_image = 'image/'.$imageName;    
        }
        else{
            $prize_manager->prize_image = $prize_manager->prize_image;
        }
        // $city->status = 1;
        $prize_manager->update();
        //  return back()->with('success', 'Business Area Has Been Updated.');
         return redirect('price_manager')->with('success', 'Template Manager  Has Been Updated');
      }
      
      
      function status($id,$actions){
          if($actions == 1){
               $prize_manager = Prize_Manager::find($id);
               $prize_manager->status = 0;
               $prize_manager->update();
          }
          else{
               $prize_manager = Prize_Manager::find($id);
               $prize_manager->status = 1;
               $prize_manager->update();
          }
           return redirect('price_manager')->with('success', 'Suspend Has Been Updated');
      }
      
      function delete($id){
           $prize_manager = Prize_Manager::find($id);
           $prize_manager->delete();
           return redirect('price_manager')->with('success', 'Record has been Delete');
      
      }
     
     
            public function clear(Request $request)
{
    
    // dd('yes');
    // Option 1: Clear specific key
    session()->forget('error_count6');

    // Option 2: Clear all session data
    // session()->flush();

    return redirect()->back();
}
}
