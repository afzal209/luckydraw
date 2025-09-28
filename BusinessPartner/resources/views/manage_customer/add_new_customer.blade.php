@extends('layout')
@section('title','Add New Customer')
@section('content')

         
         <div class="row gx-4">
                     <div class="col-sm-12">
                        <div class="card">
                           <div class="card-body">
                              <!-- Row starts -->
                              <div class="row">
                                   <form method="POST" action="{{ isset($customer_edit) ? route('manage_customer.add_new_customer.update', $customer_edit->id) : route('manage_customer.add_new_customer.create') }}">
                                       @csrf
                                 <div class="col-xxl-12 col-sm-6 col-12">
                                    <!-- Row starts -->
                                    <div class="row gx-12">
                                       <div class="col-12">
                                          <h5 class="fw-semibold mb-3">Customer Details</h5>
                                       </div>
                                       
                                               
                                          
                                       <div class="col-4">
                                          
                                          <!-- Form group start -->
                                          <div class="mb-3">
                                             <label for="customerName" class="form-label">Customer Name<font color="red">*</font></label>
                                             <input type="text" name="customer_name" id="customer_name" class="form-control" placeholder="Enter Customer Name" value="{{$customer_edit->first_name ?? ''}}">
                                          </div>
                                          <!-- Form group end -->
                                       </div>
                                       <div class="col-3">
                                          <!-- Form group start -->
                                          <div class="mb-3">
                                             <label for="invNumber" class="form-label">Customer Email<font color="red">*</font></label>
                                             <input type="text" name="customer_mail" id="customer_mail" class="form-control" placeholder="Enter Valid Email" value="{{$customer_edit->email ?? ''}}">
                                          </div>
                                          <!-- Form group end -->
                                       </div>
                                       <div class="col-sm-4 col-12">
                                          <!-- Form group start -->
                                          <div class="mb-3">
                                             <label for="dateIssued" class="form-label">Phone Number<font color="red">*</font></label>
                                             <input type="text" name="customer_phone" id="customer_phone" class="form-control" placeholder="Enter Phone Number Prefix Without 00 & +" value="{{$customer_edit->mobile ?? ''}}">
                                          </div>
                                          <!-- Form group end -->
                                       </div>
                                    </div>
                                    <!-- Row ends -->
                                 </div>
                                 <div class="col-12">
                                    <div class="d-flex justify-content-end gap-1">
                                       <button type="submit" class="btn btn-dark"><i class="bi bi-cloud-arrow-up-fill"></i>@if(isset($customer_edit)) Update Customer @else Create New Customer @endif</button>
                                       <a href="{{route('manage_customer.view_customer')}}" class="btn btn-success"><i class="bi bi-cancel"></i> Cancel</a>
                                    </div>
                                 </div>
                                </form>
                              </div>
                              <!-- Row ends -->
                           </div>
                        </div>
                     </div>
                  </div>

@endsection

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
  
});

  
</script>