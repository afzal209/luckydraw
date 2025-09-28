@extends('layout')
@section('title','Manage SMTP Mail')
@section('content')

<ul class="breadcrumb">
   <li>
      <p>Dashboard</p>
   </li>
   <li><a href="#" class="active">Settings</a></li>
   <li><a href="#" class="active">General Setting</a> </li>
</ul>
<div class="row-fluid">
<div class="span12">
   <div class="grid simple ">
      <div class="grid-title">
         <h3><i class="fa fa-users"></i><span class="semi-bold"> Manage SMTP Setting</span></h3>
      </div>
      <div class="grid-body ">
         <div class="row column-seperation">
            <!-- Main SMTP Settings Form (Left Side) -->
            <div class="col-md-6">
               <form class="form-no-horizontal-spacing" id="form-condensed" action="{{route('settings.manage_smtp_mail.save_smtp')}}" method="POST">
                  @csrf
                  <div class="row form-row">
                     <div class="col-md-6">
                        <p>SMTP Mailer<font color="red">*</font></p>
                        <select id="smtp_mailer" name="smtp_mailer" class="custom-select">
                           <option value="smtp" @if($Smtp_mail->smtp_mailer == 'smtp') selected @endif>SMTP</option>
                           <option value="sendmail" @if($Smtp_mail->smtp_mailer == 'sendmail') selected @endif>SendMail</option>
                           <option value="mailgun" @if($Smtp_mail->smtp_mailer == 'mailgun') selected @endif>Mailgun</option>
                           <option value="postmark" @if($Smtp_mail->smtp_mailer == 'postmark') selected @endif>Postmark</option>
                        </select>
                     </div>
                     <div class="col-md-6">
                        <p>SMTP Mail Host<font color="red">*</font></p>
                        <input name="smtp_host" id="smtp_host" type="text" class="form-control" value="{{$Smtp_mail->smtp_host ?? ''}}" placeholder="Enter Your SMTP Mail" required>
                     </div>   
                     <div class="col-md-6">
                        <p>SMTP Mail Port<font color="red">*</font></p>
                        <select name="smtp_port" id="smtp_port" class="select2" required>
                           <option value="587" @if($Smtp_mail->smtp_port == '587') selected @endif>587</option>
                           <option value="465" @if($Smtp_mail->smtp_port == '465') selected @endif>465</option>
                        </select>
                     </div>
                     <div class="col-md-6">
                        <p>SMTP Mail Username</p>
                        <input name="smtp_username" id="smtp_username" type="text" class="form-control" value="{{$Smtp_mail->smtp_username ?? ''}}" placeholder="Enter SMTP Username">
                     </div>
                     <div class="col-md-6">
                        <p>SMTP Mail Password<font color="red">*</font></p>
                        <div class="input-group">
                            <input name="smtp_password" id="smtp_password" type="password" class="form-control" value="" placeholder="Enter SMTP Password" required>
                            <div class="input-group-append">
                                <span class="input-group-text" onclick="togglePassword()">
                                    <i id="togglePasswordIcon" class="fa fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        
                     </div>
                     <div class="col-md-6">
                        <p>SMTP Mail Encryption<font color="red">*</font></p>
                        <select name="smtp_encryption" id="smtp_encryption" class="select2" required>
                           <option value="">Select Encryption</option>
                           <option value="ssl" @if($Smtp_mail->smtp_encryption == 'ssl') selected @endif>SSL</option>
                           <option value="tls" @if($Smtp_mail->smtp_encryption == 'tls') selected @endif>TLS</option>
                        </select>
                     </div>
                  </div>
                  <div class="pull-right">
                     @if(isset($Smtp_mail))
                        <button class="btn btn-info btn-cons" type="submit"><i class="fa fa-server"></i> Update SMTP</button>
                     @else
                        <button class="btn btn-info btn-cons" type="submit"><i class="fa fa-server"></i> Add SMTP</button>
                     @endif
                     <button class="btn btn-warning btn-cons cancel-btn" type="reset" id="clear-btn"><i class="fa fa-eraser"></i> Clear</button>
                  </div>
                  @if(isset($Smtp_mail))
                     <input type="hidden" name="action" value="update" />
                  @else
                     <input type="hidden" name="action" value="save" />
                  @endif
               </form>
            </div>
            <!-- Additional SMTP Settings Form (Right Side) -->
            <div class="col-md-6">
               <form class="form-no-horizontal-spacing" id="form-additional-smtp" action="{{route('settings.manage_smtp_mail.sendSmtpTest')}}" method="POST">
                  @csrf
                  <div class="row form-row">
                     <div class="col-md-12">
                        <h4>SMTP Test</h4>
                     </div>
                     <div class="col-md-12">
                        <p>SMTP From Address<font color="red">*</font></p>
                        <input name="smtp_from_address" id="smtp_from_address" type="email" class="form-control" value="" placeholder="Enter From Email Address" required>
                     </div>
                     <div class="col-md-12">
                        <p>SMTP From Name</p>
                        <input name="smtp_from_name" id="smtp_from_name" type="text" class="form-control" value="" placeholder="Enter From Name">
                     </div>
                     <div class="col-md-12">
                        <p>Message</p>
                        <textarea name="smtp_from_message" id="smtp_from_message"  class="form-control" value="" placeholder="Enter From Name"></textarea>
                     </div>
                  </div>
                  <div class="pull-right">
                     <button class="btn btn-info btn-cons" type="submit"><i class="fa fa-envelope"></i> Send Mail</button>
                     <button class="btn btn-warning btn-cons cancel-btn" type="reset" id="clear-btn"><i class="fa fa-eraser"></i> Clear</button>
                  </div>
                  
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
@endsection
@section('styles')
<style>
.input-group-text {
    cursor: pointer;
    background-color: #f8f9fa;
    border-left: 0;
}
.input-group {
    position: relative;
}
</style>
@endsection
@section('script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script>
async function togglePassword() {
    const passwordField = document.getElementById('smtp_password');
    const toggleIcon = document.getElementById('togglePasswordIcon');

    if (passwordField.type === 'password') {
        // Show the plain text password
        passwordField.type = 'text';
        passwordField.value = passwordField.dataset.original || passwordField.value;
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        // Show the hashed password
        passwordField.type = 'password';
        // Store the original password
        passwordField.dataset.original = passwordField.value;

        // Compute SHA-256 hash (for demonstration)
        const encoder = new TextEncoder();
        const data = encoder.encode(passwordField.value);
        const hashBuffer = await crypto.subtle.digest('SHA-256', data);
        const hashArray = Array.from(new Uint8Array(hashBuffer));
        const hashHex = hashArray.map(b => b.toString(16).padStart(2, '0')).join('');

        // Display the hash (or a placeholder if empty)
        passwordField.value = hashHex || '************************';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}
</script>


@endsection

<!-- Include Font Awesome for the eye icon -->
