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
                            <a class="btn btn-lg btn-primary" href="{{ route($RoutePrefixName.'.list') }}">Back</a>
                            </div>
                        </div>   
                  <h4><h2>@if(isset($Record)) {{ $RecordEditModule }} @else {{ $RecordAddModule }} @endif</h2>   </h4>
               </div>
               <div class="card-body">
                    
                    @if(isset($Record))
                      {{ Form::model($Record,['route'=>[$RoutePrefixName.'.update', $Record->id], 'method'=>'POST','id'=>'form_validation','enctype'=>'multipart/form-data']) }}
                    @else
                      {{ Form::open(['route'=>$RoutePrefixName.'.store', 'method'=>'POST','id'=>'form_validation','enctype'=>'multipart/form-data']) }}
                    @endif
                     @csrf
                     <table class="table table-bordered datatable">
                        <tbody>

                           <tr>
                              <th>Restaurant<span class="asterisk">*</span></th>
                              <td>
                                 <select name="restaurant_id" id="restaurant_id" class="form-control js-select2-custom">
                                     <option value="">Select Restaurant</option>
                                     @foreach($restaurant as $value)
                                     <option value="{{ $value->id }}"  @if(isset($Record)) @if($Record->restaurant_id == $value->id ) {{ 'selected' }} @endif @endif>{{ $value->name }}</option>
                                     @endforeach
                                 </select>
                                  <div class="badge-danger" id="restaurantCheck" role="alert"></div>
                              </td>
                           </tr>

                           <tr>
                              <th>Name<span class="asterisk">*</span></th>
                              <td>
                                 {{ Form::text('name', old('name'), ['class' => 'form-control','id' => 'name','placeholder' => 'Name']) }}
                                  <div class="badge-danger" id="nameCheck" role="alert"></div>
                              </td>
                           </tr>

                           <tr>
                              <th>Seller Price<span class="asterisk">*</span></th>
                              <td>
                               {{ Form::text('price', old('price'), ['class' => 'form-control','id' => 'price','placeholder' => 'Seller Price','min' => 0,'maxlength' => 10 , 'oninput' => "javascript: if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"]) }}
                                <div class="badge-danger" id="sellerPriceCheck" role="alert"></div>
                                 
                              </td>
                          </tr>                  

                          <tr>
                              <th>Display Price<span class="asterisk">*</span></th>
                              <td>
                               {{ Form::text('display_price', old('display_price'), ['class' => 'form-control','id' => 'display_price','placeholder' => 'Display Price','min' => 0,'maxlength' => 10 , 'oninput' => "javascript: if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"]) }}
                                <div class="badge-danger" id="displayPriceCheck" role="alert"></div>
                                 
                              </td>
                          </tr>                   

                          <tr>
                              <th>Description<span class="asterisk">*</span></th>
                              <td>
                               {{ Form::textarea('description', old('description'), ['class' => 'form-control','id' => 'description', 'rows' => 3, 'placeholder' => 'Description']) }}
                                <div class="badge-danger" id="descriptionCheck" role="alert"></div>
                                 
                              </td>
                          </tr>                  

                          <tr>
                              <th>Discount<span class="asterisk">*</span></th>
                              <td>
                               {{ Form::text('discount', old('discount'), ['class' => 'form-control','id' => 'discount','placeholder' => 'Discount','min' => 0,'maxlength' => 10 , 'oninput' => "javascript: if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"]) }}
                                <div class="badge-danger" id="discountCheck" role="alert"></div>
                                 
                              </td>
                          </tr>  


                          <tr>
                              <th>Discount Type<span class="asterisk">*</span></th>
                              <td>
                               <select class="form-control" id="discount_type" name="discount_type" placeholder="discount_type" data-size="5" data-live-search="true" required>
                                    <option value="Amount" @if(isset($Record)) @if($Record->discount_type == 'Amount') {{ 'selected' }} @endif @endif>Amount</option>
                                    <option value="Percentage" @if(isset($Record)) @if($Record->discount_type == 'Percentage') {{ 'selected' }} @endif @endif>Percentage</option>
                                </select>
                                 
                              </td>
                          </tr>                                    

                        </tbody>
                     </table>
                     <div class="float-right">
                        <button class="btn btn-success" id="submit" type="submit">Save</button>
                        <a class="btn btn-primary" href="{{ route($RoutePrefixName.'.list') }}">Exit</a>
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
        $("#restaurantCheck").hide();
        let restaurantError = true;
        $("#restaurant_id").on('change blur', function () {
            validateRestaurant();
        });
       
        function validateRestaurant() {
           let categoryValue = $("#restaurant_id").val();
           if (categoryValue.length == "") {
               $("#restaurantCheck").show();
               $("#restaurantCheck").html('Restaurant are required');
               restaurantError = false;
               return false;
           } else {
               $("#restaurantCheck").hide();
               restaurantError = true;
               return true;
           }
        }


        $("#nameCheck").hide();
        let nameError = true;
        $("#name").on('keyup blur', function () {
               validateName();
        });
       
        function validateName() {
           let passNameValue = $("#name").val();
           if (passNameValue.length == "") {
               $("#nameCheck").show();
               $("#nameCheck").html('Addon Name is required');
               nameError = false;
               return false;
           } else {
               $("#nameCheck").hide();
               nameError = true;
               return true;
           }
        }


        $("#sellerPriceCheck").hide();
        let priceError = true;
        $("#price").on('keyup blur', function () {
               validateSellerPrice();
        });
       
        function validateSellerPrice() {
           let sPriceValue = $("#price").val();
           let regex = /^\d*(?:\.\d{1,2})?$/;
           if (sPriceValue.length == "") {
               $("#sellerPriceCheck").show();
               $("#sellerPriceCheck").html('Seller Price is required');
               priceError = false;
               return false;
           } 
           else if(!regex.test(sPriceValue)) {
                $("#sellerPriceCheck").show();
                $("#sellerPriceCheck").html("Please Enter Numeric Value Only.");
                priceError = false;
                return false;
            } 
           else {
               $("#sellerPriceCheck").hide();
               priceError = true;
               return true;
           }
        }


        $("#displayPriceCheck").hide();
        let dispPriceError = true;
        $("#display_price").on('keyup blur', function () {
               validateDisplayPrice();
        });
       
        function validateDisplayPrice() {
           let dispPriceValue = $("#display_price").val();
           let regex = /^\d*(?:\.\d{1,2})?$/;
           if (dispPriceValue.length == "") {
               $("#displayPriceCheck").show();
               $("#displayPriceCheck").html('Display Price is required');
               dispPriceError = false;
               return false;
           }
           else if(!regex.test(dispPriceValue)) {
                $("#displayPriceCheck").show();
                $("#displayPriceCheck").html("Please Enter Numeric Value Only.");
                dispPriceError = false;
                return false;
            } 
            else {
               $("#displayPriceCheck").hide();
               dispPriceError = true;
               return true;
           }
        }


        $("#descriptionCheck").hide();
        let descriptionError = true;
        $("#description").on('keyup blur', function () {
               validateDescription();
        });
       
        function validateDescription() {
           let descriptionValue = $("#description").val();
           if (descriptionValue.length == "") {
               $("#descriptionCheck").show();
               $("#descriptionCheck").html('Description is required');
               descriptionError = false;
               return false;
           } else {
               $("#descriptionCheck").hide();
               descriptionError = true;
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
           let regex = /^\d*(?:\.\d{1,2})?$/;
           if (discountValue.length == "") {
               $("#discountCheck").show();
               $("#discountCheck").html('Discount is required');
               discountError = false;
               return false;
           } 

           else if(!regex.test(discountValue)) {
                $("#discountCheck").show();
                $("#discountCheck").html("Please Enter Numeric Value Only.");
                discountError = false;
                return false;
            } 
           else {
               $("#discountCheck").hide();
               discountError = true;
               return true;
           }
        }


        $('#submit').on('click', function(event) {
            
            validateRestaurant();
            validateName();
            validateSellerPrice();
            validateDisplayPrice();
            validateDescription();
            validateDiscount();


            if (restaurantError == false ||
                nameError == false ||
                priceError == false ||
                dispPriceError == false ||
                discountError == false ||
                descriptionError == false
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
