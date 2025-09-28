@extends('layout')
@section('title','Add Sale')
@section('content')
<style>
   #wallet_total_amount {
   margin-left: 8%;
   font-size:14px;
   }
</style>
<div class="row gx-4">
   <div class="col-sm-12">
      <div class="card">
         <div class="card-body">
            <!-- Row starts -->
            <div class="row">
               <div class="col-xxl-12 col-sm-6 col-12">
                  <!-- Row starts -->
                  <div class="row gx-12">
                     <div class="col-12">
                        <h5 class="fw-semibold mb-3">Customer Details</h5>
                     </div>
                     <div class="alert alert-success" role="alert" style="display:none"></div>
                     <div class="col-3 col-12">
                        <label class="form-label" for="inlineRadio1">Choose Customer</label>
                        <div class="m-0">
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked="checked" onclick="get_customer($(this))">
                              <label class="form-check-label" for="inlineRadio1">New</label>
                           </div>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" onclick="get_customer($(this))">
                              <label class="form-check-label" for="inlineRadio2">Existing</label>
                           </div>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" onclick="get_customer($(this))">
                              <label class="form-check-label" for="inlineRadio3">Global Customer</label>
                           </div>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4" value="option4" onclick="get_customer($(this))">
                              <label class="form-check-label" for="inlineRadio4">Customer Groups</label>
                           </div>
                        </div>
                     </div>
                     <div id="exist" style="display:none" class="row">
                        <div class="col-md-12" >
                           <label for="validationCustom04" class="form-label">Select Existing Customer</label>
                           <select class="form-select" id="validationCustom04" required>
                              <option  value="">Choose Existing Customer</option>
                              @foreach($customer as $customers)
                              <option value="{{$customers->customer_id}}">{{$customers->first_name}}-{{$customers->customer_id}}</option>
                              @endforeach
                           </select>
                           <div class="invalid-feedback">
                              Please select a valid Customer.
                           </div>
                        </div>
                     </div>
                     <div id="new" class="row">
                        <div class="col-md-4">
                           <!-- Form group start -->
                           <div class="mb-3">
                              <label for="customerName" class="form-label">Customer Name<font color="red">*</font></label>
                              <input type="text" name="customer_name" id="customer_name_txt" class="form-control" placeholder="Enter Customer Name" >
                           </div>
                           <!-- Form group end -->
                        </div>
                        <div class="col-md-4">
                           <!-- Form group start -->
                           <div class="mb-3">
                              <label for="invNumber" class="form-label">Customer Email<font color="red">*</font></label>
                              <input type="text" name="customer_mail" id="customer_mail" class="form-control" placeholder="Enter Valid Customer Email" >
                           </div>
                           <!-- Form group end -->
                        </div>
                        <div class="col-md-4 ">
                           <!-- Form group start -->
                           <div class="mb-3">
                              <label for="dateIssued" class="form-label">Phone Number<font color="red">*</font></label>
                              <input type="text" name="customer_phone" id="customer_phone" class="form-control" placeholder="Enter Phone Number Prefix Without 00 & +" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                           </div>
                           <!-- Form group end -->
                        </div>
                        <!--<div class="col-md-4 ">-->
                        <!--<button type="submit" class="btn btn-dark" id="save"><i class="bi bi-cloud-arrow-up-fill"></i> Save</button>-->
                        <!--</div>-->
                     </div>
                  </div>
                  <!-- Row ends -->
               </div>
               <div id="group" style="display:none" class="row">
                  <div class="col-md-12" >
                     <div class="card mb-12">
                        <label class="form-label" for="abc">Choose One or More Customers Groups</label>
                        <div class="card-body">
                           @foreach($customer_group as $customer_groups)
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="{{$customer_groups->id}}" onclick="get_customer_data($(this))">
                              <label class="form-check-label" for="inlineCheckbox1">{{$customer_groups->group_name}} {{$customer_groups->value_count}} Ticket Buyers</label>
                           </div>
                           @endforeach
                           <div class="row" id="customer_data_div">
                           </div>
                           <!--<div class="form-check form-check-inline">-->
                           <!--   <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">-->
                           <!--   <label class="form-check-label" for="inlineCheckbox2">Monthly Ticket Buyers</label>-->
                           <!--</div>-->
                           <!--<div class="form-check form-check-inline">-->
                           <!--   <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">-->
                           <!--   <label class="form-check-label" for="inlineCheckbox3">My Relatives - Monthly Ticket Buyers</label>-->
                           <!--</div>-->
                        </div>
                     </div>
                  </div>
               </div>
               <div id="global"  style="display:none" class="row">
                  <div class="col-md-4">
                     <!-- Form group start -->
                     <div class="mb-3">
                        <label for="customer_id" class="form-label">Global Customer<font color="red">*</font></label>
                        <input type="text" name="customer_id" id="customer_id" class="form-control" placeholder="Enter Customer Id" onkeyup="get_customer_id($(this))">
                     </div>
                     <!-- Form group end -->
                  </div>
                  <div class="col-md-8">
                     <div class="mb-3" id="customer_id_data" style="display:none;">
                        <label for="customerName" class="form-label"></label>
                        <label for="customerName" class="form-label" id="customer_label" style="margin-top: 4%;"></label>
                     </div>
                  </div>
               </div>
               <div class="col-12">
                  <div class="border-bottom border-info my-4"></div>
               </div>
            </div>
            <!-- Row ends -->
            <!-- Row starts -->
            <form method="POST" action="{{route('sales.new_sale.create')}}">
               @csrf
               <div class="row">
                  <div class="col-12">
                     <div class=" table-outer mb-2">
                        <div class="table-responsive">
                           <table class="table truncate">
                              <thead>
                                 <tr>
                                    <th colspan="8" class="pt-3 pb-3">
                                       Luckydraw Product Details
                                    </th>
                                 </tr>
                                 <tr>
                                    <th>Product</th>
                                    <th width="120px" style="display:none" id="no_of_customer_th">No.Of.Customers</th>
                                    <th width="120px">Quantity</th>
                                    <th width="120px">Price</th>
                                    <th width="120px">Discount</th>
                                    <th width="120px">VAT</th>
                                    <th width="120px">Amount</th>
                                    <th width="120px">Action</th>
                                 </tr>
                              </thead>
                              <tbody id="multi_tr">
                                 <div id="customer_id_hidden_div"></div>
                                 <tr>
                                    <td>
                                       <!-- Form group start -->
                                       <select class="form-select" name="selectProduct[]" id="selectProduct1" onchange="get_luckydraw_id($(this),1)" required>
                                          <option>Select Luckydraw Product</option>
                                          @foreach($luckydraw as $luckydraws)
                                          @if(date('Y-m-d') >= $luckydraws->start_date AND date('Y-m-d') <= $luckydraws->end_date)
                                          <option value="{{$luckydraws->id}}">{{$luckydraws->luckydraw_name}}</option>
                                          @endif
                                          @endforeach
                                       </select>
                                       <!-- Form group end -->
                                    </td>
                                    <td class="no_of_customers_div" id="no_of_customers_div" style="display:none;">
                                       <div class="m-0">
                                          <input type="number" class="form-control no_of_customers" name="no_of_customers[]" id="no_of_customers1" min="1" placeholder="1"  onchange="getTotal(1)" readonly>
                                       </div>
                                       <input type="hidden" id="no_of_customers_hidden" value="" />
                                    </td>
                                    <td>
                                       <!-- Form group start -->
                                       <div class="m-0">
                                          <input type="number" class="form-control qty" name="qty[]" id="qty1" min="1" placeholder="Qty"  onchange="getTotal(1)" required>
                                       </div>
                                       <!-- Form group end -->
                                    </td>
                                    <td>
                                       <!-- Form group start -->
                                       <div class="m-0">
                                          <input type="text" class="form-control price" name="price[]" id="price1"  onchange="getTotal(1)" readonly required>
                                       </div>
                                       <!-- Form group end -->
                                    </td>
                                    <td>
                                       <!-- Form group start -->
                                       <div class="input-group m-0">
                                          <input type="text" class="form-control discount" name="discount[]" id="discount1" value="{{ $Business_Partner->discount_status == 1 ? $Business_Partner->default_discount : 0 }}" {{ $Business_Partner->discount_status == 1 ? '' : 'disabled' }}   onchange="getTotal(1)" required>
                                          <!--<span class="input-group-text"><i class="bi bi-currency-euro"></i></span>-->
                                          <span class="input-group-text">%</span>
                                       </div>
                                       <!-- Form group end -->
                                    </td>
                                    <td>
                                       <!-- Form group start -->
                                       <div class="input-group m-0">
                                          <input type="text" class="form-control vat" name="vat[]" id="vat1" value="{{$Business_Partner->tax_status == 1 ? $Business_Partner->default_tax : 0}}" {{ $Business_Partner->tax_status == 1 ? '' : 'disabled' }}  onchange="getTotal(1)" >
                                          <span class="input-group-text">%</span>
                                       </div>
                                       <!-- Form group end -->
                                    </td>
                                    <td>
                                       <!-- Form group start -->
                                       <div class="input-group m-0">
                                          <input type="text" class="form-control amount" name="amount[]" id="amount1" readonly required>
                                          <span class="input-group-text"><i class="bi bi-currency-euro"></i></span>
                                       </div>
                                       <!-- Form group end -->
                                    </td>
                                    <td>
                                       <div class="custom-icon-group">
                                          <button class="btn btn-danger">
                                          <i class="bi bi-trash"></i>
                                          </button>
                                          <!--<button class="btn btn-info">-->
                                          <!--<i class="bi bi-pencil"></i>-->
                                          <!--</button>-->
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <a href="javascript:void(0)" class="btn btn-dark" onclick="addRow()">Add One more Luckydraw</a>
                                    </td>
                                    <td colspan="6">
                                       <div class="row justify-content-end">
                                          <div class="col-auto">
                                             <label class="col-form-label" for="disc1">Total Discount</label>
                                          </div>
                                          <div class="col-auto">
                                             <input type="text" class="form-control" id="disc1" placeholder="0%">
                                          </div>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td style="text-align:center;">
                                       Wallet Amount
                                    </td>
                                    <td colspan="6">
                                       <div class="row justify-content-end">
                                          <div class="col-auto">
                                             <label class="col-form-label" for="vat">Total Tax</label>
                                          </div>
                                          <div class="col-auto">
                                             <input type="text" class="form-control" id="vat" placeholder="0%">
                                          </div>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td colspan="5" style="color:red" id="wallet_amount">
                                       <div id="wallet_total_amount">{{$Business_Partner->wallet_amount}}</div>
                                    </td>
                                    <td>
                                       <!--<p class="m-0">Subtotal</p>-->
                                       <!--<p class="m-0">Discount</p>-->
                                       <!--<p class="m-0">Tax : VAT/GST/ABC</p>-->
                                       <h5 class="mt-2 text-danger">Total</h5>
                                    </td>
                                    <td>
                                       <!--<p class="m-0">€0.00</p>-->
                                       <!--<p class="m-0">€0.00</p>-->
                                       <!--<p class="m-0">€0.00</p>-->
                                       <h5 class="mt-2 text-success total_amount">€0.00</h5>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
                  <input type="hidden" name="customer_id_hidden" id="customer_id_hidden" value="" />
                  <div class="col-12">
                     <div class="d-flex justify-content-end gap-1">
                        <button type="submit" class="btn btn-dark" id="submit_btn" disabled><i class="bi bi-cloud-arrow-up-fill"></i> Submit</button>
                        <!-- <a href="invoice-list.html" class="btn btn-success"><i class="bi bi-whatsapp"></i> Send Invoice</a> -->
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
       //   if($('#customer_name_txt').val() != null && $('#customer_mail').val() != null && $('#customer_phone').val() != null){
       //   get_new_customer();
       // if($('#customer_id_hidden').val() === ''){
       //     $('#submit_btn').attr('disable',true);
       // }
       // else{
       //      $('#submit_btn').attr('disable',false);
       // }
         function toggleButton() {
           if ($('#customer_id_hidden').val().trim() === '') {
               $('#submit_btn').prop('disabled', true);
           } else {
               $('#submit_btn').prop('disabled', false);
           }
       }
       // Initial check on page load
       toggleButton();
       // Observer for dynamic value changes
       const observer = new MutationObserver(toggleButton);
       observer.observe(document.getElementById('customer_id_hidden'), { attributes: true, attributeFilter: ['value'] });
       if($('#customer_id_hidden_new').length > 0){
            function toggleButton_new() {
           let hasValue = false;
           // Check if at least one hidden field has a value
           $('input[name="customer_id_hidden_new[]"]').each(function () {
               if ($(this).val().trim() !== '') {
                   hasValue = true;
                   return false; // Exit loop early if found
               }
           });
           // Enable/disable the button based on hidden field values
           $('#submit_btn').prop('disabled', !hasValue);
       }
       // Initial check on page load
       toggleButton_new();
       // Watch for changes in hidden fields
       $(document).on('input change', 'input[name="customer_id_hidden_new[]"]', function () {
           toggleButton_new();
       });
       // MutationObserver for dynamically added rows
       const observer_new = new MutationObserver(() => {
           toggleButton_new(); // Run check when elements are added
       });
       observer_new.observe(document.body, { childList: true, subtree: true });
       }
       // If new rows are added dynamically, observe them too
       $('#validationCustom04').on('change',function(){
           $('#customer_id_hidden').val('');
           var id = $(this).find(":selected").val()
           $('#customer_id_hidden').val(id);
           // console.log($(this).find(":selected").text());
       })
       // }
       // function get_new_customer(){
       // //  console.log('yes');
       // var name = $('#customer_name_txt').val();
       // var email = $('#customer_mail').val();
       // var phone = $('#customer_phone').val();
       // $.ajax({
       //         url: "{{ url('sales/new_sale/add_customer_id') }}",
       //         type: "POST",
       //         data: {
       //             "_token": "{{ csrf_token() }}",
       //             "name" :  name,
       //             "email" :  email,
       //             "phone" :  phone,
       //         },
       //         success: function(data) {
       //             console.log(data);
       //             // console.log(data['doneMessage']);
       //         }
       //     });
       // }
       // $('#customer_name_txt ,#customer_mail,#customer_phone').on('change',get_new_customer);
       function get_new_customer() {
           $('#customer_id_hidden').val('');
       var name = $('#customer_name_txt').val().trim();
       var email = $('#customer_mail').val().trim();
       var phone = $('#customer_phone').val().trim();
   $('.alert-success').text('');
    $('.alert-success').hide();
       // Check if all fields are filled
       if (name !== "" && email !== "" && phone !== "" && phone.length >= 11) {
           $.ajax({
               url: "{{ url('sales/new_sale/add_customer_id') }}",
               type: "POST",
               data: {
                   "_token": "{{ csrf_token() }}",
                   "name": name,
                   "email": email,
                   "phone": phone,
               },
               success: function (data) {
                   // console.log(data);
                   var text = '';
                   if(data.msg == 'success'){
                       text = `Customer Has been Add`;
                   }   
                   else{
                       text = `${data.data.first_name} Customer is already exist in the database with customer ID: ${data.data.customer_id}`;
                   }
                       $('#customer_id_hidden').val(data.data.customer_id);
                   $('.alert-success').show();
                   $('.alert-success').text(text);
               }
           });
       }
   }
   // Trigger function when any of the three fields change
   // $('#save').on('click', function () {
   //     get_new_customer();
   // });
   $('#customer_name_txt, #customer_mail, #customer_phone').change(function () {
       get_new_customer();
   });
   //   $("div").mouseup(function(){
   //     //   var amount = 0;
   //     // Iterate over each row
   //     $("tr").each(function(){
   //          var row = $(this); // Get the current row
   //         var sum = 0;
   //          var qty = 0;
   //          var vat = 0
   //         var discount = 0;
   //         var price = 0;
   //         // Get values from the current row
   //          qty = parseFloat(row.find('.qty').val()) || 0;
   //          price = parseFloat(row.find('.price').val()) || 0;
   //          discount = parseFloat(row.find('.discount').val()) || 0;
   //          vat = parseFloat(row.find('.vat').val()) || 0;
   //         var cal = (qty * price) - discount;
   //         console.log(cal); 
   //         // var final = cal * vat;
   //         // console.log(final)
   //         $('#amount1').val(cal);
   //     });
   //   });
   });
   var totalCustomerCount = 0; 
   function get_customer_data(val){
        $('#customer_id_hidden').val('');
       $('#no_of_customers_hidden').val();
       var count_data = '';
        var id = $(val).val();
         var divId = ".div_" + id; // Ensure the correct div ID format
       if ($(val).is(':checked')) {
           // If checkbox is checked, make an AJAX call and append the data
           $.ajax({
               url: "{{ url('sales/new_sale/get_customer_data') }}",
               type: "POST",
               data: {
                   "_token": "{{ csrf_token() }}",
                   "value": id
               },
               success: function (data) {
               //   console.log(data.data.customer_id)
                  if (data.count) {
                       var countValue = parseInt(data.count.count) || 0;
                       totalCustomerCount += countValue; // Add to total count
                   }
                   $(data.data).each(function (key, value) {
                       // console.log(value);
                       //   $('#customer_id_hidden').val(value.customer_id);
                       var data = `<div class="col-md-3 div_${id}" data-count="${countValue}">
                                       <label class="form-check-label" for="inlineCheckbox2" >
                                           ${value.customer_id} - ${value.first_name}
                                       </label>
                                   </div>`;
                       $('#customer_data_div').append(data);
                       var data_hidden = `<input type="hidden" id="customer_id_hidden_new" name="customer_id_hidden_new[]" value="${value.customer_id}">`;
                       $('#customer_id_hidden_div').append(data_hidden);
                   });
                    $('.no_of_customers').val(totalCustomerCount)
                    $('#no_of_customers_hidden').val(totalCustomerCount);
                      $('.qty').each(function () {
                       var rowNo = $(this).attr('id').replace('qty', ''); // Extract row number
                       console.log(rowNo);
                       getTotal(rowNo);
                   });
                    checkSubmitButton();
               },
               error: function () {
                   console.error("Error fetching customer data.");
               }
           });
       } else {
           // If checkbox is unchecked, remove the corresponding div
           var removedCount = parseInt($(divId).attr('data-count')) || 0;
           console.log(removedCount);
           totalCustomerCount -= removedCount; // Subtract the removed count
           $(divId).remove();
           // Update input values
           $('.no_of_customers').val(totalCustomerCount);
           $('#no_of_customers_hidden').val(totalCustomerCount);
           $('.qty').each(function () {
               var rowNo = $(this).attr('id').replace('qty', ''); // Extract row number
               getTotal(rowNo);
           });
            checkSubmitButton();
       }
   }
   function checkSubmitButton() {
       setTimeout(function () {
           if ($('input[type="checkbox"]:checked').length === 0) {
               $('#submit_btn').prop('disabled', true);
           } else {
               $('#submit_btn').prop('disabled', false);
           }
       }, 100); // Small delay to ensure the checkbox state updates
   }
   // Ensure the checkSubmitButton function runs when checkboxes are changed
   $(document).on('change', 'input[type="checkbox"]', function () {
       checkSubmitButton();
   });
   function getTotal(no) {
       $('.total_amount').text('');
       var no_of_customers = '';
       if($('#no_of_customers' + no).val() == '' ){
           // console.log('yes');
            no_of_customers = 1;
       }
       else{
           // console.log('no');
           no_of_customers = parseFloat($('#no_of_customers' + no).val());
       }
       // var no_of_customers = parseFloat($('#no_of_customers' + no).val());
       // if(no_of_customers == ''){
       //     no_of_customers = 1;
       // }
       // else{
       //      no_of_customers = parseFloat($('#no_of_customers' + no).val());
       // }
       // console.log(no_of_customers);
       var qty = parseFloat($('#qty' + no).val());
       var price = parseFloat($('#price' + no).val());
       var discount =parseFloat($('#discount' + no).val());
       var vat = parseFloat($('#vat' + no).val())
       var B4Tax = (qty * price) - discount; // Limit to 2 decimals
       // console.log(total);
        var actual_cost = no_of_customers * qty * price;
       var after_discount = (actual_cost * discount) / 100;
       var final_cost = actual_cost - after_discount;
       var tax = (final_cost * vat) / 100;
       // console.log(final);
       // var total_num = B4Tax + tax;
      var total_num = actual_cost - after_discount +tax;
       $('#amount'+ no).val(total_num.toFixed(2));
       // $('#total_cost_pr' + no).html(total);
    var total_discount = 0;
       let count_sum = 1;
       $('.discount').each(function() {
           total_discount += parseFloat($('#discount' + no).val());
            count_sum++;
       });
       // console.log(total_discount);
       var total_tax = 0;
       var total_discount_final = 0
       $('.vat').each(function(index) {
           var rowNo = index + 1;
           var qty = parseFloat($('#qty' + rowNo).val()) || 0;
           var price = parseFloat($('#price' + rowNo).val()) || 0;
           var discount = parseFloat($('#discount' + rowNo).val()) || 0;
           var vat = parseFloat($('#vat' + rowNo).val()) || 0;
           var B4Tax = (qty * price) - discount;
           var actual_cost = no_of_customers * qty * price;
       var after_discount = (actual_cost * discount) / 100;
       var final_cost = actual_cost - after_discount;
           total_discount_final += after_discount;
           var tax = (final_cost * vat) / 100;
           total_tax += tax;
       });
       $('#disc1').val(total_discount_final.toFixed(2));
       $('#vat').val(total_tax.toFixed(2));
   //   var total_amount = 0;
   //     $('.amount').each(function(){
   //         total_amount += parseFloat($('#amount'+ no).val());
   //     })
   //     $('.total_amount').text('€'+total_amount);
    var total_sum = 0;
       $('.amount').each(function () {
           total_sum += parseFloat($(this).val()) || 0;
       });
       console.log(total_sum);
       $('.total_amount').text(total_sum.toFixed(2)); // Update total amount field
   }
   function get_customer(val){
       var value = $(val).val();
       $('input[type=hidden][name^="customer_id_hidden_new"]').val('');
       $('#customer_id_hidden').val('');
       // console.log(value);
       if(value == 'option1'){
           $('input[type=number][name^="no_of_customers"]').val('');
          $('#new').show();
          $('#exist').hide();
          $('#group').hide();
          $('#global').hide();
            $('#no_of_customer_th').hide();
           $('.no_of_customers_div').hide();
           $('input[type=text][name^="amount"]').val('');
           $('#vat').val('');
           $('#disc1').val('');
           $('.total_amount').text('');
           $('input[type="checkbox"]').prop('checked', false);
           $('input[type=number][name^="qty"]').val('');
       }else if(value == 'option2'){
            $('input[type=number][name^="no_of_customers"]').val('');
           $('#new').hide();
          $('#exist').show();
          $('#group').hide();
       $('#global').hide();
         $('#no_of_customer_th').hide();
           $('.no_of_customers_div').hide();
           $('input[type=text][name^="amount"]').val('');
           $('input[type="checkbox"]').prop('checked', false);
           $('input[type=number][name^="qty"]').val('');
            $('#vat').val('');
           $('#disc1').val('');
           $('.total_amount').text('');
       }else if(value == 'option3'){
           $('input[type=number][name^="no_of_customers"]').val('');
           $('#new').hide();
          $('#exist').hide();
          $('#group').hide()
      $('#global').show();
       $('#no_of_customer_th').hide();
           $('.no_of_customers_div').hide();
           $('input[type=text][name^="amount"]').val('');
            $('#vat').val('');
           $('#disc1').val('');
           $('.total_amount').text('');
           $('input[type="checkbox"]').prop('checked', false);
           $('input[type=number][name^="qty"]').val('');
       }else{
            $('#new').hide();
          $('#exist').hide();
          $('#group').show();
           $('#global').hide();
           $('#no_of_customer_th').show();
           $('.no_of_customers_div').show();
           $('input[type=number][name^="no_of_customers"]').show();
           $('input[type=text][name^="amount"]').val('');
       }
   }
   function get_customer_id(val){
       $('#customer_id_hidden').val('');
       var value = $(val).val();
       $('#customer_id_data').hide()
        $('#customer_label').text('');
        $.ajax({
               url: "{{ url('sales/new_sale/get_customer_id') }}",
               type: "POST",
               data: {
                   "_token": "{{ csrf_token() }}",
                   "value" :  value,
               },
                success: function (data) {
               if (!data || !data.first_name || !data.email || !data.mobile) {
                   $('#customer_id_data').show();
                   $('#customer_label').text('Customer NOT exists in the Global Database');
                   return;
               }
               $('#customer_id_hidden').val(data.customer_id);
               let maskedEmail = 'xxx' + data.email.substring(data.email.indexOf('@'));
               let maskedMobile = data.mobile.substring(0, 3) + 'xxx' + data.mobile.slice(-3);
               $('#customer_id_data').show();
               $('#customer_label').text(
                   'Customer name ' + data.first_name + 
                   ' - Email ' + maskedEmail + 
                   ' - Contact Number ' + maskedMobile
               );
           },
           error: function () {
               $('#customer_id_data').show();
               $('#customer_label').text('Error retrieving customer data');
           }
           });
   }
   function get_luckydraw_id(val,no){
        var value = $(val).val();
       $('#price' + no).val('');
       $('#amount' + no).val('');
       $('#qty' + no).val('');
        $.ajax({
               url: "{{ url('sales/new_sale/get_luckydraw_id') }}",
               type: "POST",
               data: {
                   "_token": "{{ csrf_token() }}",
                   "value" :  value,
               },
                success: function (data) {
           //   console.log(data)
           $('#price' + no).val(data.price);
           },
           error: function () {
           }
           });
   }
   //   var table = $("#multi_tr");
   //   var index = 1;	
   // 	var i = 1;
   //   //function to add a new row
   //   function addRow() {
   //     // console.log('yes');
   //     index++
   //     var $tableBody = $('.copy').find(".selectProduct"),
   //     $trNew = $tableBody.clone();
   //     // console.log($trNew);
   //     var select=$trNew.attr('onChange', "get_luckydraw_id($(this),"+index+")" );
   //     // console.log(select)
   //     // var item = $("<td>").html(select);
   //     var row = $("<tr>");
   // var item = $("<td>").html(select);
   // // console.log(item);
   // // 	var sno = $("<td>").html(index);
   // // 	var item = $("<td>").html(select);
   // //     var description = $("<td>").html("<input type='text' name='specify[]' id='specify' class='form-control specify'>");
   // // 	var mop = $("<td>").html("<select name='mop[]' id='mop' class='form-control mop chosen' ><option value='LP'>LP</option><option value='Tender'>Tender</option><option value='Contract'>Contract</option></select>");
   // // 	var uom = $("<td>").html(select1);
   // // 	var demanded_quantity = $("<td>").html("<input type='number' name='demanded_quantity[]' id='demanded_quantity' class='form-control demanded_quantity'>")
   // //     var tender_quantity = $("<td>").html("<input type='number' name='tender_quantity[]' id='tender_quantity"+index+"' class='form-control tender_quantity w-50' readonly>")
   // // 	var approved_quantity = $("<td style='display:none;'>").html("<input type='number' name='approved_quantity[]' value='0' id='approved_quantity' class='form-control approved_quantity'>")
   // // 	var qty_hand = $("<td>").html("<input type='number' name='qty_hand[]' id='qty_hand"+index+"' class='form-control qty_hand w-50' readonly>")
   // // 	var est_un_cos = $("<td>").html("<input type='number' name='est_un_cos[]' id='est_un_cos"+index+"' class='form-control est_un_cos'>")
   // 	var last = $("<td>");
   // //     // var plus = $("<a>").html("+").addClass("btn btn-primary").click(addRow);
   // //     var minus = $("<a>").html("<i class='fa fa-trash-o'></i>").addClass("btn btn-danger").click(removeRow);
   // //     last.append(minus);
   //     row.append(item).append(last);
   // 	table.append(row);
   //     // updateSerialNumbers(); 
   //     // $(".chosen").chosen();
   //     // getValue(1,index);
   //     //   var $tableBody = $('.copy').find("sichn_code"),
   //     // //  $trLast = $tableBody.find(".sichn_code"),
   //     //   $trNew = $tableBody.clone();
   //       //$trLast.after('');
   //   }
   //     function removeRow() {
   //     var rows = $("#multi_tr tr").length;
   //     // console.log(rows);
   //     if (rows > 1) {
   //       $(this).closest("tr").remove();
   //       updateSerialNumbers();
   //     }
   //   }
   //   $(".remove").click(removeRow);
   //   function updateSerialNumbers() {
   //     // Update serial numbers for all rows
   //     $("#multi_tr tr").each(function(index, row) {
   //         $(row).find('td:first').html(index + 1);
   //     });
   // }
   // let rowCount = 1; // Initialize row counter
   // function addRow() {
   //     rowCount++; // Increment row count
   //     // Get the table body
   //     let table = document.querySelector("table tbody");
   //     // Get all rows
   //     let rows = table.querySelectorAll("tr");
   //     // Ensure at least two rows before the button row
   //     let insertBeforeRow = rows.length > 3 ? rows[rows.length - 3] : rows[0];
   //     // Get the first row as a template
   //     let firstRow = table.querySelector("tr:first-child");
   //     let newRow = firstRow.cloneNode(true);
   //     // Update IDs and event handlers dynamically
   //     newRow.querySelectorAll("select, input").forEach((element) => {
   //         if (element.id) {
   //             // Update ID to reflect the new row count
   //             let newId = element.id.replace(/\d+$/, "") + rowCount;
   //             element.id = newId;
   //         }
   //         // Reset values (except discount and VAT)
   //         if (element.tagName === "INPUT") {
   //             if (!element.classList.contains("discount") && !element.classList.contains("vat")) {
   //                 element.value = "";
   //             }
   //         }
   //         // Update event listeners dynamically with rowCount
   //         if (element.getAttribute("onchange")) {
   //             let updatedOnchange = element.getAttribute("onchange")
   //                 .replace(/\d+/, rowCount); // Replace only the first number occurrence
   //             element.setAttribute("onchange", updatedOnchange);
   //         }
   //     });
   //      let deleteButton = newRow.querySelector(".btn-danger");
   //     deleteButton.setAttribute("onclick", "removeRow(this)");
   //     // Insert the new row **before the second last row**
   //     table.insertBefore(newRow, insertBeforeRow);
   // }
   // let rowCount = 1; // Initialize row counter
   // function addRow() {
   //     rowCount++; // Increment row count
   //     // Get the table body
   //     let table = document.querySelector("table tbody");
   //     // Get all rows
   //     let rows = table.querySelectorAll("tr");
   //     // Ensure at least two rows before the button row
   //     let insertBeforeRow = rows.length > 3 ? rows[rows.length - 3] : rows[0];
   //     // Get the first row as a template
   //     let firstRow = table.querySelector("tr:first-child");
   //     let newRow = firstRow.cloneNode(true);
   //     // Get the hidden field value
   //     let hiddenFieldValue = document.getElementById("no_of_customers_hidden").value;
   //     // Update IDs and event handlers dynamically
   //     newRow.querySelectorAll("select, input").forEach((element) => {
   //         if (element.id) {
   //             // Update ID to reflect the new row count
   //             let newId = element.id.replace(/\d+$/, "") + rowCount;
   //             element.id = newId;
   //         }
   //         // Reset values (except discount, VAT, and hidden field values)
   //         if (element.tagName === "INPUT") {
   //             if (!element.classList.contains("discount") && !element.classList.contains("vat")) {
   //                 element.value = "";
   //             }
   //             // Populate `no_of_customer` field if `no_of_customers_hidden` has a value
   //             if (element.classList.contains("no_of_customers") && hiddenFieldValue) {
   //                 element.value = hiddenFieldValue;
   //             }
   //         }
   //         // Update event listeners dynamically with rowCount
   //         if (element.getAttribute("onchange")) {
   //             let updatedOnchange = element.getAttribute("onchange")
   //                 .replace(/\d+/, rowCount); // Replace only the first number occurrence
   //             element.setAttribute("onchange", updatedOnchange);
   //         }
   //     });
   //     let deleteButton = newRow.querySelector(".btn-danger");
   //     deleteButton.setAttribute("onclick", "removeRow(this)");
   //     // Insert the new row **before the second last row**
   //     table.insertBefore(newRow, insertBeforeRow);
   // }
   let rowCount = 1; // Initialize row counter
   function addRow() {
       // Get the table body
       let table = document.querySelector("table tbody");
       // Get all rows
       let rows = table.querySelectorAll("tr");
       // Ensure at least two rows before the button row
       let insertBeforeRow = rows.length > 3 ? rows[rows.length - 3] : rows[0];
       // Get the last row before adding a new one
       let lastRow = rows[rows.length - 2]; // Last input row (excluding button row)
       // Validate required fields in the last row before adding a new one
       let isValid = true;
       lastRow.querySelectorAll("input[required], select[required]").forEach((element) => {
           if (!element.value.trim()) {
               isValid = false;
               element.style.border = "2px solid red"; // Highlight empty field
           } else {
               element.style.border = ""; // Reset border if valid
           }
       });
       if (!isValid) {
           alert("Please fill all required fields before adding a new row.");
           return;
       }
       rowCount++; // Increment row count
       // Get the first row as a template
       let firstRow = table.querySelector("tr:first-child");
       let newRow = firstRow.cloneNode(true);
       // Get the hidden field value
       let hiddenFieldValue = document.getElementById("no_of_customers_hidden").value;
       // Update IDs and event handlers dynamically
       newRow.querySelectorAll("select, input").forEach((element) => {
           if (element.id) {
               // Update ID to reflect the new row count
               let newId = element.id.replace(/\d+$/, "") + rowCount;
               element.id = newId;
           }
           // Reset values (except discount, VAT, and hidden field values)
           if (element.tagName === "INPUT") {
               if (!element.classList.contains("discount") && !element.classList.contains("vat")) {
                   element.value = "";
               }
               // Populate `no_of_customer` field if `no_of_customers_hidden` has a value
               if (element.classList.contains("no_of_customers") && hiddenFieldValue) {
                   element.value = hiddenFieldValue;
               }
           }
           // Remove red border if copied from the previous row
           element.style.border = "";
           // Update event listeners dynamically with rowCount
           if (element.getAttribute("onchange")) {
               let updatedOnchange = element.getAttribute("onchange").replace(/\d+/, rowCount); // Replace only the first number occurrence
               element.setAttribute("onchange", updatedOnchange);
           }
       });
       let deleteButton = newRow.querySelector(".btn-danger");
       deleteButton.setAttribute("onclick", "removeRow(this)");
       // Insert the new row **before the second last row**
       table.insertBefore(newRow, insertBeforeRow);
   }
   function removeRow(button) {
       let table = document.querySelector("table tbody");
       let rows = table.querySelectorAll("tr");
       if (rows.length > 1) { // Ensure at least one row remains
           let row = button.closest("tr");
           row.remove();
       }
   }
</script>