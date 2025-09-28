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
use Illuminate\Support\Facades\DB;
use Session;
use App\Models\Business_Partner;
use App\Models\Luckydraw;
use Hash;
class BusinessPartnerController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        // $donors = Donor::get();
        $luckydraw = Luckydraw::select(
            "luckydraws.*",
            "region.region_name",
            "country.country_name",
            "region.status as region_status",
            "country.status as country_status"
            
        )
            ->join("region", "luckydraws.region_id", "=", "region.id") // Join city with state
            ->join("country", "luckydraws.country_id", "=", "country.id") // Join city with country
            ->where('region.status','=',1)
            ->where('country.status','=',1)
            ->get();
        $business_area = Business_Area::get();
        $region = Region::where('status','=',1)->get();
        return view(
            "business_partners.partner",
            compact("business_area", "region", "luckydraw")
        );
    }
    public function view()
    {
        $business_Partner = Business_Partner::select(
            "business_partners.*",
            "region.region_name",
            "country.country_name",
            "business_area.area_name",
            "state.state_title",
            "region.status as region_status",
            "country.status as country_status"
        )
            ->join("region", "business_partners.region_id", "=", "region.id") // Join city with state
            ->join("country", "business_partners.country_id", "=", "country.id") // Join city with country
            ->join("state", "business_partners.state_id", "=", "state.id")
            ->join("city", "business_partners.city_id", "=", "city.id")
            ->join(
                "business_area",
                "business_partners.business_area_id",
                "=",
                "business_area.id"
            )
            ->get();
        // dd($business_Partner);
        // $donors = Donor::get();
        //  $business_area = Business_Area::get();
        return view("business_partners.partners", compact("business_Partner"));
    }
    // function get_region(Request $request)
    // {
    //     if($request->region_id == 'all'){
    //         $country = Country::get();
    //     }
    //     else{
    //         $country = Country::where("region_id", $request->region_id)->get();
    //     }
        
    //     return response()->json($country);
    // }
    
    
    public function get_region(Request $request)
{
    $region_ids = $request->input('region_ids');

    if (in_array('all', (array)$region_ids)) {
        $countries = Country::where('status','=',1)->get();
    } else {
        $countries = Country::where('status','=',1)->whereIn('region_id', (array)$region_ids)->get();
    }

    return response()->json($countries);
}

   public function get_region_luckydraw(Request $request)
{
    $region_ids = $request->input('region_ly_ids');

    if (in_array('all', (array)$region_ids)) {
        $countries = Country::where('status','=',1)->get();
    } else {
        $countries = Country::where('status','=',1)->whereIn('region_id', (array)$region_ids)->get();
    }

    return response()->json($countries);
}

    // function get_country(Request $request)
    // {
    //     $state = State::where("country_id", $request->country_id)->get();
    //     return response()->json($state);
    // }
    
    
    public function get_country(Request $request)
{
    $country_ids = $request->country_id ?? [];
    $country_ids = is_array($country_ids) ? $country_ids : [$country_ids];
    $country_ids = array_filter($country_ids, fn($value) => !in_array($value, ['all', 'Select Country', '']));

    $states = State::whereIn('country_id', $country_ids)->where('status','=',1)->get();
    return response()->json($states, 200, [], JSON_NUMERIC_CHECK);
}
    function get_state(Request $request)
    {
        $city = City::where("state_id", $request->state_id)->where('status','=',1)->get();
        return response()->json($city);
    }
   /* function get_luckydraw_data(Request $request)
    {
        if($request->region_id == "all" &&
            $request->country_id == "all" ){
                $luckydraw = Luckydraw::select(
                "luckydraws.*",
                 "region.region_name",
                "country.country_name"
            )
            ->join("region", "region.id", "=", "luckydraws.region_id")
                ->join("country", "country.id", "=", "luckydraws.country_id") // Join country table
                
                ->orderBy("luckydraws.id", "DESC")
                ->get();
            
        }
        elseif($request->region_id == "all" &&
            ($request->country_id == "Select Country" || $request->country_id != "" )){
                $luckydraw = Luckydraw::select(
                "luckydraws.*",
                "country.country_name"
            )
                ->join("country", "country.id", "=", "luckydraws.country_id") // Join country table
                ->where("country.id", $request->country_id)
                ->orderBy("luckydraws.id", "DESC")
                ->get();
            
        }
        elseif (
            $request->region_id != "" &&
            $request->country_id == "Select Country"
        ) {
            $luckydraw = Luckydraw::select("luckydraws.*", "region.region_name")
                ->join("region", "region.id", "=", "luckydraws.region_id") // Join region table
                ->where("region.id", $request->region_id)
                ->orderBy("luckydraws.id", "DESC")
                ->get();
        } elseif ($request->region_id != "" && $request->country_id != "") {
            $luckydraw = Luckydraw::select(
                "luckydraws.*",
                "region.region_name",
                "country.country_name"
            )
                ->join("region", "region.id", "=", "luckydraws.region_id") // Join region table
                ->join("country", "country.id", "=", "luckydraws.country_id") // Join country table
                ->where("region.id", $request->region_id)
                ->where("country.id", $request->country_id)
                ->orderBy("luckydraws.id", "DESC")
                ->get();
        } elseif ($request->region_id != "" && $request->country_id == null) {
            $luckydraw = Luckydraw::select("luckydraws.*", "region.region_name")
                ->join("region", "region.id", "=", "luckydraws.region_id") // Join region table
                ->where("region.id", $request->region_id)
                ->orderBy("luckydraws.id", "DESC")
                ->get();
        }
        // dd($luckydraw);
        return response()->json($luckydraw);
    }*/
    
