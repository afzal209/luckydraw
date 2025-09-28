@extends('layout')
@section('title','Manage Customer Group')
@section('content')

              <div class="row gx-4">
                     <div class="col-xl-12 col-sm-12">
                        <!-- Card start -->
                        <div class="card">
                           <div class="card-header">
                              <h5 class="card-title">Customer Group Manager</h5>
                           </div>
                         
                           <div class="card-body">
                              <form class="row g-3 needs-validation" novalidate method="POST" action="{{ isset($customer_group_edit) ? route('manage_customer.manage_customer_group.update_group', $customer_group_edit->id) : route('manage_customer.manage_customer_group.create_group') }}">
                                  @csrf
                                  
                                 <div class="m-0">
                                    <label class="form-label" for="abc">Group Name</label>
                                    <input type="text" class="form-control" name="group_name" id="group_name" value="{{$customer_group_edit->group_name ?? ''}}" required>
                                         @error('group_name')
                                            <div class="error">{{ $message }}</div>
                                        @enderror

                                 </div>
                                 <div class="col-sm-12 col-12">
                                    <div class="card mb-12">
                                        @if(!isset($customer_group_edit))
                                       <label class="form-label" for="abc">Choose One or More Customers</label>
                                        <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="checkbox" id="all_check" value="all">
                                             <label class="form-check-label" for="inlineCheckbox2">Select All Customer</label>
                                          </div>
                                          @endif
                                       <div class="card-body">
                                          @php
                                          $selectedCustomers = explode(',', $customer_group_edit->customer_ids ?? ''); 

    // Get only the first value from the list
   
                                          
                                                        
                                                    @endphp
                                           @foreach($customerId as $customers)
                                           
                                          <div class="form-check form-check-inline">
                                             <input class="form-check-input" type="checkbox" name="customer_ids[]" id="inlineCheckbox{{$customers->id}}" value="{{$customers->id}}" @if(in_array($customers->id, $selectedCustomers)) checked @endif>
                                             <label class="form-check-label" for="inlineCheckbox{{$customers->id}}">{{$customers->first_name}} - {{$customers->customer_id}}</label>
                                          </div>
                                          @endforeach
                                       
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-12">
                                    <button class="btn btn-primary" type="submit"><i class="bi bi-palette2"></i>@if(isset($customer_group_edit)) Update a Customer Group @else Create a Customer Group @endif</button>
                                 </div>
                              </form>
                           </div>
                        </div>
                        <!-- Card end -->
                     </div>
                  </div>
                  <!-- Row ends -->
                  <!-- Row starts -->
                  <div class="row">
                     <div class="col-sm-12">
                        <br>
                     </div>
                  </div>
                  <!-- Row ends -->
                  <!-- Row starts -->
                  <div class="row gx-4">
                      @foreach($customer_group as $customer_groups)
                     <div class="col-xl-4 col-sm-6 col-12">
                        <div class="card mb-4">
                           <div class="card-body">
                              <div class="d-grid gap-2">
                                 <div class="form-check">
                                    <label class="form-check-label" for="flexCheckDefault">{{$customer_groups->group_name}}</label>
                                 </div>
                                 <div class="form-check">
                                    <label class="form-check-label" for="flexCheckChecked"><small class="badge bg-primary">Total {{$customer_groups->value_count}} Subscribers</small></label>
                                 </div>
                                 <div class="col-sm-12 col-12">
                                    <div class="card mb-12">
                                       <div class="card-body">
                                          <div class="form-check form-check-inline">
                                             <!--<button class="btn btn-info" type="submit"><i class="bi bi-palette2"></i> View</button>-->
                                             <a href="{{route('manage_customer.manage_customer_group.edit_group',$customer_groups->id)}}" class="btn btn-primary"><i class="bi bi-palette2"></i>View & Edit</a>
                                             <!--<button class="btn btn-primary" type="submit"><i class="bi bi-palette2"></i> Edit</button>-->
                                             <a href="{{route('manage_customer.manage_customer_group.delete_group',$customer_groups->id)}}" class="btn btn-danger" ><i class="bi bi-palette2"></i> Delete</a>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     @endforeach
      <!--               <div class="col-xl-4 col-sm-6 col-12">-->
      <!--                  <div class="card mb-4">-->
      <!--                     <div class="card-body">-->
      <!--                        <div class="d-grid gap-2">-->
      <!--                           <div class="form-check">-->
      <!--                              <label class="form-check-label" for="flexCheckDefault">Monthly Ticket Buyers</label>-->
      <!--                           </div>-->
      <!--                           <div class="form-check">-->
      <!--                              <label class="form-check-label" for="flexCheckChecked"><small class="badge bg-primary">Total 100 Subscribers</small></label>-->
      <!--                           </div>-->
      <!--                           <div class="col-sm-12 col-12">-->
      <!--                              <div class="card mb-12">-->
      <!--                                 <div class="card-body">-->
      <!--                                    <div class="form-check form-check-inline">-->
      <!--                                       <button class="btn btn-info" type="submit"><i class="bi bi-palette2"></i> View</button>-->
      <!--                                       <button class="btn btn-primary" type="submit"><i class="bi bi-palette2"></i> Edit</button>-->
      <!--                                       <button class="btn btn-danger" type="submit"><i class="bi bi-palette2"></i> Delete</button>-->
      <!--                                    </div>-->
      <!--                                 </div>-->
      <!--                              </div>-->
      <!--                           </div>-->
      <!--                        </div>-->
      <!--                     </div>-->
      <!--                  </div>-->
      <!--               </div>-->
					 <!--<div class="col-xl-4 col-sm-6 col-12">-->
      <!--                  <div class="card mb-4">-->
      <!--                     <div class="card-body">-->
      <!--                        <div class="d-grid gap-2">-->
      <!--                           <div class="form-check">-->
      <!--                              <label class="form-check-label" for="flexCheckDefault">My Relatives - Monthly Ticket Buyers</label>-->
      <!--                           </div>-->
      <!--                           <div class="form-check">-->
      <!--                              <label class="form-check-label" for="flexCheckChecked"><small class="badge bg-primary">Total 15 Subscribers</small></label>-->
      <!--                           </div>-->
      <!--                           <div class="col-sm-12 col-12">-->
      <!--                              <div class="card mb-12">-->
      <!--                                 <div class="card-body">-->
      <!--                                    <div class="form-check form-check-inline">-->
      <!--                                       <button class="btn btn-info" type="submit"><i class="bi bi-palette2"></i> View</button>-->
      <!--                                       <button class="btn btn-primary" type="submit"><i class="bi bi-palette2"></i> Edit</button>-->
      <!--                                       <button class="btn btn-danger" type="submit"><i class="bi bi-palette2"></i> Delete</button>-->
      <!--                                    </div>-->
      <!--                                 </div>-->
      <!--                              </div>-->
      <!--                           </div>-->
      <!--                        </div>-->
      <!--                     </div>-->
      <!--                  </div>-->
      <!--               </div>-->
                  </div>
            
         


@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   $(document).ready(function() {
       $("#all_check").change(function() {
           $("input[name='customer_ids[]']").prop("checked", $(this).prop("checked"));
       });
   });
</script>