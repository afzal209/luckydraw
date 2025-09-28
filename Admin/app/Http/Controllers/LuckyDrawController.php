<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Business_Area;
use App\Models\Region;
use App\Models\Country;
use App\Models\State;
use App\Models\Template_Manager;
use App\Models\Template_group;
use App\Models\Luckydraw;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use Carbon\Carbon;
use App\Models\Prize_Distribution;
use App\Models\Prize;
class LuckyDrawController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        // $applicant = Applicant::get();
        $business_area = Business_Area::get();
        $region = Region::where('status','=', 1)
        ->get()
        ->prepend((object)[
            'id' => 'all',
            'region_name' => 'All',
            'region_code' => null,
            'created_at' => null,
            'updated_at' => null,
            'deleted_at' => null,
            'status' => 1
        ]);
        $template_Manager = Template_Manager::where('status','=',1)->get();
        $luckydraw_sale = Luckydraw::select("sales.id")
            ->join("sales", "luckydraws.id", "=", "sales.luckydraw_id")
            ->count("sales.luckydraw_id");
        $luckydraws = Luckydraw::select(
        "luckydraws.*",
        DB::raw("GROUP_CONCAT(DISTINCT luckydraw_template.template_name SEPARATOR ', ') as template_names"),
        DB::raw("GROUP_CONCAT(DISTINCT region.region_name SEPARATOR ', ') as region_names"),
        DB::raw("GROUP_CONCAT(DISTINCT country.country_name SEPARATOR ', ') as country_names"),
        DB::raw("GROUP_CONCAT(DISTINCT state.state_title SEPARATOR ', ') as state_names")
    )
    ->leftJoin("region", function ($join) {
        $join->on(DB::raw("FIND_IN_SET(region.id, luckydraws.region_id)"), ">", DB::raw("0"));
    })
    ->leftJoin("country", function ($join) {
        $join->on(DB::raw("FIND_IN_SET(country.id, luckydraws.country_id)"), ">", DB::raw("0"));
    })
    ->leftJoin("state", function ($join) {
        $join->on(DB::raw("FIND_IN_SET(state.id, luckydraws.state_id)"), ">", DB::raw("0"));
    })
    ->leftJoin("luckydraw_template", function ($join) {
        $join->on(DB::raw("FIND_IN_SET(luckydraw_template.id, luckydraws.template_id)"), ">", DB::raw("0"));
    })
    ->where('region.status','=',1)
    ->where('country.status','=',1)
    ->where('state.status','=',1)
    ->groupBy("luckydraws.id") // only group by main ID
    ->get();
        // dd($luckydraws);
        // $donors = Donor::where('status', 0)
        // ->with(['payment', 'city', 'district', 'state']) // Eager load related models
        // ->orderBy('id', 'desc')
        // ->paginate(3);
        return view(
            "luckydraw",
            compact(
                "business_area",
                "region",
                "template_Manager",
                "luckydraws",
                "luckydraw_sale"
            )
        );
    }
    
    
    public function add(){
        
          $business_area = Business_Area::get();
        $region = Region::where('status','=', 1)
        ->get()
        ->prepend((object)[
            'id' => 'all',
            'region_name' => 'All',
            'region_code' => null,
            'created_at' => null,
            'updated_at' => null,
            'deleted_at' => null,
            'status' => 1
        ]);
        $template_Manager = Template_Manager::where('status','=',1)->get();
        $luckydraw_sale = Luckydraw::select("sales.id")
            ->join("sales", "luckydraws.id", "=", "sales.luckydraw_id")
            ->count("sales.luckydraw_id");
        $luckydraws = Luckydraw::select(
        "luckydraws.*",
        DB::raw("GROUP_CONCAT(DISTINCT luckydraw_template.template_name SEPARATOR ', ') as template_names"),
        DB::raw("GROUP_CONCAT(DISTINCT region.region_name SEPARATOR ', ') as region_names"),
        DB::raw("GROUP_CONCAT(DISTINCT country.country_name SEPARATOR ', ') as country_names"),
        DB::raw("GROUP_CONCAT(DISTINCT state.state_title SEPARATOR ', ') as state_names")
    )
    ->leftJoin("region", function ($join) {
        $join->on(DB::raw("FIND_IN_SET(region.id, luckydraws.region_id)"), ">", DB::raw("0"));
    })
    ->leftJoin("country", function ($join) {
        $join->on(DB::raw("FIND_IN_SET(country.id, luckydraws.country_id)"), ">", DB::raw("0"));
    })
    ->leftJoin("state", function ($join) {
        $join->on(DB::raw("FIND_IN_SET(state.id, luckydraws.state_id)"), ">", DB::raw("0"));
    })
    ->leftJoin("luckydraw_template", function ($join) {
        $join->on(DB::raw("FIND_IN_SET(luckydraw_template.id, luckydraws.template_id)"), ">", DB::raw("0"));
    })
    ->where('region.status','=',1)
    ->where('country.status','=',1)
    ->where('state.status','=',1)
    ->groupBy("luckydraws.id") // only group by main ID
    ->get();
        // dd($luckydraws);
        // $donors = Donor::where('status', 0)
        // ->with(['payment', 'city', 'district', 'state']) // Eager load related models
        // ->orderBy('id', 'desc')
        // ->paginate(3);
        return view(
            "luckydraws",
            compact(
                "business_area",
                "region",
                "template_Manager",
                "luckydraws",
                "luckydraw_sale"
            )
        );
    }
    
    public function get_template_option(Request $request){
       if ($request->option_id == 1) {
    $template_option = Template_Manager::select('id as id', 'template_name as name')->get();
} else {
    $template_option = Template_group::select('id as id', 'group_name as name')->get();
}

// prepend "All" option
$template_option->prepend([
    'id' => 'all',
    'name' => 'All'
]);

return response()->json(['template_option' => $template_option]);
    }
    
    public function get_country(Request $request)
    {
        $regions = $request->input('region_id'); // Can be a single value or array
        // If 'all' is selected, fetch all countries
        if (is_array($regions) && in_array('all', $regions)) {
            $countries = Country::where('status', 1)->get();
        } elseif ($regions === 'all') {
            $countries = Country::where('status','=', 1)->get();
        } else {
            // Ensure $regions is always an array
            $regionIds = is_array($regions) ? $regions : [$regions];
            $countries = Country::whereIn('region_id', $regionIds)
                ->where('status','=', 1)
                ->get();
        }
        // Add "All" option at the top
        $countries->prepend((object)[
            'id' => 'all',
            'country_name' => 'All',
            'region_id' => null,
            'created_at' => null,
            'updated_at' => null,
            'deleted_at' => null,
            'status' => 1
        ]);
        return response()->json(['countries' => $countries]);
    }
    public function get_state(Request $request)
    {
        $countries = (array) $request->input("country_id");
        $regionIds = (array) $request->input("region_ids");
        if (is_array($countries) && in_array('all', $countries)) {
            $states = State::where('status','=', 1)->get();
        } elseif ($countries === 'all') {
            $states = State::where('status','=', 1)->get();
        } else {
            // Ensure $regions is always an array
            $countries = is_array($countries) ? $countries : [$countries];
            $states = State::whereIn('country_id', $countries)
                ->where('status','=', 1)
                ->get();
        }
        // if (in_array('all', $countries)) {
        //     if (!empty($regionIds)) {
        //         // Filter states by countries that belong to the selected regions
        //         $states = State::whereHas('country', function ($q) use ($countries) {
        //             $q->whereIn("country_id", $countries)->where('status', 1);
        //         })->where('status', 1)->get();
        //     } else {
        //         // fallback: all states
        //         $states = State::where('status', 1)->get();
        //     }
        // } else {
        //     $states = State::whereIn("country_id", $countries)
        //         ->where('status', 1)
        //         ->get();
        // }
        // Prepend "All" state
        $states->prepend((object)[
            'id' => 'all',
            'state_title' => 'All',
            'state_description' => null,
            'country_id' => null,
            'status' => 1,
            'created_at' => null,
            'updated_at' => null,
            'deleted_at' => null,
        ]);
        return response()->json(["states" => $states]);
    }
    
    
      private function getTemplateGroups($groups)
    {
        
        
        
        $positions = array_fill(0, count($groups), 0);
    $groupCount = count($groups);

    // Find the max group length
    $maxLength = 0;
    foreach ($groups as $group) {
        $maxLength = max($maxLength, count($group));
    }

    $result = [];
    $i = 0;

    // Run only as many times as the longest group
    while ($i < $maxLength * $groupCount) {
        $groupIndex = $i % $groupCount;
        $group = $groups[$groupIndex];

        $value = $group[$positions[$groupIndex] % count($group)];
        $result[] = $value;

        $positions[$groupIndex]++;
        $i++;
    }

    return $result;
        
    }

    
    public function create(Request $request)
    {
        //   dd($request->all());
        //   dd($request);
        //   dd($request->input('region_id'));
        $region = Region::get();
        $template_Manager = Template_Manager::where('status','=',1)->get();
        $Luckydraw = new Luckydraw();
        $Luckydraw->luckydraw_name = $request->luckydraw_name;
        $Luckydraw->frequency = $request->frequency;
        $Luckydraw->format = $request->format;
        // $Luckydraw ->region_id  =implode(',', $request->input('region_id'));
        // $Luckydraw ->country_id =implode(',', $request->input('country_id'));
        // $Luckydraw ->state_id  =implode(',', $request->input('state_id'));
        // $Luckydraw ->template_id   =$request->template_id;
        $regionIds = (array) $request->input('region_id');
        $countryIds = (array) $request->input('country_id');
        $stateIds = (array) $request->input('state_id');
         $templateIds = (array) $request->input('template_id');

// If "all" is selected
if (in_array('all', $templateIds)) {
    // Get all active IDs
    $allTemplateIds = Template_Manager::where('status', 1)->pluck('id')->toArray();
    $templateArrayIds = implode(",", $allTemplateIds);
} else {
    // Use only selected IDs
    $templateArrayIds = implode(",", $templateIds);
}
        
        
        
        $allRegionIds = in_array('all', $regionIds) ? Region::where('status', 1)->pluck('id')->toArray() : NULL;
      $allCountryIds = in_array('all', $regionIds)
    ? Country::where('status', 1)->pluck('id')->toArray()
    : Country::whereIn('region_id', $regionIds)->where('status', 1)->pluck('id')->toArray();
        $allStateIds = in_array('all', $countryIds)
    ? State::where('status', 1)->pluck('id')->toArray()
    : State::whereIn('country_id', $countryIds)->where('status', 1)->pluck('id')->toArray();
        // $allStateIds = in_array('all', $stateIds) ? State::whereIn('country_id', $countryIds)->where('status', 1)->pluck('id')->toArray() : NULL;
        //  $allTemplateIds = in_array('all', $templateIds) ? Template_Manager::whereIn('id', $templateIds)->where('status', 1)->pluck('id')->toArray() : NULL;
        $regionArrayIds = in_array('all', $regionIds) ?  implode(",", $allRegionIds) : implode(",", $regionIds);
        $countryArrayIds = in_array('all', $countryIds) ?  implode(",", $allCountryIds) : implode(",", $countryIds);
        $stateArrayIds = in_array('all', $stateIds) ?  implode(",", $allStateIds) : implode(",", $stateIds);
        // $templateArrayIds = in_array('all', $templateIds) ?  implode(",", $allTemplateIds) : implode(",", $templateIds);
        $Luckydraw->region_id = isset($regionArrayIds) ? $regionArrayIds : "";
        
        
        
        $Luckydraw->country_id = isset($countryArrayIds) ? $countryArrayIds : "";
        // dd($allCountryIds);
        
    
        
         $Luckydraw->template_option = $request->template_option;
        $Luckydraw->state_id = isset($stateArrayIds) ? $stateArrayIds : "";
        
            if($request->template_option == 1){
            $Luckydraw->template_id = $templateArrayIds;
        }else{
            
            //  $groups = $this->getTemplateGroups($templateArrayIds);
            
//             $template_id = $this->getTemplateGroups($templateArrayIds)
//     ->pluck('template_ids')   // get only template_ids column
//     ->take(30)                // limit 30 groups
//     ->flatMap(function ($ids) {
//         // split comma-separated values into array
//         return explode(',', $ids);
//     })
//     ->unique()                // remove duplicates
//     ->implode(',');           // join back into string



// $Luckydraw->template_id = $template_id;
// $Luckydraw->template_group_id = $templateArrayIds;
$ids = explode(',', $templateArrayIds); // convert string to array

        $rows = DB::table('template_groups')
            ->select('group_name','template_ids')->whereIn('id',$ids)
            ->get();
    // dd($rows);
        // Convert to arrays
        $groups = [];
foreach ($rows as $row) {
    // If template_ids is comma separated like "1,2,3"
    $groups[] = explode(',', $row->template_ids);

    // If it's JSON like '["1","2","3"]', then use:
    // $groups[] = json_decode($row->template_ids, true);
}

        
        $result = $this->getTemplateGroups($groups);
// dd($result);
        // Example: collect first 30 values
    
        
        
        $template_id = implode(',', $result);
        // dd($template_id);
        
        $Luckydraw->template_id = $template_id;
$Luckydraw->template_group_id = $templateArrayIds;

            
        }
        
        // $Luckydraw->template_id = $templateArrayIds;
        $Luckydraw->start_date = $request->start_date;
        $Luckydraw->end_date = $request->end_date;
        $Luckydraw->price = $request->price;
        $Luckydraw->no_of_prizes = $request->no_of_prizes;
        $Luckydraw->method = $request->method;
        $Luckydraw->template_luckydraw_id = is_array(
            $request->input("template_luckydraw_id")
        )
            ? implode(",", $request->input("template_luckydraw_id"))
            : "";
        $Luckydraw->luckydraw_wise_allocation = is_array(
            $request->input("luckydraw_wise_allocation")
        )
            ? implode(",", $request->input("luckydraw_wise_allocation"))
            : "";
        $Luckydraw->country_luckydraw_id = is_array(
            $request->input("country_luckydraw_id")
        )
            ? implode(",", $request->input("country_luckydraw_id"))
            : "";
        $Luckydraw->state_luckydraw_id = is_array(
            $request->input("state_luckydraw_id")
        )
            ? implode(",", $request->input("state_luckydraw_id"))
            : "";
        $Luckydraw->status = 1;
        if ($Luckydraw->save()) {
            if (isset($request->prize_type) && is_array($request->prize_type)) {
                for ($i = 0; $i < count($request->prize_type); $i++) {
                    $prizes = new Prize();
                    $prizes->luckydraw_id = $Luckydraw->id;
                    $prizes->prize_type = $request->prize_type[$i] ?? null;
                    $prizes->prize_number = $i;
                    $prizes->amount = trim(($request->currency[$i] ?? '') . ' ' . ($request->amount[$i] ?? ''));
                    $prizes->item = $request->item[$i] ?? null;
                    // $prizes->image = $request->image[$i];
                    if ($request->hasFile("image.$i")) {
                        $image = $request->file("image.$i");
                        $imageName =time() ."_" .$i ."." . $image->getClientOriginalExtension();
                        $image->move("../../uploads/luckydraw/prizes/",$imageName);
                        $prizes->image = $imageName;
                    }
                    $prizes->save();
                }
            }
        }
        return redirect("luckydraws")->with("success","luckydraw Has Been Add.");
    }
    public function edit($id)
    {
        $region = Region::where('status', 1)
        ->get()
        ->prepend((object)[
            'id' => 'all',
            'region_name' => 'All',
            'region_code' => null,
            'created_at' => null,
            'updated_at' => null,
            'deleted_at' => null,
            'status' => 1
        ]);;
        $business_area = Business_Area::get();
        $template_Manager = Template_Manager::where('status','=',1)->get();
        $luckydraws = Luckydraw::select(
            "luckydraws.*",
            "luckydraw_template.template_name", // Fetch template name
            DB::raw(
                "GROUP_CONCAT(DISTINCT region.region_name SEPARATOR ', ') as region_names"
            ),
            DB::raw(
                "GROUP_CONCAT(DISTINCT country.country_name SEPARATOR ', ') as country_names"
            ),
            DB::raw(
                "GROUP_CONCAT(DISTINCT state.state_title SEPARATOR ', ') as state_names"
            )
        )
            ->leftJoin("region", function ($join) {
                $join->on(
                    DB::raw("FIND_IN_SET(region.id, luckydraws.region_id)"),
                    ">",
                    DB::raw("0")
                );
            })
            ->leftJoin("country", function ($join) {
                $join->on(
                    DB::raw("FIND_IN_SET(country.id, luckydraws.country_id)"),
                    ">",
                    DB::raw("0")
                );
            })
            ->leftJoin("state", function ($join) {
                $join->on(
                    DB::raw("FIND_IN_SET(state.id, luckydraws.state_id)"),
                    ">",
                    DB::raw("0")
                );
            })
            ->leftJoin(
                "luckydraw_template",
                "luckydraws.template_id",
                "=",
                "luckydraw_template.id"
            ) // Join with luckydraw_template
             ->where('region.status','=',1)
    ->where('country.status','=',1)
    ->where('state.status','=',1)
            ->groupBy("luckydraws.id", "luckydraw_template.template_name") // Group by template_name as well
            ->get();
        $luckydraws_edit = Luckydraw::select(
            "luckydraws.*",
            "luckydraw_template.template_name", // Fetch template name
            DB::raw(
                "GROUP_CONCAT(DISTINCT region.region_name SEPARATOR ', ') as region_names"
            ),
            DB::raw(
                "GROUP_CONCAT(DISTINCT country.country_name SEPARATOR ', ') as country_names"
            ),
            DB::raw(
                "GROUP_CONCAT(DISTINCT state.state_title SEPARATOR ', ') as state_names"
            )
        )
            ->leftJoin("region", function ($join) {
                $join->on(
                    DB::raw("FIND_IN_SET(region.id, luckydraws.region_id)"),
                    ">",
                    DB::raw("0")
                );
            })
            ->leftJoin("country", function ($join) {
                $join->on(
                    DB::raw("FIND_IN_SET(country.id, luckydraws.country_id)"),
                    ">",
                    DB::raw("0")
                );
            })
            ->leftJoin("state", function ($join) {
                $join->on(
                    DB::raw("FIND_IN_SET(state.id, luckydraws.state_id)"),
                    ">",
                    DB::raw("0")
                );
            })
            ->leftJoin(
                "luckydraw_template",
                "luckydraws.template_id",
                "=",
                "luckydraw_template.id"
            )
            ->where("luckydraws.id", $id) // Join with luckydraw_template
            ->where('region.status','=',1)
    ->where('country.status','=',1)
    ->where('state.status','=',1)
            ->groupBy("luckydraws.id", "luckydraw_template.template_name") // Group by template_name as well
            ->first();
        $prize_group = Prize::where("luckydraw_id", $id)->get();
        return view(
            "luckydraws",
            compact(
                "business_area",
                "region",
                "template_Manager",
                "luckydraws_edit",
                "luckydraws",
                "prize_group"
            )
        );
        // dd($luckydraws_edit);
        //         $luckydraws_edit = DB::table('luckydraws')
        // ->leftJoin('region', function ($join) {
        //     $join->on(DB::raw("FIND_IN_SET(region.id, luckydraws.region_id)"), '>', DB::raw('0'));
        // })
        // ->leftJoin('country', function ($join) {
        //     $join->on(DB::raw("FIND_IN_SET(country.id, luckydraws.country_id)"), '>', DB::raw('0'));
        // })
        // ->leftJoin('state', function ($join) {
        //     $join->on(DB::raw("FIND_IN_SET(state.id, luckydraws.state_id)"), '>', DB::raw('0'));
        // })
        // ->select('luckydraws.*', 'region.name as region_name', 'country.name as country_name', 'state.name as state_name')->where('luckydraws.id',$id)
        // ->get();
    }
    function update(Request $request, $id)
    {
        // dd($request->all());
        //   dd($id);
        $region = Region::get();
        $template_Manager = Template_Manager::where('status','=',1)->get();
        $Luckydraw = Luckydraw::find($id);
        $Luckydraw->luckydraw_name = $request->luckydraw_name;
        $Luckydraw->frequency = $request->frequency;
        $Luckydraw->format = $request->format;
        // $Luckydraw ->region_id  =implode(',', $request->input('region_id'));
        // $Luckydraw ->country_id =implode(',', $request->input('country_id'));
        // $Luckydraw ->state_id  =implode(',', $request->input('state_id'));
        // $Luckydraw->business_area_id = $request->business_area_id;
        // $Luckydraw->region_id = is_array($request->input("region_hidden_id"))
        //     ? implode(",", $request->input("region_id"))
        //     : "";
        // $Luckydraw->country_id = is_array($request->input("country_hidden_id"))
        //     ? implode(",", $request->input("country_id"))
        //     : "";
        // $Luckydraw->state_id = is_array($request->input("state_hidden_id"))
        //     ? implode(",", $request->input("state_id"))
        //     : "";
        
        $regionIds = (array) $request->input('region_id');
        $countryIds = (array) $request->input('country_id');
        $stateIds = (array) $request->input('state_id');
        // $templateIds = (array) $request->input('template_id');
        
        $templateIds = (array) $request->input('template_id');

// If "all" is selected
if (in_array('all', $templateIds)) {
    // Get all active IDs
    $allTemplateIds = Template_Manager::where('status', 1)->pluck('id')->toArray();
    $templateArrayIds = implode(",", $allTemplateIds);
} else {
    // Use only selected IDs
    $templateArrayIds = implode(",", $templateIds);
}

// Save

        
        // dd($templateIds);
        $allRegionIds = in_array('all', $regionIds) ? Region::where('status', 1)->pluck('id')->toArray() : NULL;
        $allCountryIds = in_array('all', $countryIds) ? Country::whereIn('region_id', $regionIds)->where('status', 1)->pluck('id')->toArray() : NULL;
        $allStateIds = in_array('all', $stateIds) ? State::whereIn('country_id', $countryIds)->where('status', 1)->pluck('id')->toArray() : NULL;
        // $allTemplateIds = in_array('all', $templateIds) ? Template_Manager::whereIn('id', $templateIds)->where('status', 1)->pluck('id')->toArray() : NULL;
        $regionArrayIds = in_array('all', $regionIds) ?  implode(",", $allRegionIds) : implode(",", $regionIds);
        $countryArrayIds = in_array('all', $countryIds) ?  implode(",", $allCountryIds) : implode(",", $countryIds);
      
        
        $stateArrayIds = in_array('all', $stateIds) ?  implode(",", $allStateIds) : implode(",", $stateIds);
        // $templateArrayIds = in_array('all', $templateIds) ?  implode(",", $allTemplateIds) : implode(",", $templateIds);
        //   dd($countryIds);
        $Luckydraw->region_id = isset($regionArrayIds) ? $regionArrayIds : "";
        $Luckydraw->country_id = isset($countryArrayIds) ? $countryArrayIds : "";
        $Luckydraw->state_id = isset($stateArrayIds) ? $stateArrayIds : "";
        $Luckydraw->template_option = $request->template_option;
        
        
        if($request->template_option == 1){
            $Luckydraw->template_id = $templateArrayIds;
        }else{
            
//             //  $groups = $this->getTemplateGroups($templateArrayIds);
            
//             $template_id = $this->getTemplateGroups($templateArrayIds)
//     ->pluck('template_ids')   // get only template_ids column
//     ->take(30)                // limit 30 groups
//     ->flatMap(function ($ids) {
//         // split comma-separated values into array
//         return explode(',', $ids);
//     })
//     ->unique()                // remove duplicates
//     ->implode(',');           // join back into string



// $Luckydraw->template_id = $template_id;
// $Luckydraw->template_group_id = $templateArrayIds;

// dd($templateArrayIds);
    $ids = explode(',', $templateArrayIds); // convert string to array



$rows = DB::table('template_groups')
            ->select('group_name','template_ids')
            ->whereIn('id', $ids)
            ->get();
            
            
            
// dd($rows);
        // Convert to arrays
        // $groups = [];
        // foreach ($rows as $row) {
        //     $groups[$row->group_name] = explode(',', $row->template_ids);
        // }
        
        // $gen = $this->getTemplateGroups($groups);

        // // Example: collect first 30 values
        // $result = [];
        // foreach ($gen as $val) {
        //     $result[] = $val;
           
        // }
        
        
        // $template_id = implode(',', $result);
        
        
            $groups = [];
foreach ($rows as $row) {
    // If template_ids is comma separated like "1,2,3"
    $groups[] = explode(',', $row->template_ids);

    // If it's JSON like '["1","2","3"]', then use:
    // $groups[] = json_decode($row->template_ids, true);
}

        
        $result = $this->getTemplateGroups($groups);
// dd($result);
        // Example: collect first 30 values
    
        
        
        $template_id = implode(',', $result);
        // dd($template_id);        
        
        $Luckydraw->template_id = $template_id;
$Luckydraw->template_group_id = $templateArrayIds;




            
        }
        
        
        // $Luckydraw->template_id = $templateArrayIds;
        $Luckydraw->end_date = $request->end_date;
        $Luckydraw->price = $request->price;
        $Luckydraw->no_of_prizes = $request->no_of_prizes;
        $Luckydraw->method = $request->method;
        $Luckydraw->template_luckydraw_id = is_array(
            $request->input("template_luckydraw_id")
        )
            ? implode(",", $request->input("template_luckydraw_id"))
            : "";
        $Luckydraw->luckydraw_wise_allocation = is_array(
            $request->input("luckydraw_wise_allocation")
        )
            ? implode(",", $request->input("luckydraw_wise_allocation"))
            : "";
        $Luckydraw->country_luckydraw_id = is_array(
            $request->input("country_luckydraw_id")
        )
            ? implode(",", $request->input("country_luckydraw_id"))
            : "";
        $Luckydraw->state_luckydraw_id = is_array(
            $request->input("state_luckydraw_id")
        )
            ? implode(",", $request->input("state_luckydraw_id"))
            : "";
        if ($Luckydraw->save()) {
            if (isset($request->prize_type) && is_array($request->prize_type)) {
                for ($i = 0; $i < count($request->prize_type); $i++) {
                    // dd($request->prize_type);
                    $get_pize_id = Prize::find($request->prize_id[$i]);
                    if ($get_pize_id) {
                        $prizes = Prize::find($request->prize_id[$i]);
                        $prizes->prize_type = $request->prize_type[$i] ?? null;
                        $prizes->prize_number = $i;
                        $prizes->amount = $request->amount[$i] ?? null;
                        $prizes->item = $request->item[$i] ?? null;
                        // $prizes->image = $request->image[$i];
                        if ($request->hasFile("image.$i")) {
                            $image = $request->file("image.$i");
                            $imageName =
                                time() .
                                "_" .
                                $i .
                                "." .
                                $image->getClientOriginalExtension();
                            $image->move(
                                "../../uploads/luckydraw/prizes/",
                                $imageName
                            );
                            $prizes->image = $imageName;
                        }
                        $prizes->save();
                    } else {
                        $prizes = new Prize();
                        $prizes->luckydraw_id = $id;
                        $prizes->prize_type = $request->prize_type[$i];
                        $prizes->prize_number = $i;
                        $prizes->amount = $request->amount[$i];
                        $prizes->item = $request->item[$i];
                        // $prizes->image = $request->image[$i];
                        if ($request->hasFile("image.$i")) {
                            $image = $request->file("image.$i");
                            $imageName =
                                time() .
                                "_" .
                                $i .
                                "." .
                                $image->getClientOriginalExtension();
                            $image->move(
                                "../../uploads/luckydraw/prizes/",
                                $imageName
                            );
                            $prizes->image = $imageName;
                        }
                        $prizes->save();
                    }
                }
            }
        }
        // $success = "Country Has Been Add.";
        return redirect("luckydraws")->with("success","luckydraw Has Been Updated.");
    }
    function status($id, $actions)
    {
        //   dd($id);
        if ($actions == 1) {
            $Luckydraw = Luckydraw::find($id);
            $Luckydraw->status = 0;
            $Luckydraw->update();
        } else {
            $Luckydraw = Luckydraw::find($id);
            $Luckydraw->status = 1;
            $Luckydraw->update();
        }
        return redirect("luckydraw")->with("success","Suspend Has Been Updated");
    }
    public function get_luckydraw_country(Request $request)
    {
        //  dd($id);
        // $id = $request->input('template_id');
        // $luckydraw_id = Luckydraw ::select(
        //     'luckydraws.*',
        //      // Fetch template name
        //     DB::raw("GROUP_CONCAT(DISTINCT country.country_name SEPARATOR ', ') as country_names")
        // )
        // ->leftJoin('country', function ($join) {
        //     $join->on(DB::raw("FIND_IN_SET(country.id, luckydraws.country_id)"), '>', DB::raw('0'));
        // })
        // ->groupBy('luckydraws.id')
        // ->where('luckydraws.template_id',$id) // Join with luckydraw_template// Group by template_name as well
        // ->get();
        $country = Country::get();
        return response()->json(["country" => $country]); // Return
    }
    public function get_luckydraw_state(Request $request)
    {
        $state = State::where("country_id", $request->country_id)->get();
        return response()->json(["state" => $state]); // Return
    }
    public function get_declare_winner(Request $request)
    {
        $luckydraw = Luckydraw::find($request->recordId);
        if ($luckydraw->frequency == 1) {
            $start = Carbon::yesterday()->setTime(17, 30); // Still a Carbon object
            $end = Carbon::today()->setTime(17, 30); // Still a Carbon object
            $saleCount = Sale::where("luckydraw_id", $request->recordId)
                ->where("created_at", ">=", $start)
                ->where("created_at", "<", $end)
                ->count();
        } elseif ($luckydraw->frequency == 2) {
            $lastFriday = Carbon::now()
                ->previous(Carbon::FRIDAY)
                ->setTime(17, 31);
            // Get coming Friday 5:30 PM
            $comingFriday = Carbon::now()
                ->next(Carbon::FRIDAY)
                ->setTime(17, 30);
            $saleCount = Sale::where("luckydraw_id", $request->recordId)
                ->whereBetween("created_at", [$lastFriday, $comingFriday])
                ->count();
        } elseif ($luckydraw->frequency == 3) {
            $start = Carbon::now()
                ->subMonthNoOverflow()
                ->startOfMonth()
                ->setTime(17, 31);
            // End: last day of current month at 5:30 AM
            $end = Carbon::now()
                ->endOfMonth()
                ->setTime(17, 30);
            // Get luckydraw record
            $luckydraw = Luckydraw::find($request->recordId);
            // Count sales in the range
            $saleCount = Sale::where("luckydraw_id", $request->recordId)
                ->whereBetween("created_at", [$start, $end])
                ->count();
        } elseif ($luckydraw->frequency == 4) {
            // Start from last year's Dec 31 at 5:31 AM
            $start = Carbon::create(null, 12, 31, 17, 31)->subYear();
            // End at this year's Nov 30 at 5:30 AM
            $end = Carbon::create(null, 11, 30, 17, 30)->year(
                Carbon::now()->year
            );
            // Get the Luckydraw
            $luckydraw = Luckydraw::find($request->recordId);
            // Count sales in that range
            $saleCount = Sale::where("luckydraw_id", $request->recordId)
                ->whereBetween("created_at", [$start, $end])
                ->count();
        }
        return response()->json([
            "luckydraw" => $luckydraw,
            "sale_count" => $saleCount,
        ]);
        //  return response()->json(['luckydraw' => $luckydraw]); // Return
    }
    function validation(Request $request)
    {
        //  dd($request->all());
        $status = "";
        $action = [];
        $luckydraw_name = Luckydraw::where(
            "luckydraw_name",
            $request->luckydraw_name
        )->first();
        if ($luckydraw_name != null) {
            // dd('yes');
            $action["field"] = "name";
            $action["status"] = 1;
        } else {
            $action["field"] = "name";
            $action["status"] = 0;
        }
        return response()->json(["action" => $action]);
    }
    public function view_sale($id)
    {
        $business_partner = Sale::where("luckydraw_id", $id)
            ->distinct()
            ->count("partner_id");
        $customer = Sale::where("luckydraw_id", $id)
            ->distinct()
            ->count("customer_id");
        $ticket = Sale::where("luckydraw_id", $id)->count("ticket_id");
        $revenue = Sale::where("luckydraw_id", $id)->sum("price");
        $luckydraw_name = Luckydraw::select("luckydraw_name")
            ->where("id", $id)
            ->first();
        $view_sale = Sale::select(
            "business_partners.poc_first_name",
            "business_partners.poc_email",
            "business_partners.poc_mobile",
            "customers.first_name",
            "customers.email",
            "customers.mobile",
            "sales.created_at",
            "sales.price"
        )
            ->join(
                "customers",
                "sales.customer_id",
                "=",
                "customers.customer_id"
            )
            ->join(
                "business_partners",
                "sales.partner_id",
                "=",
                "business_partners.id"
            )
            ->where("sales.luckydraw_id", $id)
            ->get();
        return view(
            "luckydrawwise_sales",
            compact(
                "business_partner",
                "revenue",
                "customer",
                "ticket",
                "view_sale",
                "luckydraw_name"
            )
        );
    }
    function delete($id)
    {
        $Luckydraw = Luckydraw::find($id);
        $Luckydraw->delete();
        return redirect("luckydraws")->with("success", "Record has been Delete");
    }
    function get_luckydraw_sale(Request $request)
    {
        //   dd($requyest);
        if ($request->luckydraw_frequency == 1) {
            $start = Carbon::yesterday()->setTime(17, 30); // Still a Carbon object
            $end = Carbon::today()->setTime(17, 30); // Still a Carbon object
            $sale = Sale::where("luckydraw_id", $request->luckydraw_id)
                ->where("created_at", ">=", $start)
                ->where("created_at", "<", $end)
                ->inRandomOrder()
                ->limit($request->compare_value)
                ->get();
        } elseif ($request->luckydraw_frequency == 2) {
            $lastFriday = Carbon::now()
                ->previous(Carbon::FRIDAY)
                ->setTime(17, 31);
            // Get coming Friday 5:30 PM
            $comingFriday = Carbon::now()
                ->next(Carbon::FRIDAY)
                ->setTime(17, 30);
            $sale = Sale::where("luckydraw_id", $request->luckydraw_id)
                ->whereBetween("created_at", [$lastFriday, $comingFriday])
                ->inRandomOrder()
                ->limit($request->compare_value)
                ->get();
        } elseif ($request->luckydraw_frequency == 3) {
            $start = Carbon::now()
                ->subMonthNoOverflow()
                ->startOfMonth()
                ->setTime(17, 31);
            // End: last day of current month at 5:30 AM
            $end = Carbon::now()
                ->endOfMonth()
                ->setTime(17, 30);
            $sale = Sale::where("luckydraw_id", $request->luckydraw_id)
                ->whereBetween("created_at", [$start, $end])
                ->inRandomOrder()
                ->limit($request->compare_value)
                ->get();
        } elseif ($request->luckydraw_frequency == 4) {
            $start = Carbon::create(null, 12, 31, 17, 31)->subYear();
            // End at this year's Nov 30 at 5:30 AM
            $end = Carbon::create(null, 11, 30, 17, 30)->year(
                Carbon::now()->year
            );
            $sale = Sale::where("luckydraw_id", $request->luckydraw_id)
                ->whereBetween("created_at", [$start, $end])
                ->inRandomOrder()
                ->limit($request->compare_value)
                ->get();
        }
        // dd($sale);
        return response()->json($sale);
    }
    public function saveWinnerData(Request $request)
    {
        // Email headers for Business Partner and Customer to inform about the Luckydraw Winner
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";
        $headers .= "From: Luckydraw Team <no-reply@ubgglobal.com>\r\n"; // Use a valid cPanel email
        // $headers .= "Reply-To: support@ubgglobal.com\r\n";
        $headers .= "Reply-To: no-reply@ubgglobal.com\r\n";

        //Winners data storage
        $ticketIds = $request->input("ticket_ids");
        $luckydrawId = $request->input("luckydraw_id");
        if (is_array($ticketIds) && $luckydrawId) {
            // Step 1: Update existing records' status to 0
            DB::table("prize_distribution")
                ->where("luckydraw_id", $luckydrawId)
                ->update(["status" => 0]);
            // Step 2: Get prize records
            $prizes = Prize::where("luckydraw_id", $luckydrawId)->get();
            // Step 3: Insert new prize distributions
            foreach ($ticketIds as $index => $ticketId) {
                if (isset($prizes[$index])) {
                    DB::table("prize_distribution")->insert([
                        "luckydraw_id" => $luckydrawId,
                        "ticket_id" => $ticketId,
                        "prize_id" => $prizes[$index]->id,
                        "status" => 1, // Newly inserted records should have status 1
                    ]);
                    $prize_distributions = DB::table("prize_distribution as pd")
                    ->join("sales as s", "pd.ticket_id", "=", "s.ticket_id")
                    ->join("customers as c", "s.customer_id", "=", "c.customer_id")
                    ->join("business_partners as bp", "s.partner_id", "=", "bp.id")
                    ->join("prizes", "pd.prize_id", "=", "prizes.id")
                    ->select(
                        "pd.*",
                        "first_name as customer_first_name",
                        "c.last_name as customer_last_name",
                        "c.email as customer_email",
                        "c.mobile as customer_mobile",
                        "bp.poc_first_name as partner_first_name",
                        "bp.poc_last_name as partner_last_name",
                        "bp.poc_email  as partner_email",
                        "bp.poc_mobile as partner_mobile",
                        "bp.business_name as partner_business_name",
                        "prizes.amount",
                        "prizes.item",
                        "prizes.image"
                    )
                    ->where("pd.ticket_id", "=", $ticketId)
                    ->first();
                    $poc_first_name =$prize_distributions->partner_first_name;
                    $poc_last_name =$prize_distributions->partner_last_name;
                    $poc_email =$prize_distributions->partner_email;
                    $poc_mobile =$prize_distributions->partner_mobile;
                    $business_name =$prize_distributions->partner_business_name;
                    $customer_first_name  =$prize_distributions->customer_first_name;
                    $customer_last_name  =$prize_distributions->customer_last_name;
                    $customer_email = $prize_distributions->customer_email;
                    $customer_mobile = $prize_distributions->customer_mobile;
                    $luckydraw = Luckydraw::select('luckydraw_name','frequency')->find($luckydrawId);
                    $luckydraw_name = $luckydraw->luckydraw_name;
                    if($luckydraw->frequency == 1){
                        $luckydraw_frequency = 'Daily';
                    }
                    elseif($luckydraw->frequency == 2){
                        $luckydraw_frequency = 'Weekly';
                    }
                    elseif($luckydraw->frequency == 3){
                        $luckydraw_frequency = 'Monthly';
                    }
                    elseif($luckydraw->frequency == 4){
                        $luckydraw_frequency = 'Yearly';
                    }
                    //Send an email to the Customer
                    $customer_subject = "Congratulations! You have won the $luckydraw_name - $luckydraw_frequency";
                    $customer_message =
                    '
                        <!DOCTYPE html>
                        <html>
                           <head>
                              <meta charset="UTF-8"> 
                              <title>Winner Notification</title>
                           </head>
                           <body style="font-family: Arial, sans-serif; background-color: #f6f6f6; padding: 20px;">
                              <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
                                 <tr>
                                    <td style="padding: 30px;">
                                       <h2 style="color: #333333;">Dear <strong>' . htmlspecialchars($customer_first_name) . '</strong>,
                                       </h2>
                                       <p style="font-size: 16px; color: #555555;">
                                          Welcome to UBG Luckydraw.
                                       </p>
                                       <p style="font-size: 16px; color: #555555;">
                                          We are happy to inform you that the ' . $luckydraw_name . ' draw was held today, and you are one of the winners.🎉
                                       </p>
                                       <p style="font-size: 16px; color: #555555; margin-top: 20px;">
                                          	Please find your <strong>LuckyDraw Winner Details</strong> below:<br>
                                            <b>🧾 Ticket ID: ' . $ticketId . '</b> which is purchased from <b>' . $business_name . '</b><br><br>
                                            You will receive details of the prize distribution in our next email. You can also track updates through your LuckyDraw Android application.<br>
                                            Additionally, please check your WhatsApp for a message from our business partner regarding this win.<br><br>
                                            <b>Congratulations once again!</b><br>
                                       </p>
                                       <p style="font-size: 16px; color: #555555;">
                                          Regards,<br>
                                          <strong>Luckydraw Team</strong><br>
                                          UBG Global
                                       </p>
                        			   <p>Please visit our company Terms by visit the below link: <br><a href="https://ubgglobal.com/terms" style="color: #1a73e8;">https://ubgglobal.com/terms</a></p>
                                    </td>
                                 </tr>
                              </table>
                           </body>
                        </html>
                    ';
                    mail($customer_email, $customer_subject, $customer_message, $headers);
                    //Send an email to the Business Partner
                    $business_partner_subject = "Your Customer $customer_first_name has won the $luckydraw_name - $luckydraw_frequency Lukcudraw";
                    $business_partner_message =
                    '
                        <!DOCTYPE html>
                        <html>
                           <head>
                              <meta charset="UTF-8">
                              <title>Winner Notification</title>
                           </head>
                           <body style="font-family: Arial, sans-serif; background-color: #f6f6f6; padding: 20px;">
                              <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
                                 <tr>
                                    <td style="padding: 30px;">
                                       <h2 style="color: #333333;">Dear <strong>' . htmlspecialchars($poc_first_name) . '</strong>,
                                       </h2>
                                       <p style="font-size: 16px; color: #555555;">
                                          Welcome to UBG Luckydraw.
                                       </p>
                                       <p style="font-size: 16px; color: #555555;">
                                          Please find your <strong>LuckyDraw Winner Details</strong> below:
                                       </p>
                                       <p style="font-size: 16px; color: #555555; margin-top: 20px;">
                                          	We are pleased to inform you that during today ' . $luckydraw_name . '  draw, your customer has won the Prize. 🎉<br><br>
                                            <b>Winner Details as follows:</b><br>
                                                Customer First Name : <b>' . $customer_first_name . '</b><br>
                                                Customer Last Name : <b>' . $customer_last_name . '</b><br>
                                                Customer Email ID  : <b>' . $customer_email . '</b><br>
                                                Customer Mobile Number : <b>' . $customer_mobile . '</b><br>
                                                🧾 Winning Ticket ID: <b>' . $ticketId . '</b><br>
                                            We will send the prize distribution details in the next email. Please also check your dashboard and WhatsApp for a message regarding this winner under View Sales page.
                                            <br>
                                            Thank you for your continued support.
                                       </p>
                                       <p style="font-size: 16px; color: #555555;">
                                          Regards,<br>
                                          <strong>Luckydraw Team</strong><br>
                                          UBG Global
                                       </p>
                        			   <p>Please visit our company Terms by visit the below link: <br><a href="https://ubgglobal.com/terms" style="color: #1a73e8;">https://ubgglobal.com/terms</a></p>
                                    </td>
                                 </tr>
                              </table>
                           </body>
                        </html>
                    ';
                    mail($poc_email, $business_partner_subject, $business_partner_message, $headers);
                }
               
            }
             return response()->json(["status" => "success", "message" => "Successfully Winners Data saved", ]);
            // return response()->json(["status" => "error", "message" => "Invalid input."], 400);
        }
        return response()->json(
            ["status" => "error", "message" => "Invalid input."],
            400
        );
    }
    public function view_winner($id)
    {
        $prize_distributions = DB::table("prize_distribution as pd")
            ->join("sales as s", "pd.ticket_id", "=", "s.ticket_id")
            ->join("customers as c", "s.customer_id", "=", "c.customer_id")
            ->join("business_partners as bp", "s.partner_id", "=", "bp.id")
            ->join("prizes", "pd.prize_id", "=", "prizes.id")
            ->select(
                "pd.*", // All columns from prize_distribution
                // Customer details
                "c.first_name as customer_first_name",
                "c.last_name as customer_last_name",
                "c.email as customer_email",
                "c.mobile as customer_mobile",
                // Business partner (POC) details
                "bp.poc_first_name as partner_first_name",
                "bp.poc_last_name as partner_last_name",
                "bp.poc_email as partner_email",
                "bp.poc_mobile as partner_mobile",
                // Prize details
                "prizes.amount",
                "prizes.item",
                "prizes.image"
            )
            ->where("pd.luckydraw_id", "=", $id)
            ->get();
        return view("view_winner", compact("prize_distributions"));
    }
    function update_prize_tx(Request $request)
    {
        // No validation on tx_remarks so null is allowed
        $prize_tx_update = Prize_Distribution::find(
            $request->view_winner_hidden_id
        );
        //new cod
        $prize_distributions = DB::table("prize_distribution as pd")
            ->join("sales as s", "pd.ticket_id", "=", "s.ticket_id")
            ->join("customers as c", "s.customer_id", "=", "c.customer_id")
            ->join("business_partners as bp", "s.partner_id", "=", "bp.id")
            ->join("prizes", "pd.prize_id", "=", "prizes.id")
            ->select(
                "pd.*",
                "first_name as customer_first_name",
                "c.last_name as customer_last_name",
                "c.email as customer_email",
                "c.mobile as customer_mobile",
                "bp.poc_first_name as partner_first_name",
                "bp.poc_last_name as partner_last_name",
                "bp.poc_email  as partner_email",
                "bp.poc_mobile as partner_mobile",
                "prizes.amount",
                "prizes.item",
                "prizes.image"
            )
            ->where("pd.ticket_id", "=", $prize_tx_update->ticket_id)
            ->first();
        $ticket_id = $prize_tx_update->ticket_id;
        $customer_name = $prize_distributions->customer_first_name;
        $customer_mail = $prize_distributions->customer_email;
        $business_partner_mail = $prize_distributions->partner_email;
        $business_partner_name = $prize_distributions->partner_first_name;
        $prize_amount = $prize_distributions->amount;
        $prize_item = $prize_distributions->item;
        $prize_image = $prize_distributions->image;
        if (!$prize_tx_update) {
            return redirect()
                ->back()
                ->with("error", "Transaction not found.");
        }
        $prize_tx_update->tx_remarks = $request->tx_remarks; // null allowed
        $prize_tx_update->tx_status = 1;
        if ($request->hasFile("tx_proof")) {
            $image = $request->file("tx_proof");
            $imageName_txproof = time() . "." . $image->getClientOriginalExtension();
            //$image->move(public_path("luckydraw/prizetransactions/"), $imageName_txproof);//Ram commented this line
            $image->move( "../../uploads/luckydraw/prizetransactions/", $imageName_txproof);
            $prize_tx_update->tx_proof = $imageName_txproof;
        }
        try {
            $prize_tx_update->update();   
            $username = $to = $request->poc_email; // Replace with actual email
            // Subject
            $subject = "Congratulations! You have Won the Luckydraw – Claim Your Prize";
            // HTML Email Luckydraw Gift/Prize Content
            $message =
            '
                <!DOCTYPE html>
                <html>
                   <head>
                      <meta charset="UTF-8">
                      <title>Claim Your Prize</title>
                   </head>
                   <body style="font-family: Arial, sans-serif; background-color: #f6f6f6; padding: 20px;">
                      <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
                         <tr>
                            <td style="padding: 30px;">
                               <h2 style="color: #333333;">Dear <strong>' . htmlspecialchars($customer_name) . '</strong>,
                               </h2>
                               <p style="font-size: 16px; color: #555555;">
                                  Welcome to UBG Luckydraw.
                               </p>
                               <p style="font-size: 16px; color: #555555;">
                                  Please find your <strong>LuckyDraw Winner Details</strong> below:
                               </p>
                               <p style="font-size: 16px; color: #555555; margin-top: 20px;">
                                   We are thrilled to inform you that you have been selected as a winner in our recent Luckydraw draw! 🎉<br>
                                   Please find your Luckydraw gift details below:<br>
                                   🎁 Gift Details: ' . $prize_amount . ' <br> ' . $prize_item . '  <br> 
                                   <img src="' . env('WEB_URL') . '/uploads/luckydraw/prizes/' . $prize_image . '" style="width:100px;height:100px;">
                                   <br>
                                   🎫 Luckydraw Ticket Number: ' . $ticket_id . ' <br>
                                   🧾 Claim Instructions: [Mention how they can claim – in-person, via courier, etc.]<br>
                                   📍 Collection Address / Contact Details: [Enter Address or Contact Info]<br><br>
                                   Please make sure to claim your gift on or before [Last Claim Date]. Kindly carry a valid ID proof and your Luckydraw ticket (or confirmation) for verification.<br>
                                   If you have any questions, feel free to contact us at [Phone Number] or reply to this email.<br>
                                   Once again, congratulations and thank you for being part of our Luckydraw event!<br><br>
                               </p>
                               <p style="font-size: 16px; color: #555555;">
                                  Regards,<br>
                                  <strong>Luckydraw Team</strong><br>
                                  UBG Global
                               </p>
                               <p>Please visit our company Terms by visiting the below link: <br><a href="https://ubgglobal.com/terms" style="color: #1a73e8;">https://ubgglobal.com/terms</a></p>
                            </td>
                         </tr>
                      </table>
                   </body>
                </html>
            ';
            // Email headers
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=UTF-8\r\n";
            $headers .= "From: Luckydraw Team <no-reply@ubgglobal.com>\r\n"; // Use a valid cPanel email
            // $headers .= "Reply-To: support@ubgglobal.com\r\n";
            $headers .= "Reply-To: no-reply@ubgglobal.com\r\n";
            // Send the email
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        if (mail($customer_mail, $subject, $message, $headers)) {
            return redirect( "luckydraw/view_winner/" . $prize_tx_update->luckydraw_id)->with("success", "Luckydraw Transaction is Updated");
        } else {
            return redirect( "luckydraw/view_winner/" . $prize_tx_update->luckydraw_id)->with("error", "Luckydraw Transaction is Updated but Mail NOT sent");
            // echo "Failed to send HTML Email.";
        }
    }
    public function get_view_winner(Request $request)
    {
        $Prize_Distribution = Prize_Distribution::find($request->recordId);
        return response()->json(["winner" => $Prize_Distribution]); // Return
    }
}