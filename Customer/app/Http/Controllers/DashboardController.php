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
use App\Models\Luckydraws;
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
        
        $lottery = Business_Partner::select(
            DB::raw("LENGTH(lottery_id) - LENGTH(REPLACE(lottery_id, ',', '')) + 1 AS value_count")
            )->where('id',$user_id)->first();
            
             $Sale = Sale::select(
            'customers.first_name',
            'customers.customer_id',
            'customers.mobile',
            'lotteries.lottery_name',
            'lotteries.ticket_id',
            'sales.created_at',
            'customers.profile_image'
        )
        ->join('customers', 'customers.customer_id', '=', 'sales.customer_id') // Join customers
        ->join('luckydraws', 'lotteries.id', '=', 'sales.lottery_id') // Join lotteries
        ->where('sales.winner_status', 1)
        ->where('sales.partner_id', $user_id)
        ->get();
        $url = request()->getSchemeAndHttpHost();
        // dd($Sale);
        // $lottery = Lottery::count('id');
        return view('dashboard',compact('customer','lottery','tickets','wallet','Sale','url'));
    }  
}