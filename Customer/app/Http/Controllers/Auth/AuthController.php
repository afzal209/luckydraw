<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;

use Hash;
class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view("auth.login");
    }
    /**
      * Write code on Method
      *
      * @return response()
      */
    public function registration()
    {
        return view("auth.registration");
    }
    /**
      * Write code on Method
      *
      * @return response()
      */
    public function postLogin(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            "email" => "required",
            "password" => "required",
        ]);
        
        // Find the business partner by email
        $customer = Customer::where("email", $request->email)->first();
        // dd($businessPartner);
        if ($customer && Hash::check($request->password, $customer->password)) {
            Session::put('user', $customer);
            // dd('yes');
            // Auth::guard("business_partner")->login($businessPartner);
        
            // return redirect()
            //     ->intended("dashboard")
            //     ->withSuccess("You have successfully logged in");
            return response()->json(['success' => 'You have successfully logged in']);
        }
        
        // return redirect("/")->with("error_login", "Oops! You have entered invalid credentials");
        return response()->json(['errors' => 'Oops! You have entered invalid credentials'], 422);
    }
    /**
      * Write code on Method
      *
      * @return response()
      */
    public function postRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
        "email" => "required|email|unique:customers",
        "password" => "required|min:6",
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // Create the user
        $data = $request->all();
        $customer = $this->create($data);
        $msg = "Customer Created";
        return response()->json(['success' => 'Customer Created Successfully']);
        // return response()->json(['msg' => $msg]);
        // Log the user in
        // Auth::login($user);
        // Redirect to dashboard with success message
        // return redirect("dashboard")->withSuccess("Great! You have successfully registered and logged in.");
    }
    /**
      * Write code on Method
      *
      * @return response()
      */
    public function dashboard()
    {
        if (Auth::check()) {
            return view("dashboard");
        }
        return redirect("/")->withSuccess("Opps! You do not have access");
    }
    /**
      * Write code on Method
      *
      * @return response()
      */
    public function create(array $data)
    {
        return Customer::create([
            "email" => $data["email"],
            "password" => Hash::make($data["password"]),
        ]);
    }
    /**
      * Write code on Method
      *
      * @return response()
      */
    public function logout()
    {
        
        Session::flush();
        Auth::logout();
        return Redirect("/");
    }
}