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
use App\Models\Support_Category;
use Carbon\Carbon;
use App\Models\Support;
use Barryvdh\DomPDF\Facade\Pdf;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Format;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Typography\FontFactory;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str; //Random Ticket Download Number generator

use App\Models\Faq;
class HomeController extends Controller
{
    /**

     * Write code on Method

     *

     * @return response()

     */

    public function index()
    {
       
        return view('index');
    }
    
    public Function user(){
        $user= Session::get('user');
        $customer = Customer::find($user['id']);
        $sale = Sale::where('customer_id',$user['customer_id'])->count();
        $sale_cal = Sale::where('customer_id',$user['customer_id'])->sum('price');
    //     $customer_lottery = DB::table('sales')
    // ->join('lotteries', 'sales.lottery_id', '=', 'lotteries.id')
    // ->where('sales.customer_id', $user['customer_id'])
    // ->select('lotteries.lottery_name','lotteries.winner_status', 'sales.*') // You can customize the columns you want
    // ->get();

        $customer_lottery = DB::table('lotteries as l')
    ->join('sales as s', 'l.id', '=', 's.lottery_id')
    ->join('business_partners as bp', 's.partner_id', '=', 'bp.id')
    ->select(
        'l.lottery_name',
        'l.ticket_id',
        'bp.business_name',
        'bp.poc_first_name',
        'bp.poc_email',
        'bp.poc_mobile',
        's.price',
        's.qty',
        's.discount',
        's.tax',
        's.status'
    )->where('s.customer_id',$user['customer_id'])
    ->orderBy('s.created_at', 'desc') // or 's.id' if no timestamps
    ->limit(3)
    ->get();

        return view('user',compact('customer','sale','sale_cal','customer_lottery'));
    }
    
    public function user_info()
    {
       $user = Session::get('user');
        $customer_data = Customer::find($user['id']);
        return view('profile',compact('customer_data'));
    }

    public function user_lottery()
    {
       
        return view('user_lottery');
    }
    
    public function user_referral()
    {
       $business_partner = Business_Partner::all();
       $results = DB::table('customers as c')
    ->join('sales as s', 'c.customer_id', '=', 's.customer_id')
    ->join('business_partners as bp', 's.partner_id', '=', 'bp.id')
    ->distinct()
    ->select(
        'bp.business_name',
        'bp.address_line_1',
        'bp.address_line_2',
        'bp.poc_first_name',
        'bp.poc_last_name',
        'bp.poc_email',
        'bp.poc_mobile'
    )
    ->get();
       
        return view('user_referral',compact('business_partner','results'));
    }
    
    public function user_transaction()
    {
        
        
       $user = Session::get('user');
       
        $customer = Customer::find($user['id']);
        $sale = Sale::where('customer_id',$user['customer_id'])->count();
        $sale_cal = Sale::where('customer_id',$user['customer_id'])->sum('price');
       
       $results = DB::table('lotteries as l')
    ->join('sales as s', 'l.id', '=', 's.lottery_id')
    ->join('business_partners as bp', 's.partner_id', '=', 'bp.id')
    ->select(
        'l.lottery_name',
        'l.ticket_id',
        'bp.business_name',
        'bp.poc_first_name',
        'bp.poc_email',
        'bp.poc_mobile',
        's.price',
        's.qty',
        's.discount',
        's.tax',
        's.status'
    )->where('s.customer_id',$user['customer_id'])
    ->get();
       
        return view('user_transaction',compact('results','sale','sale_cal','customer'));
    }
    public function contact(){
        return view('contact');
    }
    public function user_support()
    {
        $user = Session::get('user');
        $total_ticket = Support::where('raised_by_id',$user['customer_id'])->count();
        $close_ticket =Support::where('raised_by_id',$user['customer_id'])->where('status',2)->count();
        $support_data  = DB::table('support')
            ->join('support_categories', 'support.categoryid', '=', 'support_categories.id')
            ->select('support.*', 'support_categories.name as category_name')
            ->get();
        $support_categories = Support_Category::get();
        
        return view('user_support',compact('support_categories','total_ticket','close_ticket','support_data'));
    }    
    public function insert_support(Request $request){
         $currentYear = Carbon::now()->format('y'); // Get last two digits of the year
        $lastSupportId = DB::table('support')
    ->select(DB::raw("MAX(CAST(SUBSTRING(support_ticket_id, 4) AS UNSIGNED)) as max_id"))
    ->first();

if ($lastSupportId && $lastSupportId->max_id) {
    $newNumber = str_pad($lastSupportId->max_id + 1, 6, '0', STR_PAD_LEFT);
} else {
    $newNumber = '000001';
}

$newSupportId = 'CST' . $newNumber;
        
        $support = new Support();
        $support->support_ticket_id = $newSupportId;
        $support->raised_by_id = $request->customer_id;
        $support->raised_by = 2; //2= Customer
        $support->categoryid = $request->categoryid;
        $support->subject = $request->subject;
        $support->description = $request->description;
        $support->status = 0; 
        $support->save();
        return redirect('user_support');
    }
    
    
     public function faq(Request $request){
            $faqs = Faq::get();
            
            return view('faq',compact('faqs'));
     }
 
 
   function download_ticket_id($id)
    {
        $sale = Sale::where('ticket_download_id', $id)->first();
        $path = public_path($sale->sale_image_path); // Image path is coming as local folder as Customer so it should be replaced with BusinessPartner where actually image is exist.
        //$webPath = str_replace('/home/crm2amicrosharp/public_html/Customer/public/', 'https://crm2a.microsharp.net/BusinessPartner/public/', $path); 
        $webPath = str_replace('/home/crm2amicrosharp/public_html/Customer/public/', env('WEB_URL') . '/BusinessPartner/public/',$path);
        
        if (!$sale || !$sale->sale_image_path) {
            $redirectUrl = env('APP_URL'); // directly read from .env
            $html = "
                <html>
                    <head>
                        <meta http-equiv='refresh' content='5;url={$redirectUrl}' />
                        <style>
                            body {
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                height: 100vh;
                                font-family: Arial, sans-serif;
                                text-align: center;
                                background: #f8f9fa;
                            }
                            .message {
                                padding: 20px;
                                background: #fff;
                                border: 1px solid #ddd;
                                border-radius: 8px;
                                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                            }
                        </style>
                    </head>
                    <body>
                        <div class='message'>
                            <h2>Your Luckydraw Ticket is NOT Found</h2>
                            <p>You will be redirected to our main site in 5 seconds...</p>
                            <p><a href='{$redirectUrl}'>Click here if it doesn’t redirect</a></p>
                        </div>
                    </body>
                </html>
            ";
            return response($html, 404);
        }
        
        $html = '<img src="' . $webPath . '" style="width:100%; height:100vh; object-fit:cover;">';
        $pdf = Pdf::setOptions(['isRemoteEnabled' => true])
          ->loadHTML($html)
          ->setPaper('a4', 'landscape');
        // $image->save(storage_path('/app/home/text_image.jpg'));
        return $pdf->download($sale->ticket_id.'-ticket.pdf'); // Download PDF
    }

}
