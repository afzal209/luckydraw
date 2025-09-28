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
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Customer;
use Session;
use Carbon\Carbon;
use App\Models\Customer_group;
use Illuminate\Support\Facades\DB;
use Hash;
class ManageCustomerController extends Controller
{
    /**

     * Write code on Method

     *

     * @return response()

     */
    public function index()
    {
        // $donors = Donor::get();

        return view("manage_customer.add_new_customer");
    }

    public function view()
    {
        //$customer = Customer::get();
        $user = Session::get("user");
        $user_id = $user["id"];
        $customer = Customer::where('bp_id', $user_id)->get();
        return view("manage_customer.view_customer", compact("customer"));
    }

    public function bulk()
    {
        // dd($business_Partner);
        // $donors = Donor::get();

        //  $business_area = Business_Area::get();
        return view("manage_customer.bulk_customer");
    }

    public function group()
    {
        $user = Session::get("user");
        $id = $user["id"];
        $customerId = Customer::where("bp_id", $id)->get();
        $customer_group = Customer_group::select(
            "group_name",
            "id",
            "status",
            DB::raw(
                "LENGTH(customer_ids) - LENGTH(REPLACE(customer_ids, ',', '')) + 1 AS value_count"
            )
        )
            ->where("bp_id", $id)
            ->get();
        //  dd($customer_group);
        // dd($business_Partner);
        // $donors = Donor::get();

        //  $business_area = Business_Area::get();
        return view(
            "manage_customer.manage_customer_group",
            compact("customerId", "customer_group")
        );
    }

    public function customer_bulk_upload(Request $request)
    {
        $request->validate([
            "file" => "required|mimes:xlsx,csv",
        ]);

        $file = $request->file("file");

        // dd($newCustomerId);

        // Load the spreadsheet file
        $spreadsheet = IOFactory::load($file->getPathname());
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        foreach ($rows as $key => $row) {
            $currentYear = Carbon::now()->format("y"); // Get last two digits of the year
            $select_customser_id = Customer::select("customer_id")
                ->latest("customer_id")
                ->first();
            // dd($select_customser_id);
            if ($select_customser_id) {
                $lastNumber = (int) substr($select_customser_id->customer_id,2); // Extract numeric part
                $newNumber = str_pad($lastNumber + 1, 6, "0", STR_PAD_LEFT); // Increment and format
            } else {
                $newNumber = "000001"; // Start from 000001 if no records exist
            }

            $newCustomerId = $currentYear . $newNumber;
            $user = Session::get("user");
            $id = $user["id"];
            // Skip the header row
            if ($key == 0) {
                continue;
            }

            // Check if the name already exists in the database
            $customer = Customer::where("email", $row[2])->first();

            if ($customer) {
                // Update the existing record
                $customer->update([
                    "first_name" => $row[1], // Update email
                    "mobile" => $row[3], // Update phone
                    "status" => 1,
                ]);
            } else {
                // Insert a new record
                Customer::create([
                    "first_name" => $row[1], // Insert name
                    "email" => $row[2], // Insert email
                    "mobile" => $row[3], // Insert phone
                    "customer_id" => $newCustomerId,
                    "password" => Hash::make($row[3]),
                    "bp_id" => $id,
                    "status" => 1,
                ]);
                $business_partner = Business_Partner::find($id);
                $business_partner_company_name = $business_partner->business_name;
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
        						htmlspecialchars($row[1]) .',</p>
        						<h3>Welcome to UBG Global!</h3>
        						  <p>This email is sent on behalf of our trusted business partner <b>' . $business_partner_company_name.'</b>.We are excited to have you on board.</p>
        						</td>
        					 </tr>
        					 <tr>
        						<td style="padding: 5px; background-color: #f4f4f4;">
        						  <center><h2 style="color: #333;">Please find your login details below to access our portal through both the web and your Android mobile phone.</h2></center>
        						  Web Link: <a href="' . env('WEB_URL') . '/Customer/public/">' . env('WEB_URL') . '/Customer/public/</a>
        						  <p>Username: ' .
                    			htmlspecialchars($row[2]) .
        						'</p>
        						  <p>Password: ' .
        						htmlspecialchars($row[3]) .
        						'</p>
        						</td>
        					 </tr>
        					 <tr>
        						<td style="padding:5px; background-color: #f4f4f4;">
                                    <b>Mobile Access:</b><br>
                                    You can download our Android mobile app using the link below:<br>
                                    <a href="' . env('WEB_URL') . '/customerApp/">' . env('WEB_URL') . '/customerApp/</a><br>
                                    Follow the on-screen instructions to install the app, log in, and start enjoying access to the lucky draws you have purchased.<br>
                                    Thank you for choosing us. We look forward to bringing you exciting opportunities and rewards.<br>
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
                    mail($row[2], $subject, $message, $headers);                
            }
        }
        return redirect("manage_customer/view_customer")->with("success","Excel file processed successfully.");
    }

