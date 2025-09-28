<?php
namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\Business_Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use PDF;

class WalletReportController extends Controller
{
    private function getFilteredWallets($filters)
    {
        $query = Wallet::with('businessPartner');

        if (!empty($filters['bp_id']) && $filters['bp_id'] != 'all') {
            $query->where('bp_id', $filters['bp_id']);
        }

        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            $query->whereBetween('tx_date', [$filters['start_date'], $filters['end_date']]);
        }

        if (!empty($filters['status']) && $filters['status'] != 'all') {
            $query->where('status', $filters['status']);
        }

        return $query->get();
    }

    public function index()
    {
        $partners = Business_Partner::all();
        $wallets = Wallet::with('businessPartner')->get();

        return view('wallet.report', [
            'partners' => $partners,
            'wallets' => $wallets,
            'filters' => [],
        ]);
        
    }

    public function filter(Request $request)
    {
        $filters = $request->only(['bp_id','start_date','end_date','status']);
        $wallets = $this->getFilteredWallets($filters);

        return view('wallet.report', [
            'partners' => Business_Partner::all(),
            'wallets' => $wallets,
            'filters' => $filters,
        ]);
    }

    public function exportCsv(Request $request)
    {
        $wallets = $this->getFilteredWallets($request->all());

        $filename = "wallet-report.csv";
        $handle = fopen('php://temp', 'r+');
        fputcsv($handle, ['Business Partner','Tx ID','Tx Date','Amount','Tx Type','Tx Mode','Created At','Status']);

        foreach ($wallets as $w) {
            fputcsv($handle, [
                $w->businessPartner->company_name ?? '-',
                $w->tx_id,
                $w->tx_date,
                $w->amount,
                $w->tx_type == 1 ? 'Online' : 'Offline',
                $this->txModeLabel($w->tx_mode),
                $w->created_at,
                $w->status == 1 ? 'Active' : 'Inactive'
            ]);
        }

        rewind($handle);
        $contents = stream_get_contents($handle);
        fclose($handle);

        return Response::make($contents, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}"
        ]);
    }

    public function exportPdf(Request $request)
    {
        $wallets = $this->getFilteredWallets($request->all());
        $pdf = PDF::loadView('wallet.report_pdf', compact('wallets'));
        return $pdf->download('wallet-report.pdf');
    }

    public function txModeLabel($mode)
    {
        $modes = [
            1=>'Paypal',2=>'Razorpay',3=>'Instamojo',4=>'Stripe',5=>'Mollie',
            6=>'FLW',7=>'Authorizenet',8=>'Midtrans',9=>'Payfast',10=>'Cashfree',
            11=>'Marcadopago',12=>'Squareup',13=>'Flutterwave',14=>'Paystack',
            15=>'Cinetpay',16=>'Zitopay'
        ];
        return $modes[$mode] ?? '-';
    }
}