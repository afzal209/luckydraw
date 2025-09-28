@if(!Request::is('/contact'))
@php 
    $user = Session::get('user');
    $customer = \App\Models\Customer::find($user['id']);
    $sale = \App\Models\Sale::where('customer_id',$user['customer_id'])->count();
@endphp
@endif
<div class="col-lg-3">
     <div class="user-card">
        <div class="avatar-upload">
           <div class="obj-el"><img src="{{URL::asset('images/elements/team-obj.png') }}" alt="image"></div>
           <form id="avatarForm" method="POST" enctype="multipart/form-data" action="{{ route('avatar') }}">
                @csrf
                <div class="avatar-edit">
                    <input type='file' id="imageUpload" name="avatar" accept=".png, .jpg, .jpeg" />
                    <label for="imageUpload"></label>
                </div>
            </form>

           <div class="avatar-preview">
              <div id="imagePreview" style="background-image: url('https://crm1.microsharp.net/uploads/customer/profile/{{$customer->profile_image}}');">
              </div>
           </div>
        </div>
        <h3 class="user-card__name">{{$user['first_name'] ?? ''}}</h3>
        <span class="user-card__id">ID : {{$user['customer_id'] ?? ''}}</span>
     </div>
     <!-- user-card end -->
     <div class="user-action-card">
        <ul class="user-action-list">
           <li class="{{ request()->is('user') ? 'active' : '' }}"><a href="{{route('user.user')}}">My Tickets <span class="badge">{{$sale ?? ''}}</span></a></li>
           <li class="{{ request()->is('user_info') ? 'active' : '' }}"><a href="{{route('user_info')}}">Personal Information</a></li>
           <li class="{{ request()->is('user_transaction') ? 'active' : '' }}"><a href="{{route('user_transaction')}}">Transactions</a></li>
           <li class="{{ request()->is('user_referral') ? 'active' : '' }}"><a href="{{route('user_referral')}}">Referral & Agencies</a></li>
           <li class="{{ request()->is('user_support') ? 'active' : '' }}"><a href="{{route('user_support')}}">Support & Help Center</a></li>
           <li class="{{ request()->is('faq') ? 'active' : '' }}"><a href="{{route('faq')}}" target="_blank">Faqs</a></li>
           <li><a href="{{route('logout')}}">Log Out</a></li>
           
        </ul>
     </div>
     <!-- user-action-card end -->
</div>