<?php

namespace App\Http\Controllers;

use App\Models\Luckydraw;
use App\Models\LuckydrawTemplate;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use PDF;

class LuckydrawReportController extends Controller
{
    /**
     * Return a Collection of Sale models filtered by the provided filters array.
     * Expects keys: luckydraw_id, template_id, start_date, end_date
     */
    private function getFilteredSales(array $filters = [])
    {
        $query = Sale::query();

        if (!empty($filters['luckydraw_id']) && $filters['luckydraw_id'] !== 'all') {
            $query->where('luckydraw_id', $filters['luckydraw_id']);
        }

        if (!empty($filters['template_id']) && $filters['template_id'] !== 'all') {
            $query->where('template_id', $filters['template_id']);
        }

        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            // If your created_at stores datetime, use full-day range or parse with Carbon as needed.
            $query->whereBetween('created_at', [$filters['start_date'].' 00:00:00', $filters['end_date'].' 23:59:59']);
        }

        return $query->with(['luckydraw', 'template'])->get();
    }

    /**
     * Show the filter form (no results yet).
     */
    public function index()
    {
        $luckydraws = Luckydraw::all();

        // No sales yet — pass safe defaults so Blade never sees undefined vars.
        return view('luckydraws.report', [
            'luckydraws'    => $luckydraws,
            'sales'         => collect(),
            'grouped'       => collect(),
            'totalTickets'  => 0,
            'grandTotal'    => 0,
            'filters'       => [],
        ]);
    }

    /**
     * Handle filter submit and show results.
     */
    public function filter(Request $request)
    {
        $filters = $request->only(['luckydraw_id', 'template_id', 'start_date', 'end_date']);
        $sales = $this->getFilteredSales($filters);

        // Group by luckydraw -> template -> count
        $grouped = $sales->groupBy('luckydraw_id')->map(function ($luckydrawSales) {
            return $luckydrawSales->groupBy('template_id')->map(function ($templateSales) {
                return $templateSales->count();
            });
        });

        // Total tickets = number of sale rows matching filters (use qty sum if needed)
        $totalTickets = $sales->count();

        // Grand total (same as totalTickets if each sale represents one ticket).
        // If you want to sum 'qty' column instead: $grandTotal = $sales->sum('qty');
        $grandTotal = $totalTickets;

        return view('luckydraws.report', [
            'luckydraws'    => Luckydraw::all(),
            'sales'         => $sales,
            'grouped'       => $grouped,
            'totalTickets'  => $totalTickets,
            'grandTotal'    => $grandTotal,
            'filters'       => $filters,
        ]);
    }

    /**
     * Export CSV respecting current filters (filters passed as GET params or query string)
     */
    public function exportCsv(Request $request)
    {
        $filters = $request->only(['luckydraw_id', 'template_id', 'start_date', 'end_date']);
        $sales = $this->getFilteredSales($filters);

        $filename = "luckydraw-report.csv";
        $handle = fopen('php://temp', 'r+');
        fputcsv($handle, ['Luckydraw', 'Template', 'Sales Count', 'Luckydraw Total']);

        $grandTotal = 0;

        // Group as in UI and write
        $sales->groupBy('luckydraw_id')->each(function ($luckydrawSales, $ldId) use (&$handle, &$grandTotal) {
            $ldName = optional($luckydrawSales->first()->luckydraw)->luckydraw_name ?? 'Unknown';
            $templates = $luckydrawSales->groupBy('template_id');
            $luckydrawTotal = $templates->sum(function($col) { return $col->count(); });

            $templates->each(function ($templateSales, $tId) use (&$handle, $ldName, $luckydrawTotal, &$grandTotal) {
                $templateName = optional($templateSales->first()->template)->template_name ?? '-';
                $count = $templateSales->count();
                fputcsv($handle, [$ldName, $templateName, $count, $luckydrawTotal]);
            });

            $grandTotal += $luckydrawTotal;
        });

        fputcsv($handle, ['Grand Total', '', $grandTotal, '']);
        rewind($handle);
        $contents = stream_get_contents($handle);
        fclose($handle);

        return Response::make($contents, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}"
        ]);
    }

    /**
     * Export PDF respecting current filters
     */
    public function exportPdf(Request $request)
    {
        $filters = $request->only(['luckydraw_id', 'template_id', 'start_date', 'end_date']);
        $sales = $this->getFilteredSales($filters);

        $grouped = $sales->groupBy('luckydraw_id')->map(function ($luckydrawSales) {
            return $luckydrawSales->groupBy('template_id')->map(function ($templateSales) {
                return $templateSales->count();
            });
        });

        $totalTickets = $sales->count();

        $pdf = PDF::loadView('luckydraws.report_pdf', [
            'grouped'       => $grouped,
            'luckydraws'    => Luckydraw::all(),
            'totalTickets'  => $totalTickets,
            'grandTotal'    => $totalTickets,
        ]);

        return $pdf->download('luckydraw-report.pdf');
    }
}