    public function create(Request $request)
    {
        // $data = $request->validate([
        //     "group_name" => "required|string|max:255",
        // ]);

        $user = Session::get("user");
        $id = $user["id"];

        $currentYear = Carbon::now()->format("y"); // Get last two digits of the year
        $select_customser_id = Customer::select("customer_id")
            ->latest("customer_id")
            ->first();
        // dd($select_customser_id);
        if ($select_customser_id) {
            $lastNumber = (int) substr($select_customser_id->customer_id, 2); // Extract numeric part
            $newNumber = str_pad($lastNumber + 1, 6, "0", STR_PAD_LEFT); // Increment and format
        } else {
            $newNumber = "000001"; // Start from 000001 if no records exist
        }
        $newCustomerId = $currentYear . $newNumber;
        $customer = new Customer();
        $customer->first_name = $request->customer_name;
        $customer->email = $request->customer_mail;
        $customer->mobile = $request->customer_phone;
        $customer->password = Hash::make($request->customer_name);
        $customer->bp_id = $id;
        $customer->customer_id = $newCustomerId;
        $customer->status = 1;
        $customer->save();
        $business_partner = Business_Partner::find($id);
        $business_partner_company_name = $business_partner->business_name;
        //Mail to the Customer Individaully Added through Add Customer
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
						  <p>This email is sent on behalf of our trusted business partner <b>' . $business_partner_company_name.'</b>.We are excited to have you on board.</p>
						</td>
					 </tr>
					 <tr>
						<td style="padding: 5px; background-color: #f4f4f4;">
						  <center><h2 style="color: #333;">Please find your login details below to access our portal through both the web and your Android mobile phone.</h2></center>
						  Web Link: <a href="' . env('WEB_URL') . '/Customer/public/">' . env('WEB_URL') . '/Customer/public/</a>
						  <p>Username: ' .
            			htmlspecialchars($customer->email) .
						'</p>
						  <p>Password: ' .
						htmlspecialchars($customer->first_name) .
						'</p>
						</td>
					 </tr>
					 <tr>
						<td style="padding:5px; background-color: #f4f4f4;">
                            <b>Mobile Access:</b><br>
                            You can download our Android mobile app using the link below:<br>
                            <a href="' . env('WEB_URL') . '/customerApp/">' . env('WEB_URL') . '/customerApp/</a><br>
                            Follow the on-screen instructions to install the app, log in, and start enjoying access to the lucky draws you have purchased.<br>
                            Thank you for choosing us. We look forward to bringing you exciting opportunities and rewards.<br>
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
        return redirect("manage_customer/view_customer")->with( "success", "Customer Has Been Added");
    }

    public function edit($id)
    {
        $customer_edit = Customer::find($id);
        return view(
            "manage_customer/add_new_customer",
            compact("customer_edit")
        );
    }

    public function edit_group($id)
    {
        $user = Session::get("user");
        $user_id = $user["id"];
        $customerId = Customer::where("bp_id", $user_id)->get();
        $customer_group = Customer_group::where("bp_id", $user_id)->get();
        $customer_group_edit = Customer_group::find($id);
        //  dd($customer_group_edit);
        return view(
            "manage_customer/manage_customer_group",
            compact("customerId", "customer_group_edit", "customer_group")
        );
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        $customer->first_name = $request->customer_name;
        $customer->email = $request->customer_mail;
        $customer->mobile = $request->customer_phone;
        $customer->update();
        return redirect("manage_customer/view_customer")->with(
            "success",
            "Customer Has Been Updated"
        );
    }

