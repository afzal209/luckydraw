@extends('layout')
@section('title','Wallet')
@section('content')
<style>
    .row.online {
        display: flex; /* Arrange thumbnails in a row */
        flex-wrap: wrap; /* Allow wrapping if needed */
        gap: 10px; /* Space between thumbnails */
        padding: 10px; /* Optional: padding for the container */
    }

    .thumbnail-image {
        width: 128px; /* Size between 40px and 50px */
        height: 80px;
        object-fit: cover; /* Ensures images scale nicely as thumbnails */
        cursor: pointer; /* Indicates the image is clickable */
        transition: all 0.3s ease; /* Smooth transition for visual feedback */
        border-radius: 4px; /* Slight rounding for thumbnail aesthetic */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow for thumbnail look */
    }

    .thumbnail-image.selected {
        border: 2px solid blue; /* Highlight border when selected */
        background-color: rgba(0, 0, 255, 0.1); /* Light background tint */
    }
</style>

    <div class="row">
                     <div class="col-sm-12">
                        <div class="card mb-4">
                           <div class="card-body">
						   	  <h5 class="m-0 ms-2 fw-semibold">Pay to My Wallet</h5><br>
                              <form class="row g-3 needs-validation" novalidate method="POST" action="{{route('wallet.add')}}" enctype="multipart/form-data">
                                  @csrf
                                <div class="col-3 col-12">
                                  <label class="form-label" for="inlineRadio1">Payment Mode</label>
                                  <div class="m-0">
                                    <div class="form-check form-check-inline">
                                      <input class="form-check-input" type="radio" name="tx_type" id="tx_type" value="1" onchange="get_payment_type($(this))" checked>
                                      <label class="form-check-label" for="inlineRadio1">Online</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                      <input class="form-check-input" type="radio" name="tx_type" id="tx_type" value="2" onchange="get_payment_type($(this));get_amount($('#amount_of'),2)">
                                      <label class="form-check-label" for="inlineRadio2">Offline</label>
                                    </div>
                                  </div>
                                </div>
                                <div class="row offline">
                                    <div class="col-md-3 position-relative">
                                    <label for="validationCustomUsername" class="form-label">Transaction Date<font color="red">*</font></label>
                                    <div class="input-group has-validation">
                                       <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-emoji-laughing"></i></span>
                                       <input type="date" class="form-control" name="tx_date" id="tx_date"  aria-describedby="inputGroupPrepend" required />
                                    </div>
                                 </div>
                                 <div class="col-md-3 position-relative">
                                    <label for="validationCustomUsername" class="form-label">Amount<font color=""red>*</font></label>
                                    <div class="input-group has-validation">
                                       <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-emoji-laughing"></i></span>
                                       <input type="text" class="form-control" name="amount_of" id="amount_of" aria-describedby="inputGroupPrepend" requried onchange="get_amount($(this),2)"/>
                                    </div>
                                 </div>                                 
                                 <div class="col-md-3 position-relative">
                                    <label for="validationCustomUsername" class="form-label">Transaction ID (Ex: UTR Code)<font color="red">*</font></label>
                                    <div class="input-group has-validation">
                                       <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-mailbox"></i></span>
                                       <input type="text" class="form-control" name="tx_id" id="tx_id" aria-describedby="inputGroupPrepend" required />
                                    </div>
                                 </div>
                                 <div class="col-md-3 position-relative">
                                    <label for="validationCustomUsername" class="form-label">Transaction Proof<font color="red">*</font></label>
                                    <div class="input-group has-validation">
                                       <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-phone-fill"></i></span>
                                       <input type="file" class="form-control" name="tx_proof" id="tx_proof" aria-describedby="inputGroupPrepend" required />
                                    </div>
                                 </div>
                                 <div class="col-12">
                                    <button class="btn btn-primary" type="submit" id="submit_of">Submit</button>
                                 </div>
                                </div>
                                <div class="row online" style="display:none">
                                    <div class="col-md-3 position-relative">
                                    <label for="validationCustomUsername" class="form-label">Amount<font color=""red>*</font></label>
                                    <div class="input-group has-validation">
                                       <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-emoji-laughing"></i></span>
                                       <input type="text" class="form-control" name="amount" id="amount" aria-describedby="inputGroupPrepend" requried  onchange="get_amount($(this),1)" />
                                    </div>
                                 </div>  
                                </div>
                                <div class="row online" style="display:none">
                                    
                                    
                                    @foreach($Payment_Gateway as $Payment_Gateways)
                                    
                                    @if($Payment_Gateways->paypal_gateway == "Yes")
                                    <img id="1" src="{{ str_replace("../../",request()->getSchemeAndHttpHost().'/', $Payment_Gateways->paypal_preview_logo)}}" alt="Thumbnail 1" class="thumbnail-image">
                                    @endif
                                    
                                    @if($Payment_Gateways->razorpay_gateway == "Yes")
                                    <img id="2" src="{{ str_replace("../../",request()->getSchemeAndHttpHost().'/', $Payment_Gateways->razorpay_preview_logo)}}" alt="Thumbnail 1" class="thumbnail-image">
                                    @endif
                                    
                                    @if($Payment_Gateways->instamojo_gateway == "Yes")
                                    <img id="3" src="{{ str_replace("../../", request()->getSchemeAndHttpHost().'/', $Payment_Gateways->instamojo_preview_logo)}}" alt="Thumbnail 1" class="thumbnail-image">
                                    @endif
                                    
                                    @if($Payment_Gateways->stripe_gateway == "Yes")
                                    <img id="4" src="{{ str_replace("../../", request()->getSchemeAndHttpHost().'/', $Payment_Gateways->stripe_preview_logo)}}" alt="Thumbnail 1" class="thumbnail-image">
                                    @endif
                                    
                                    @if($Payment_Gateways->mollie_gateway == "Yes")
                                    <img id="5" src="{{ str_replace("../../", request()->getSchemeAndHttpHost().'/', $Payment_Gateways->mollie_preview_logo)}}" alt="Thumbnail 1" class="thumbnail-image">
                                    @endif
                                    
                                    @if($Payment_Gateways->flw_gateway == "Yes")
                                    <img id="6" src="{{ str_replace("../../",request()->getSchemeAndHttpHost().'/', $Payment_Gateways->flw_preview_logo)}}" alt="Thumbnail 1" class="thumbnail-image">
                                    @endif
                                    
                                    @if($Payment_Gateways->authorizenet_gateway == "Yes")
                                    <img id="7" src="{{ str_replace("../../",request()->getSchemeAndHttpHost().'/', $Payment_Gateways->authorizenet_preview_logo)}}" alt="Thumbnail 1" class="thumbnail-image">
                                    @endif
                                    
                                    @if($Payment_Gateways->midtrans_gateway == "Yes")
                                    <img id="8" src="{{ str_replace("../../",request()->getSchemeAndHttpHost().'/', $Payment_Gateways->midtrans_preview_logo)}}" alt="Thumbnail 1" class="thumbnail-image">
                                    @endif
                                    
                                    @if($Payment_Gateways->payfast_gateway == "Yes")
                                    <img id="9" src="{{ str_replace("../../",request()->getSchemeAndHttpHost().'/', $Payment_Gateways->payfast_preview_logo)}}" alt="Thumbnail 1" class="thumbnail-image">
                                    @endif
                                    
                                     @if($Payment_Gateways->cashfree_gateway == "Yes")
                                    <img id="10" src="{{ str_replace("../../",request()->getSchemeAndHttpHost().'/', $Payment_Gateways->cashfree_preview_logo)}}" alt="Thumbnail 1" class="thumbnail-image">
                                    @endif
                                    
                                     @if($Payment_Gateways->marcado_pago_gateway == "Yes")
                                    <img id="11" src="{{ str_replace("../../",request()->getSchemeAndHttpHost().'/', $Payment_Gateways->marcadopago_preview_logo)}}" alt="Thumbnail 1" class="thumbnail-image">
                                    @endif
                                    
                                    
                                     @if($Payment_Gateways->squareup_gateway == "Yes")
                                    <img id="12" src="{{ str_replace("../../",request()->getSchemeAndHttpHost().'/', $Payment_Gateways->squareup_preview_logo)}}" alt="Thumbnail 1" class="thumbnail-image">
                                    @endif
                                    
                                     @if($Payment_Gateways->flutterwave_gateway == "Yes")
                                    <img id="13" src="{{ str_replace("../../",request()->getSchemeAndHttpHost().'/', $Payment_Gateways->flutterwave_preview_logo)}}" alt="Thumbnail 1" class="thumbnail-image">
                                    @endif
                                    
                                     @if($Payment_Gateways->paystack_gateway == "Yes")
                                    <img id="14" src="{{ str_replace("../../",request()->getSchemeAndHttpHost().'/', $Payment_Gateways->paystack_preview_logo)}}" alt="Thumbnail 1" class="thumbnail-image">
                                    @endif
                                    
                                     @if($Payment_Gateways->cinetpay_gateway == "Yes")
                                    <img id="15" src="{{ str_replace("../../",request()->getSchemeAndHttpHost().'/', $Payment_Gateways->cinetpay_preview_logo)}}" alt="Thumbnail 1" class="thumbnail-image">
                                    @endif
                                    
                                     @if($Payment_Gateways->zitopay_gateway == "Yes")
                                    <img id="16" src="{{ str_replace("../../",request()->getSchemeAndHttpHost().'/', $Payment_Gateways->zitopay_preview_logo)}}" alt="Thumbnail 1" class="thumbnail-image">
                                    @endif
                                    
                                     
                                    
                                    
                                    @endforeach
                                    
                                    <input type="hidden" id="payment_gateway" name="payment_gateway" value="" />
                                    <div class="col-12">
                                    <button class="btn btn-primary" type="submit" id="submit">Submit</button>
                                 </div>
