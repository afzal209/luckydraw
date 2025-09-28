<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\LuckyDraw;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class OverallSalesReportController extends Controller
{
    public function index()
    {
        return view('overallSalesReport');
    }

    public function generateReport(Request $request)
    {
        $query = Sale::with('luckydraw');

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
        }

        $sales = $query->get();
        $totalAmount = $sales->sum(function ($sale) {
            return (float) $sale->amount;
        });

        if ($request->has('download_excel')) {
            return Excel::download(new \App\Exports\SalesExport($sales), 'overall_sales_report.xlsx');
        }

        if ($request->has('download_pdf')) {
            $pdf = PDF::loadView('overallSalesPdf', compact('sales', 'totalAmount'));
            return $pdf->download('overall_sales_report.pdf');
        }

        return view('overallSalesReport', compact('sales', 'totalAmount'));
    }
}
