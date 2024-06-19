@extends('layouts.admin.app')

@section('title') {{$Module}} @endsection

@push('css_or_js')

@endpush

@section('content')


 

<div class="container-fluid">
   <div class="fade-in">
      <div class="row">
         <div class="col-sm-12">
            <div class="card">
               <div class="card-header">
                <div class="row">
                            <div class="col-sm-12">
                            <a class="btn btn-lg btn-primary" href="{{ route($RoutePrefixName.'.index') }}">Back</a>
                            </div>
                        </div>   
                  <h4><h2>@if(isset($Record)) {{ $RecordEditModule }} @else {{ $RecordAddModule }} @endif</h2>   </h4>
               </div>
               <div class="card-body">
                    
                    @if(isset($Record))
                      {{ Form::model($Record,['route'=>[$RoutePrefixName.'.update', $Record->id], 'method'=>'PATCH','id'=>'form_validation','enctype'=>'multipart/form-data']) }}
                    @else
                      {{ Form::open(['route'=>$RoutePrefixName.'.store', 'method'=>'POST','id'=>'form_validation','enctype'=>'multipart/form-data']) }}
                    @endif
                     @csrf
                     <table class="table table-bordered datatable">
                        <tbody>

                           <tr>
                              <th>Name<span class="asterisk">*</span></th>
                              <td>
                                 {{ Form::text('name', old('name'), ['class' => 'form-control','id' => 'name','placeholder' => 'Name']) }}

                                  <div class="badge-danger" id="nameCheck" role="alert"></div>
                              </td>
                           </tr>

                           <tr>
                              <th>Phone<span class="asterisk">*</span></th>
                              <td>
                                 {{ Form::text('phone', old('phone'), ['class' => 'form-control','id' => 'phone','placeholder' => 'Phone']) }}
                                    <div class="badge-danger" id="phoneCheck" role="alert"></div>
                              </td>
                           </tr>                   

                          <tr>
                              <th>E-mail<span class="asterisk">*</span></th>
                              <td>
                               {{ Form::text('email', old('email'), ['class' => 'form-control','id' => 'email','placeholder' => 'E-mail']) }}
                                    <div class="badge-danger" id="emailCheck" role="alert"></div>
                                 
                              </td>
                          </tr>                  

                          <tr>
                              <th>Message<span class="asterisk">*</span></th>
                              <td>
                               {{ Form::textarea('message', old('message'), ['class' => 'form-control','id' => 'message', 'rows' => 3,  'placeholder' => 'Message']) }}
                                    <div class="badge-danger" id="messageCheck" role="alert"></div>
                                 
                              </td>
                          </tr>                   

                          



                        </tbody>
                     </table>
                     <div class="float-right">
                        <button class="btn btn-success" id="submit" type="submit">Save</button>
                        <a class="btn btn-primary" href="{{ route($RoutePrefixName.'.index') }}">Exit</a>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
<!-- end row -->

<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>

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