    public function create_group(Request $request)
    {
        $user = Session::get("user");
        $id = $user["id"];
        $customerId = Customer::where("bp_id", $id)->get();
        $customer_group = Customer_group::where("bp_id", $id)->get();
        $customer_group_add = new Customer_group();
        $customer_group_add->group_name = $request->group_name;
        $customer_group_add->customer_ids = is_array(
            $request->input("customer_ids")
        )
            ? implode(",", $request->input("customer_ids"))
            : "";
        $customer_group_add->bp_id = $id;
        $customer_group_add->status = 1;
        $customer_group_add->save();
        $success = "Customer Group Has Been Added";
        //  return redirect('manage_customer/manage_customer_group',compact('success','customerId','customer_group'));

        return redirect("manage_customer/manage_customer_group")
            ->with("success", "Customer Group Has Been Added")
            ->with("customerId", $customerId)
            ->with("customer_group", $customer_group);
    }

    public function update_group(Request $request, $id)
    {
        $user = Session::get("user");
        $id_u = $user["id"];
        $customerId = Customer::where("bp_id", $id_u)->get();
        $customer_group = Customer_group::where("bp_id", $id_u)->get();
        $customer_group_add = Customer_group::find($id);
        $customer_group_add->group_name = $request->group_name;
        $customer_group_add->customer_ids = is_array(
            $request->input("customer_ids")
        )
            ? implode(",", $request->input("customer_ids"))
            : "";

        $customer_group_add->update();
        $success = "Customer Group Has Been Added";
        //  return redirect('manage_customer/manage_customer_group',compact('success','customerId','customer_group'));

        return redirect("manage_customer/manage_customer_group")
            ->with("success", "Customer Group Has Been Update")
            ->with("customerId", $customerId)
            ->with("customer_group", $customer_group);
    }

    function delete_group($id)
    {
        $customer_group_delete = Customer_group::find($id);
        $customer_group_delete->delete();
        return redirect("manage_customer/manage_customer_group")->with(
            "success",
            "Customer Group Has Been Delete"
        );
    }

    //      function get_region(Request $request){
    //          $country = Country::where('region_id',$request->region_id)->get();
    //         return response()->json($country);
    //      }

    //      function get_country(Request $request){
    //          $state = State::where('country_id',$request->country_id)->get();
    //         return response()->json($state);
    //      }

    //      function get_state(Request $request){
    //          $city = City::where('state_id',$request->state_id)->get();
    //         return response()->json($city);
    //      }

    //  function create(Request $request){
    //         // dd($request);

    //         $request->validate([
    //         'prefix' => 'required',  // Required textbox
    //         'poc_first_name' => 'required', // Required dropdown
    //         'poc_last_name' => 'required', // Required dropdown
    //         'poc_email' => 'required', // Required dropdown
    //         'poc_mobile' => 'required', // Required dropdown
    //         'business_area_id' => 'required', // Required dropdown
    //         'business_name' => 'required', // Required dropdown
    //         'region_id' => 'required', // Required dropdown
    //         'country_id' => 'required', // Required dropdown
    //         'state_id' => 'required', // Required dropdown
    //         'city_id' => 'required', // Required dropdown
    //         'zip_code' => 'required', // Required dropdown
    //         'profile_image' => 'required', // Required dropdown
    //         'initial_deposit' => 'required', // Required dropdown
    //         'initial_tx_id' => 'required', // Required dropdown
    //         'initial_tx_date' => 'required', // Required dropdown
    //         'imageName_tx_image' => 'required', // Required dropdown

    //     ]);