//     public function get_luckydraw_data(Request $request)
// {
//     $region_ids = $request->input('region_ids', []);
//     $country_ids = $request->input('country_ids', []);

//     $query = Luckydraw::select(
//         'luckydraws.*',
//         'region.region_name',
//         'country.country_name'
//     )
//     ->join('region', 'region.id', '=', 'luckydraws.region_id')
//     ->join('country', 'country.id', '=', 'luckydraws.country_id')
//     ->where('luckydraws.status',1)
//     ->orderBy('luckydraws.id', 'DESC');

//     if (in_array('all', (array)$region_ids) && in_array('all', (array)$country_ids)) {
//         // Fetch all lucky draws
//     } elseif (in_array('all', (array)$region_ids) && !empty($country_ids) && !in_array('Select Country', (array)$country_ids)) {
//         $query->whereIn('country.id', $country_ids);
//     } elseif (!empty($region_ids) && in_array('Select Country', (array)$country_ids)) {
//         $query->whereIn('region.id', $region_ids);
//     } elseif (!empty($region_ids) && !empty($country_ids)) {
//         $query->whereIn('region.id', $region_ids)
//               ->whereIn('country.id', $country_ids);
//     } elseif (!empty($region_ids) && empty($country_ids)) {
//         $query->whereIn('region.id', $region_ids);
//     }

//     $luckydraws = $query->get();

//     return response()->json($luckydraws);
// }


