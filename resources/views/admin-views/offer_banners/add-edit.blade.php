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
                              <th>Title<span class="asterisk">*</span></th>
                              <td>
                                 {{ Form::text('title', old('title'), ['class' => 'form-control','id' => 'title','placeholder' => 'Title', 'onkeypress' => "return onlyAlphabets(event,this);"]) }}
                                  <div class="badge-danger" id="titleCheck" role="alert"></div>
                              </td>
                           </tr>

                           <tr>
                              <th>Banner Type<span class="asterisk">*</span></th>
                              <td>
                                <select class="form-control" name="type" id="type">
                                    <option value="resturant_wise"  @if(isset($Record)) @if($Record->type == 'resturant_wise') {{ 'selected' }} @endif @endif>Resturant Wise</option>
                                    <option value="food_wise"  @if(isset($Record)) @if($Record->type == 'food_wise') {{ 'selected' }} @endif @endif>Food Wise</option>
                                </select>
                              </td>
                           </tr>   

                           <tr>
                              <th>Status<span class="asterisk">*</span></th>
                              <td>
                                <select class="form-control" name="status" id="status">
                                    <option value="1" @if(isset($Record)) @if($Record->status == 1) {{ 'selected' }} @endif @endif>Active</option>
                                    <option value="0" @if(isset($Record)) @if($Record->status == 0) {{ 'selected' }} @endif @endif>Inactive</option>
                                </select>
                              </td>
                           </tr>                   

                           <tr>
                              <th>Image<span class="asterisk">*</span></th>
                              <td>
                                @if(isset($Record))
                                    @if(isset($Record->image))
                                        <img src="{{ asset('images/offer_banners/'.$Record->image) }}" style="max-width: 50%;">
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
               $("#titleCheck").html('Title is required');
               titleError = false;
               return false;
           } else {
               $("#titleCheck").hide();
               titleError = true;
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
            validateImage();


            if (titleError == false || 
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
