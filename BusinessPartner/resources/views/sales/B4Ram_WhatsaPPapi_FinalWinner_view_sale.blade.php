@extends('layout')
@section('title', 'View Sale')
@section('content')




    @php
        $user = Session::get('user');
    @endphp
    <div class="row gx-4">
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card mb-3">
                <div class="card-body">
                    <h6 class="mb-3">Total Invoices Amount</h6>
                    <h2 class="mb-2 d-flex align-items-center justify-content-between">
                        <i class="bi bi-journal-medical fs-3 lh-1 bg-primary p-3 rounded-3 text-white"></i>
                        <span class="text-primary">€ {{ $sale_amount }}</span>
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card mb-3">
                <div class="card-body">
                    <h6 class="mb-3">Paid to Company</h6>
                    <h2 class="mb-2 d-flex align-items-center justify-content-between">
                        <i class="bi bi-journal-check fs-3 lh-1 bg-primary p-3 rounded-3 text-white"></i>
                        <span class="text-primary">€ {{ $sale_amount }}</span>
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card mb-3">
                <div class="card-body">
                    <h6 class="mb-3">Total Luckydraw Tickets Sold</h6>
                    <h2 class="mb-2 d-flex align-items-center justify-content-between">
                        <i class="bi bi-ticket-perforated-fill fs-3 lh-1 bg-primary p-3 rounded-3 text-white"></i>
                        <span class="text-primary">{{ $sales }}</span>
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card mb-3">
                <div class="card-body">
                    <h6 class="mb-3">Wallet Balance</h6>
                    <h2 class="mb-2 d-flex align-items-center justify-content-between">
                        <i class="bi bi-wallet-fill fs-3 lh-1 bg-primary p-3 rounded-3 text-white"></i>
                        <span class="text-primary">€ {{ $wallet->wallet_amount }}</span>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Row ends -->
    <!-- Row starts -->
    <div class="row gx-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Sales History</h5>
                </div>
                <div class="card-body">
                    <div class=" table-outer mb-2">
                        <div class="table-responsive">
                            <table class="table truncate align-middle">
                                <thead>
                                    <tr>
                                        <td width="200px">Customer Details</td>
                                        <td width="100px">Luckydraw Details</td>
                                        <td width="100px">Ticket Details</td>
                                        <td width="100px">Purchased Date</td>
                                        <td width="100px">Draw Date</td>
                                        <td width="100px">Is Winner</td>
                                        <td width="100px">Actions</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Sale as $Sales)
                                    @php 
                                    $busniess_partner = \App\Models\Business_Partner::from('business_partners as bp')
                                        ->select(
                                            'bp.poc_first_name',
                                            'bp.poc_last_name',
                                            'bp.poc_email',
                                            'bp.poc_mobile',
                                            'bp.business_name',
                                            'bp.address_line_1',
                                            'bp.address_line_2',
                                            'bp_ar.area_name',
                                            'rg.region_name',
                                            'ct.country_name',
                                            'st.state_title',
                                            'cit.name as city_name',
                                            'bp.zip_code'
                                        )
                                        ->leftJoin('business_area as bp_ar', 'bp.business_area_id', '=', 'bp_ar.id')
                                        ->leftJoin('region as rg', 'bp.region_id', '=', 'rg.id')
                                        ->leftJoin('country as ct', 'bp.country_id', '=', 'ct.id')
                                        ->leftJoin('state as st', 'bp.state_id', '=', 'st.id')
                                        ->leftJoin('city as cit', 'bp.city_id', '=', 'cit.id')
                                        ->where('bp.id', $user['id'])
                                        ->first();
                                    @endphp
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center"><img src="{{ env('WEB_URL') }}/uploads/customer/profile_image/{{ $Sales->profile_image }}" class="img-3x rounded-5 me-3" alt="{{ $Sales->first_name }}"></div>
                                                {{ $Sales->first_name }}<br>
                                                <small>{{ $Sales->email }}<br />{{ $Sales->mobile }}</small>
                                            </td>
                                            <td>{{ $Sales->luckydraw_name }}<br>€{{ $Sales->price }}/- <span class="badge bg-success">Paid Online</span></td>
                                            <td align="center"><br><img src="{{ asset($Sales->sale_image_path) }}" class="img-3x rounded-5 me-3" alt="Customer Name"><br>Ticket ID:{{ $Sales->ticket_id }} </td>
                                            <td>{{ $Sales->created_at->format('Y-m-d') }}</td>
                                            <td>{{ $Sales->created_at->format('Y-m-d') }}</td>
                                            <td>
                                                <!--//If This ID is the winner then show Yes label else No lable.-->
                                                 
                                                
                                                <!--//prize_id from prizes Tables-->
                                                @php 
    $prize_distribution = \App\Models\Prize_Distribution::where('ticket_id', $Sales->ticket_id)->first();
    $prize = null;

    if ($prize_distribution && $prize_distribution->prize_id != null) {
        $prize = \App\Models\Prize::where('id', $prize_distribution->prize_id)
                   ->select('amount','item','image')
                   ->first();
    }
