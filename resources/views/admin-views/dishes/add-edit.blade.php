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
                              <th>Dish Name<span class="asterisk">*</span></th>
                              <td>
                                 {{ Form::text('name', old('name'), ['class' => 'form-control','id' => 'name','placeholder' => 'Name', 'onkeypress' => "return onlyAlphabets(event,this);"]) }}

                                  @error('name')
                                      <div class="badge badge-pill badge-danger" role="alert">
                                          {{ $message }}
                                      </div>
                                  @enderror
                                  <div class="badge badge-pill badge-danger" id="nameCheck" role="alert"> Dish Name is required </div>
                              </td>
                           </tr>

                           <tr>
                              <th>Description<span class="asterisk">*</span></th>
                              <td>
                                {{ Form::textarea('description', old('description'), ['class' => 'form-control','id' => 'description', 'rows' => 3, 'placeholder' => 'Description']) }}

                                 
                                 <div class="badge badge-pill badge-danger" id="descriptionCheck" role="alert"> Description is required </div>
                              </td>
                          </tr>                    

                          <tr>
                              <th>Display Price<span class="asterisk">*</span></th>
                              <td>
                               {{ Form::number('display_price', old('display_price'), ['class' => 'form-control','id' => 'display_price','placeholder' => 'Display Price','min' => 0,'maxlength' => 10 , 'oninput' => "javascript: if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"]) }}
                                <div class="badge badge-pill badge-danger" id="displayPriceCheck" role="alert"> Display Price is required </div>
                                 
                              </td>
                          </tr>                   

                          <tr>
                              <th>Maximum Seller Price<span class="asterisk">*</span></th>
                              <td>
                               {{ Form::number('maximum_seller_price', old('maximum_seller_price'), ['class' => 'form-control','id' => 'maximum_seller_price','placeholder' => 'Maximum Seller Price','min' => 0,'maxlength' => 10 , 'oninput' => "javascript: if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"]) }}
                                <div class="badge badge-pill badge-danger" id="maxSellerPriceCheck" role="alert"> Maximum Seller Price is required </div>
                                 
                              </td>
                          </tr>



                           <tr>
                              <th>Discount<span class="asterisk">*</span></th>
                              <td>
                                 {{ Form::number('discount', old('discount'), ['class' => 'form-control','id' => 'discount','placeholder' => 'Discount','min' => 0,'maxlength' => 10 , 'oninput' => "javascript: if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"]) }}

                                 <div class="badge badge-pill badge-danger" id="discountCheck" role="alert">Discount is required </div>
                              </td>
                           </tr>

                         
                           <tr>
                              <th>Discount Type<span class="asterisk">*</span></th>
                              <td>
                                  <select class="form-control" id="discount_type" name="discount_type" placeholder="discount_type" data-size="5" data-live-search="true" required>
                                    
                                    <option value="amount" @if(isset($Record)) @if($Record->discount_type == 'amount') {{ 'selected' }} @endif @endif>Amount</option>
                                    <option value="percentage" @if(isset($Record)) @if($Record->discount_type == 'percentage') {{ 'selected' }} @endif @endif>Percentage</option>
                                    
                                </select>

                              </td>
                           </tr>

                         
                           <tr>
                              <th>Item Type<span class="asterisk">*</span></th>
                              <td>
                                  <select class="form-control" id="item_type" name="item_type" placeholder="item_type" data-size="5" data-live-search="true" required>
                                    
                                    <option value="veg" @if(isset($Record)) @if($Record->item_type == 'veg') {{ 'selected' }} @endif @endif>Veg</option>
                                    <option value="non_veg" @if(isset($Record)) @if($Record->item_type == 'non_veg') {{ 'selected' }} @endif @endif>Non Veg</option>
                                    <option value="vegan" @if(isset($Record)) @if($Record->item_type == 'vegan') {{ 'selected' }} @endif @endif>Vegan</option>
                                    
                                </select>

                              </td>
                           </tr>

                         
                           <tr>
                              <th>Categories<span class="asterisk">*</span></th>
                              <td>
                                  <select class="form-control" id="category_id" name="category_id" placeholder="category_id" data-size="5" data-live-search="true">
                                    
                                    <option value="">Select Categories</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if(isset($Record->category_id)) @if($Record->category_id == $category->id) {{ 'selected' }} @endif @endif >
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                    
                                </select>

                                <div class="badge badge-pill badge-danger" id="categoryCheck" role="alert">Category is required </div>

                              </td>
                           </tr>

                           <tr>
                              <th>Attributes<span class="asterisk">*</span></th>
                              <td>
                                 {{ Form::text('dish_attributes', old('dish_attributes'), ['class' => 'form-control','id' => 'dish_attributes','placeholder' => 'Attributes']) }}

                                  <div class="badge badge-pill badge-danger" id="attributesCheck" role="alert"> Attributes is required </div>
                              </td> 
                           </tr>



                           <tr>
                              <th>Addons<span class="asterisk">*</span></th>
                              <td>
                                {{ Form::textarea('addons', old('addons'), ['class' => 'form-control','id' => 'addons', 'rows' => 3, 'placeholder' => 'Addons']) }}

                                 
                                 <div class="badge badge-pill badge-danger" id="addOnCheck" role="alert"> Addons is required </div>
                              </td>
                          </tr> 

                          <tr>
                              <th>Available Time Starts<span class="asterisk">*</span></th>
                              <td>
                                 {{ Form::time('available_time_starts', old('available_time_starts'), ['class' => 'form-control','id' => 'available_time_starts','placeholder' => 'Available Time Starts']) }}

                                  <div class="badge badge-pill badge-danger" id="startTimeCheck" role="alert"> Available Time Starts is required </div>
                              </td>
                           </tr>

                           <tr>
                              <th>Available Time Ends<span class="asterisk">*</span></th>
                              <td>
                                 {{ Form::time('available_time_ends', old('available_time_ends'), ['class' => 'form-control','id' => 'available_time_ends','placeholder' => 'Available Time Ends']) }}

                                  <div class="badge badge-pill badge-danger" id="endTimeCheck" role="alert"> Available Time Ends is required </div>
                              </td>
                           </tr>

                           <tr>
                              <th>Preparation Time<span class="asterisk">*</span></th>
                              <td>
                                 {{ Form::number('preparation_time', old('preparation_time'), ['class' => 'form-control','id' => 'preparation_time','placeholder' => 'Preparation Time','min' => 0,'maxlength' => 10 , 'oninput' => "javascript: if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"]) }}

                                  <div class="badge badge-pill badge-danger" id="PreparationTimeCheck" role="alert"> Preparation Time is required </div>
                              </td>
                           </tr>



                           <tr>
                              <th>Metadata<span class="asterisk">*</span></th>
                              <td>
                                 {{ Form::text('metadata', old('metadata'), ['class' => 'form-control','id' => 'metadata','placeholder' => 'Metadata', 'onkeypress' => "return onlyAlphabets(event,this);"]) }}

                                  <div class="badge badge-pill badge-danger" id="metadataCheck" role="alert"> Metadata is required </div>
                              </td> 
                           </tr>


                           <tr>
                              <th>Image<span class="asterisk">*</span></th>
                              <td>
                                @if(isset($Record))
                                    @if(isset($Record->image))
                                        <img src="{{ asset('admin/dishes/'.$Record->image) }}" width="50px" height="50px">
                                    <br><br>
                                    @endif
                                 @endif
                                 {{ Form::file('image', ['class' => 'form-control-file','id'=> 'image']) }}
                                  
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
    $("#nameCheck").hide();
       let nameError = true;
       $("#name").on('keyup blur', function () {
           validateName();
       });
       
       function validateName() {
           let nameValue = $("#name").val();
           if (nameValue.length == "") {
               $("#nameCheck").show();
               nameError = false;
               return false;
           } else {
               $("#nameCheck").hide();
               nameError = true;
               return true;
           }
       }

       $("#attributesCheck").hide();
       let attributesError = true;
       $("#dish_attributes").on('keyup blur', function () {
           validateAttributes();
       });
       
       function validateAttributes() {
           let attributesValue = $("#dish_attributes").val();
           if (attributesValue.length == "") {
               $("#attributesCheck").show();
               attributesError = false;
               return false;
           } else {
               $("#attributesCheck").hide();
               attributesError = true;
               return true;
           }
       }
  


       $("#descriptionCheck").hide();
       let descriptionError = true;
       $("#description").on('keyup blur', function () {
           validateDescription();
       });
       
       function validateDescription() {
           let usernameValue = $("#description").val();
           if (usernameValue.length == "") {
               $("#descriptionCheck").show();
               descriptionError = false;
               return false;
           } else {
               $("#descriptionCheck").hide();
               descriptionError = true;
               return true;
           }
       }


       $("#addOnCheck").hide();
       let addOnError = true;
       $("#addons").on('keyup blur', function () {
           validateAddons();
       });
       
       function validateAddons() {
           let usernameValue = $("#addons").val();
           if (usernameValue.length == "") {
               $("#addOnCheck").show();
               addOnError = false;
               return false;
           } else {
               $("#addOnCheck").hide();
               addOnError = true;
               return true;
           }
       }

       $("#displayPriceCheck").hide();
    let displayPriceError = true;
    $("#display_price").on('keyup blur', function () {
        validateDisplayPrice();
    });

    function validateDisplayPrice() {
        let dPValue = $("#display_price").val();
        if (dPValue.length == "") {
            $("#displayPriceCheck").show();
            displayPriceError = false;
            return false;
        } else {
            $("#displayPriceCheck").hide();
            displayPriceError = true;
            return true;
        }
    }

    $("#maxSellerPriceCheck").hide();
    let maxSellerPriceError = true;
    $("#maximum_seller_price").on('keyup blur', function () {
        validateMaxSellerPrice();
    });

    function validateMaxSellerPrice() {
        let mspValue = $("#maximum_seller_price").val();
        if (mspValue.length == "") {
            $("#maxSellerPriceCheck").show();
            maxSellerPriceError = false;
            return false;
        } else {
            $("#maxSellerPriceCheck").hide();
            maxSellerPriceError = true;
            return true;
        }
    }


    $("#discountCheck").hide();
    let discountError = true;
    $("#discount").on('keyup blur', function () {
        validateDiscount();
    });

    function validateDiscount() {
        let discountValue = $("#discount").val();
        if (discountValue.length == "") {
            $("#discountCheck").show();
            discountError = false;
            return false;
        } else {
            $("#discountCheck").hide();
            discountError = true;
            return true;
        }
    }



    $("#categoryCheck").hide();
       let categoryError = true;
       $("#category_id").on('change blur', function () {
           validateCategory();
       });
       
       function validateCategory() {
           let categoryValue = $("#category_id").val();
           if (categoryValue.length == "") {
               $("#categoryCheck").show();
               categoryError = false;
               return false;
           } else {
               $("#categoryCheck").hide();
               categoryError = true;
               return true;
           }
       }

       $("#startTimeCheck").hide();
    let startTimeError = true;
    $("#available_time_starts").on('keyup blur', function () {
        validatStartTime();
    });

    function validatStartTime() {
        let timeFromValue = $("#available_time_starts").val();
        if (timeFromValue.length == "") {
            $("#startTimeCheck").show();
            startTimeError = false;
            return false;
        } else {
            $("#startTimeCheck").hide();
            startTimeError = true;
            return true;
        }
    }


    $("#endTimeCheck").hide();
    let endTimeError = true;
    $("#available_time_ends").on('keyup blur', function () {
        validatEndTime();
    });

    function validatEndTime() {
        let timeToValue = $("#available_time_ends").val();
        if (timeToValue.length == "") {
            $("#endTimeCheck").show();
            endTimeError = false;
            return false;
        } else {
            $("#endTimeCheck").hide();
            endTimeError = true;
            return true;
        }
    }


    $("#PreparationTimeCheck").hide();
    let preparationTimeError = true;
    $("#preparation_time").on('keyup blur', function () {
        validatPreparationTime();
    });

    function validatPreparationTime() {
        let ptimeValue = $("#preparation_time").val();
        if (ptimeValue.length == "") {
            $("#PreparationTimeCheck").show();
            preparationTimeError = false;
            return false;
        } else {
            $("#PreparationTimeCheck").hide();
            preparationTimeError = true;
            return true;
        }
    }


    $("#metadataCheck").hide();
    let metadataError = true;
    $("#metadata").on('keyup blur', function () {
        validatMetadata();
    });

    function validatMetadata() {
        let metadataValue = $("#metadata").val();
        if (metadataValue.length == "") {
            $("#metadataCheck").show();
            metadataError = false;
            return false;
        } else {
            $("#metadataCheck").hide();
            metadataError = true;
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
        
        validateName();
        validateDescription();
        validateDisplayPrice();
        validateMaxSellerPrice();
        validateDiscount();
        validateCategory();
        validateAttributes();
        validateAddons();
        validatStartTime();
        validatEndTime();
        validatPreparationTime();
        validateImage();
        validatMetadata();


        if (displayPriceError == false || 
            descriptionError == false ||
            nameError == false ||
            maxSellerPriceError == false ||
            categoryError == false ||
            discountError == false ||
            attributesError == false ||
            startTimeError == false ||
            endTimeError == false ||
            addOnError == false ||
            preparationTimeError == false ||
            metadataError == false ||
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
