<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Template_Manager;
use Session;
use App\Models\Template_group;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;


class TemplateManagerController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        // $donors = Donor::get();
        $template_manager = Template_Manager::get();
        return view("template_manager", compact("template_manager"));
    }
    function create(Request $request)
    {
        $template_manager_name = Template_Manager::where("template_name",$request->template_name)->exists();
        $template_manager_code = Template_Manager::where("template_code",$request->template_code)->exists();
        if ($template_manager_name) {
            Session::put("error_count6", "Same Template name is exists");
            return back()->with("error_count6", "Same Template name is exists");
        } elseif ($template_manager_code) {
            Session::put("error_count6", "Same Template code is exists");
            return back()->with("error_count6", "Same Template code is exists");
        } else {
            $template_manager = new Template_Manager();
            $template_manager->template_name = $request->template_name;
            $template_manager->template_code = $request->template_code;
            $template_manager->status = 1;
            if ($request->file("image")) {
                $image = $request->file("image");
                $imageName =
                    time() . "." . $image->getClientOriginalExtension();
                // dd('image/'.$imageName);
                $image->move("../../uploads/luckydraw/templates/", $imageName);
                $template_manager->template_image = $imageName;
            }
            $template_manager->save();
        }
        // $success = "Country Has Been Add.";
        return redirect("template_manager")->with(
            "success",
            "Template Manager Has Been Add."
        );
    }
    function validation(Request $request)
    {
        //  dd($request->all());
        $status = "";
        $action = [];
        $action1 = [];
        if ($request->action_status == "add") {
            $template_manager_name = Template_Manager::where(
                "template_name",
                $request->template_name
            )->first();
            if ($template_manager_name != null) {
                // dd('yes');
                $action["field"] = "name";
                $action["status"] = 1;
            } else {
                $action["field"] = "name";
                $action["status"] = 0;
            }
            $template_manager_code = Template_Manager::where(
                "template_code",
                $request->template_code
            )->first();
            if ($template_manager_code != null) {
                $action1["field"] = "code";
                $action1["status"] = 1;
            } else {
                $action1["field"] = "code";
                $action1["status"] = 0;
            }
            // $multi = [
            //     'action'=> $action,
            //     // 'status' => $status,
            //     ];
            return response()->json([
                "action" => $action,
                "action1" => $action1,
            ]);
        } else {
            $template_manager_name = Template_Manager::where(
                "template_name",
                $request->template_name
            )
                ->where("id", "!=", $request->b_area_id)
                ->first();
            if ($template_manager_name != null) {
                // dd('yes');
                $action["field"] = "name";
                $action["status"] = 1;
            } else {
                $action["field"] = "name";
                $action["status"] = 0;
            }
            $template_manager_code = Template_Manager::where(
                "template_code",
                $request->template_code
            )
                ->where("id", "!=", $request->b_area_id)
                ->first();
            if ($template_manager_code != null) {
                $action1["field"] = "code";
                $action1["status"] = 1;
            } else {
                $action1["field"] = "code";
                $action1["status"] = 0;
            }
            // $multi = [
            //     'action'=> $action,
            //     // 'status' => $status,
            //     ];
            return response()->json([
                "action" => $action,
                "action1" => $action1,
            ]);
        }
        // $Business_Area_code = Business_Area::where('area_code',$request->area_code)->first();
        // if($Business_Area_code != null)
        // {
        //     return back()->with('error', 'This code is already exist.');
        // }
        // $Business_Area_name_code = Business_Area::where('area_name',$request->area_name)->where('area_code',$request->area_code)->first();
    }
    function edit($id)
    {
        $template_manager = Template_Manager::get();
        $template_manager_edit = Template_Manager::find($id);
        // dd($city_edit);
        return view(
            "template_manager",
            compact("template_manager", "template_manager_edit")
        );
    }
    function update(Request $request, $id)
    {
        //   dd($id);
        $template_manager = Template_Manager::find($id);
        $template_manager->template_name = $request->template_name;
        $template_manager->template_code = $request->template_code;
        if ($request->file("image")) {
            $image = $request->file("image");
            $imageName = time() . "." . $image->getClientOriginalExtension();
            $image->move("../../uploads/luckydraw/templates/", $imageName);
            $template_manager->template_image = $imageName;
        } else {
            $template_manager->template_image =
                $template_manager->template_image;
        }
        // $city->status = 1;
        $template_manager->update();
        //  return back()->with('success', 'Business Area Has Been Updated.');
        return redirect("template_manager")->with(
            "success",
            "Template Manager  Has Been Updated"
        );
    }
    function status($id, $actions)
    {
        if ($actions == 1) {
            $city = Template_Manager::find($id);
            $city->status = 0;
            $city->update();
        } else {
            $city = Template_Manager::find($id);
            $city->status = 1;
            $city->update();
        }
        return redirect("template_manager")->with(
            "success",
            "Suspend Has Been Updated"
        );
    }
    function delete($id)
    {
        $city = Template_Manager::find($id);
        $city->delete();
        return redirect("template_manager")->with(
            "success",
            "Record has been Delete"
        );
    }
    public function clear(Request $request)
    {
        // dd('yes');
        // Option 1: Clear specific key
        session()->forget("error_count6");
        // Option 2: Clear all session data
        // session()->flush();
        return redirect()->back();
    }
 
	public function group()
    {
        $templateIds = Template_Manager::get();
        $template_group = Template_group::select(
            "id",
            "group_name",
            "template_ids",
            "status",
            DB::raw("LENGTH(template_ids) - LENGTH(REPLACE(template_ids, ',', '')) + 1 AS value_count")
        )
		->get();
        return view("manage_template_group",compact("templateIds", "template_group"));
    }
    public function create_group(Request $request)
    {
        $template_manager_name = Template_group::where("group_name",$request->group_name)->exists();
        $templateIds = (array) $request->input('template_ids');
        if ($template_manager_name) {
            Session::put("error_count7", "Same Group name is exists");
            return back()->with("error_count7", "Same Group name is exists");
        }  else {
            $template_group = new Template_group();
            
            if (in_array('all', $templateIds)) {
                // Get all active IDs
                $allTemplateIds = Template_Manager::where('status', 1)->pluck('id')->toArray();
                $templateArrayIds = implode(",", $allTemplateIds);
            } else {
                // Use only selected IDs
                $templateArrayIds = implode(",", $templateIds);
            }
            
            $template_group->group_name = $request->group_name;
            $template_group->template_ids = $templateArrayIds;
            $template_group->status = 1;
            
            $template_group->save();
        }
        // $success = "Country Has Been Add.";
        return redirect("template_manager_group/group")->with(
            "success",
            "Template Group Has Been Add."
        );

       
    }

    public function edit_group($id)
    {
        $template_group = Template_group::select(
            "id",
            "group_name",
            "template_ids",
            "status",
            DB::raw("LENGTH(template_ids) - LENGTH(REPLACE(template_ids, ',', '')) + 1 AS value_count")
        )
		->get();
        $templateIds = Template_Manager::get();
        $template_manager = Template_Manager::get();
        $template_group_edit = Template_group::select(
            "id",
            "group_name",
            "template_ids",
            "status",
            DB::raw("LENGTH(template_ids) - LENGTH(REPLACE(template_ids, ',', '')) + 1 AS value_count")
        )->find($id);
        // dd($template_group_edit);
        return view(
            "manage_template_group",
            compact("template_manager", "template_group_edit",'templateIds','template_group')
        );
    }

    public function update_group(Request $request, $id)
    {
        
         $template_group = Template_group::select(
            "id",
            "group_name",
            "template_ids",
            "status",
            DB::raw("LENGTH(template_ids) - LENGTH(REPLACE(template_ids, ',', '')) + 1 AS value_count")
        )
		->get();
		
		$template_group_edit = Template_group::select(
            "id",
            "group_name",
            "template_ids",
            "status",
            DB::raw("LENGTH(template_ids) - LENGTH(REPLACE(template_ids, ',', '')) + 1 AS value_count")
        )->find($id);
        
         $template_manager_name = Template_group::where("group_name",$request->group_name)->exists();
        $templateIds = (array) $request->input('template_ids');
        
        
        $template_group = Template_group::find($id);
            
            if (in_array('all', $templateIds)) {
                // Get all active IDs
                $allTemplateIds = Template_Manager::where('status', 1)->pluck('id')->toArray();
                $templateArrayIds = implode(",", $allTemplateIds);
            } else {
                // Use only selected IDs
                $templateArrayIds = implode(",", $templateIds);
            }
            
            $template_group->group_name = $request->group_name;
            $template_group->template_ids = $templateArrayIds;
    
            
            $template_group->update();
        $success = "Customer Group Has Been Added";
        //  return redirect('manage_customer/manage_customer_group',compact('success','customerId','customer_group'));

        return redirect("template_manager_group/group")
            ->with("success", "Template Group Has Been Update")
            ->with("template_group", $template_group)
            ->with("template_group_edit",$template_group_edit);
    }
    
    
    function status_group($id, $actions)
    {
        if ($actions == 1) {
            $city = Template_group::find($id);
            $city->status = 0;
            $city->update();
        } else {
            $city = Template_group::find($id);
            $city->status = 1;
            $city->update();
        }
        return redirect("template_manager_group/group")->with(
            "success",
            "Suspend Has Been Updated"
        );
    }

    function delete_group($id)
    {
        $customer_group_delete = Template_group::find($id);
        $customer_group_delete->delete();
        return redirect("template_manager_group/group")->with(
            "success",
            "Customer Group Has Been Delete"
        );
    }
}