@endphp



                                                @if($prize_distribution != '')
                                                <span class="badge bg-success">Yes</span>
                                                @php
                                                $created_at = $prize_distribution->created_at; 
                                                $updated_at = $prize_distribution->updated_at; 
                                                $tx_remarks = $prize_distribution->tx_remarks;
                                                $tx_proof = $prize_distribution->tx_proof;
                                                @endphp
                                                <br>
                                                {{$created_at}}
                                                <br>
                                                {{$updated_at}}
                                                <br>
                                                {{$tx_remarks}}
                                                <br>
                                                <img src="{{ env('WEB_URL') }}/uploads/luckydraw/prizetransactions/{{$tx_proof}}" class="img-3x rounded-5 me-3" alt="Customer Name">
                                                <br>
                                                @if($prize)
                                                    <!-- Display prize info -->
                                                    <br>
                                                    {{ $prize->item }}  
                                                    <br>
                                                    {{ $prize->amount }}
                                                    <br>
                                                    <img src="{{ env('WEB_URL') }}/uploads/luckydraw/prizes/{{$prize->image}}" alt="Prize" style="width: 90px;height: 90px;">
                                                @endif
                                                
                                                <br>
                                                @else
                                                <span class="badge bg-danger">No</span>
                                                @endif
                                                <!--$amount = "";-->
                                                <!--$item = "";-->
                                                <!--$image = "";-->
                                                
                                                <!--//Table : prize_distribution -->
                                                <!--$created_at = ""; -->
                                                <!--$updated_at = ""; -->
                                                <!--$tx_remarks = "";-->
                                                <!--$tx_proof = "";-->
                                            </td>
                                            <!-- Will be used later ... <td>{{$busniess_partner->poc_first_name}}<br> {{$busniess_partner->poc_last_name}}<br> {{$busniess_partner->poc_email}}<br> {{$busniess_partner->poc_mobile}}<br> {{$busniess_partner->area_name}}<br> {{$busniess_partner->business_name}}<br> {{$busniess_partner->address_line_1}}<br> {{$busniess_partner->address_line_2}}<br> {{$busniess_partner->region_name}}<br> {{$busniess_partner->country_name}}<br> {{$busniess_partner->state_title}}<br> {{$busniess_partner->city_name}}<br> {{$busniess_partner->zip_code}}</td> -->
                                            <td>
                                                <a href="{{ asset($Sales->sale_image_path) }}" class="btn btn-primary" target="_blank"> <i class="bi bi-printer"></i> View & Print Ticket</a>
                                                <a href="https://wa.me/{{ $Sales->mobile }}?text=Dear%20*{{$Sales->first_name}}*%2C%0A%0AThank%20you%20for%20purchasing%20the%20Luckydraw%20*{{$Sales->luckydraw_name}}*%20from%20*Naresh%20Luckydraws%2C%20India*.%0A%0AYour%20Luckydraw%20details%20are%20as%20follows%3A%0A%0ALuckydraw%20Name%3A%20*{{$Sales->luckydraw_name}}*%0ATicket%20Number%3A%20*{{$Sales->ticket_id}}*%0A%0APlease%20click%20the%20link%20below%20to%20download%20your%20Luckydraw%20ticket%3A%20https%3A%2F%2Fwww.crm2.microsharp.net%2FCustomer%2Fpublic%2Fmyticket%2F{{$Sales->ticket_download_id}}%0A%0AThank%20you%20for%20choosing%20*{{$busniess_partner->business_name}}*.%0A%0AWarm%20Regards%2C%0A*{{$busniess_partner->poc_first_name}}*%0A{{$busniess_partner->poc_email}}%2C%20{{$busniess_partner->poc_mobile}}%0A{{$busniess_partner->area_name}}%2C%20{{$busniess_partner->region_name}}%2C%20{{$busniess_partner->city_name}}%0A{{$busniess_partner->city_name}}%2C%20{{$busniess_partner->state_title}}%0A{{$busniess_partner->country_name}}%2C%20{{$busniess_partner->zip_code}}" target="_blank" class="btn btn-info"><i class="bi bi-whatsapp"></i> Send Ticket</a>
                                                <br><br>
                                                <a href="{{ route('sales.print', $Sales->id) }}" class="btn btn-info"><i class="bi bi-file-pdf"></i> Download Ticket</a>
                                                <a href="https://wa.me/{{ $Sales->mobile }}?text=Dear%20*{{$Sales->first_name}}*%2C%0A%0AThank%20you%20for%20purchasing%20the%20Luckydraw%20*{{$Sales->luckydraw_name}}*%20from%20*Naresh%20Luckydraws%2C%20India*.%0A%0AYour%20Luckydraw%20details%20are%20as%20follows%3A%0A%0ALuckydraw%20Name%3A%20*{{$Sales->luckydraw_name}}*%0ATicket%20Number%3A%20*{{$Sales->ticket_id}}*%0A%0APlease%20click%20the%20link%20below%20to%20download%20your%20Luckydraw%20ticket%3A%20https%3A%2F%2Fwww.crm2.microsharp.net%2FCustomer%2Fpublic%2Fmyticket%2F{{$Sales->ticket_download_id}}%0A%0AThank%20you%20for%20choosing%20*{{$busniess_partner->business_name}}*.%0A%0AWarm%20Regards%2C%0A*{{$busniess_partner->poc_first_name}}*%0A{{$busniess_partner->poc_email}}%2C%20{{$busniess_partner->poc_mobile}}%0A{{$busniess_partner->area_name}}%2C%20{{$busniess_partner->region_name}}%2C%20{{$busniess_partner->city_name}}%0A{{$busniess_partner->city_name}}%2C%20{{$busniess_partner->state_title}}%0A{{$busniess_partner->country_name}}%2C%20{{$busniess_partner->zip_code}}" target="_blank" class="btn btn-primary"><i class="bi bi-whatsapp"></i> Click To Inform Winner</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Pagination start -->
                    <div class="d-flex justify-content-end">
                        <b>Note:</b> If you find any mistakes, please raise a&nbsp;<u><a
                                href="{{ route('support') }}">Support Ticket</a></u>.
                    </div>
                    <!-- Pagination end -->
                </div>
            </div>
        </div>
    </div>
@endsection