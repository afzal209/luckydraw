<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Applicant;
use App\Models\Expert;
use App\Models\Paper;
use App\Models\Payment;
use App\Models\State;
use App\Models\District;
use App\Models\City;
use App\Models\Donor;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Faq;

class FaqController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
     public function index()
     {
        $faqs = Faq::get();
        return view('faq',compact('faqs'));
     }
     
     public function create(Request $request){
        // dd($request);
        $faq = new Faq();
        $faq->for =$request->for;
        $faq->question =$request->question;
        $faq->answer =$request->answer;
        $faq->status =$request->status;
        $faq->save();

        return back()->with('success', 'F.A.Q has been successfully added.');
    }
    function edit($id){
        $faq = Faq::where('id', $id);
        // dd($faq);
        return view('faq',compact('faqs'));
      }
      
      
      function view(){
            $faqs = Faq::get();
        return view('faqs',compact('faqs'));
      }
}