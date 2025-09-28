<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Business_Partner;
use App\Models\Customer;
use App\Models\Luckydraw;
use App\Models\Sale;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**

     * Write code on Method

     *

     * @return response()

     */

     public function index()

     {
         $business_partner = Business_Partner::count('id');
         $customer = Customer::count('id');
         $luckydraw= luckydraw::count('id');
         $luckydraw_sum = luckydraw::sum('price');
         $sale_today = Sale::whereDate('created_at', Carbon::today())->count();
         $sale_month = Sale::whereMonth('created_at', date('m'))->count();
         $sale_year = Sale::whereYear('created_at', date('Y'))->count();
         
         $business_today = Business_Partner::whereDate('created_at', Carbon::today())->count();
         $business_month = Business_Partner::whereMonth('created_at',date('m'))->count();
         $business_year = Business_Partner::whereYear('created_at',date('Y'))->count();
         
        
         
         $customer_today = Customer::whereDate('created_at', Carbon::today())->count();
         $customer_month = Customer::whereMonth('created_at', date('m'))->count();
         $customer_year = Customer::whereYear('created_at',date('Y'))->count();
         
         
         $sale= Sale ::select('customers.prefix as cust_prefix','customers.first_name','customers.email','customers.mobile','customers.zip_code','customers.country_id','customers.state_id','customers.city_id','business_partners.prefix as bp_prefix', 'business_partners.poc_first_name','business_partners.poc_email','business_partners.poc_mobile','luckydraws.luckydraw_name','luckydraws.frequency','luckydraws.price','sales.ticket_id')
        ->join('customers', 'sales.customer_id', '=', 'customers.customer_id') // Join city with state
        ->join('business_partners', 'sales.partner_id', '=', 'business_partners.id') // Join city with country
        ->join('luckydraws', 'sales.luckydraw_id', '=', 'luckydraws.id')
        ->orderBy('sales.ticket_id', 'desc') // Order by ticket_id in descending order
    ->take(10) // Limit to 10 records
        ->get();
         
        //  dd($sale);
        // $applicant = Applicant::count('id');
        // $expert = Expert::count('id');
        // $paper = Paper::count('id');
        // $payment = Payment::sum('amount');
        // $submit = Paper::where('status',0)->count();
        // $accepted = Paper::where('status',1)->count();
        // $rejected = Paper::where('status',2)->count();
        // $review = Paper::where('status',3)->count();
        // $complete = Paper::where('status',4)->count();
        // $donors  = Donor::where('status',0)->orderBy('id','desc')->take(3)->get();
        
        
    //     $donors = Donor::join('payments', 'payments.payer_id', '=', 'donors.id')
    // ->where('donors.status', 0)
    // ->orderBy('donors.id', 'desc')
    // ->take(3)
    // ->get(['donors.*', 'payments.*']);
    
    
    // $donors = Donor::where('status', 0)
    // ->with(['payment', 'city', 'district', 'state']) // Eager load related models
    // ->orderBy('id', 'desc')
    // ->paginate(3);
        //  return view('dashboard',compact('applicant','expert','paper','payment','submit','rejected','review','donors'));
 return view('dashboard',compact('business_partner','customer','luckydraw','luckydraw_sum','sale_today','sale_month','sale_year','business_today','business_month','business_year','customer_today','customer_month','customer_year','sale'));
     }  
 
       
 
     
     
}
