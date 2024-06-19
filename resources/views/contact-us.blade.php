@extends('layouts.landing.app')

@section('title','Contact Us')

@section('content')
    <?php /*
    <main>
        <div class="main-body-div">
            <!-- Top Start -->
            <section class="top-start" style="min-height: 100px">
                <div class="container">
                    <div class="row">
                        <div class="col-12 mt-2 text-center">
                            {{--<h1>{{__('messages.contact_us')}}</h1>--}}
                        </div>
                        <div class="col-12">
                           <center>
                               <img style="max-width: 50%" src="{{asset('public/assets/landing/image/contact.png')}}">
                               <h6 class="mt-4">
                                   Phone : {{\App\CentralLogics\Helpers::get_settings('phone')}},
                                   Email : {{\App\CentralLogics\Helpers::get_settings('email_address')}}
                               </h6><br>
                               <h6>
                                   Address : {{\App\CentralLogics\Helpers::get_settings('address')}}
                               </h6>
                           </center>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Top End -->
        </div>
    </main>
*/ ?>
    <!-- Begin Page Content -->
<main>
        <div class="main-body-div">
            <!-- Top Start -->
            <section class="top-start" style="min-height: 100px;margin-top: 60px;">
                <div class="container">
                    <div class="row">
            <div class="col-xl-12 my-col-md-6">
                @include('admin-views.messages')
            </div>
            <div class="col-xl-8">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-body">
                        
                        {{ Form::open(['route'=>'store_contact_us','method'=>'POST','id'=>'form_validation','enctype'=>'multipart/form-data']) }}
                        
                        @csrf
                    <div class="row">      
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-xl-12">Name<span class="asterisk">*</span></label>
                                <div class="col-xl-12">                      
                                    {{ Form::text('name', old('name'), ['class' => 'form-control','id' => 'name','placeholder' => 'Name']) }}
                                    <div class="badge-danger" id="nameCheck" role="alert"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-xl-12">Phone<span class="asterisk">*</span></label>
                                <div class="col-xl-12">                      
                                    {{ Form::text('phone', old('phone'), ['class' => 'form-control','id' => 'phone','placeholder' => 'Phone']) }}
                                    <div class="badge-danger" id="phoneCheck" role="alert"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-xl-12">E-mail<span class="asterisk">*</span></label>
                                <div class="col-xl-12">                      
                                    {{ Form::text('email', old('email'), ['class' => 'form-control','id' => 'email','placeholder' => 'E-mail']) }}
                                    <div class="badge-danger" id="emailCheck" role="alert"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group row">
                                    <label class="control-label col-xl-12">Message<span class="asterisk">*</span></label>
                                    <div class="col-xl-12">                      
                                        {{ Form::textarea('message', old('message'), ['class' => 'form-control','id' => 'message', 'rows' => 3,  'placeholder' => 'Message']) }}
                                    <div class="badge-danger" id="messageCheck" role="alert"></div>
                                    </div>
                            </div>
                        </div>
                    </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="col-md-6 mb-3">
                                    <button type="submit" id="submit" class="btn btn-sm btn-success btn-user btn-block">
                                        <i class="fa fa-check"></i> Save</button>
                                </div>
                            </div>
                        </div>
                          </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="col-12 mt-2 text-center">
                            {{--<h1>{{__('messages.contact_us')}}</h1>--}}
                        </div>
                        <div class="col-12">
                           <center>
                               <img style="max-width: 50%" src="{{asset('public/assets/landing/image/contact.png')}}">
                               <h6 class="mt-4">
                                   Phone : {{\App\CentralLogics\Helpers::get_settings('phone')}},
                                   Email : {{\App\CentralLogics\Helpers::get_settings('email_address')}}
                               </h6><br>
                               <h6>
                                   Address : {{\App\CentralLogics\Helpers::get_settings('address')}}
                               </h6>
                           </center>
                        </div>
            </div>
        </div>
                </div>
            </section>
            <!-- Top End -->
        </div>
    </main>       
<!-- /.container-fluid -->

<script type="text/javascript">
$(document).ready(function () 
{
    $("#nameCheck").hide();
    let nameError = true;
    $("#name").on('keyup blur', function () {
        validateName();
    });

    function validateName() {
        let usernameValue = $("#name").val();
        let regex = /^[a-zA-Z\s]+$/;
        if (usernameValue.length == "") {
            $("#nameCheck").show();
            $("#nameCheck").html('Name is required.');
            nameError = false;
            return false;
        } else if(!regex.test(usernameValue)) {
            $("#nameCheck").show();
            $("#nameCheck").html("Please Enter Alphabetic Characters Only");
            nameError = false;
            return false;
        } else {
            $("#nameCheck").hide();
            nameError = true;
            return true;
        }
    }


    $("#emailCheck").hide();
    let emailError = true;
    $("#email").on('keyup blur', function () {
        validateEmail();
    });

    function validateEmail() {
        let useremailValue = $("#email").val();

        let regex =
        /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
        
        if (useremailValue.length == "") {
            $("#emailCheck").show();
            $("#emailCheck").html("Email is required.");
            emailError = false;
            return false;
        } else if(!regex.test(useremailValue)) {
            $("#emailCheck").show();
            $("#emailCheck").html("Please Enter Valid Email Id");
            emailError = false;
            return false;
        } else {
            $("#emailCheck").hide();
            emailError = true;
            return true;
        }
    } 

   

    $("#phoneCheck").hide();
    let phoneError = true;
    $("#phone").on('keyup blur', function () {
        validatePhone();
    });

    function validatePhone() {
        let phoneValue = $("#phone").val();
        let regex = /^\d*(?:\.\d{1,2})?$/;
        if (phoneValue.length == "") {
            $("#phoneCheck").show();
            $("#phoneCheck").html("Phone is required.");
            phoneError = false;
            return false;
        } else if(!regex.test(phoneValue)) {
            $("#phoneCheck").show();
            $("#phoneCheck").html("Please Enter Valid Phone Number");
            phoneError = false;
            return false;
        } else if(phoneValue.length != 10) {
            $("#phoneCheck").show();
            $("#phoneCheck").html("Phone Number should of 10 digits.");
            phoneError = false;
            return false;
        }else {
            $("#phoneCheck").hide();
            phoneError = true;
            return true;
        }
    }

    $("#messageCheck").hide();
       let messageError = true;
       $("#message").on('keyup blur', function () {
           validateMessage();
    });
   
    function validateMessage() {
       let subjectValue = $("#message").val();
       if (subjectValue.length == "") {
           $("#messageCheck").show();
            $("#messageCheck").html('Message is required.');
           messageError = false;
           return false;
       } else {
           $("#messageCheck").hide();
           messageError = true;
           return true;
       }
    }



    $('#submit').on('click', function(event) {
        
        validateName();
        validateEmail();
        validatePhone();
        validateMessage();


        if (nameError == false || 
            emailError == false ||
            phoneError == false ||
            messageError == false
        ) {  return false; }
        
    });
});



</script>
@endsection
