@extends('layouts.landing.app')
@section('title',\App\Models\BusinessSetting::where(['key'=>'business_name'])->first()->value??'Stack Food')
@section('content')
<main>
   @php($front_end_url=\App\Models\BusinessSetting::where(['key'=>'front_end_url'])->first())
   @php($front_end_url=$front_end_url?$front_end_url->value:null)
   @php($landing_page_text = \App\Models\BusinessSetting::where(['key'=>'landing_page_text'])->first())
   @php($landing_page_text = isset($landing_page_text->value)?json_decode($landing_page_text->value, true):null)
   @php($landing_page_links = \App\Models\BusinessSetting::where(['key'=>'landing_page_links'])->first())
   @php($landing_page_links = isset($landing_page_links->value)?json_decode($landing_page_links->value, true):null)
   @php($landing_page_images = \App\Models\BusinessSetting::where(['key'=>'landing_page_images'])->first())
   @php($landing_page_images = isset($landing_page_images->value)?json_decode($landing_page_images->value, true):null)
   @php($heroSlider = \App\Models\BusinessSetting::where(['key'=>'heroSlider'])->first())
   @php($heroSlider = isset($heroSlider->value)?json_decode($heroSlider->value, true):null)

   @php($occasionsSlider = \App\Models\BusinessSetting::where(['key'=>'occasions'])->first())
   @php($occasionsSlider = isset($occasionsSlider->value)?json_decode($occasionsSlider->value, true):null)

   <div class="main-body-div">
      @if($heroSlider)
      <!-- Hero carousel -->
      <div id="hero-owl-carousel" class="hero-owl-carousel owl-theme">
         @foreach ($heroSlider as $hs)
         <div class="slide" style="background-image:url({{asset('public/assets/landing/image')}}/{{$hs['img']}});">
            <div class="slide-content">
               <h1>{{$hs['title']}}</h1>
               <p>{{$hs['desc']}}</p>
            </div>
         </div>
         @endforeach
      </div>
      <!-- Hero carousel End-->
      @endif

      <!-- Occasions carousel Starts-->
      @if($occasionsSlider)
      <div id="occasions-owl-carousel" class="hero-owl-carousel owl-theme">
         @foreach ($occasionsSlider as $hs)
         <div class="slide" style="background-image:url({{asset('public/assets/landing/image')}}/{{$hs['img']}});">
            <div class="slide-content">
               <h1>{{$hs['title']}}</h1>
               <p><a href="" target="_blank">{{$hs['desc']}}</a></p>
            </div>
         </div>
         @endforeach
      </div>
      @endif
      <!-- Occasions carousel End-->
      

      <!-- Top Start -->
      <section class="top-start">
         <div class="container ">
            <div class="row">
               <div class="row col-lg-7 top-content">
                  <div>
                     <h3 class="d-flex justify-content-center justify-content-md-start text-center text-md-left">
                        {{isset($landing_page_text)?$landing_page_text['header_title_1']:''}}
                     </h3>
                     <span
                        class="d-flex justify-content-center justify-content-md-start text-center text-md-left">
                     {{isset($landing_page_text)?$landing_page_text['header_title_2']:''}}
                     </span>
                     <h4 class="d-flex justify-content-center justify-content-md-start text-center text-md-left">
                        {{isset($landing_page_text)?$landing_page_text['header_title_3']:''}}
                     </h4>
                     @if($landing_page_links['web_app_url_status'])
                     <div class="web-button" >
                        <a href="{{$landing_page_links['web_app_url']}}">
                           <!-- <img src="{{asset('public/assets/landing')}}/image/find_food.png"> -->
                           Find Nearby Food
                        </a>
                     </div>
                     @endif
                  </div>
                  <div class="download-buttons">
                     @if($landing_page_links['app_url_android_status'])
                     <div class="play-store">
                        <a href="{{$landing_page_links['app_url_android']}}">
                        <img src="{{asset('public/assets/landing')}}/image/play_store.png">
                        </a>
                     </div>
                     @endif
                     @if($landing_page_links['app_url_ios_status'])
                     <div class="apple-store">
                        <a href="{{$landing_page_links['app_url_ios']}}">
                        <img src="{{asset('public/assets/landing')}}/image/apple_store.png">
                        </a>
                     </div>
                     @endif
                  </div>
               </div>
               <div
                  class="col-lg-5 d-flex justify-content-center justify-content-md-end text-center text-md-right top-image">
                  <img src="{{asset('public/assets/landing')}}/image/{{isset($landing_page_images)?$landing_page_images['top_content_image']:'double_screen_image.png'}}">
               </div>
            </div>
         </div>
      </section>
      <!-- Top End -->
      <!-- About Us Start -->
      <section class="about-us">
         <div class="container">
            <div class="row featured-section">
               <div class="col-12 featured-title-m">
                  <span>{{__('messages.about_us')}}</span>
               </div>
               <div
                  class="col-lg-6 col-md-6  d-flex justify-content-center justify-content-md-start text-center text-md-left featured-section__image">
                  <img src="{{asset('public/assets/landing')}}/image/{{isset($landing_page_images)?$landing_page_images['about_us_image']:'about_us_image.png'}}"></img>
               </div>
               <!-- <div class="col-lg-3 col-md-0"></div> -->
               <div class="col-lg-6 col-md-6">
                  <div class="featured-section__content"
                     class="d-flex justify-content-center justify-content-md-start text-center text-md-left">
                     <span>{{__('messages.about_us')}}</span>
                     <h2
                        class="d-flex justify-content-center justify-content-md-start text-center text-md-left">
                        {{isset($landing_page_text)?$landing_page_text['about_title']:''}}
                     </h2>
                     <p
                        class="d-flex justify-content-center justify-content-md-start text-center text-md-left">
                        {!! \Illuminate\Support\Str::limit(\App\CentralLogics\Helpers::get_settings('about_us'),200) !!}
                     </p>
                     <div
                        class="d-flex justify-content-center justify-content-md-start text-center text-md-left">
                        <a href="{{route('about-us')}}"
                           class="btn btn-color-primary text-white rounded align-middle">{{__('messages.read_more')}}</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- About Us End -->
      <!-- Contact Us Start -->
      <section class="about-us">
         <div class="container">
            <div class="row featured-section">
               <div class="col-12 featured-title-m">
                  <span>Contact Us</span>
               </div>
               <div
                  class="col-lg-6 col-md-6  d-flex justify-content-center justify-content-md-start text-center text-md-left featured-section__image">
                  <img src="{{asset('public/assets/landing')}}/image/{{isset($landing_page_images)?$landing_page_images['contact_us_image']:'about_us_image.png'}}"></img>
               </div>
               <!-- <div class="col-lg-3 col-md-0"></div> -->
               <div class="col-lg-6 col-md-6">
                  <div class="featured-section__content"
                     class="d-flex justify-content-center justify-content-md-start text-center text-md-left">
                     <span>Contact Us</span>
                     <!-- <h2
                        class="d-flex justify-content-center justify-content-md-start text-center text-md-left">
                        Phone : {{\App\CentralLogics\Helpers::get_settings('phone')}},
                        Email : {{\App\CentralLogics\Helpers::get_settings('email_address')}}
                     </h2> -->
                     <p
                        class="d-flex justify-content-center justify-content-md-start text-center text-md-left">
                        Phone : {{\App\CentralLogics\Helpers::get_settings('phone')}},
                     </p>
                     <p
                        class="d-flex justify-content-center justify-content-md-start text-center text-md-left">
                        Email : {{\App\CentralLogics\Helpers::get_settings('email_address')}}
                     </p>
                     <p
                        class="d-flex justify-content-center justify-content-md-start text-center text-md-left">
                        Address : {{\App\CentralLogics\Helpers::get_settings('address')}}
                     </p>
                     <div
                        class="d-flex justify-content-center justify-content-md-start text-center text-md-left">
                        <a href="{{route('contact-us')}}"
                           class="btn btn-color-primary text-white rounded align-middle">Contact Here</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- Contact Us End -->
      <!-- Ribbon CMS Start -->
      @php($ribboncms = \App\Models\BusinessSetting::where(['key'=>'ribboncms'])->first())
      @php($ribboncms = isset($ribboncms->value)?json_decode($ribboncms->value, true):null)
      @if(isset($ribboncms) && count($ribboncms)>0)
      <section id="slideContact Usdiv class="container">
            <h1 class="text-center"><b>{{isset($landing_page_text['ribbon_header'])?$landing_page_text['ribbon_header']:''}}</b></h1>
            <div class="slider">
               <div id="ribboncms-owl-carousel" class="owl-carousel">
                  @foreach ($ribboncms as $key => $sp)
                  <div class="slider-card">
                     <div class="d-flex justify-content-center align-items-center mb-4">
                        <img src="{{asset('public/assets/landing/image')}}/{{$sp['img']}}" alt="" >
                     </div>
                     <h5 class="mb-0 text-center"><b>{!! \Illuminate\Support\Str::limit($sp['title'],50) !!}</b></h5>
                     <p class="text-center p-4">{!! \Illuminate\Support\Str::limit($sp['desc'],50) !!}</p>
                     <a href="{{route('ribbon-view', $key)}}"
                        class="btn btn-color-primary text-white rounded align-middle">{{__('messages.read_more')}}</a>
                  </div>
                  @endforeach
               </div>
            </div>
         </div>
      </section>
      @endif
      <!-- Ribbon CMS End -->
      <!-- Why Choose Us Start -->
      @php($speciality = \App\Models\BusinessSetting::where(['key'=>'speciality'])->first())
      @php($speciality = isset($speciality->value)?json_decode($speciality->value, true):null)
      @if(isset($speciality) && count($speciality)>0)
      <section class="why-choose-us">
         <div class="container">
            <div class="row choosing-section">
               <div class="choosing-section__title">
                  <div>
                     <h2>{{isset($landing_page_text)?$landing_page_text['why_choose_us']:''}}</h2>
                     <span>{{isset($landing_page_text)?$landing_page_text['why_choose_us_title']:''}}</span>
                     <hr class="customed-hr-1">
                  </div>
               </div>
               <div class="choosing-section__content">
                  @foreach ($speciality as $sp)
                  <div>
                     <div class="choosing-section__image-card">
                        <img src="{{asset('public/assets/landing')}}/image/{{$sp['img']}}"></img>
                     </div>
                     <div style="margin: 0px 55px 30px 54px">
                        <p>{{$sp['title']}}</p>
                     </div>
                  </div>
                  @endforeach
                  <!-- <div>
                     <div class="choosing-section__image-card">
                         <img src="{{asset('public/assets/landing')}}/image/best_dishes_icon.png"></img>
                     </div>
                     <div style="margin: 0px 54px 30px 55px">
                         <p>Best Dishes Near You</p>
                     </div>
                     </div>
                     
                     <div>
                     <div class="choosing-section__image-card">
                         <img
                             src="{{asset('public/assets/landing')}}/image/virtual_restaurant_icon.png"></img>
                     </div>
                     <div style="margin: 0px 31px 30px 31px">
                         <p>Your Own Virtual Restaurant</p>
                     </div>
                     </div> -->
               </div>
            </div>
         </div>
      </section>
      @endif
      <!-- Why Choose Us End -->
      @php($testimonial = \App\Models\BusinessSetting::where(['key'=>'testimonial'])->first())
      @php($testimonial = isset($testimonial->value)?json_decode($testimonial->value, true):null)
      <!-- Trusted Customers Starts -->
      @if($testimonial && count($testimonial)>0)
      <section class="trusted-customers">
         <div class="container">
            <div class="trusted_customers__title">
               <span class="trusted-customer mt-4" style="font-size: 33px">{{isset($landing_page_text)?$landing_page_text['testimonial_title']:''}}</span>
            </div>
            <div class="mt-5">
               <div class="demo">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-12">
                           <div id="testimonial-slider" class="owl-carousel">
                              @foreach($testimonial as $data)
                              <div class="testimonial">
                                 <div class="pic">
                                    <img src="{{asset('public/assets/landing')}}/image/{{$data['img']}}"
                                       alt="">
                                 </div>
                                 <div class="testimonial-content">
                                    <h3 class="testimonial-title">
                                       {{$data['name']}}
                                       <small class="post">{{$data['position']}}</small>
                                    </h3>
                                    <p class="description">
                                       {{$data['detail']}}
                                    </p>
                                 </div>
                              </div>
                              @endforeach
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      @endif
      <!-- Trusted Customers Ends -->
   </div>
</main>
@endsection