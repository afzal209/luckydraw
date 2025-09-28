<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Business_Partner;
use App\Models\Customer;
use App\Models\Luckydraw;
use App\Models\Region;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use PDF; // if using barryvdh/laravel-dompdf package
//use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    // Landing page with buttons
    public function index()
    {
        return view('reports.index');
    }

    public function customers(Request $request)
    {
        $query = Customer::with(['country','state','city']);

        if ($request->filled('country_id')) {
            $query->where('country_id', $request->country_id);
        }
        if ($request->filled('state_id')) {
            $query->where('state_id', $request->state_id);
        }
        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        $customers = $query->get();

        $countries = Country::all();
        $states    = State::all();
        $cities    = City::all();

        return view('reports.customers', compact('customers','countries','states','cities'));
    }
    
    // === Customer Report Logic ===
    public function customersReport(Request $request)
    {
        $countries = Country::all();

        $query = Customer::with(['country','state','city']);

        if ($request->country_id) {
            $query->where('country_id', $request->country_id);
        }
        if ($request->state_id) {
            $query->where('state_id', $request->state_id);
        }
        if ($request->city_id) {
            $query->where('city_id', $request->city_id);
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        $customers = $query->paginate(10)->withQueryString();

        return view('reports.customers', compact('customers','countries'));
    }

    public function customersExport($type, Request $request)
    {
        $query = Customer::with(['country','state','city']);

        if ($request->country_id) $query->where('country_id', $request->country_id);
        if ($request->state_id)   $query->where('state_id', $request->state_id);
        if ($request->city_id)    $query->where('city_id', $request->city_id);
        if ($request->status)     $query->where('status', $request->status);
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        $customers = $query->get();

        if ($type == 'csv') {
            $filename = "customers.csv";
            $headers = [
                "Content-Type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$filename",
            ];

            $callback = function() use ($customers) {
                $handle = fopen('php://output', 'w');
                fputcsv($handle, ['Name','Email','Country','State','City','Status','Created At']);
                foreach ($customers as $c) {
                    fputcsv($handle, [
                        $c->name,
                        $c->email,
                        $c->country->country_name ?? '',
                        $c->state->state_title ?? '',
                        $c->city->name ?? '',
                        $c->status,
                        $c->created_at,
                    ]);
                }
                fclose($handle);
            };

            return Response::stream($callback, 200, $headers);
        }

        if ($type == 'pdf') {
            $pdf = PDF::loadView('reports.customers_pdf', compact('customers'));
            return $pdf->download('customers.pdf');
        }
    }

    public function getStates($country_id)
    {
        $states = \App\Models\State::where('country_id', $country_id)->pluck('state_title', 'id');
        return response()->json($states);
    }
    
    public function getCities($state_id)
    {
        $cities = \App\Models\City::where('state_id', $state_id)->pluck('name', 'id');
        return response()->json($cities);
    }

    public function businessPartnersReport(Request $request)
    {
        $query = Business_Partner::query()->with(['country','state','city']);
    
        // Filters
        if($request->filled('region_id')) {
            $query->where('country_id', $request->region_id);
        }
        if($request->filled('state_id')) {
            $query->where('state_id', $request->state_id);
        }
        if($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }
        if($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }
    
        $businessPartners = $query->paginate(10);
    
        $countries = Country::all();
        $states    = State::all();
        $cities    = City::all();
    
        return view('reports.business_partners', compact('businessPartners','countries','states','cities'));
    }
    
    // CSV export
    public function exportBusinessPartnersCsv(Request $request)
    {
        $data = $this->getFilteredBusinessPartners($request);
    
        $filename = "business_partners_" . now()->format('Y-m-d') . ".csv";
    
        return response()->streamDownload(function () use ($data) {
            $handle = fopen('php://output','w');
            fputcsv($handle,['Name','Email','Region','State','City','Status','Created At']);
    
            foreach($data as $d){
                fputcsv($handle, [
                    $d->name,
                    $d->email,
                    $d->country->country_name ?? '',
                    $d->state->state_title ?? '',
                    $d->city->name ?? '',
                    $d->status == 1 ? 'Active' : 'Inactive',
                    $d->created_at->format('Y-m-d')
                ]);
            }
    
            fclose($handle);
        }, $filename);
    }
    
    // PDF export
    public function exportBusinessPartnersPdf(Request $request)
    {
        $pdf = PDF::loadView('reports.business_partners_pdf', compact('data'));
        return $pdf->download('business_partners.pdf');
    }
    
    // Helper for filtering
    private function getFilteredBusinessPartners(Request $request)
    {
        $query = Business_Partner::query()->with(['country','state','city']);
    
        if($request->filled('region_id')) {
            $query->where('country_id', $request->region_id);
        }
        if($request->filled('state_id')) {
            $query->where('state_id', $request->state_id);
        }
        if($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }
        if($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }
    
        return $query->get();
    }

    public function salesReport() {
        return view('reports.sales');
    }

    public function luckydrawReport() {
        return view('reports.luckydraws');
    }
}