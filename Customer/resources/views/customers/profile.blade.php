@extends('layout')
@section('title','Luckydraw')
@section('content')
     <!-- breadcrumb begin  -->
      <div class="breadcrumb-pok">
         <img class="br-shape-left" src="{{URL::asset('img/breadcrumb/left-bg.png' ) }}" alt="">
         <img class="br-shape-right" src="{{URL::asset('img/breadcrumb/right-bg.png' ) }}" alt="">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-xl-7 col-lg-8">
                  <div class="breadcrumb-content">
                     <span class="subtitle">UBG Luckydraw</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
    <!-- breadcrumb end  -->
    <!-- lottery begin -->
    <div class="lotteries">
<div class="container">
    <!-- Header Row -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">My Profile</h2>
        <div>
            <a class="btn-pok mid me-2" href="{{ route('profile') }}">
                Edit Profile <i class="fa-solid fa-user"></i>
            </a>
            <a class="btn-pok mid" href="{{ route('logout') }}">
                Logout <i class="fa-solid fa-lock"></i>
            </a>
        </div>
    </div>

    <!-- Profile Content -->
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-6">
            <div class="card position-relative">
                <!-- Top Right Images -->
                <div class="position-absolute top-0 end-0 m-2 text-center">
                    <img src="{{ request()->getSchemeAndHttpHost() }}/uploads/customer/profile_image/{{ $customer->profile_image ?? '' }}" style="width:100px;height:100px;">
                </div>
                <div class="card-body">
                    <p><strong>Customer ID:</strong> {{ $customer->customer_id }}</p>
                    <p><strong>Name:</strong> {{ $customer->first_name }} {{ $customer->last_name }}</p>
                    <p><strong>Email:</strong> {{ $customer->email }}</p>
                    <p><strong>Mobile:</strong> {{ $customer->mobile }}</p>
                    <p><strong>Address:</strong> {{ $customer->address_line_1 }} {{ $customer->address_line_2 }}</p>
                    <p><strong>Country:</strong> {{ $customer->country_name }} | <strong>State:</strong> {{ $customer->state_name }}</p>
                    <p><strong>City:</strong> {{ $customer->city_name }}</p>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6">
            <div class="card position-relative">
                <!-- Top Right Images -->
                <div class="position-absolute top-0 end-0 m-2 text-center">
                    <img src="{{ request()->getSchemeAndHttpHost() }}/uploads/customer/national_id_photo/{{ $customer->national_id_photo ?? '' }}" style="width:100px;height:100px;">
                </div>
                <div class="card-body">
                    <p><strong>DOB:</strong> {{ $customer->dob }}</p>
                    <p><strong>Timezone:</strong> {{ $customer->timezone }}</p>
                    <p><strong>Account Since :</strong> {{ $customer->created_at }}</p>
                    <p><strong>Last Updated :</strong> {{ $customer->updated_at }}</p>
                    <p><strong>Status:</strong> {{ $customer->status == 1 ? 'Active' : 'Inactive' }}</p>
                    <p><strong>Nationality Number:</strong> {{ $customer->national_id_number }}</p>
                    <p><strong>Zip:</strong> {{ $customer->zip_code }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>
@endsection
