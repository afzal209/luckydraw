<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\Business_Partner;
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
        // dd($request->all());
        // $request->validate([
        //     "email" => "required",
        //     "password" => "required",
        // ]);
        // $credentials = $request->only("email", "password");
        // if (Auth::attempt($credentials)) {
        //     return redirect()
        //         ->intended("dashboard")
        //         ->withSuccess("You have Successfully loggedin");
        // }
        // return redirect("/")->withSuccess("Oopes! You have entered invalid credentials");
        
        $request->validate([
            "email" => "required",
            "password" => "required",
        ]);
        
        // Find the business partner by email
        $businessPartner = Business_Partner::where("poc_email", $request->email)->first();
        // dd($businessPartner);
        if ($businessPartner && Hash::check($request->password, $businessPartner->open_password)) {
            Session::put('user', $businessPartner);
            // dd('yes');
            // Auth::guard("business_partner")->login($businessPartner);
        
            return redirect()
                ->intended("dashboard")
                ->withSuccess("You have successfully logged in");
        }
        
        return redirect("/")->with("error_login", "Oops! You have entered invalid credentials");
    }
    /**
      * Write code on Method
      *
      * @return response()
      */
    public function postRegistration(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|min:6",
        ]);
        // Create the user
        $data = $request->all();
        $user = $this->create($data);
        // Log the user in
        Auth::login($user);
        // Redirect to dashboard with success message
        return redirect("dashboard")->withSuccess("Great! You have successfully registered and logged in.");
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
        return User::create([
            "name" => $data["name"],
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