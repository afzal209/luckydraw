<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Business_Area;
use App\Models\Template_Manager;
use App\Models\Region;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Business_Partner;
use App\Models\Customer;
use App\Models\Customer_group;
use App\Models\Luckydraw;
use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;
use Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Format;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Typography\FontFactory;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str; //Random Ticket Download Number generator
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\File;


use Illuminate\Support\Facades\Log;


class SaleController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */

    public function index()
    {
        $user = Session::get('user');
        // dd($user);
        $user_id = $user['id'];
        $lucky = array();
        $luckydraw_id =  $user['luckydraw_id'];
        // $lucky = explode(',', $user['luckydraw_id']);
        // $lucky[] = $luckydraw_id;
        $Business_Partner = Business_Partner::find($user_id);
       $lucky = explode(',', $Business_Partner->luckydraw_id);
       
        // $donors = Donor::get();
        $customer = Customer::where('bp_id', $user_id)->get();
        $customer_group = Customer_group::select(
            'group_name',
            'id',
            'status',
            DB::raw("LENGTH(customer_ids) - LENGTH(REPLACE(customer_ids, ',', '')) + 1 AS value_count")
        )->where('bp_id', $user_id)->get();
        $luckydraw = Luckydraw::whereIn('id', $lucky)->get();
        // dd($luckydraw);
        return view('sales.new_sale', compact('customer', 'customer_group', 'luckydraw', 'Business_Partner'));
    }

    public function view()
    {
        $user = Session::get('user');
        $user_id = $user['id'];
        $sales = Sale::where('partner_id', $user['id'])->count('id');
        $sale_amount  = Sale::where('partner_id', $user['id'])->sum('price');
        $Sale = Sale::select(
            'customers.first_name',
            'customers.customer_id',
            'customers.mobile',
            'customers.email',
            'luckydraws.luckydraw_name',
            'luckydraws.price',
            'sales.ticket_id',
            'sales.ticket_download_id',
            'sales.created_at',
            'sales.sale_image_path',
            'sales.id',
            'customers.profile_image',
            'luckydraw_template.template_image'
        )
            ->join('customers', 'customers.customer_id', '=', 'sales.customer_id') // Join customers
            ->join('luckydraws', 'luckydraws.id', '=', 'sales.luckydraw_id') // Join luckydraws
            ->join('luckydraw_template', 'luckydraw_template.id', '=', 'luckydraws.template_id')
            ->where('sales.partner_id', $user_id)->orderby('sales.ticket_id','desc')
            ->get();

        $wallet = Business_Partner::select('wallet_amount')->where('id', $user_id)->first();
        // dd($Sale);
        // $donors = Donor::get();
        //  $business_area = Business_Area::get();
        return view('sales.view_sale', compact('sales', 'wallet', 'Sale', 'sale_amount'));
    }

    private function getUserTimezoneFromIP($ip)
    {
    // Use fallback IP for localhost
    if ($ip === '127.0.0.1' || $ip === '::1') {
        $ip = '8.8.8.8'; // Google's public IP for testing
    }

    $response = Http::get("https://ipapi.co/{$ip}/json/");
    if ($response->ok()) {
        $data = $response->json();
        return $data['timezone'] ?? 'UTC'; // e.g., 'America/Guatemala'
    }

    return 'UTC';
}



    function add_customer_id(Request $request)
    {
        
        $ip = $request->ip();
    $timezone = $this->getUserTimezoneFromIP($ip);

        

        
        // dd($timezone);
        $user = Session::get('user');
        $id = $user['id'];
        //  dd($request);
        $customer = Customer::where('email', $request->email)->where('first_name', $request->name)->first();
        if ($customer === null) {
            $currentYear = Carbon::now()->format('y'); // Get last two digits of the year
            $select_customser_id = Customer::select('customer_id')->latest('customer_id')->first();
            // dd($select_customser_id);
            if ($select_customser_id) {
                $lastNumber = (int) substr($select_customser_id->customer_id, 2); // Extract numeric part
                $newNumber = str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT); // Increment and format
            } else {
                $newNumber = '000001'; // Start from 000001 if no records exist
            }

            $newCustomerId = $currentYear . $newNumber;
            // dd($newCustomerId);
            $customer = new Customer();
            $customer->bp_id = $id;
            $customer->first_name = $request->name;
            $customer->email = $request->email;
            $customer->mobile = $request->phone;
            $customer->password = Hash::make($request->phone);
            $customer->timezone = $timezone;
            $customer->customer_id = $newCustomerId;
            $customer->status = 1;
            $customer->save();
            $customer_show = customer::where('mobile', $request->phone)->where('email', $request->email)->first();
            $msg = 'success';
            $user = User::first(); //For Company Information
            $Business_Partner = Business_Partner::find($id); //For business Partner Information
            $company_name = $Business_Partner->business_name;
            $country_fetch  = Country::where('id',$Business_Partner->country_id)->first();
            $country = $country_fetch->country_name;
            $user_company_name = $user->company_name;
            $address =  $user->address;
            $email = $user->email;
            $phone = $user->mobile;
            $company_website  = $user->company_website;
            
            $subject = "Welcome to UBG Global – Your Lucky Draw Portal & App Access Details";
            $message = '
    		<!DOCTYPE html>
    			<html>
    			  <head>
    				  <meta charset="UTF-8">
    				  <title>Customer Login Details</title>
    			  </head>
    			  <body style="font-family: sans-serif;">
    				  <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
    					 <tr>
    						<td style="padding: 5px; background-color: #f4f4f4;">
    						  <p>Dear ' .
    						htmlspecialchars($customer->first_name) .',</p>
    						<h3>Welcome to UBG Global!</h3>
    						  <p>This email is sent on behalf of our trusted business partner <b>' . $company_name.'</b>,<b>'.$country . '</b>.We are excited to have you on board.</p>
    						</td>
    					 </tr>
    					 <tr>
    						<td style="padding: 5px; background-color: #f4f4f4;">
    						  <center><h2 style="color: #333;">Please find your login details below to access our portal through both the web and your Android mobile phone.</h2></center>
    						  Web Link : ' . env('WEB_URL') . '/Customer/public/
    						  <p>Username: ' .
                			htmlspecialchars($customer->email) .
    						'</p>
    						  <p>Password: ' .
    						htmlspecialchars($customer->mobile) .
    						'</p>
    						</td>
    					 </tr>
    					 <tr>
    						<td style="padding:5px; background-color: #f4f4f4;">
                                <b>Mobile Access:</b><br>
                                You can download our Android mobile app using the link below:<br>
                                ' . env('WEB_URL') . '/customerApp/<br>
                                Follow the on-screen instructions to install the app, log in, and start enjoying access to the lucky draws you have purchased.<br>
                                Thank you for choosing us. We look forward to bringing you exciting opportunities and rewards.<br>
    						</td>
    					 </tr>
                		 <tr>
                            <td style="padding: 20px;">
                              <h2 style="color: #333;">' . $user_company_name.'</h2>
                              <p>' . $address.'<br>
                              ' . $email.'|' . $phone.'|' . $company_website.'</p>
                            </td>
                         </tr>
                    </table>
    			  </body>
    			</html>
    				';
                $headers = "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=UTF-8\r\n";
                $headers .= "From: Luckydraw Team <no-reply@ubggloba.com>\r\n"; // Use a valid cPanel email
                $headers .= "Reply-To: no-reply@ubggloba.com\r\n";
                mail($customer->email, $subject, $message, $headers);
        } else {
            $customer_show = customer::where('mobile', $request->phone)->where('email', $request->email)->first();
            $msg = "exist";
        }
        return response()->json(['msg' => $msg, 'data' => $customer_show]);
    }

    function get_customer_id(Request $request)
    {
        //  dd($request);
        $customer = Customer::where('customer_id', $request->value)->first();
        return response()->json($customer);
    }

    function compress($sale = null, $templateId = null)
    {
        // $path  = storage_path('template/'.$name); // Image path
        $path = $this->print_text($sale, $templateId);
        $sale->sale_image_path = $path;
        // $link = str_replace('sales/photos/','', $path);
        // dd($link);
        $sale->save();
        // move(public_path('sales/photos/'), $link);
        // $imagePath = public_path('images/sample.jpg'); // Image path

        // PRINT IMAGE
        // $pdf = Pdf::loadHTML('<img src="'.$path.'" style="width:100%;">');
        // $image->save(storage_path('/app/home/text_image.jpg'));
        // return $pdf->download($name.'-ticket.pdf'); // Download PDF

        // return response()->image($image, Format::WEBP, quality: 65);
        
        // dd($sale);
        $customer_name = Customer::where('customer_id',$sale->customer_id)->first();
        $partner_name = Business_Partner::where('id',$sale->partner_id)->first();
        $luckydraw = Luckydraw::where('id',$sale->luckydraw_id)->first();
        $total_amount = $sale->qty * $sale->price;
        $user = User::first();
        $to = $customer_name->email; // Replace with actual email
            // Subject
            $subject = "Luckydraw Order - Ticket No:$sale->ticket_id";
            // Business partner details
        //   dd($subject);
            $message =
                '
    <!DOCTYPE html>
<html>
  <head>
      <meta charset="UTF-8">
      <title>Luckydraw Order Confirmation</title>
  </head>
  <body style="font-family: sans-serif;">
      <table width="600" align="center" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
         <tr>
            <td style="padding: 20px; background-color: #f4f4f4;">
              <h1 style="color: #333;">Your Luckydraw Order is Confirmed!</h1>
              <p>Dear ' .
                htmlspecialchars($customer_name->first_name) .
                ',</p>
              <p>Thank you for your recent order from' .htmlspecialchars($partner_name->business_name) .'. We re excited to get it to you!</p>
            </td>
         </tr>
         <tr>
            <td style="padding: 20px;">
              <center><h2 style="color: #333;">Order Summary</h2></center>
              <p>Luckydraw Ticket Number: #' .htmlspecialchars($sale->ticket_id) .'</p>
              <p>Order Date: ' .htmlspecialchars($sale->created_at->format('Y-m-d')) .'</p>
              <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
                  <tr>
                     <th style="text-align: left; padding-bottom: 5px;">Lucky draw Name</th>
                     <th style="text-align: right; padding-bottom: 5px;">Quantity</th>
                     <th style="text-align: right; padding-bottom: 5px;">Price</th>
                  </tr>
                  <tr>
                     <td style="border-top: 1px solid #ccc; padding-top: 5px;">' .htmlspecialchars($luckydraw->luckydraw_name) .'</td>
                     <td style="border-top: 1px solid #ccc; padding-top: 5px; text-align: right;">' .htmlspecialchars($sale->qty) .'</td>
                     <td style="border-top: 1px solid #ccc; padding-top: 5px; text-align: right;">' .htmlspecialchars($sale->price) .'</td>
                  </tr>
                  <tr>
                     <td colspan="3" style="text-align: right; padding-top: 10px;">Subtotal: ' .htmlspecialchars($total_amount) .'</td>
                  </tr>
                  <tr>
                     <td colspan="3" style="text-align: right;">Total: ' .htmlspecialchars($total_amount) .'</td>
                  </tr>
              </table>
            </td>
         </tr>
 		 <tr>
            <td style="padding: 20px; background-color: #f4f4f4;">
              <p>Downlod this ticket by clicking the below link : <a href="' . env('WEB_URL') . '/Apps/UBG-Luckydraws.apk" target="_blank">Download Android App</a></p>OR <p>You can download your this ticket by clicking the following link : <a href="' . env('WEB_URL') . '/BusinessPartner/public/'.$path.'" target="_blank">View Ticket</a></p>
            </td>
         </tr>
 		 <tr>
            <td style="padding: 20px; background-color: #f4f4f4;">
              <p>If you have any questions, please contact us at  ' .htmlspecialchars($user->email) .' or  ' .htmlspecialchars($user->mobile) .'.</p>
            </td>
         </tr>
		 <tr>
            <td style="padding: 20px;">
              <h2 style="color: #333;">Luckydraw Address:</h2>
              <p> ' .htmlspecialchars($partner_name->business_name) .'</p>
              <p>' .htmlspecialchars($partner_name->address_line_1) .'</p>
              <p>' .htmlspecialchars($partner_name->poc_email) .' | ' .htmlspecialchars($partner_name->poc_mobile) .' </p>
            </td>
         </tr>
      </table>
  </body>
</html>
    ';
    
    // dd($message);
    
    $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=UTF-8\r\n";
            $headers .= "From: Luckydraw Team <no-reply@ubggloba.com>\r\n"; // Use a valid cPanel email
            // $headers .= "Reply-To: support@your-domain.com\r\n";
            $headers .= "Reply-To: no-reply@ubggloba.com\r\n";
    
    // dd($message);

    mail($to, $subject, $message, $headers);
            
                
    }

    function print($id)
    {

        // $path  = storage_path('template/'.$name); // Image path
        // $path = $this->print_text($sale);
        // $sale->sale_image_path = $path;
        // $sale->save();
        $sale = Sale::where('id', $id)->first();
        
        $path = public_path($sale->sale_image_path); // Image path
        $html = '<img src="' . $path . '" style="width:100%; height:100vh; object-fit:cover;">';

        // PRINT IMAGE
        // $pdf = Pdf::loadHTML('<img src="'.$path.'" style="width:100%;">');
        $pdf = Pdf::loadHTML($html)->setPaper('a4', 'landscape');
        // $image->save(storage_path('/app/home/text_image.jpg'));
        return $pdf->download($sale->ticket_id.'-ticket.pdf'); // Download PDF

        // return response()->image($image, Format::WEBP, quality: 65);
    }
    
    
    function download_ticket_id($id)
    {
        // $path  = storage_path('template/'.$name); // Image path
        // $path = $this->print_text($sale);
        // $sale->sale_image_path = $path;
        // $sale->save();
        $sale = Sale::where('ticket_download_id', $id)->first();

        $path = public_path($sale->sale_image_path); // Image path
        $html = '<img src="' . $path . '" style="width:100%; height:100vh; object-fit:cover;">';

        // PRINT IMAGE
        // $pdf = Pdf::loadHTML('<img src="'.$path.'" style="width:100%;">');
        $pdf = Pdf::loadHTML($html)->setPaper('a4', 'landscape');
        // $image->save(storage_path('/app/home/text_image.jpg'));
        return $pdf->download($sale->ticket_id.'-ticket.pdf'); // Download PDF

        // return response()->image($image, Format::WEBP, quality: 65);
    }

    public function print_text($sale, $templateId = null)
    {
        $manager = new ImageManager(new Driver());
        //$image = $manager->read(Storage::get('/template/one.jpg'))->scale(1300, 1200);
        
        $templateImage = Template_Manager::find($templateId)->template_image;
        $image = $manager->read(file_get_contents(env('TEMPLATES_FOLDER_URL') . $templateImage))->scale(1300, 1200);
            
        $customer = Customer::where('customer_id', $sale->customer_id)->first();
        $luckydraw = Luckydraw::where('id', $sale->luckydraw_id)->first();

        $user = Session::get('user');
        $user_id = $user['id'];
        $business_partner = Business_Partner::find($user_id);

		$y = 200; 
		$lineHeight = 50; // vertical gap between rows

		// Label + Value pairs (without Price and Contact)
		$fields = [
			'Name'       => $customer->first_name ?? 'N/A',
			'Lucky Draw' => $luckydraw->luckydraw_name ?? 'N/A',
			'Ticket ID'  => $sale->ticket_id,
			'Business Partner'    => $business_partner->business_name ?? 'N/A',
		];

		// Loop through normal fields
		foreach ($fields as $label => $value) {
			if ($label === 'Business Partner') {
				$BPY = 375;  
				// Special case → Company in center with two lines
				$image->text($label, 600, $BPY, function (FontFactory $font) {
					$font->filename('./fonts/comic-sans.ttf');
					$font->size(28);
					$font->color('000000');
					$font->align('center');
					$font->valign('middle');
				});

				$BPY += $lineHeight;

				$image->text((string) $value, 600, $BPY, function (FontFactory $font) {
					$font->filename('./fonts/comic-sans.ttf');
					$font->size(32);
					$font->color('000000');
					$font->align('center');
					$font->valign('middle');
				});
				
				
			} else {
				// Normal left/right layout
				$image->text($label, 350, $y, function (FontFactory $font) {
					$font->filename('./fonts/comic-sans.ttf');
					$font->size(28);
					$font->color('000000');
					$font->align('left');
					$font->valign('middle');
				});

				$image->text((string) $value, 850, $y, function (FontFactory $font) {
					$font->filename('./fonts/comic-sans.ttf');
					$font->size(32);
					$font->color('000000');
					$font->align('right');
					$font->valign('middle');
				});
			}

			$y += $lineHeight;
		}

		// =======================
		// Fixed Draw Date Section
		// =======================

		// Example: put it lower than before (adjust $drawDateY if needed)
		$drawDateY = 550;  

		$image->text('Draw Date', 600, $drawDateY, function (FontFactory $font) {
			$font->filename('./fonts/comic-sans.ttf');
			$font->size(28);
			$font->color('000000');
			$font->align('center');
			$font->valign('middle');
		});

		$drawDateY += $lineHeight;

		$image->text((string) $sale->draw_date, 600, $drawDateY, function (FontFactory $font) {
			$font->filename('./fonts/comic-sans.ttf');
			$font->size(32);
			$font->color('000000');
			$font->align('center');
			$font->valign('middle');
		});

        //$name = time() . '.jpg';
        $name = $sale->ticket_id . '_' . uniqid() . '.jpg';

        $image->save(storage_path('app/sales/photos/' . $name));
        // $image->save(public_path('images/text_image2.jpg'));
        // $path  = public_path('sales/photos/' . $name); //
        
        $from = storage_path('app/sales/photos/' . $name);
        $to = public_path('sales/photos/' . $name);
        if (!File::exists(public_path('sales/photos'))) {
            File::makeDirectory(public_path('sales/photos'), 0755, true);
        }
        File::copy($from, $to);

        $path  = 'sales/photos/' . $name; //
        
        unset($image);
        unset($manager);

        return $path;
    }


    function get_luckydraw_id(Request $request)
    {
        $luckydraw = Luckydraw::where('id', $request->value)->first();
        return response()->json($luckydraw);
    }

    function get_customer_data(Request $request)
    {
        $user = Session::get('user');
        $user_id = $user['id'];
        $data = DB::table('customers')
            ->join('customers_groups', function ($join) {
                $join->on(DB::raw('FIND_IN_SET(customers.id, customers_groups.customer_ids)'), '>', DB::raw('0'));
            })
            ->where('customers_groups.id', $request->value)
            ->where('customers_groups.bp_id', $user_id)
            ->select('customers.*')
            ->get();
        $count = DB::table('customers_groups')
            ->where('id', $request->value)
            ->where('bp_id', $user_id)
            ->selectRaw('LENGTH(customer_ids) - LENGTH(REPLACE(customer_ids, ",", "")) + 1 as count')
            ->first();
        return response()->json(['data' => $data, 'count' => $count]);
    }
    
    public function create(Request $request)
    {
        $user = Session::get('user');
        $partnerId = $user['id'];
        if ($request->no_of_customers[0] == null) {
            // Single customer case
            foreach ($request->selectProduct as $key => $luckydrawId) {
                $luckydraw_data = Luckydraw::find($luckydrawId);
                $today = \Carbon\Carbon::now();
                $timeThreshold = \Carbon\Carbon::today()->setTime(17, 30,0);
                $displayDate = ($today->isFriday() && $today->lessThanOrEqualTo($timeThreshold))
                    ? $today->format('d-m-Y')
                    : $today->next(\Carbon\Carbon::FRIDAY)->format('d-m-Y');
                    $now = \Carbon\Carbon::now();
                    $isDec31 = $now->month === 12 && $now->day === 31;
                    $timeThreshold1 = \Carbon\Carbon::today()->setTime(17, 30,0);
                    $displayYear = ($isDec31 && $now->greaterThan($timeThreshold1))
                        ? $now->addYear()->year
                        : $now->year;
                        $now = \Carbon\Carbon::now();
                        $timeThreshold = \Carbon\Carbon::today()->setTime(17, 30 ,0);
                        $displayMonthEnd = $now->lessThanOrEqualTo($timeThreshold)
                        ? $now->endOfMonth()->format('d-m-Y')
                        : $now->addMonth()->endOfMonth()->format('d-m-Y');
                        $currentTime1 = \Carbon\Carbon::now();
                        $checkTime1 = \Carbon\Carbon::today()->setTime(17, 30, 0); // 5:30:00 PM
                        $isAfter1 = $currentTime1->greaterThan($checkTime1);
                        $displayDate1 = $isAfter1 
                        ? $currentTime1->copy()->addDay()->format('d-m-Y') 
                        : $currentTime1->format('d-m-Y');
			if($luckydraw_data->frequency == 1){
            	$draw_date =  $displayDate1.'-'.'At 9:30pm';
			}
		    elseif($luckydraw_data->frequency == 2){
                $draw_date =  $displayDate.'-'.'At 9:30pm';
		    }
		    elseif($luckydraw_data->frequency == 3){
                $draw_date =  $displayMonthEnd.'-'.'At 9:30pm';
		    }
		    elseif($luckydraw_data->frequency == 4){
                $draw_date =  '31-12-'.$displayYear.'-'.'At 9:30pm';
		    }
                
                $this->processSalesBatch(
                    $partnerId,
                    $luckydrawId,
                    $request->qty[$key],
                    $request->discount[$key] ?? 0,
                    $request->vat[$key] ?? 0,
                    $request->price[$key],
                    $draw_date,
                    $request->amount[$key],
                    $request->customer_id_hidden
                );
            }
        } else {
            // Multiple customers case
            foreach ($request->no_of_customers as $key => $noOfCustomers) {
                $luckydraw_data = Luckydraw::find($request->selectProduct[$key]);
                $today = \Carbon\Carbon::now();
                        $timeThreshold = \Carbon\Carbon::today()->setTime(17, 30,0);
                        $displayDate = ($today->isFriday() && $today->lessThanOrEqualTo($timeThreshold))
                            ? $today->format('d-m-Y')
                            : $today->next(\Carbon\Carbon::FRIDAY)->format('d-m-Y');
                            $now = \Carbon\Carbon::now();
                            $isDec31 = $now->month === 12 && $now->day === 31;
                            $timeThreshold1 = \Carbon\Carbon::today()->setTime(17, 30,0);
                            $displayYear = ($isDec31 && $now->greaterThan($timeThreshold1))
                                ? $now->addYear()->year
                                : $now->year;
                                $now = \Carbon\Carbon::now();
                                $timeThreshold = \Carbon\Carbon::today()->setTime(17, 30 ,0);
                                $displayMonthEnd = $now->lessThanOrEqualTo($timeThreshold)
                                ? $now->endOfMonth()->format('d-m-Y')
                                : $now->addMonth()->endOfMonth()->format('d-m-Y');
                                $currentTime1 = \Carbon\Carbon::now();
                                $checkTime1 = \Carbon\Carbon::today()->setTime(17, 30, 0); // 5:30:00 PM
                                $isAfter1 = $currentTime1->greaterThan($checkTime1);
                                $displayDate1 = $isAfter1 
                                ? $currentTime1->copy()->addDay()->format('d-m-Y') 
                                : $currentTime1->format('d-m-Y');
                
					
					if($luckydraw_data->frequency == 1){
                    	$draw_date =  $displayDate1.'-'.'At 9:30pm';
					}
				    elseif($luckydraw_data->frequency == 2){
                        $draw_date =  $displayDate.'-'.'At 9:30pm';
				    }
				    elseif($luckydraw_data->frequency == 3){
                        $draw_date =  $displayMonthEnd.'-'.'At 9:30pm';
				    }
				    elseif($luckydraw_data->frequency == 4){
                        $draw_date =  '31-12-'.$displayYear.'-'.'At 9:30pm';
				    }

                // dd($draw_date);
                
                $this->processSalesBatch(
                    $partnerId,
                    $request->selectProduct[$key],
                    $noOfCustomers * $request->qty[$key],
                    $request->discount[$key] ?? 0,
                    $request->vat[$key] ?? 0,
                    $request->price[$key],
                    $draw_date,
                    $request->amount[$key],
                    $request->customer_id_hidden_new,
                    true
                );
            }
        }
        return redirect('sales/view_sale')->with('success', 'Luckydraw tickets created successfully');
    }
    
    private function processSalesBatch(
        $partnerId,
        $luckydrawId,
        $quantity,
        $discount,
        $tax,
        $price,
        $draw_date,
        $amount,
        $customerIds,
        $isMultiCustomer = false
    ) {
        // Get last sale for this lucky draw
        $lastSale = Sale::where('luckydraw_id', $luckydrawId)
            ->orderBy('id', 'desc')
            ->first();
    
        // Get lucky draw templates
        $luckyDraw   = Luckydraw::findOrFail($luckydrawId);
        $templateIds = $this->parseTemplateIds($luckyDraw->template_id);
        $totalTemplates = count($templateIds);
    
        // Determine where we left off
        if ($lastSale) {
            $lastTemplateId = $lastSale->template_id;
            $lastIndex      = array_search($lastTemplateId, $templateIds);
            $lastIndex      = ($lastIndex === false) ? -1 : $lastIndex;
        } else {
            $lastIndex = -1; // no previous sale
        }
        
        // Get last ticket number
        $lastTicket = Sale::orderBy('ticket_id', 'desc')->first();
        $lastNumber = $lastTicket ? (int) preg_replace('/\D/', '', $lastTicket->ticket_id) : 0;
    
        $assignedTemplates = [];
    
        // Loop through the quantity and assign sequential templates
        for ($i = 0; $i < $quantity; $i++) {
            $lastIndex = ($lastIndex + 1) % $totalTemplates;
            $nextTemplateId = $templateIds[$lastIndex];
    
            $ticketNo = 'ABC' . str_pad($lastNumber + $i + 1, 4, '0', STR_PAD_LEFT);

            $customerId = $isMultiCustomer
                ? $customerIds[$i % count($customerIds)]
                : $customerIds;
    
            try {
                $sale = $this->createSale(
                    $partnerId,
                    $luckydrawId,
                    1,
                    $discount,
                    $tax,
                    $price,
                    $draw_date,
                    $amount,
                    $customerId,
                    $ticketNo,
                    $nextTemplateId
                );
    
                $this->compress($sale, $nextTemplateId);
                $assignedTemplates[] = $nextTemplateId;
            } catch (\Exception $e) {
                \Log::error('Sale creation error: ' . $e->getMessage());
            }
        }
    
        return $assignedTemplates;
    }
    
    private function parseTemplateIds($templateString)
    {
        $templateIds = array_map('intval', explode(',', trim($templateString, "() ")));
        return !empty($templateIds) ? $templateIds : [1];
    }
    
    private function parseAllocations($allocationString, $templateCount)
    {
        $allocations = array_map('intval', explode(',', trim($allocationString, "() ")));
    
        if (count($allocations) !== $templateCount || array_sum($allocations) !== 100) {
            return array_fill(0, $templateCount, intval(100 / $templateCount));
        }
    
        return $allocations;
    }
    
    private function getCurrentTemplateCounts($luckydrawId, $templateIds)
    {
        $counts = [];
        foreach ($templateIds as $templateId) {
            $counts[$templateId] = Sale::where('luckydraw_id', $luckydrawId)
                ->where('template_id', $templateId)
                ->count();
        }
        return $counts;
    }
    
    /**
     * Percentage-based fair distribution with drift correction
     */
    private function calculateFairDistribution($templateIds, $quantity, $currentCounts, $allocations)
    {
        $distribution = [];
        $totalCurrent = array_sum($currentCounts) ?: 1;
    
        // Step 1: Ratios from allocation %
        $ratios = [];
        foreach ($templateIds as $i => $templateId) {
            $ratios[$templateId] = $allocations[$i] / 100;
        }
    
        // Step 2: Target counts after this batch (total so far + this batch)
        $totalAfterBatch = $totalCurrent + $quantity;
        $targetAfterBatch = [];
        foreach ($templateIds as $templateId) {
            $targetAfterBatch[$templateId] = $ratios[$templateId] * $totalAfterBatch;
        }
    
        // Step 3: Tickets needed in this batch to hit target
        $neededThisBatch = [];
        foreach ($templateIds as $templateId) {
            $neededThisBatch[$templateId] = max(0, $targetAfterBatch[$templateId] - $currentCounts[$templateId]);
        }
    
        // Step 4: Normalize to match $quantity
        $sumNeeded = array_sum($neededThisBatch) ?: 1;
        foreach ($neededThisBatch as $templateId => $need) {
            $neededThisBatch[$templateId] = round(($need / $sumNeeded) * $quantity);
        }
    
        // Step 5: Adjust rounding drift
        $diff = $quantity - array_sum($neededThisBatch);
        if ($diff !== 0) {
            // Sort by how far behind they are from target
            $behindScore = [];
            foreach ($templateIds as $templateId) {
                $behindScore[$templateId] = $targetAfterBatch[$templateId] - ($currentCounts[$templateId] + $neededThisBatch[$templateId]);
            }
            arsort($behindScore); // largest positive gap first
        
            $keys = array_keys($behindScore);
            $i = 0;
            while ($diff > 0) {
                $neededThisBatch[$keys[$i % count($keys)]]++;
                $diff--;
                $i++;
            }
            while ($diff < 0) {
                $neededThisBatch[$keys[$i % count($keys)]]--;
                $diff++;
                $i++;
            }
        }
    
        // Step 6: Build final distribution
        foreach ($neededThisBatch as $templateId => $count) {
            $distribution = array_merge($distribution, array_fill(0, $count, $templateId));
        }
    
        shuffle($distribution);
        return $distribution;
    }
    
    private function createSale($partnerId, $luckydrawId, $quantity, $discount, $tax, $price,$draw_date, $amount, $customerId, $ticketNo, $templateId)
    {
        
        return Sale::create([
            'partner_id' => $partnerId, 
            'luckydraw_id' => $luckydrawId,
            'qty' => $quantity,
            'discount' => (int)$discount,
            'tax' => (int)$tax,
            'price' => $price,
            'amount' => $amount,
            'customer_id' => $customerId,
            'ticket_id' => $ticketNo,
            'draw_date' => $draw_date,
            'ticket_download_id' => Str::random(12),
            'template_id' => $templateId
        ]);
    }


}