<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Luckydraw;
use Carbon\Carbon;
use PDF; // barryvdh/laravel-dompdf
use Maatwebsite\Excel\Facades\Excel; // maatwebsite/excel

class SalesReportController extends Controller
{
    public function index(Request $request)
    {
        $luckydraws = Luckydraw::all();

        $query = Sale::with('luckydraw');

        // Filters
        if ($request->luckydraw_id) {
            $query->where('luckydraw_id', $request->luckydraw_id);
        }
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [
                Carbon::parse($request->start_date)->startOfDay(),
                Carbon::parse($request->end_date)->endOfDay()
            ]);
        }
        $sales = $query->selectRaw('luckydraw_id, SUM(qty) as tickets_sold')
            ->groupBy('luckydraw_id')
            ->with('luckydraw')
            ->get();
        $totalTickets = $sales->sum('tickets_sold');

        return view('sales-report.index', compact('sales', 'luckydraws', 'totalTickets'));
    }

    public function export($type, Request $request)
    {
        $query = Sale::with('luckydraw');

        if ($request->luckydraw_id) {
            $query->where('luckydraw_id', $request->luckydraw_id);
        }
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [
                Carbon::parse($request->start_date)->startOfDay(),
                Carbon::parse($request->end_date)->endOfDay()
            ]);
        }

        $sales = $query->get();

        if ($type === 'csv') {
            $filename = "sales_report.csv";
            $handle = fopen($filename, 'w+');
            fputcsv($handle, ['Sl. No', 'Luckydraw Name', 'Tickets Sold']);
        
            $i = 1;
            foreach ($sales as $sale) {
                fputcsv($handle, [
                    $i++,
                    $sale->luckydraw->luckydraw_name ?? '',
                    $sale->tickets_sold
                ]);
            }
        
            fclose($handle);
            return response()->download($filename)->deleteFileAfterSend(true);
        }

        if ($type === 'pdf') {
            $pdf = PDF::loadView('sales-report.pdf', compact('sales'));
            return $pdf->download('sales_report.pdf');
        }
    }
}
