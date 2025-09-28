@extends('layout')
@section('title','Support')
@section('content')

    <div class="row gx-4">
                     <div class="col-sm-12">
                        <div class="card">
                           <div class="card-body">
                              <!-- Row starts -->
                              <div class="row justify-content-center align-items-end">
                                 <div class="col-xl-4 col-sm-6">
                                    Read our F.A.Qs before raise a Support Ticket.
                                    <div class="p-3">
                                       <img src="{{ URL::asset('images/login2.svg') }}" alt="Contact Us" class="img-fluid">
                                    </div>
                                 </div>
                                 <div class="col-xl-8 col-sm-6">
                                    <div class="p-3">
                                       <h6 class="mb-3">
                                          <span class="display-5">👋</span> Thank you for using Naresh Luckydraw. Please provide the following information about your business needs to help us serve you better. This information will enable us to route your request to the appropriate person. You should receive a response within 24 hours.
                                       </h6>
                                       <!-- Row starts -->
                                       <form method="POST" action="{{route('support.create')}}"> 
                                           @csrf
                                      
                                       <div class="row gx-4">
                                          <div class="col-sm-6">
                                             <div class="mb-3">
                                                <label for="fullName" class="form-label">Support Categroy<span class="text-danger fs-5">*</span></label>
                                                <div class="input-group">
                                                   <span class="input-group-text"><i class="bi bi-building"></i></span>
                                                   <!--<input type="text" class="form-control" id="fullName" placeholder="Enter your full name">-->
                                                   <select name="categoryid" id="categoryid" class="form-control"> 
                                                       <option></option>
                                                       @foreach($support_category as $support_categorys)
                                                        <option value="{{$support_categorys->id}}">{{$support_categorys->name}}</option>
                                                       @endforeach
                                                   </select>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-sm-6">
                                             <div class="mb-3">
                                                <label for="yourEmail" class="form-label">Subject<span class="text-danger fs-5">*</span></label>
                                                <div class="input-group">
                                                   <span class="input-group-text"> <i class="bi bi-envelope"></i></span>
                                                   <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter Subject">
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-sm-12">
                                             <div class="mb-3">
                                                <label for="yourMessage" class="form-label">Message</label>
                                                <textarea rows="3" class="form-control" id="description" name="description" placeholder="Describe your issue "></textarea>
                                             </div>
                                          </div>
                                          <div class="col-sm-12">
                                             <div class="d-grid">
                                                <button type="submit" class="btn btn-primary">Submit Ticket</button>
                                             </div>
                                          </div>
                                       </div>
                                        </form>
                                       <!-- Row ends -->
                                    </div>
                                 </div>
                              </div>
                              <!-- Row ends -->
                           </div>
                           <div class="card-footer">
                              <div class="row gx-4">
                                 <div class="col-sm-4">
                                    <div class="mb-3">
                                       <div class="card-body">
                                          <div class="d-flex align-items-center flex-row">
                                             <img src="{{ URL::asset('images/user2.png') }}" alt="Naresh Luckydraw" class="rounded-circle img-3xx">
                                             <div class="ms-3">
                                                <h5 class="mb-1">Mr. ABC</h5>
                                                <p class="m-0 text-primary small">Sales Team</p>
                                                <p class="mb-1">sales@nareshluckydraw.com</p>
                                             </div>
                                             <div class="ms-auto">
                                                <a href="#" class="icon-box sm bg-secondary-subtle rounded-circle"><i class="bi bi-heart-fill lh-1 text-danger"></i></a>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-4">
                                    <div class="mb-3">
                                       <div class="card-body">
                                          <div class="d-flex align-items-center flex-row">
                                             <img src="{{ URL::asset('images/user2.png') }}" alt="Naresh Luckydraw" class="rounded-circle img-3xx">
                                             <div class="ms-3">
                                                <h5 class="mb-1">Mr. ABC</h5>
                                                <p class="m-0 text-primary small">Billing Team</p>
                                                <p class="mb-1">billing@nareshluckydraw.com</p>
                                             </div>
                                             <div class="ms-auto">
                                                <a href="#" class="icon-box sm bg-secondary-subtle rounded-circle"><i class="bi bi-heart-fill lh-1 text-danger"></i></a>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
								 <div class="col-sm-4">
                                    <div class="mb-3">
                                       <div class="card-body">
                                          <div class="d-flex align-items-center flex-row">
                                             <img src="{{ URL::asset('images/user2.png') }}" alt="Naresh Luckydraw" class="rounded-circle img-3xx">
                                             <div class="ms-3">
                                                <h5 class="mb-1">Mr. ABC</h5>
                                                <p class="m-0 text-primary small">Technical Team</p>
                                                <p class="mb-1">technical@nareshluckydraw.com</p>
                                             </div>
                                             <div class="ms-auto">
                                                <a href="#" class="icon-box sm bg-secondary-subtle rounded-circle"><i class="bi bi-heart-fill lh-1 text-danger"></i></a>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- Row Support Ticket ends -->


				              <!-- Row starts -->
            <div class="row gx-4">
              <div class="col-sm-12">
                <div class="card mb-3">
                  <div class="card-body">

                    <!-- Row starts -->
                    <div class="row justify-content-center align-items-end">
                      <div class="col-xl-4 col-lg-4 col-sm-12 col-12">
                        <div class="p-3">
                          <img src="{{ URL::asset('images/login2.svg') }}" alt="Contact Us" class="img-fluid">
                        </div>
                      </div>
                      <div class="col-xl-8 col-lg-8 col-sm-12 col-12">
                        <div class="p-3">

                          <!-- Row starts -->
                          <div class="row g-4">
                            <div class="col-sm-6 col-12">
                              <div class="card bg-primary">
                                <div class="card-body text-white">
                                  <div class="d-flex mb-2">
                                    <div class="icon-box md bg-white rounded-5 me-3">
                                      <i class="bi bi-box fs-4 text-primary"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                      <h2 class="m-0 lh-1">{{$total_ticket}}</h2>
                                      <p class="m-0 opacity-50">Total Support Tickets</p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6 col-12">
                              <div class="card bg-info">
                                <div class="card-body text-white">
                                  <div class="d-flex mb-2">
                                    <div class="icon-box md bg-white rounded-5 me-3">
                                      <i class="bi bi-box fs-4 text-info"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                      <h2 class="m-0 lh-1">{{$open_ticket}}</h2>
                                      <p class="m-0 opacity-50">Open</p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6 col-12">
                              <div class="card bg-danger">
                                <div class="card-body text-white">
                                  <div class="d-flex mb-2">
                                    <div class="icon-box md bg-white rounded-5 me-3">
                                      <i class="bi bi-box fs-4 text-danger"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                      <h2 class="m-0 lh-1">{{$under_process_ticket}}</h2>
                                      <p class="m-0 opacity-50">Under Process</p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6 col-12">
                              <div class="card bg-success">
                                <div class="card-body text-white">
                                  <div class="d-flex mb-2">
                                    <div class="icon-box md bg-white rounded-5 me-3">
                                      <i class="bi bi-box fs-4 text-success"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                      <h2 class="m-0 lh-1">{{$close_ticket}}</h2>
                                      <p class="m-0 opacity-50">Closed</p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- Row ends -->

                        </div>
                      </div>
                    </div>
                    <!-- Row ends -->

                  </div>
                </div>
              </div>
            </div>
            <!-- Row ends -->

            <!-- Row starts -->
            <div class="row gx-4">
              <div class="col-sm-12">
                <!-- Card start -->
                <div class="card">
                  <div class="card-body">

                    <!-- Table start -->
                    <div class="table-outer">
                      <div class="table-responsive">
                        <table class="table truncate align-middle m-0">
                          <thead>
                            <tr>
                              <th>Sl.No</th>
                              <th>Support Ticket Details</th>
                              <th>Dates</th>
							  <th>Subject</th>
                              <th>Message</th>							  
                              <th>Status</th>
                            </tr>
                          </thead>
                          <tbody>
                             
                               @foreach($support_category_view as $support_categorys)
                               <tr>
                                  <td>1</td>
    							  <td><span class="badge border border-primary text-primary">{{$support_categorys->support_ticket_id}}</span><br>Category: {{$support_categorys->category_name}}</td>
                                  <td>Created On : {{$support_categorys->created_at}}<br>Updated On : {{$support_categorys->updated_at}}</td>
    							  <td>{{$support_categorys->subject}}</td>
    							  <td>{{$support_categorys->description}}</td>
                                  <td>
                                      @if($support_categorys->status  == 0)
                                      {{'Open'}}
                                      @elseif($support_categorys->status  == 1)
                                      {{'Under Process'}}
                                      @else
                                      {{'Closed'}}
                                      @endif
                                  </td>
                                </tr>
                               @endforeach
                           
                           
                          </tbody>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <!-- Table end -->

                  </div>
                </div>
                <!-- Card end -->
              </div>
            </div>


@endsection