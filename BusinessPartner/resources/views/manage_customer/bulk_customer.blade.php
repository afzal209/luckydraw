@extends('layout')
@section('title','Bulk Customer')
@section('content')

              <div class="row gx-4">
                     <div class="col-xl-12 col-sm-12">
                        <!-- Card start -->
                        <div class="card">
                           <div class="card-header">
                              <h5 class="card-title">Bulk Customer Creation Manager <a href="{{ asset('bulkupload_customer_sample.xlsx') }}" class="btn btn-primary"  download><i class="bi bi-xs bi-palette2"></i> Download Sample Customer Excel</a></h5>
                           </div>
                           <div class="card-body">
                              <form class="row g-3 needs-validation" novalidate method="POST" action="{{route('manage_customer.bulk_customer.customer_bulk_upload')}}" enctype="multipart/form-data">
								  @csrf
								  <div class="col-sm-12 col-12">
									<div class="card mb-4">
									  <div class="card-body">
										<div class="m-0">
										  <label class="form-label">Upload Excel</label>
										  <div class="input-group">
											<input type="file" name="file" class="form-control" id="inputGroupFile01">
										  </div>
										</div>
									  </div> 
									 <div class="col-sm-12 col-12">
										<div class="card mb-12">
										   <div class="card-body">
											  <div class="form-check form-check-inline">
												 <button class="btn btn-info" type="submit"><i class="bi bi-palette2"></i> Upload & Create Bulk Customers</button>
											  </div>
										   </div>
										</div>
									 </div>
									</div>
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
            
         


@endsection