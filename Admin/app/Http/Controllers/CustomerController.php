<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Business_Area;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
     public function index()
     {
        $customer = Customer::select('customers.*')->get();
        // dd($customer);
        return view('customer',compact('customer'));
     }  
     public function edit($id){
         $customer_edit = Customer::find($id);
         return view('customer_edit',compact('customer_edit'));
     }
     
     public function update(Request $request ,$id){
         $customer_update = Customer::find($id);
         $customer_update->first_name =$request->first_name;
         $customer_update->email =$request->email;
         $customer_update->mobile =$request->mobile;
         $customer_update->update();
         return redirect('customer')->with('success', 'City Has Been Updated');
     }
     
     
    public function status($id,$actions){
          if($actions == 1){
               $city = Customer::find($id);
               $city->status = 0;
               $city->update();
          }
          else{
               $city = Customer::find($id);
               $city->status = 1;
               $city->update();
          }
           return redirect('customer')->with('success', 'Suspend Has Been Updated');
      }
     
}