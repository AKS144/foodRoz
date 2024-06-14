@extends('layouts.admin.app')

@section('title',__('messages.landing_page_settings'))

@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{asset('public/assets/admin/css/croppie.css')}}" rel="stylesheet">
    <style>
        .flex-item{
            padding: 10px;
            flex: 20%;
        }

        /* Responsive layout - makes a one column-layout instead of a two-column layout */
        @media (max-width: 768px) {
            .flex-item{
                flex: 50%;
            }
        }

        @media (max-width: 480px) {
            .flex-item{
                flex: 100%;
            }
        }
    </style>
@endpush

@section('content')
<div class="content container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('messages.dashboard')}}</a></li>
            <li class="breadcrumb-item" aria-current="page">{{__('messages.landing_page_settings')}}</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-header-title">{{__('messages.landing_page_settings')}}</h1>
        <!-- Nav Scroller -->
        <div class="js-nav-scroller hs-nav-scroller-horizontal">
            <!-- Nav -->
            <ul class="nav nav-tabs page-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('admin.business-settings.landing-page-settings', 'index')}}">{{__('messages.text')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.business-settings.landing-page-settings', 'links')}}"  aria-disabled="true">{{__('messages.button_links')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.business-settings.landing-page-settings', 'heroslider')}}"  aria-disabled="true">{{__('messages.heroSlider')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.business-settings.landing-page-settings', 'ribboncms')}}"  aria-disabled="true">{{__('messages.ribbonSlider')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.business-settings.landing-page-settings', 'speciality')}}"  aria-disabled="true">{{__('messages.speciality')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.business-settings.landing-page-settings', 'testimonial')}}"  aria-disabled="true">{{__('messages.testimonial')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.business-settings.landing-page-settings', 'image')}}"  aria-disabled="true">{{__('messages.image')}}</a>
                </li>
            </ul>
            <!-- End Nav -->
        </div>
        <!-- End Nav Scroller -->
    </div>
        <!-- End Page Header -->
    <!-- Page Heading -->

    <div class="card my-2">
        <div class="card-body">
            <form action="{{route('admin.business-settings.landing-page-settings', 'text')}}" method="POST">
                @php($landing_page_text = \App\Models\BusinessSetting::where(['key'=>'landing_page_text'])->first())
                @php($landing_page_text = isset($landing_page_text->value)?json_decode($landing_page_text->value, true):null)

                @csrf
                <div class="form-group">
                    <label for="header_title_1">{{__('messages.header_title_1')}}</label>
                    <input type="text" id="header_title_1" name="header_title_1" class="form-control" value="{{isset($landing_page_text)?$landing_page_text['header_title_1']:''}}">
                </div>
                <div class="form-group">
                    <label for="header_title_2">{{__('messages.header_title_2')}}</label>
                    <input type="text" id="header_title_2" name="header_title_2" class="form-control" value="{{isset($landing_page_text)?$landing_page_text['header_title_2']:''}}">
                </div>
                <div class="form-group">
                    <label for="header_title_3">{{__('messages.header_title_3')}}</label>
                    <input type="text" id="header_title_3" name="header_title_3" class="form-control" value="{{isset($landing_page_text)?$landing_page_text['header_title_3']:''}}">
                </div>
                <div class="form-group">
                    <label for="about_title">{{__('messages.about_title')}}</label>
                    <input type="text" id="about_title" name="about_title" class="form-control" value="{{isset($landing_page_text)?$landing_page_text['about_title']:''}}">
                </div>
                <div class="form-group">
                    <label for="ribbon_header">{{__('messages.ribbon_header')}}</label>
                    <input type="text" id="ribbon_header" name="ribbon_header" class="form-control" value="{{isset($landing_page_text['ribbon_header'])?$landing_page_text['ribbon_header']:''}}">
                </div>
                <div class="form-group">
                    <label for="why_choose_us">{{__('messages.why_choose_us')}}</label>
                    <input type="text" id="why_choose_us" name="why_choose_us" class="form-control" value="{{isset($landing_page_text)?$landing_page_text['why_choose_us']:''}}">
                </div>
                <div class="form-group">
                    <label for="why_choose_us_title">{{__('messages.why_choose_us_title')}}</label>
                    <input type="text" id="why_choose_us_title" name="why_choose_us_title" class="form-control" value="{{isset($landing_page_text)?$landing_page_text['why_choose_us_title']:''}}">
                </div>
                <div class="form-group">
                    <label for="testimonial_title">{{__('messages.testimonial_title')}}</label>
                    <input type="text" id="testimonial_title" name="testimonial_title" class="form-control" value="{{isset($landing_page_text)?$landing_page_text['testimonial_title']:''}}">
                </div>
                <div class="form-group">
                    <label for="footer_article">{{__('messages.footer_article')}}</label>
                    <textarea type="text" id="footer_article" name="footer_article" class="form-control">{{isset($landing_page_text)?$landing_page_text['footer_article']:''}}</textarea>
                </div>
                <div class="form-group">
                    <label for="seo_description">{{__('messages.seo_description')}}</label>
                    <textarea type="text" id="seo_description" name="seo_description" class="form-control">{{isset($landing_page_text)?$landing_page_text['seo_description']:''}}</textarea>
                </div>

                 <div class="form-group">
                    <label for="seo_keywords">{{__('messages.seo_keywords')}}</label>
                    <textarea type="text" id="seo_keywords" name="seo_keywords" class="form-control">{{isset($landing_page_text)?$landing_page_text['seo_keywords']:''}}</textarea>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="{{__('messages.submit')}}">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script_2')
    
@endpush