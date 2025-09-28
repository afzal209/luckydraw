@extends('layout')
@section('title','Setting')
@section('content')

    <div class="row gx-4">
                     <div class="col-xxl-12">
                        <div class="card">
                           <div class="card-body">
                              <!-- Custom tabs start -->
                              <div class="custom-tabs-container">
                                 <!-- Nav tabs start -->
                                 <ul class="nav nav-tabs" id="customTab2" role="tablist">
                                    <li class="nav-item" role="presentation">
                                       <a class="nav-link" id="tab-pref_luckydraws" data-bs-toggle="tab" href="#pref_luckydraws" role="tab" aria-controls="pref_luckydraws" aria-selected="false">
									   <i class="bi bi-credit-card-2-front me-2"></i>Preferred Luckydraws</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                       <a class="nav-link" id="tab-pref_countries" data-bs-toggle="tab" href="#pref_countries" role="tab" aria-controls="pref_countries" aria-selected="false">
									   <i class="bi bi-info-circle me-2"></i>Preferred Countries</a>
                                    </li>
                                 </ul>
                                 <!-- Nav tabs end -->
                                 <!-- Tab content start -->
                                 <div class="tab-content h-300">
                                    <div class="tab-pane fade show active" id="pref_luckydraws" role="tabpanel">
                                       <!-- Row starts -->
                                        <form method="POST" action="{{route('setting.create')}}">
                                              @csrf
                                       <div class="row gx-5 align-items-center">
                                          <div class="col-sm-4 col-12">
                                             <div class="p-3">
                                                <img src="{{URL::asset('images/notifications.svg') }}" alt="Notifications" class="img-fluid">
                                             </div>
                                          </div>
                                         
                                              <div class="col-sm-4 col-12">
                                             <!-- List group start -->
                                             <ul class="list-group mb-4">
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                   Tax (VAT/GST)
                                                   <div class="form-check form-switch m-0"><input class="form-check-input" type="checkbox" role="switch" name="tax_status" id="tax_status" @if($Business_Partner->tax_status == 1) checked @endif /></div>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                     <label for="customerName" class="form-label">Value<font color="red">*</font></label>
                                                     <input type="text" name="default_tax" id="default_tax" value="{{$Business_Partner->default_tax ?? 0}}" class="form-control" placeholder="Enter Default Discount value" >
                                                </li>                                                
                                             </ul>
                                             <!-- List group end -->
                                          </div>
                                          <div class="col-sm-4 col-12">
                                             <!-- List group start -->
                                             <ul class="list-group mb-4">
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                   Discount
                                                   <div class="form-check form-switch m-0"><input class="form-check-input" type="checkbox" role="switch" name="discount_status" id="discount_status" @if($Business_Partner->discount_status == 1) checked @endif  /></div>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                     <label for="customerName" class="form-label">Value<font color="red">*</font></label>
                                                     <input type="text" name="default_discount" id="default_discount" class="form-control"  value="{{$Business_Partner->default_discount ?? 0}}" placeholder="Enter Default Discount value" >
                                                </li>
                                             </ul>
                                             <!-- List group end -->
                                          </div>
                                          
                                          
                                          
                                       </div>
                                        <div class="d-flex gap-2 justify-content-end">
                                 <button type="button" class="btn btn-outline-dark">
                                 Cancel
                                 </button>
                                 <button type="submit" class="btn btn-primary">
                                 Update
                                 </button>
                              </div>
                                       </form>
                                       <!-- Row ends -->
                                    </div>
                                    <div class="tab-pane fade" id="pref_countries" role="tabpanel">
                                       <!-- Row starts -->
                                       <div class="row gx-4">
                                          <div class="col-12">
                                             <div class="table-outer mb-4">
                                                <div class="table-responsive">
                                                   <table class="table truncate align-middle m-0">
                                                      <thead>
                                                         <tr>
                                                            <th>Sl.No</th>
															<th>Country Name</th>
                                                            <th>Current Luckydraws</th>
                                                            <th>Actions</th>
                                                         </tr>
                                                      </thead>
                                                      <tbody>
                                                         <tr>
                                                            <td>1</td>
                                                            <td><span class="badge bg-primary text-white">India</span></td>
                                                            <td>Xmas, Diwali, Weekly</td>
                                                            <td><div class="form-check form-switch m-0"><input class="form-check-input" type="checkbox" role="switch" id="cardActive" checked /></div></td>
                                                         </tr>
                                                         <tr>
                                                            <td>1</td>
                                                            <td><span class="badge bg-primary text-white">USA</span></td>
                                                            <td>Xmas, Diwali, Weekly</td>
                                                            <td><div class="form-check form-switch m-0"><input class="form-check-input" type="checkbox" role="switch" id="cardActive" checked /></div></td>
                                                         </tr>
                                                         <tr>
                                                            <td>1</td>
                                                            <td><span class="badge bg-primary text-white">UK</span></td>
                                                            <td>Xmas, Diwali, Weekly</td>
                                                            <td><div class="form-check form-switch m-0"><input class="form-check-input" type="checkbox" role="switch" id="cardActive" checked /></div></td>
                                                         </tr>
                                                      </tbody>
                                                   </table>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <!-- Row ends -->
                                    </div>
                                    <div class="tab-pane fade" id="fourA" role="tabpanel">
                                       <!-- Row starts -->
                                       <div class="row align-items-end">
                                          <div class="col-xl-4 col-sm-6 col-12">
                                             <div class="p-3">
                                                <img src="{{URL::asset('images/login.svg') }}" alt="Contact Us" class="img-fluid">
                                             </div>
                                          </div>
                                          <div class="col-sm-4 col-12">
                                             <div class="card border mb-3">
                                                <div class="card-body">
                                                   <div class="mb-3">
                                                      <label class="form-label" for="currentPwd">Current password <span
                                                         class="text-danger">*</span></label>
                                                      <div class="input-group">
                                                         <input type="password" id="currentPwd" placeholder="Enter Current password"
                                                            class="form-control">
                                                         <button class="btn btn-outline-secondary" type="button">
                                                         <i class="bi bi-eye text-black"></i>
                                                         </button>
                                                      </div>
                                                   </div>
                                                   <div class="mb-3">
                                                      <label class="form-label" for="newPwd">New password <span
                                                         class="text-danger">*</span></label>
                                                      <div class="input-group">
                                                         <input type="password" id="newPwd" class="form-control"
                                                            placeholder="Your password must be 8-20 characters long.">
                                                         <button class="btn btn-outline-secondary" type="button">
                                                         <i class="bi bi-eye text-black"></i>
                                                         </button>
                                                      </div>
                                                   </div>
                                                   <div class="mb-3">
                                                      <label class="form-label" for="confNewPwd">Confirm new password <span
                                                         class="text-danger">*</span></label>
                                                      <div class="input-group">
                                                         <input type="password" id="confNewPwd" placeholder="Confirm new password"
                                                            class="form-control">
                                                         <button class="btn btn-outline-secondary" type="button">
                                                         <i class="bi bi-eye text-black"></i>
                                                         </button>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <!-- Row ends -->
                                    </div>
                                 </div>
                                 <!-- Tab content end -->
                              </div>
                              <!-- Custom tabs end -->
                              <!-- Buttons start -->
                             
                              <!-- Buttons end -->
                           </div>
                        </div>
                     </div>
                  </div>


@endsection