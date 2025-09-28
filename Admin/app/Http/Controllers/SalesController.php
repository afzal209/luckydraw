<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Business_Partner;
use App\Models\Customer;
use App\Models\Luckydraw;
use App\Models\Sale;


class SalesController extends Controller
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
        $sale= Sale ::select('customers.prefix as cust_prefix','customers.first_name','customers.email','customers.mobile','customers.zip_code','customers.country_id','customers.state_id','customers.city_id','business_partners.prefix as bp_prefix', 'business_partners.poc_first_name','business_partners.poc_email','business_partners.poc_mobile','luckydraws.luckydraw_name','luckydraws.frequency','luckydraws.price','sales.ticket_id','sales.created_at')
        ->join('customers', 'sales.customer_id', '=', 'customers.customer_id') // Join city with state
        ->join('business_partners', 'sales.partner_id', '=', 'business_partners.id') // Join city with country
        ->join('luckydraws', 'sales.luckydraw_id', '=', 'luckydraws.id')
        ->orderBy('sales.created_at', 'ASC') // Order by ticket_id in descending order
        ->get();
         return view('sales',compact('business_partner','customer','luckydraw','sale'));
     }
}