</div>


                                <!--<div class="row online" style="display:none">-->
                                <!--    <div class="row">-->
                                <!--        <div class="col-md-3">-->
                                <!--            <img src="your-image-url.jpg" alt="Thumbnail Image" class="thumbnail-image">-->
                                <!--        </div>-->
                                <!--    </div>-->
                                    
                                <!--</div>-->
                                 
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- Row ends -->

@endsection
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>

$(document).ready(function() {
   get_payment_type($('#tx_type'));
   get_amount($('#amount'),1);
});

document.addEventListener('DOMContentLoaded', function() {
    var images = document.querySelectorAll('.thumbnail-image');
    var hiddenInput = document.getElementById('payment_gateway');

    images.forEach(img => {
        img.addEventListener('click', function() {
            // Remove 'selected' class from all images
            images.forEach(i => i.classList.remove('selected'));
            // Add 'selected' class to clicked image
            this.classList.add('selected');
            // Set hidden input value to the id of the clicked image
            hiddenInput.value = this.id || ''; // Use empty string if id is undefined
            console.log('Selected image ID:', this.id); // Debugging
        });
    });
});

   function get_payment_type(val){
      console.log($(val).val());
    var id =  $(val).val();
    get_amount($('#amount'),id)
    if(id == 1){
        $('.offline').hide();
        $('.online').show();
    }
    else{
        $('.offline').show();
        $('.online').hide();
    }
   }
   
   
   function get_amount(val,id=null){
      var value = $(val).val();
    //   console.log(value);
    if(id= 1){
        if(value == '' || value < 1){
        //   console.log('yes');
          $('#submit').attr('disabled',true);
      }
      else{
          $('#submit').prop('disabled',false);
      }
    }
    else{
        console.log(value);
        if(value == '' || value < 1){
          console.log('yes');
          $('#submit_of').attr('disabled',true);
      }
      else{
          $('#submit_of').prop('disabled',false);
      }
    }
      
   }
    
</script>