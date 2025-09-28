<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Business_Partner;
use App\Models\Support;
use App\Models\Support_Category;
use Hash;
use Session;
use Illuminate\Support\Facades\DB;
class SupportController extends Controller
{
    /**

     * Write code on Method

     *

     * @return response()

     */

	public function index()
	{
		$total_ticket = Support::count('id');
		$open_ticket = Support::where('status',0)->count('id');
		$under_process_ticket = Support::where('status',1)->count('id');
		$close_ticket = Support::where('status',2)->count('id');
		// $donors = Donor::get();
		$support_category_view =  DB::table('support')
		->join('support_categories', 'support.categoryid', '=', 'support_categories.id')
		->select('support.*', 'support_categories.name as category_name')
		->get();
		$support_category = Support_Category::where('status',1)->get();
		// dd($support_category);
		return view('support',compact('support_category','total_ticket','open_ticket','under_process_ticket','close_ticket','support_category_view'));
	}  
     
     
	function create(Request $request)
	{
		$support_category = Support_Category::where('status',1)->get();
		$user = Session::get('user');
		$userid = $user['id'];
		// dd($request);

		$support_data = Support::select('id')->latest('support_ticket_id')->first();
		// dd($support_data);
		if ($support_data) {
			$lastNumber = $support_data['id'];
			// $newNumber = $lastNumber++; 
			// dd($lastNumber++);
			$newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT); // Increment and format
			// dd($newNumber);
		} else {
			$newNumber = '0001'; // Start from 000001 if no records exist
		};
		$ticket_no = 'ABC'.$newNumber;
		// dd($ticket_no);
		$support = new Support();
		$support->support_ticket_id= $ticket_no;
		$support->raised_by_id = $userid;
		$support->categoryid = $request->categoryid;
		$support->subject = $request->subject;
		$support->description = $request->description;
		$support->status  = 0;
		$support->save();
		return redirect('support')->with('success','Support Has been Add')->with('support_category',$support_category);
	}    
	
	function update_support(Request $request, $id){
	    $record = Support::find($id);
    if ($record) {
        $record->status = $request->status;
        $record->reply = $request->reply;
        $record->updated_by = $request->updated_by;
        $record->updated_at = now();
        $record->update();

        return response()->json(['success' => true]);
    }
    return response()->json(['success' => false]);
	}
	
	function delete($id){
           $Support = Support::find($id);
           $Support->delete();
           return redirect('support')->with('success', 'Record has been Delete');
      
      }
     
	
	
}