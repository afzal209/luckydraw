<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;

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
        // dd($request);
        
        // $request->validate([
        //     "email" => "required",
        //     "password" => "required",
        // ]);
        // $credentials = $request->only("email", "password");
        // if (Auth::guard('business_partner')->attempt($credentials)) {
        //     return redirect()
        //         ->intended("dashboard")
        //         ->withSuccess("You have Successfully loggedin");
        // }
        // return redirect("/")->withSuccess("Oopes! You have entered invalid credentials");
        
        $request->validate([
            "email" => "required",
            "password" => "required",
        ]);
        $credentials = $request->only("email", "password");
        if (Auth::attempt($credentials)) {
            Session::put('user', Auth::user());
            return redirect()
                ->intended("dashboard")
                ->withSuccess("You have Successfully loggedin");
        }
        return redirect("/")->with("session_error","Oops! You have entered invalid credentials");
    }
    
    
    public function showLoginForm()
{
    if (session()->has('user')) {
        return redirect()->route('dashboard'); // Redirect if session exists
    }
    
    return view('auth.login'); // Show login page if no session
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
        return redirect("/")->withSuccess("Oops! You do not have access permission");
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