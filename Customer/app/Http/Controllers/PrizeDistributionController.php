<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
use Illuminate\Support\Facades\Session;
use App\Models\Support_Category;
use Carbon\Carbon;
use App\Models\Support;
use App\Models\Luckydraws;
use Illuminate\Support\Facades\Response;
//use PDF; // if using barryvdh/laravel-dompdf package
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Faq;

class PrizeDistributionController extends Controller
{
    public function index(Request $request)
    {
        // Logged in customer_id from session
        $user = Session::get('user');
        $customerId = $user['customer_id'];
        
        $tickets = DB::table('prize_distribution as pd')
            ->join('sales as s', 'pd.ticket_id', '=', 's.ticket_id')
            ->join('luckydraws as ld', 'pd.luckydraw_id', '=', 'ld.id')
            ->join('business_partners as bp', 's.partner_id', '=', 'bp.id')
            ->join('prizes as p', 'pd.prize_id', '=', 'p.id')
            ->where('s.customer_id', $customerId)
            ->select(
                'pd.id',
                'pd.ticket_id',
                'ld.luckydraw_name',
                'bp.business_name',
                'pd.tx_remarks',
                'pd.tx_proof',
                'pd.tx_status',
                'p.prize_type',
                'p.amount',
                'p.item',
                'p.image'
            )
            ->get();

        return view('my_prizes', compact('tickets'));
    }
}