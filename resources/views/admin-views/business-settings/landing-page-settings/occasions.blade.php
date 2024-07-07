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
                    <a class="nav-link" href="{{route('admin.business-settings.landing-page-settings', 'index')}}">{{__('messages.text')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('admin.business-settings.landing-page-settings', 'occasions')}}"  aria-disabled="true">Occasions</a>
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
            <form action="{{route('admin.business-settings.landing-page-settings', 'occasions')}}" method="POST" enctype="multipart/form-data">
                @php($occasion_slider = \App\Models\BusinessSetting::where(['key'=>'occasions'])->first())
                @php($occasion_slider = isset($occasion_slider->value)?json_decode($occasion_slider->value, true):null)

                @csrf

                <div class="form-group">
                    <label class="input-label" for="occasion_slider_title">{{__('messages.heroSlider_title')}}</label>
                    <input type="text" id="occasion_slider_title"  name="occasion_slider_title" class="form-control" >
                </div>
                <div class="form-group">
                    <label class="input-label" for="occasion_slider_desc">{{__('messages.heroSlider_desc')}}</label>
                    <textarea type="text-area" id="occasion_slider_desc"  name="occasion_slider_desc" class="form-control" ></textarea>
                </div>
                <div class="form-group">
                    <label class="input-label" >{{__('messages.heroSlider_img')}}<small style="color: red">* ( {{__('messages.size')}}: high-resolution )</small></label>
                    <div class="custom-file">
                        <input type="file" name="image" id="customFileEg1" class="custom-file-input"
                                accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" required>
                        <label class="custom-file-label" for="customFileEg1">{{__('messages.choose')}} {{__('messages.file')}}</label>
                    </div>

                    <center style="display: none" id="image-viewer-section" class="pt-2">
                        <img style="height: 200px;border: 1px solid; border-radius: 10px;" id="viewer"
                                src="{{asset('public/assets/admin/img/400x400/img2.jpg')}}" alt=""/>
                    </center>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="{{__('messages.submit')}}">
                </div>
            </form>
            <div class="col-12">
                <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table" style="border-spacing: 0px;white-space:nowrap;table-layout: fixed; width: 100%;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{__('messages.image')}}</th>
                            <th style="word-wrap: break-word" scope="col">SLIDE HEADER</th>
                            <th style="word-wrap: break-word" scope="col">SLIDE DESCRIPTION</th>
                            <th scope="col">{{__('messages.action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($occasion_slider)
                        @foreach ($occasion_slider as $key=>$sp)
                            <tr>
                                <td scope="row" style="width:10%">{{$key + 1}}</td>
                                <td>
                                    <div class="media align-items-center">
                                        <img class="avatar avatar-lg mr-3" src="{{asset('public/assets/landing/image')}}/{{$sp['img']}}" 
                                                onerror="this.src='{{asset('public/assets/admin/img/160x160/img2.jpg')}}'" alt="{{$sp['title']}}">
                                    </div>
                                </td>
                                <td style="width: auto; word-wrap: break-word">{!! \Illuminate\Support\Str::limit($sp['title'],20) !!}</td>
                                <td style="width: auto; word-wrap: break-word">{!! \Illuminate\Support\Str::limit($sp['desc'],20) !!}</td>
                                <td>
                                    <a class="btn btn-sm btn-white" href="javascript:"
                                        onclick="form_alert('sp-{{$key}}','{{__('messages.Want_to_delete_this_item')}}')" title="{{__('messages.delete')}}"><i class="tio-delete-outlined"></i>
                                    </a>
                                    <form action="{{route('admin.business-settings.landing-page-settings-delete',['tab'=>'occasions', 'key'=>$key])}}"
                                            method="post" id="sp-{{$key}}">
                                        @csrf @method('delete')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection

@push('script_2')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg1").change(function () {
            readURL(this);
            $('#image-viewer-section').show(1000);
        });

        $(document).on('ready', function () {
            
        });
    </script>
@endpush