public function get_luckydraw_data(Request $request)
{
    $region_ids = $request->input('region_ids', []);
    $country_ids = $request->input('country_ids', []);

    $query = Luckydraw::select(
        'luckydraws.*',
        'region.region_name',
        'country.country_name'
    )
    ->join('region', 'region.id', '=', 'luckydraws.region_id')
    ->join('country', 'country.id', '=', 'luckydraws.country_id')
    ->where('region.status','=',1)
    ->where('country.status','=',1)
    ->where('luckydraws.status', 1)
    ->orderBy('luckydraws.id', 'DESC');

    if (in_array('all', (array)$region_ids) && in_array('all', (array)$country_ids)) {
        // Fetch all lucky draws (no additional filters needed)
    } elseif (in_array('all', (array)$region_ids) && !empty($country_ids) && !in_array('all', (array)$country_ids) && !in_array('Select Country', (array)$country_ids)) {
        $query->whereIn('country.id', $country_ids);
    } elseif (!empty($region_ids) && (in_array('all', (array)$country_ids) || in_array('Select Country', (array)$country_ids))) {
        $query->whereIn('region.id', $region_ids);
    } elseif (!empty($region_ids) && !empty($country_ids)) {
        $query->whereIn('region.id', $region_ids)
              ->whereIn('country.id', $country_ids);
    } elseif (!empty($region_ids) && empty($country_ids)) {
        $query->whereIn('region.id', $region_ids);
    }

    $luckydraws = $query->get();

    return response()->json($luckydraws);
}
    
    // function get_bp_luckydraw_data(Request $request){
    //     $area_name = $request->area_name;
    //     $region_id = $request->region_id;
    //     $country_id = $request->country_id;
    //     $array_bp_ly =array();
    //     if($area_name == 'all' && $region_id == 'Choose Region' && $country_id == 'Select Country'){
    //     $Business_Partner = Business_Partner::get();
    //     $Luckydraw = Luckydraw::get();
        
    //     $array_bp_ly = array(
    //         'Business_Partner' => $Business_Partner,
    //         'Luckydraw' => $Luckydraw,
    //         );    
    //     }
    //     elseif($area_name == 'all' && $region_id == 'all' && $country_id == 'Select Country'){
    //     $Business_Partner = Business_Partner::get();
    //     $Luckydraw = Luckydraw::get();
        
    //     $array_bp_ly = array(
    //         'Business_Partner' => $Business_Partner,
    //         'Luckydraw' => $Luckydraw,
    //         );    
    //     }
    //     elseif($area_name == 'all' && $region_id == 'all' && $country_id == ''){
    //     $Business_Partner = Business_Partner::get();
    //     $Luckydraw = Luckydraw::get();
        
    //     $array_bp_ly = array(
    //         'Business_Partner' => $Business_Partner,
    //         'Luckydraw' => $Luckydraw,
    //         );    
    //     }
    //     elseif($area_name == 'all' && $region_id == 'all' && ($country_id != '' || $country_id != 'Select Country')){
    //         $country_ids = is_array($country_id) ? $country_id : [$country_id];
    //     $Business_Partner = Business_Partner::where('country_id',$country_id)->get();
    //     $Luckydraw = Luckydraw::whereIn('country_id',$country_ids)->get();
        
    //     $array_bp_ly = array(
    //         'Business_Partner' => $Business_Partner,
    //         'Luckydraw' => $Luckydraw,
    //         );    
    //     }
    //     elseif($area_name == 'all' && $region_id == 'all' && $country_id == 'all'){
    //     $Business_Partner = Business_Partner::get();
    //     $Luckydraw = Luckydraw::get();
        
    //     $array_bp_ly = array(
    //         'Business_Partner' => $Business_Partner,
    //         'Luckydraw' => $Luckydraw,
    //         );    
    //     }
    //     elseif(($area_name != 'all' || $area_name != 'Choose Business Area')  && $region_id == 'Choose Region' && $country_id == 'Select Country'){
    //         // dd('elseif1');
    //     $Business_Partner = Business_Partner::where('business_area_id',$area_name)->get();
    //     $Luckydraw = Luckydraw::where('business_area_id',$area_name)->get();
        
    //     $array_bp_ly = array(
    //         'Business_Partner' => $Business_Partner,
    //         'Luckydraw' => $Luckydraw,
    //         );    
    //     }
    //      elseif($area_name == 'Choose Business Area' && $region_id == 'all' && $country_id == ''){
    //         // dd('elseif2');
    //     $Business_Partner = Business_Partner::get();
    //     // dd($Business_Partner);
    //     $Luckydraw = Luckydraw::get();
        
    //     $array_bp_ly = array(
    //         'Business_Partner' => $Business_Partner,
    //         'Luckydraw' => $Luckydraw,
    //         );    
    //     }
    //      elseif($area_name == 'Choose Business Area' && $region_id == 'all' && $country_id == 'all'){
    //         // dd('elseif2');
    //     $Business_Partner = Business_Partner::get();
    //     // dd($Business_Partner);
    //     $Luckydraw = Luckydraw::get();
        
    //     $array_bp_ly = array(
    //         'Business_Partner' => $Business_Partner,
    //         'Luckydraw' => $Luckydraw,
    //         );    
    //     }
    //     elseif($area_name == 'Choose Business Area' && $region_id != 'Choose Region' && $country_id == ''){
    //         // dd('elseif2');
    //          $region_ids = is_array($region_id) ? $region_id : [$region_id];
    //     $Business_Partner = Business_Partner::where('region_id',$region_id)->get();
    //     // dd($Business_Partner);
    //     $Luckydraw = Luckydraw::whereIn('region_id',$region_ids)->get();
        
    //     $array_bp_ly = array(
    //         'Business_Partner' => $Business_Partner,
    //         'Luckydraw' => $Luckydraw,
    //         );    
    //     }
    //     elseif($area_name == 'Choose Business Area' && $region_id != 'Choose Region' && $country_id == 'all'){
    //         // dd('elseif4');
    //         $region_ids = is_array($region_id) ? $region_id : [$region_id];
    //     $Business_Partner = Business_Partner::where('region_id',$region_id)->get();
    //     $Luckydraw = Luckydraw::whereIn('region_id',$region_ids)->get();
        
    //     $array_bp_ly = array(
    //         'Business_Partner' => $Business_Partner,
    //         'Luckydraw' => $Luckydraw,
    //         );    
    //     }
    //     elseif($area_name == 'Choose Business Area' && $region_id != 'Choose Region' && ($country_id != 'Select Country' || $country_id != 'all')){
    //         // dd('elseif3');
    //         $region_ids = is_array($region_id) ? $region_id : [$region_id];
    //         $country_ids = is_array($country_id) ? $region_id : [$country_id];
    //     $Business_Partner = Business_Partner::where('region_id',$region_id)->where('country_id',$country_id)->get();
    //     $Luckydraw = Luckydraw::whereIn('region_id',$region_ids)->whereIn('country_id',$country_ids)->get();
        
    //     $array_bp_ly = array(
    //         'Business_Partner' => $Business_Partner,
    //         'Luckydraw' => $Luckydraw,
    //         );    
    //     }
        
    //     elseif(($area_name != 'all' || $area_name != 'Choose Business Area')  && $region_id != '' && $country_id == ''){
    //         // dd('elseif15');
    //         $region_ids = is_array($region_id) ? $region_id : [$region_id];
    //     $Business_Partner = Business_Partner::where('business_area_id',$area_name)->where('region_id',$region_id)->get();
    //     $Luckydraw = Luckydraw::where('business_area_id',$area_name)->whereIn('region_id',$region_ids)->get();
        
    //     $array_bp_ly = array(
    //         'Business_Partner' => $Business_Partner,
    //         'Luckydraw' => $Luckydraw,
    //         );    
    //     }
    //     elseif(($area_name != 'all' || $area_name != 'Choose Business Area')  && $region_id != 'Choose Region' && $country_id != 'Select Country'){
    //         // dd('elseif6');
    //         $region_ids = is_array($region_id) ? $region_id : [$region_id];
    //     $Business_Partner = Business_Partner::where('business_area_id',$area_name)->where('region_id',$region_id)->get();
    //     $Luckydraw = Luckydraw::where('business_area_id',$area_name)->whereIn('region_id',$region_ids)->get();
        
    //     $array_bp_ly = array(
    //         'Business_Partner' => $Business_Partner,
    //         'Luckydraw' => $Luckydraw,
    //         );    
    //     }
        
       
        
        
        
    //     return response()->json($array_bp_ly);    
            
        
        
    // }
    
    
