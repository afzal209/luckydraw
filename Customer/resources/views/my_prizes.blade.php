@extends('layout')
@section('title','My Prizes')
@section('content')


<style>
 
.single-lottery-item {
    display: inline-block;
    padding: 10px;
    background: #fff;
    border-radius: 8px;
}


.lottery-item {
    text-align: center; /* centers inline content inside this div */
}

.lottery-name {
    display: block;       /* span becomes block so text-align works */
    margin-top: 8px;      /* spacing from the image */
    font-weight: bold;    /* optional */
    text-align: center;   /* ensures text is centered */
}

table {
        border-collapse: collapse; /* makes borders visible */
        width: 100%;
    }
    table, th, td {
        border: 1px solid black; /* sets border style */
    }
    th, td {
        padding: 8px;
        text-align: left;
    }


</style>



     <!-- breadcrumb begin  -->
      <div class="breadcrumb-pok">
         <img class="br-shape-left" src="{{URL::asset('img/breadcrumb/left-bg.png' ) }}" alt="">
         <img class="br-shape-right" src="{{URL::asset('img/breadcrumb/right-bg.png' ) }}" alt="">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-xl-7 col-lg-8">
                  <div class="breadcrumb-content">
                     <span class="subtitle">🎁 My Prize Distribution</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- breadcrumb end  -->

<div class="lotteries">
    <div class="container">
        @if($tickets->isEmpty())
            <div class="alert alert-info">No prize records found.</div>
        @else
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Sl.No</th>
                        <th>Ticket ID</th>
                        <th>Lucky Draw</th>
                        <th>Prize</th>
                        <th>Business Partner</th>
                        <th>Remarks</th>
                        <th>Proof</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $index => $t)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $t->ticket_id }}</td>
                            <td>{{ $t->luckydraw_name }}</td>
                            <td>
                                @if($t->prize_type == 1)
                                    💰 {{ $t->amount }}
                                @elseif($t->prize_type == 2)
                                    <div>
                                        🎁 {{ $t->item }} <br>
                                        @if($t->image)
                                            <img src="{{ asset($t->image) }}" alt="Prize" width="80">
                                        @endif
                                    </div>
                                @endif
                            </td>
                            <td>{{ $t->business_name }}</td>
                            <td>{{ $t->tx_remarks ?? '-' }}</td>
                            <td>
                                @if($t->tx_proof)
                                    <a href="{{ env('WEB_URL') }}/uploads/luckydraw/prizetransactions/{{ $t->tx_proof }}" target="_blank"><img src="{{ env('WEB_URL') }}/uploads/luckydraw/prizetransactions/{{ $t->tx_proof }}" style="width:125px;height:75px;"></a>
                                @else
                                    
                                @endif
                            </td>
                            <td>
                                @if($t->tx_status == 1)
                                    <span class="badge bg-success">Paid</span>
                                @else
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>    
@endsection
