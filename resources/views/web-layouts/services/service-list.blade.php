@extends('web-layouts.app')
@section('content')
@section('title'){{ $item->MetaTitle }} @endsection
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <h1 class="center font-size-40 font-wt-600">{{ __('msg.ServiceListHeading') }} </h1>
    </div>
    <section class="gray">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="row">
                        @if (empty(!$items))
                        @foreach ($items as $service)
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <div class="card animate__animated animate__fadeIn animate__slow">
                                <figure>
                                    <a href="{{ route('servicesdetails',[app()->getLocale(),urlencode($service->Slug)])}}">
                                        <img src="{{ URL::asset('uploads/services/'.$service->Image) }}" class="card-img-top listing-card-img" alt="">
                                        <div class="list-overlay"></div>
                                    </a>
                                </figure>
                                <div class="card-body">
                                    <a href="{{ route('servicesdetails',[app()->getLocale(),urlencode($service->Slug)])}}">
                                        <h2 class="font-size-16 font-wt-600">{!! Str::limit(strip_tags($service->Title),30, $end='...')  !!}</h2>
                                    </a>
                                    <p class="font-size-12 font-wt-500 color-gray">{!! Str::limit(strip_tags($service->Description),80, $end='...')  !!}</p>                                    
                                    <!--<p class="font-size-14 font-wt-500 color-gold float-left mb-1"><span dir="ltr"> {{date('d-M-Y h:i a', strtotime($service->CreatedDate))}}</span></p>-->
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <h2>{{ __('msg.CommingSoon') }}</h2>
                       @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection()