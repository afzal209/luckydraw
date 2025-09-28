<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Business_Area;
use Session;
class BusinessAreaController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $business_area = Business_Area::get();
        return view("business_area", compact("business_area"));
    }
    function create(Request $request)
    {
        // dd($request);
        $Business_Area_name = Business_Area::where("area_name",$request->area_name)->exists();
        $Business_Area_code = Business_Area::where("area_code",$request->area_code)->exists();
        if ($Business_Area_name) {
            Session::put("error_count1", "Same Business name is exists");
            return back()->with("error_count", "This business name has already been registered");
        } elseif ($Business_Area_code) {
            Session::put("error_count1", "Same Business Code is exists");
            return back()->with("error_count", "This Business Code has already been registered");
        } else {
            $business_area = new Business_Area();
            $business_area->area_name = $request->area_name;
            $business_area->area_code = $request->area_code;
            $business_area->status = 1;
            $business_area->save();
            return back()->with("success", "Business Area has been added.");
        }
    }
    function validation(Request $request)
    {
        //  dd($request->all());
        $status = "";
        $action = [];
        $action1 = [];
        if ($request->action_status == "add") {
            $Business_Area_name = Business_Area::where("area_name",$request->area_name)->first();
            if ($Business_Area_name != null) {
                // dd('yes');
                $action["field"] = "name";
                $action["status"] = 1;
            } else {
                $action["field"] = "name";
                $action["status"] = 0;
            }
            $Business_Area_code = Business_Area::where("area_code",$request->area_code)->first();
            if ($Business_Area_code != null) {
                $action1["field"] = "code";
                $action1["status"] = 1;
            } else {
                $action1["field"] = "code";
                $action1["status"] = 0;
            }
            return response()->json(["action" => $action,"action1" => $action1,]);
        } else {
            $Business_Area_name = Business_Area::where("area_name",$request->area_name)
                ->where("id", "!=", $request->b_area_id)
                ->first();
            // dd($Business_Area_name);
            if ($Business_Area_name != null) {
                // dd('yes');
                $action["field"] = "name";
                $action["status"] = 1;
            } else {
                $action["field"] = "name";
                $action["status"] = 0;
            }
            $Business_Area_code = Business_Area::where(
                "area_code",
                $request->area_code
            )
                ->where("id", "!=", $request->b_area_id)
                ->first();
            if ($Business_Area_code != null) {
                $action1["field"] = "code";
                $action1["status"] = 1;
            } else {
                $action1["field"] = "code";
                $action1["status"] = 0;
            }
            return response()->json([
                "action" => $action,
                "action1" => $action1,
            ]);
        }
    }
    function edit($id)
    {
        $business_area_edit = Business_Area::where("id", $id)->first();
        $business_area = Business_Area::get();
        // dd($expert);
        return view("business_area",compact("business_area_edit", "business_area"));
    }
    function update(Request $request, $id)
    {
        $business_area = Business_Area::find($id);
        $business_area->area_name = $request->area_name;
        $business_area->area_code = $request->area_code;
        // $business_area->status = 1;
        $business_area->update();
        //  return back()->with('success', 'Business Area Has Been Updated.');
        return redirect("business_area")->with("success","Business Area has been updated");
    }
    function status($id, $actions)
    {
        if ($actions == 1) {
            $business_area = Business_Area::find($id);
            $business_area->status = 0;
            $business_area->update();
            return redirect("business_area")->with("success","Business Area has been Suspended");
        } else {
            $business_area = Business_Area::find($id);
            $business_area->status = 1;
            $business_area->update();
            return redirect("business_area")->with("success","Business Area has been Un Suspended");
        }
    }
    function delete($id)
    {
        $business_area = Business_Area::find($id);
        $business_area->delete();
        return redirect("business_area")->with("success","Record has been Deleted");
    }
    public function clear(Request $request)
    {
        session()->forget("error_count1");
        return redirect()->back();
    }
}