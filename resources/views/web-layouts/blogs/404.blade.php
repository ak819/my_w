@extends('web-layouts.app')
@section('content')
@section('title'){{ "404" }} @endsection
<section class="pt-5 pb-5 d-none d-sm-block">
    <div class="container">
        <div class="row" lang="en" dir="ltr">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center mt-5 animate__animated animate__fadeIn animate__slow">
                <br /><br /><br /><br />
                <h1 class="font-size-60 font-wt-700">404</h1><br /><br />
                <h2 class="font-size-30 font-wt-600 pb-1">Blog you are looking for is not available</h2>
                <h3 class="font-size-20 font-wt-500">We have other interesting options for you, check it out.</h3><br /><br />
                <a href="{{ route('blogs',app()->getLocale()) }}" class="btn btn-gold btn-medium">All Blogs</a>
            </div>
        </div>
    </div>
</section>
@endsection()