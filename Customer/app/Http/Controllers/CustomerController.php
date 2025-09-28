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
use App\Models\Lottery;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use Illuminate\Support\Facades\File;
use Hash;

use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function profile()
    {
        // Get logged-in user from session
        $user = Session::get('user');
        $customerId = $user['id'];
    
        // Fetch customer with country, state, city names
        $customer = \DB::table('customers as c')
            ->leftJoin('country as co', 'c.country_id', '=', 'co.id')
            ->leftJoin('state as s', 'c.state_id', '=', 's.id')
            ->leftJoin('city as ci', 'c.city_id', '=', 'ci.id')
            ->select(
                'c.*',
                'co.country_name as country_name',
                's.state_title as state_name',
                'ci.name as city_name'
            )
            ->where('c.id', $customerId)
            ->first();
    
        return view('customers.profile', compact('customer'));
    }
}