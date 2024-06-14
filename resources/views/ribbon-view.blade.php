@extends('layouts.landing.app')

@section('title','About Us')

@section('content')
    <main>
        <div class="main-body-div">
            <!-- Top Start -->
            <section class="top-start" style="min-height: 100px">
                <div class="container">
                    <div class="row">
                        <div class="col-12 mt-2 text-center">
                            <h1>{{$data['title']}}</h1>
                        </div>
                        <div class="col-12 mt-2 text-center">
                            <img style="width:100%; max-height:400px !important;" src="{{asset('public/assets/landing/image')}}/{{$data['img']}}" alt="" >
                        </div>
                        <div class="col-12">
                           <p> {!! $data['desc'] !!}</p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Top End -->
        </div>
    </main>
@endsection
