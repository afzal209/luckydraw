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
use App\Models\Luckydraws;
use Illuminate\Support\Facades\Response;
//use PDF; // if using barryvdh/laravel-dompdf package
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Faq;
class LuckydrawController extends Controller
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
    
    public function luckydraw()
    {
        $user = Session::get('user');
        $customer_id = $user['customer_id']; // e.g. "25000001"
        $sales = DB::table('sales')
        ->join('customers', DB::raw('CAST(sales.customer_id AS CHAR)'), '=', 'customers.customer_id')
        ->join('luckydraws', 'luckydraws.id', '=', 'sales.luckydraw_id')
        ->join('business_partners', 'business_partners.id', '=', 'sales.partner_id')
        ->select(
            'sales.ticket_id',
            'sales.draw_date',
            'sales.sale_image_path',
            'luckydraws.luckydraw_name',
            'business_partners.id as partner_id',
            'business_partners.business_name',
            'business_partners.poc_mobile',
            'business_partners.poc_email',
            'business_partners.address_line_1',
            'business_partners.address_line_2'
        )
        ->where('sales.customer_id', $customer_id)
        ->orderBy('sales.ticket_id', 'asc')
        ->get()
        ->groupBy('partner_id');
        return view('luckydraw', compact('sales'));
    }
    
    public function export($type)
    {
        $user = Session::get('user');
        $customer_id = $user['customer_id'];
    
        $sales = DB::table('sales')
            ->join('customers', DB::raw('CAST(sales.customer_id AS CHAR)'), '=', 'customers.customer_id')
            ->join('luckydraws', 'luckydraws.id', '=', 'sales.luckydraw_id')
            ->join('business_partners', 'business_partners.id', '=', 'sales.partner_id')
            ->select(
                'sales.ticket_id',
                'sales.draw_date',
                'sales.sale_image_path',
                'luckydraws.luckydraw_name',
                'business_partners.business_name',
                'business_partners.poc_mobile',
                'business_partners.poc_email',
                'business_partners.address_line_1',
                'business_partners.address_line_2'
            )
            ->where('sales.customer_id', $customer_id)
            ->orderBy('sales.ticket_id', 'asc')
            ->get();
    
        if ($type === 'csv') {
            $filename = "my_tickets.csv";
            $handle = fopen('php://output', 'w');
            fputcsv($handle, [
                'Business Partner', 'Phone', 'Email', 'Address',
                'Ticket ID', 'Lucky Draw', 'Draw Date'
            ]);
            foreach ($sales as $sale) {
                fputcsv($handle, [
                    $sale->business_name,
                    $sale->poc_mobile,
                    $sale->poc_email,
                    $sale->address_line_1 . ' ' . $sale->address_line_2,
                    $sale->ticket_id,
                    $sale->luckydraw_name,
                    $sale->draw_date
                ]);
            }
            fclose($handle);
    
            return Response::make('', 200, [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => "attachment; filename={$filename}",
            ]);
        }
    
        // if ($type === 'pdf') {
        //     $pdf = PDF::loadView('exports.tickets_pdf', compact('sales'));
        //     return $pdf->download('my_tickets.pdf');
        // }
        if ($type === 'pdf') {
            $pdf = Pdf::loadView('exports.tickets_pdf', compact('sales'));
            return $pdf->download('my_tickets.pdf');
        }
    
        return back()->with('error', 'Invalid export type.');
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
}