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
                              <th>Time From<span class="asterisk">*</span></th>
                              <td>
                                 {{ Form::time('time_from', old('time_from'), ['class' => 'form-control','id' => 'time_from','placeholder' => 'Time From']) }}

                                  <div class="badge badge-pill badge-danger" id="timeFromCheck" role="alert"> Time From is required </div>
                              </td>
                           </tr>

                           <tr>
                              <th>Time To<span class="asterisk">*</span></th>
                              <td>
                                 {{ Form::time('time_to', old('time_to'), ['class' => 'form-control','id' => 'time_to','placeholder' => 'Time To']) }}

                                  <div class="badge badge-pill badge-danger" id="timeToCheck" role="alert"> Time To is required </div>
                              </td>
                           </tr>
                         
                           <tr>
                              <th>Happy Hour Tag<span class="asterisk">*</span></th>
                              <td>
                                  <select class="form-control" id="happy_hour_tag" name="happy_hour_tag" placeholder="happy_hour_tag" data-size="5" data-live-search="true" required>
                                    
                                    <option value="Inactive" @if(isset($Record)) @if($Record->happy_hour_tag == 'Inactive') {{ 'selected' }} @endif @endif>Inactive</option>
                                    <option value="Active" @if(isset($Record)) @if($Record->happy_hour_tag == 'Active') {{ 'selected' }} @endif @endif>Active</option>
                                    
                                </select>

                                 <div class="badge badge-pill badge-danger" id="HappyHourTagCheck" role="alert">Happy Hour Tag is required </div>
                              </td>
                           </tr>

                           <tr id="HappyHourDiscountDiv">
                              <th>Happy Hour Discount<span class="asterisk">*</span></th>
                              <td>
                                 {{ Form::number('happy_hour_discount', old('happy_hour_discount'), ['class' => 'form-control','id' => 'happy_hour_discount','placeholder' => 'Happy Hour Discount']) }}

                                 <div class="badge badge-pill badge-danger" id="HappyHourDiscountCheck" role="alert">Happy Hour Discount is required </div>
                              </td>
                           </tr>

                           <tr>
                              <th>Happy Hour Image<span class="asterisk">*</span></th>
                              <td>
                                @if(isset($Record))
                                    @if(isset($Record->happy_hour_image))
                                        <img src="{{ asset('admin/timeslots/'.$Record->happy_hour_image) }}" width="50px" height="50px">
                                    <br><br>
                                    @endif
                                 @endif
                                 {{ Form::file('happy_hour_image', ['class' => 'form-control-file','id'=> 'happy_hour_image']) }}
                                  <div class="badge badge-pill badge-danger" id="image_check" role="alert"></div>
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
  
    $("#timeFromCheck").hide();
    let timeFromError = true;
    $("#time_from").on('keyup blur', function () {
        validatTimeFrom();
    });

    function validatTimeFrom() {
        let timeFromValue = $("#time_from").val();
        if (timeFromValue.length == "") {
            $("#timeFromCheck").show();
            timeFromError = false;
            return false;
        } else {
            $("#timeFromCheck").hide();
            timeFromError = true;
            return true;
        }
    }


    $("#timeToCheck").hide();
    let timeToError = true;
    $("#time_to").on('keyup blur', function () {
        validatTimeTo();
    });

    function validatTimeTo() {
        let timeToValue = $("#time_to").val();
        if (timeToValue.length == "") {
            $("#timeToCheck").show();
            timeToError = false;
            return false;
        } else {
            $("#timeToCheck").hide();
            timeToError = true;
            return true;
        }
    }

    $("#HappyHourTagCheck").hide();
    let happyHourTagValue = "";
    var existingHappyHorTag = '<?php if(isset($Record)){ echo $Record->happy_hour_tag; }?>';
    if(existingHappyHorTag == "Active")
    {
      $("#HappyHourDiscountDiv").show();
    }
    else
    {
      $("#HappyHourDiscountDiv").hide();
    }

    let happyHourDiscountError = true;
    let happyHourTagError = true;
    $("#happy_hour_tag").on('change blur', function () {
        validateHappyHourTag();
    });

    function validateHappyHourTag() {
        
        happyHourTagValue = $("#happy_hour_tag").val();
        if (happyHourTagValue.length == "") {
            $("#HappyHourTagCheck").show();
            $("#HappyHourDiscountDiv").hide();
            happyHourTagError = false;
            return false;
        } else {
            $("#HappyHourTagCheck").hide();
            if(happyHourTagValue == 'Active')
            {
                $("#HappyHourDiscountDiv").show();
            }
            else
            {   
                happyHourDiscountError = true;
                $("#HappyHourDiscountDiv").hide();
            }
            happyHourTagError = true;
            return true;
        }
    }

    $("#HappyHourDiscountCheck").hide();
    
    $("#happy_hour_discount").on('keyup blur', function () {
        validateHappyHourDiscount();
    });

    function validateHappyHourDiscount() {
        let happyHourDiscountValue = $("#happy_hour_discount").val();
        if (happyHourDiscountValue.length == "") {
            $("#HappyHourDiscountCheck").show();
            happyHourDiscountError = false;
            return false;
        } else {
            $("#HappyHourDiscountCheck").hide();
            happyHourDiscountError = true;
            return true;
        }
    }

    $("#image_check").hide();
    let imageError = true;

    $("#happy_hour_image").on('change', function () {
        validateImage();
    });

    function validateImage() {
        const allowedFormats = ['jpg', 'jpeg', 'png', 'gif'];
        const imageInput = document.getElementById('happy_hour_image');
        const imageCheck = document.getElementById('image_check');

        var existingImage = '<?php if(isset($Record->happy_hour_image)) { echo $Record->happy_hour_image; } ?>'; 
        if (!existingImage && imageInput.files.length === 0) {
            // No file selected, show error message
            imageCheck.innerHTML = 'Image is required.';
            imageCheck.style.display = 'block';
            imageError = false;
            return false;
        }


        const fileName = imageInput.value.toLowerCase();
        const fileExtension = fileName.split('.').pop();
        if (imageInput.files.length > 0) {
          if (!allowedFormats.includes(fileExtension)) {
              imageCheck.innerHTML = 'Invalid image format. Please upload a valid image.';
              imageCheck.style.display = 'block';
              imageError = false;
              return false;
          } else {
              imageCheck.style.display = 'none';
              imageError = true;
              return true;
          }
        }
    }



    $('#submit').on('click', function(event) {
        
        validatTimeFrom();
        validatTimeTo();
        validateHappyHourTag();
        if (happyHourTagValue.length == "Active") 
        {
          validateHappyHourDiscount();
        }
        validateImage();


        if (happyHourTagError == false || 
            timeToError == false ||
            timeFromError == false ||
            imageError == false
        ) {  return false; }
        
    });
});



</script>

@endsection