    //         $business_partner = new Business_Partner();
    //          $business_partner->prefix =$request->prefix;
    //         $business_partner->poc_first_name =$request->poc_first_name;
    //         $business_partner->poc_last_name =$request->poc_last_name;
    //         $business_partner->poc_email =$request->poc_email;
    //         $business_partner->poc_mobile =$request->poc_mobile;
    //         $business_partner->business_area_id =$request->business_area_id;
    //         $business_partner->business_name =$request->business_name;
    //         $business_partner->address_line_1 =$request->address_line_1;
    //         $business_partner->address_line_2 =$request->address_line_2;
    //         $business_partner->region_id =$request->region_id;
    //         $business_partner->country_id =$request->country_id;
    //         $business_partner->state_id =$request->state_id;
    //         $business_partner->city_id =$request->city_id;
    //         $business_partner->zip_code =$request->zip_code;
    //         if ($request->file('profile_image')) {
    //             $image = $request->file('profile_image');
    //             $imageName_profile = time() . '.' . $image->getClientOriginalExtension();
    //             // dd('image/'.$imageName);
    //             $image->move(public_path('image/profile_image/'), $imageName_profile);

    //         // $template_manager->template_image = 'image/'.$imageName;
    //         $business_partner->profile_image ='image/profile_image/'.$imageName_profile;
    //         }

    //         $business_partner->initial_deposit =$request->initial_deposit;
    //         $business_partner->initial_tx_id =$request->initial_tx_id;
    //         $business_partner->initial_tx_date =$request->initial_tx_date;
    //         if ($request->file('initial_tx_image')) {
    //             $image = $request->file('initial_tx_image');
    //             $imageName_tx_image = time() . '.' . $image->getClientOriginalExtension();
    //             // dd('image/'.$imageName);
    //             $image->move(public_path('image/tx_image/'), $imageName_tx_image);

    //         // $template_manager->template_image = 'image/'.$imageName;
    //         // $business_partner->profile_image ='image/profile_image/'.$imageName_profile;
    //         $business_partner->initial_tx_image ='image/tx_image/'.$imageName_tx_image;
    //         }
    //         $business_partner->open_password = Hash::make($request->poc_first_name);
    //         $business_partner->save();
    //         $business_Partner = Business_Partner::select('business_partners.*', 'region.region_name', 'country.country_name','business_area.area_name','state.state_title')
    //         ->join('region', 'business_partners.region_id', '=', 'region.id') // Join city with state
    //         ->join('country', 'business_partners.country_id', '=', 'country.id') // Join city with country
    //         ->join('state', 'business_partners.state_id', '=', 'state.id')
    //         ->join('business_area','business_partners.business_area_id','=','business_area.id')
    //         ->get();
    //         $success = 'Partner Has Been Add.';
    //         return view('business_partners/partners',compact('success','business_Partner'));
    //     }

    //   function edit($id){
    //             $business_area = Business_Area::get();
    //           $region = Region::get();
    //           $business_edit = Business_Partner::select('business_partners.*', 'region.region_name', 'country.country_name','business_area.area_name','state.state_title')
    //         ->join('region', 'business_partners.region_id', '=', 'region.id') // Join city with state
    //         ->join('country', 'business_partners.country_id', '=', 'country.id') // Join city with country
    //         ->join('state', 'business_partners.state_id', '=', 'state.id')
    //         ->join('business_area','business_partners.business_area_id','=','business_area.id')->where('business_partners.id',$id)->first();
    //         // dd($business_edit);
    //         return view('business_partners.partner',compact('business_area','region','business_edit'));
    //       }

    //       function update(Request $request,$id){

    //           $business_area = Business_Area::find($id);
    //             $business_area->area_name =$request->area_name;
    //         $business_area->area_code =$request->area_code;
    //         // $business_area->status = 1;
    //         $business_area->update();
    //         //  return back()->with('success', 'Business Area Has Been Updated.');
    //          return redirect('business_area')->with('success', 'Business Area Has Been Updated');
    //       }

    //       function status($id,$actions){
    //           if($actions == 1){
    //               $business_area = Business_Area::find($id);
    //               $business_area->status = 0;
    //               $business_area->update();
    //           }
    //           else{
    //               $business_area = Business_Area::find($id);
    //               $business_area->status = 1;
    //               $business_area->update();
    //           }
    //           return redirect('business_area')->with('success', 'Suspend Has Been Updated');
    //       }

    //       function delete($id){
    //           $business_area = Business_Area::find($id);
    //           $business_area->delete();
    //           return redirect('business_area')->with('success', 'Record has been Delete');

    //       }
}