//     public function get_bp_luckydraw_data(Request $request)
// {
//     // Get inputs, default to empty arrays
//     $area_names = $request->area_name ?? [];
//     $region_ids = $request->region_id ?? [];
//     $country_ids = $request->country_id ?? [];

//     // Convert single values to arrays
//     $area_names = is_array($area_names) ? $area_names : [$area_names];
//     $region_ids = is_array($region_ids) ? $region_ids : [$region_ids];
//     $country_ids = is_array($country_ids) ? $country_ids : [$country_ids];

//     // Filter out placeholder values
//     $area_names = array_filter($area_names, fn($value) => !in_array($value, ['all', 'Choose Business Area', '']));
//     $region_ids = array_filter($region_ids, fn($value) => !in_array($value, ['all', 'Choose Region', '']));
//     $country_ids = array_filter($country_ids, fn($value) => !in_array($value, ['all', 'Select Country', '']));

//     // Initialize queries
//     $business_partner_query = Business_Partner::query();
//     $luckydraw_query = Luckydraw::query();

//     // Apply filters
//     if (!empty($area_names)) {
//         $business_partner_query->whereIn('business_area_id', $area_names);
//         $luckydraw_query->whereIn('business_area_id', $area_names);
//     }
//     if (!empty($region_ids)) {
//         $business_partner_query->whereIn('region_id', $region_ids);
//         $luckydraw_query->whereIn('region_id', $region_ids);
//     }
//     if (!empty($country_ids)) {
//         $business_partner_query->whereIn('country_id', $country_ids);
//         $luckydraw_query->whereIn('country_id', $country_ids);
//     }

//     // Fetch data
//     $business_partners = $business_partner_query->get();
//     $luckydraws = $luckydraw_query->get();

