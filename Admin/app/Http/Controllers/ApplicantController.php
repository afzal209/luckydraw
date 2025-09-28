<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Applicant;
use App\Models\Expert;
use App\Models\Paper;
use App\Models\Payment;

use App\Models\Donor;

class ApplicantController extends Controller
{
    /**

     * Write code on Method

     *

     * @return response()

     */

     public function index()

     {
        $applicant = Applicant::get();
       
        
        
 
    
    
    // $donors = Donor::where('status', 0)
    // ->with(['payment', 'city', 'district', 'state']) // Eager load related models
    // ->orderBy('id', 'desc')
    // ->paginate(3);
         return view('applicant',compact('applicant'));
 
     }  
 
       
 
     
     
}
