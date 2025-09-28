@extends('layout')
@section('title','View Customer')
@section('content')

             <div class="row gx-4">
                     <div class="col-sm-12">
                        <div class="card mb-3">
                           <div class="card-header">
                              <h5 class="card-title">My Customers</h5>
                           </div>
                           <div class="card-body">
                              <div class="table-outer">
                                 <div class="table-responsive">
                                    <table class="table align-middle table-hover m-0 truncate">
                                       <thead>
                                          <tr>
                                             <th scope="col">Customer</th>
                                             <th scope="col">Details</th>
                                             <th scope="col">Address</th>
                                             <th scope="col">Age</th>
                                             <th scope="col">Since</th>
                                             <th scope="col">Revenue</th>
                                             <th scope="col">Status</th>
                                             <!--<th scope="col">Actions</th>-->
                                          </tr>
                                       </thead>
                                       <tbody>
                                           @php
                                                use Carbon\Carbon;
                                            @endphp
                                           
                                           @foreach($customer as $customers)
                                          @php
                                                $dob = Carbon::parse($customers->dob);
                                                $today = Carbon::now();
                                                $years = $today->diffInYears($dob);
                                                $months = $today->diffInMonths($dob) % 12;
                                            @endphp
                                          <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img class="rounded-circle img-3x me-2" src="{{request()->getSchemeAndHttpHost()}}/uploads/customer/profile/{{$customers->profile_image }}" alt="Prabhakar">
                                                        <span class="fw-bold">{{$customers->customer_id}}</span>
                                                    </div>
                                                </td>
                                                <td>{{$customers->first_name}}<br>{{$customers->email}}<br>{{$customers->mobile}}</td>
                                                <td>{{$customers->address_line_1}}<br>{{$customers->address_line_2}}</td>
                                                <td>{{$months}} Years</td>
                                                <td>{{Carbon::parse($customers->created_at)->format('Y-m-d');}}</td>
                                                <td></td>
    											<td>@if($customers->status == 1)
    											<span class="badge border border-success text-primary">Active</span>
    											    @else
    											        <span class="badge border border-danger text-danger">In-Active</span>
    											    @endif
                                                <!-- <td>-->
                                                <!-- <a class="btn btn-info btn-icon btn-sm mb-1" href="{{route('manage_customer.add_new_customer.edit',$customers->id)}}"><i class="bi bi-pencil"></i> Edit</a>-->
                                    		    <!-- <a class="btn btn-primary btn-icon btn-sm mb-1" href="#"><i class="bi bi-trash"></i> View Tx</a>-->
                                                <!-- </td>-->
                                          </tr>
                                          @endforeach
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
            
         


@endsection