//     return response()->json([
//         'Business_Partner' => $business_partners,
//         'Luckydraw' => $luckydraws,
//     ], 200, [], JSON_NUMERIC_CHECK);
// }
    
  public function get_bp_business_data(Request $request)
{
    $area_names  = $request->area_name ?? [];
    $region_ids  = $request->region_id ?? [];
    $country_ids = $request->country_id ?? [];

    // Ensure arrays
    $area_names  = is_array($area_names) ? $area_names : [$area_names];
    $region_ids  = is_array($region_ids) ? $region_ids : [$region_ids];
    $country_ids = is_array($country_ids) ? $country_ids : [$country_ids];

    $bp_query = Business_Partner::query();

    // --------------------------
    // Business Area filter
    // --------------------------
    if (!empty($area_names) && !in_array("all", $area_names)) {
        $bp_query->where(function ($q) use ($area_names) {
            foreach ($area_names as $area_id) {
                $q->orWhereRaw("FIND_IN_SET(?, business_area_id)", [$area_id]);
            }
        });
    }

    // --------------------------
    // Region filter
    // --------------------------
    if (!empty($region_ids) && !in_array("all", $region_ids)) {
        $bp_query->where(function ($q) use ($region_ids) {
            foreach ($region_ids as $region_id) {
                $q->orWhereRaw("FIND_IN_SET(?, region_id)", [$region_id]);
            }
        });
    }

    // --------------------------
    // Country filter
    // --------------------------
    if (!empty($country_ids) && !in_array("all", $country_ids)) {
        $bp_query->where(function ($q) use ($country_ids) {
            foreach ($country_ids as $country_id) {
                $q->orWhereRaw("FIND_IN_SET(?, country_id)", [$country_id]);
            }
        });
    }

    $business_partners = $bp_query->get();

    return response()->json([
        'Business_Partner' => $business_partners,
    ], 200, [], JSON_NUMERIC_CHECK);
}

    
    
 public function get_bp_luckydraw_data(Request $request)
{
    $region_ly_ids = $request->region_ly_ids ?? [];
    $country_ly_ids = $request->country_ly_ids ?? [];

    // Ensure they are arrays
    $region_ly_ids = is_array($region_ly_ids) ? $region_ly_ids : [$region_ly_ids];
    $country_ly_ids = is_array($country_ly_ids) ? $country_ly_ids : [$country_ly_ids];

    $ly_query = Luckydraw::query();

    // Apply region filter if "all" is NOT selected
    if (!in_array("all", $region_ly_ids) && !empty($region_ly_ids)) {
        $ly_query->where(function ($q) use ($region_ly_ids) {
            foreach ($region_ly_ids as $region_id) {
                $q->orWhereRaw("FIND_IN_SET(?, region_id)", [$region_id]);
            }
        });
    }

    // Apply country filter if "all" is NOT selected
    if (!in_array("all", $country_ly_ids) && !empty($country_ly_ids)) {
        $ly_query->where(function ($q) use ($country_ly_ids) {
            foreach ($country_ly_ids as $country_id) {
                $q->orWhereRaw("FIND_IN_SET(?, country_id)", [$country_id]);
            }
        });
    }

    $luckydraws = $ly_query->get();

    return response()->json([
        'Luckydraw' => $luckydraws,
    ], 200, [], JSON_NUMERIC_CHECK);
}
 
    
    function create(Request $request)
    {
        $user = Session::get("user");
        //  dd($user);
        $name = $user["naem"];
        //   dd($request->all());
        // $luckydrawIds = $request->input('luckydraw_id', []);
        // dd($luckydrawIds);
        $business_partner_add = new Business_Partner();
        $business_partner_add->prefix = $request->prefix;
        $business_partner_add->poc_first_name = $request->poc_first_name;
        $business_partner_add->poc_last_name = $request->poc_last_name;
        $business_partner_add->poc_email = $request->poc_email;
        $business_partner_add->poc_mobile = $request->poc_mobile;
        $business_partner_add->business_area_id = $request->business_area_id;
        $business_partner_add->business_name = $request->business_name;
        $business_partner_add->address_line_1 = $request->address_line_1;
        $business_partner_add->address_line_2 = $request->address_line_2;
        $business_partner_add->region_id = $request->region_id;
        $business_partner_add->country_id = $request->country_id;
        $business_partner_add->state_id = $request->state_id;
        $business_partner_add->city_id = $request->city_id;
        $business_partner_add->zip_code = $request->zip_code;
        if ($request->file("profile_image")) {
            $image = $request->file("profile_image");
            $imageName_profile =
                time() . "." . $image->getClientOriginalExtension();
            // dd('image/'.$imageName);
            $image->move(
                public_path("image/profile_image/"),
                $imageName_profile
            );
            // $template_manager->template_image = 'image/'.$imageName;
            $business_partner_add->profile_image =
                "image/profile_image/" . $imageName_profile;
        }
        /* Ram Commented since this is moved to View Page with a new Button.
        $business_partner_add->initial_deposit =$request->initial_deposit;  
        $business_partner_add->initial_tx_id =$request->initial_tx_id;
        $business_partner_add->initial_tx_date =$request->initial_tx_date;
        if ($request->file('initial_tx_image')) {
            $image = $request->file('initial_tx_image');
            $imageName_tx_image = time() . '.' . $image->getClientOriginalExtension();
            // dd('image/'.$imageName);
            $image->move(public_path('image/tx_image/'), $imageName_tx_image);
        // $template_manager->template_image = 'image/'.$imageName;   
        // $business_partner->profile_image ='image/profile_image/'.$imageName_profile;
        $business_partner_add->initial_tx_image ='image/tx_image/'.$imageName_tx_image;
        }
        */
        $business_partner_add->luckydraw_id = is_array(
            $request->input("luckydraw_id")
        )
            ? implode(",", $request->input("luckydraw_id"))
            : "";
        $business_partner_add->status = 1;
        $business_partner_add->open_password = Hash::make(
            $request->poc_first_name
        );
        try {
            $business_partner_add->save();
            $username = $to = $request->poc_email; // Replace with actual email
            // Subject
            $subject = "Your LuckyDraw Login Credentials";
            // Business partner details
            $partnerName = $request->poc_first_name; // Replace dynamically
            $password = $request->poc_first_name; // Replace dynamically
            // HTML Email Content
            $message =
                '
    <!DOCTYPE html>
    <html>
    <head>
      <meta charset="UTF-8">
      <title>Welcome Email</title>
    </head>
    <body style="font-family: Arial, sans-serif; background-color: #f6f6f6; padding: 20px;">
      <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
        <tr>
          <td style="padding: 30px;">
            <h2 style="color: #333333;">Dear <strong>' .
                htmlspecialchars($partnerName) .
                '</strong>,</h2>
            <p style="font-size: 16px; color: #555555;">
              Thank you for joining with us.
            </p>
            <p style="font-size: 16px; color: #555555;">
              Please find your <strong>LuckyDraw Login Credentials</strong> below:
            </p>
            <table cellpadding="10" cellspacing="0" style="font-size: 16px; color: #333333;">
              <tr>
                <td><strong>URL:</strong></td>
                <td>
                    <a href="' . env('WEB_URL') . '/BusinessPartner/public" style="color: #1a73e8;">
                        ' . env('WEB_URL') . '/BusinessPartner/public
                    </a>
                </td>
              </tr>
              <tr>
                <td><strong>Username:</strong></td>
                <td>' .
                htmlspecialchars($username) .
                '</td>
              </tr>
              <tr>
                <td><strong>Password:</strong></td>
                <td>' .
                htmlspecialchars($password) .
                '</td>
              </tr>
            </table>
            <p style="font-size: 16px; color: #555555; margin-top: 20px;">
              Thank you.
            </p>
            <p style="font-size: 16px; color: #555555;">
              Regards,<br>
              <strong>Luckydraw Team</strong><br>
              UBG Global
            </p>
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
            // $headers .= "Reply-To: support@your-domain.com\r\n";
            $headers .= "Reply-To: no-reply@ubgglobal.com\r\n";
            // Send the email
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        if (mail($to, $subject, $message, $headers)) {
            return redirect("business_partners/partner")->with(
                "success",
                "Business Partner Added"
            );
        } else {
            return redirect("business_partners/partner")->with(
                "error",
                "Failed to send HTML Email."
            );
            // echo "Failed to send HTML Email.";
        }
    }
    function edit($id)
    {
        $luckydraw = Luckydraw::select(
            "luckydraws.*",
            "region.region_name",
            "country.country_name"
        )
            ->join("region", "luckydraws.region_id", "=", "region.id") // Join city with state
            ->join("country", "luckydraws.country_id", "=", "country.id") // Join city with country
            ->where('region.status','=',1)
             ->where('country.status','=',1)
            ->get();
            $business_area = Business_Area::get();
            $region = Region::where('status','=',1)->get();
            $business_edit = Business_Partner::select(
            "business_partners.*",
            "region.region_name",
            "country.country_name",
            "business_area.area_name",
            "state.state_title"
        )
            ->join("region", "business_partners.region_id", "=", "region.id") // Join city with state
            ->join("country", "business_partners.country_id", "=", "country.id") // Join city with country
            ->join("state", "business_partners.state_id", "=", "state.id")
            ->join("city", "business_partners.city_id", "=", "city.id")
            ->join(
                "business_area",
                "business_partners.business_area_id",
                "=",
                "business_area.id"
            )
            ->where("business_partners.id", $id)
            ->where('region.status','=',1)
            ->where('country.status','=',1)
            ->where('state.status','=',1)
            ->where('city.status','=',1)
            ->first();
        // dd($business_edit);
        return view(
            "business_partners.partner",
            compact("business_area", "region", "business_edit", "luckydraw")
        );
    }
    function update(Request $request, $id)
    {
        //   $business_area = Business_Area::find($id);
        //     $business_area->area_name =$request->area_name;
        // $business_area->area_code =$request->area_code;
        // // $business_area->status = 1;
        // $business_area->update();
        // //  return back()->with('success', 'Business Area Has Been Updated.');
        //  return redirect('business_area')->with('success', 'Business Area Has Been Updated');
        $business_partner_update = Business_Partner::find($id);
        $business_partner_update->prefix = $request->prefix;
        $business_partner_update->poc_first_name = $request->poc_first_name;
        $business_partner_update->poc_last_name = $request->poc_last_name;
        $business_partner_update->poc_email = $request->poc_email;
        $business_partner_update->poc_mobile = $request->poc_mobile;
        $business_partner_update->business_area_id = $request->business_area_id;
        $business_partner_update->business_name = $request->business_name;
        $business_partner_update->address_line_1 = $request->address_line_1;
        $business_partner_update->address_line_2 = $request->address_line_2;
        $business_partner_update->region_id = $request->region_id;
        $business_partner_update->country_id = $request->country_id;
        $business_partner_update->state_id = $request->state_id;
        $business_partner_update->city_id = $request->city_id;
        $business_partner_update->zip_code = $request->zip_code;
        if ($request->file("profile_image")) {
            $image = $request->file("profile_image");
            $imageName_profile =
                time() . "." . $image->getClientOriginalExtension();
            // dd('image/'.$imageName);
            $image->move(
                public_path("image/profile_image/"),
                $imageName_profile
            );
            // $template_manager->template_image = 'image/'.$imageName;
            $business_partner_update->profile_image =
                "image/profile_image/" . $imageName_profile;
        } else {
            $business_partner_update->profile_image =
                $business_partner_update->profile_image;
        }
        /* Ram Commented since this is moved to View Page with a new Button.
        $business_partner_update->initial_deposit =$request->initial_deposit;  
        $business_partner_update->initial_tx_id =$request->initial_tx_id;
        $business_partner_update->initial_tx_date =$request->initial_tx_date;
        if ($request->file('initial_tx_image')) {
            $image = $request->file('initial_tx_image');
            $imageName_tx_image = time() . '.' . $image->getClientOriginalExtension();
            // dd('image/'.$imageName);
            $image->move(public_path('image/tx_image/'), $imageName_tx_image);
        // $template_manager->template_image = 'image/'.$imageName;   
        // $business_partner->profile_image ='image/profile_image/'.$imageName_profile;
        $business_partner_update->initial_tx_image ='image/tx_image/'.$imageName_tx_image;
        }
        else{
            $business_partner_update->initial_tx_image =$business_partner_update->initial_tx_image;
        }
        */
        // $business_partner_update->luckydraw_id = is_array($request->input('luckydraw_id')) ? implode(',', $request->input('luckydraw_id')) : '';
        $business_partner_update->update();
        return redirect("business_partners/partners")->with(
            "success",
            "Business Partner Update"
        );
    }
    function assign_luckydraws($id)
    {
        $luckydraw = Luckydraw::select(
            "luckydraws.*",
            "region.region_name",
            "country.country_name"
        )
            ->join("region", "luckydraws.region_id", "=", "region.id") // Join city with state
            ->join("country", "luckydraws.country_id", "=", "country.id") // Join city with country
            
            ->get();
        $business_area = Business_Area::get();
        $region = Region::where('status',1)->get();
        $business_edit = Business_Partner::select(
            "business_partners.*",
            "region.region_name",
            "country.country_name",
            "business_area.area_name",
            "state.state_title"
        )
            ->join("region", "business_partners.region_id", "=", "region.id") // Join city with state
            ->join("country", "business_partners.country_id", "=", "country.id") // Join city with country
            ->join("state", "business_partners.state_id", "=", "state.id")
            ->join(
                "business_area",
                "business_partners.business_area_id",
                "=",
                "business_area.id"
            )
            ->where("business_partners.id", $id)
            
            ->first();
        // dd($business_edit);
        return view(
            "business_partners.assign_luckydraws",
            compact("business_area", "region", "business_edit", "luckydraw")
        );
    }
    function assign_luckydraws_update(Request $request, $id)
    {
        $business_partner_update = Business_Partner::find($id);
        $business_partner_update->luckydraw_id = is_array(
            $request->input("luckydraw_id")
        )
            ? implode(",", $request->input("luckydraw_id"))
            : "";
        // $business_partner_update->region_id = $request->region_id;
        // $business_partner_update->country_id = $request->country_id;    
        $business_partner_update->update();
        return redirect("business_partners/partners")->with(
            "success",
            "Assign Luckydraws Add"
        );
    }
    
    function assign_bulk_luckydraws()
    {
        $business_Partners_bulk = Business_Partner::select(
            "business_partners.*",
            "region.region_name",
            "country.country_name",
            "business_area.area_name",
            "state.state_title"
        )
        ->join("region", "business_partners.region_id", "=", "region.id") // Join city with state
        ->join("country", "business_partners.country_id", "=", "country.id") // Join city with country
        ->join("state", "business_partners.state_id", "=", "state.id")
        ->join( "business_area", "business_partners.business_area_id", "=", "business_area.id" )
        ->where('region.status','=',1)
            ->where('country.status','=',1)
            ->where('state.status','=',1)
        ->get();
        $region = Region::where('status','=',1)->get();
        $business_area = Business_Area::get();
        return view("business_partners.assign_bulk_luckydraws", compact("business_Partners_bulk","region","business_area"));
    }    
    function assign_luckydraws_bulk_update(Request $request)
    {
        
        
        
        // $business_partner_id = implode(",", $request->input("business_partner_id"));
        // $luckydraw_id = implode(",", $request->input("luckydraw_id")); 
        // // dd($luckydraw_id);
        // $business_partner = Business_Partner::whereIn('id',$business_partner_id)->get();
        // $business_partner->luckydraw_id = $luckydraw_id;
        // $business_partner->update();
        
        $business_partner_id = implode(",", $request->input("business_partner_id"));
$luckydraw_id = implode(",", $request->input("luckydraw_id")); 

// Ensure $business_partner_id is an array
$business_partner_ids = explode(",", $business_partner_id); // Convert comma-separated string to array

// Use whereIn with column name and array of IDs
$business_partner = Business_Partner::whereIn('id', $business_partner_ids)->get();

// Update the records
foreach ($business_partner as $partner) {
    $partner->luckydraw_id = $luckydraw_id;
    $partner->save();
}
        return redirect("business_partners/partners")->with( "success", "Bulk Luckydraws are Added to the Business Partners" );
    }
    
    function status($id, $actions)
    {
        if ($actions == 1) {
            $business_area = Business_Partner::find($id);
            $business_area->status = 0;
            $business_area->update();
        } else {
            $business_area = Business_Partner::find($id);
            $business_area->status = 1;
            $business_area->update();
        }
        return redirect("business_partners/partners")->with(
            "success",
            "Suspend Has Been Updated"
        );
    }
    function delete($id)
    {
        $business_area = Business_Partner::find($id);
        $business_area->delete();
        return redirect("business_partners/partners")->with(
            "success",
            "Record has been Delete"
        );
    }

 function validation_OLD (Request $request){
    //  dd($request->all());
    $status = '';
    $action = array();
    $action1 = array();    
    $Business_Partner_Email = Business_Partner::where('poc_email',$request->poc_email)->first();
    
    if($Business_Partner_Email != null)
    {
        // dd('yes');
        $action['field'] = 'name';   
        $action['status']  = 1;
    }
    else{
        $action['field'] = 'name';
        $action['status']  = 0;
    }
    
    $Business_Partner_Mobile = Business_Partner::where('poc_mobile',$request->poc_mobile)->first();
    if($Business_Partner_Mobile != null)
    {
        $action1['field'] = 'code';   
        $action1['status']  = 1;
    }
    else{
        $action1['field'] = 'code';
        $action1['status']  = 0;
    }
    return response()->json(['action' => $action,'action1'=> $action1]);
}

    function validation (Request $request){
    	//  dd($request->all());
    	$status = '';
    	$action = array();
    	$action1 = array();    
    	if($request->action == 'add'){
    		$Business_Partner_name = Business_Partner::where('poc_email',$request->poc_email)->first();
    
    		if($Business_Partner_name != null)
    		{
    			// dd('yes');
    			$action['field'] = 'name';   
    			$action['status']  = 1;
    		}
    		else{
    			$action['field'] = 'name';
    			$action['status']  = 0;
    		}
    
    		$Business_Partner_mobile = Business_Partner::where('poc_mobile',$request->poc_mobile)->first();
    
    		if($Business_Partner_mobile != null)
    		{
    			$action1['field'] = 'code';   
    			$action1['status']  = 1;
    		}
    		else{
    			$action1['field'] = 'code';
    			$action1['status']  = 0;
    		}
    		return response()->json(['action' => $action,'action1'=> $action1]);
    	}
    	else{
    		$Business_Partner_name = Business_Partner::where('poc_email',$request->poc_email)->where('id','!=',$request->b_partner_id)->first();
    		// dd($Business_Partner_name);
    		
    		if($Business_Partner_name != null)
    		{
    			// dd('yes');
    			$action['field'] = 'name';   
    			$action['status']  = 1;
    		}
    		else{
    			$action['field'] = 'name';
    			$action['status']  = 0;
    		}
    
    		$Business_Partner_mobile = Business_Partner::where('poc_mobile',$request->poc_mobile)->where('id','!=',$request->b_partner_id)->first();
    
    		if($Business_Partner_mobile != null)
    		{
    			$action1['field'] = 'code';   
    			$action1['status']  = 1;
    		}
    		else{
    			$action1['field'] = 'code';
    			$action1['status']  = 0;
    		}
    		return response()->json(['action' => $action,'action1'=> $action1]);
    	}
    }
    
    public function view_luckydraw($id){
        
        $view_selected_bp = Business_Partner::find($id);
        $luckydraw_id = $view_selected_bp->luckydraw_id;
        // dd($luckydraw_id);
        
        $ids = explode(',', $luckydraw_id); // ["1","2","3","4"]

        
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
    ->whereIn('luckydraws.id', $ids)
    ->groupBy('luckydraws.id')   // 👈 add this
    ->get();

        // dd($luckydraws);
        // $donors = Donor::where('status', 0)
        // ->with(['payment', 'city', 'district', 'state']) // Eager load related models
        // ->orderBy('id', 'desc')
        // ->paginate(3);
        return view(
            "business_partners.view_luckydraw",
            compact(
                "business_area",
                "region",
                "template_Manager",
                "luckydraws",
                "luckydraw_sale"
            )
        );
        
        
    }
}