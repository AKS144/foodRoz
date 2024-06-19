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
                              <th>Pass Title<span class="asterisk">*</span></th>
                              <td>
                                 {{ Form::text('title', old('title'), ['class' => 'form-control','id' => 'title','placeholder' => 'Pass Title', 'onkeypress' => "return onlyAlphabets(event,this);"]) }}
                                  <div class="badge-danger" id="titleCheck" role="alert"></div>
                              </td>
                           </tr>

                           <tr>
                              <th>Pass Name<span class="asterisk">*</span></th>
                              <td>
                                 {{ Form::text('pass_name', old('pass_name'), ['class' => 'form-control','id' => 'pass_name','placeholder' => 'Pass Name', 'onkeypress' => "return onlyAlphabets(event,this);"]) }}

                                  <div class="badge-danger" id="passNameCheck" role="alert"></div>
                              </td>
                           </tr>                   

                          <tr>
                              <th>Number oF Orders<span class="asterisk">*</span></th>
                              <td>
                               {{ Form::number('number_of_orders', old('number_of_orders'), ['class' => 'form-control','id' => 'number_of_orders','placeholder' => 'Number oF Orders','min' => 0,'maxlength' => 10 , 'oninput' => "javascript: if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"]) }}
                                <div class="badge-danger" id="numberOfOrdersCheck" role="alert"></div>
                                 
                              </td>
                          </tr>                  

                          <tr>
                              <th>Limit For Same User<span class="asterisk">*</span></th>
                              <td>
                               {{ Form::number('limit_for_same_user', old('limit_for_same_user'), ['class' => 'form-control','id' => 'limit_for_same_user','placeholder' => 'Limit For Same User','min' => 0,'maxlength' => 10 , 'oninput' => "javascript: if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"]) }}
                                <div class="badge-danger" id="limitForSameUserCheck" role="alert"></div>
                                 
                              </td>
                          </tr>                   

                          <tr>
                              <th>Validity(Days)<span class="asterisk">*</span></th>
                              <td>
                               {{ Form::number('validity', old('validity'), ['class' => 'form-control','id' => 'validity','placeholder' => 'Validity','min' => 0,'maxlength' => 10 , 'oninput' => "javascript: if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"]) }}
                                <div class="badge-danger" id="validityCheck" role="alert"></div>
                                 
                              </td>
                          </tr>                  

                          <tr>
                              <th>Start Date<span class="asterisk">*</span></th>
                              <td>
                               {{ Form::date('start_date', old('start_date'), ['class' => 'form-control','id' => 'start_date','placeholder' => 'Start Date']) }}
                                <div class="badge-danger" id="startDateCheck" role="alert"></div>
                                 
                              </td>
                          </tr>                   

                          <tr>
                              <th>Expire Date<span class="asterisk">*</span></th>
                              <td>
                               {{ Form::date('expire_date', old('expire_date'), ['class' => 'form-control','id' => 'expire_date','placeholder' => 'Expire Date']) }}
                                <div class="badge-danger" id="expireDateCheck" role="alert"></div>
                                 
                              </td>
                          </tr>                      

                          @if(isset($Record))
                              <?php 
                                $explode = explode(',', $Record->dishes);
                              ?>
                            @endif
                     
                           <tr>
                              <th>Dishes<span class="asterisk">*</span></th>
                              <td>
                                  <select class="form-control js-select2-custom" id="dishes" name="dishes[]" placeholder="Dishes" multiple>
                                    
                                    <option value="">Select Dishes</option>
                                    @foreach ($Dishes as $dish)
                                    <option value="{{ $dish->id }}" @if(isset($Record->dishes)) @if(in_array($dish->id, $explode)) {{ 'selected' }} @endif @endif >
                                            {{ $dish->name }}
                                        </option>
                                    @endforeach
                                    
                                </select>

                                <div class="badge-danger" id="dishCheck" role="alert"></div>

                              </td>
                           </tr>


                           <tr>
                              <th>Image<span class="asterisk">*</span></th>
                              <td>
                                @if(isset($Record))
                                    @if(isset($Record->image))
                                        <img src="{{ asset('images/passes/'.$Record->image) }}" width="100%" height="100%">
                                    <br><br>
                                    @endif
                                 @endif
                                 {{ Form::file('image', ['class' => 'form-control-file','id'=> 'image']) }}
                                  
                                  <div class="badge-danger" id="image_check" role="alert"></div>
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
        $("#titleCheck").hide();
        let titleError = true;
        $("#title").on('keyup blur', function () {
           validateTitle();
        });
       
        function validateTitle() {
           let titleValue = $("#title").val();
           if (titleValue.length == "") {
               $("#titleCheck").show();
               $("#titleCheck").html('Pass Title is required');
               titleError = false;
               return false;
           } else {
               $("#titleCheck").hide();
               titleError = true;
               return true;
           }
        }


        $("#passNameCheck").hide();
        let passNameError = true;
        $("#pass_name").on('keyup blur', function () {
               validatePassName();
        });
       
        function validatePassName() {
           let passNameValue = $("#pass_name").val();
           if (passNameValue.length == "") {
               $("#passNameCheck").show();
               $("#passNameCheck").html('Pass Name is required');
               passNameError = false;
               return false;
           } else {
               $("#passNameCheck").hide();
               passNameError = true;
               return true;
           }
        }


        $("#numberOfOrdersCheck").hide();
        let ordnumberError = true;
        $("#number_of_orders").on('keyup blur', function () {
               validateNumberOfOrders();
        });
       
        function validateNumberOfOrders() {
           let ordnoValue = $("#number_of_orders").val();
           if (ordnoValue.length == "") {
               $("#numberOfOrdersCheck").show();
               $("#numberOfOrdersCheck").html('Number oF Orders is required');
               ordnumberError = false;
               return false;
           } else {
               $("#numberOfOrdersCheck").hide();
               ordnumberError = true;
               return true;
           }
        }


        $("#limitForSameUserCheck").hide();
        let limitError = true;
        $("#limit_for_same_user").on('keyup blur', function () {
               validateLimit();
        });
       
        function validateLimit() {
           let ordnoValue = $("#limit_for_same_user").val();
           if (ordnoValue.length == "") {
               $("#limitForSameUserCheck").show();
               $("#limitForSameUserCheck").html('Limit For Same User is required');
               limitError = false;
               return false;
           } else {
               $("#limitForSameUserCheck").hide();
               limitError = true;
               return true;
           }
        }


        $("#validityCheck").hide();
        let validityError = true;
        $("#validity").on('keyup blur', function () {
               validateValidity();
        });
       
        function validateValidity() {
           let validityValue = $("#validity").val();
           if (validityValue.length == "") {
               $("#validityCheck").show();
               $("#validityCheck").html('Validity is required');
               validityError = false;
               return false;
           } else {
               $("#validityCheck").hide();
               validityError = true;
               return true;
           }
        }


        $("#startDateCheck").hide();
        let startDateError = true;
        $("#start_date").on('keyup blur', function () {
               validateStartDate();
        });
       
        function validateStartDate() {
           let sDateValue = $("#start_date").val();
           if (sDateValue.length == "") {
               $("#startDateCheck").show();
               $("#startDateCheck").html('Start Date is required');
               startDateError = false;
               return false;
           } else {
               $("#startDateCheck").hide();
               startDateError = true;
               validateExpireDate();
               return true;
           }
        }


        $("#expireDateCheck").hide();
        let expireDateError = true;
        $("#expire_date").on('keyup blur', function () {
               validateExpireDate();
        });
       
        function validateExpireDate() {
           let sDateValue = $("#start_date").val();
           let eDateValue = $("#expire_date").val();
           if (eDateValue.length == "") {
               $("#expireDateCheck").show();
               $("#expireDateCheck").html('Expire Date is required');
               expireDateError = false;
               return false;
           } else {
               $("#expireDateCheck").hide();

               if (new Date(eDateValue) < new Date(sDateValue)) {
                    $("#expireDateCheck").show().text("Expire Date should be after the Start Date.");
                    expireDateError = false;
                    return false;
                } else {
                    $("#expireDateCheck").hide();
                    expireDateError = true;
                    return true;
                }
               expireDateError = true;
               return true;
           }
        }

        $("#dishCheck").hide();
        let dishError = true;
        $("#dishes").on('change blur', function () {
            validateDishes();
        });
       
        function validateDishes() {
           let categoryValue = $("#dishes").val();
           if (categoryValue.length == "") {
               $("#dishCheck").show();
               $("#dishCheck").html('Dishes are required');
               dishError = false;
               return false;
           } else {
               $("#dishCheck").hide();
               dishError = true;
               return true;
           }
        }

        $("#image_check").hide();
        let imageError = true;

        $("#image").on('change', function () {
            validateImage();
        });

        function validateImage() {
            const allowedFormats = ['jpg', 'jpeg', 'png', 'gif'];
            const imageInput = document.getElementById('image');
            const imageCheck = document.getElementById('image_check');

            var existingImage = '<?php if(isset($Record->image)) { echo $Record->image; } ?>'; 
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
            
            validateTitle();
            validatePassName();
            validateNumberOfOrders();
            validateLimit();
            validateValidity();
            validateStartDate();
            validateExpireDate();
            validateDishes();
            validateImage();


            if (titleError == false || 
                passNameError == false ||
                ordnumberError == false ||
                limitError == false ||
                validityError == false ||
                startDateError == false ||
                expireDateError == false ||
                dishError == false ||
                imageError == false
            ) {  return false; }
            
        });
});



</script>

<script type="text/javascript">
        function onlyAlphabets(e, t) {
            try {
                if (window.event) {
                    var charCode = window.event.keyCode;
                }
                else if (e) {
                    var charCode = e.which;
                }
                else { return true; }
                if ((charCode < 48 && charCode > 57) || (charCode != 32 && charCode < 65) || (charCode > 90 && charCode < 97) || charCode > 122)
                    return false;
                else
                    return true;
            }
            catch (err) {
                alert(err.Description);
            }
        }
    </script>




@endsection
