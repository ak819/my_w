@extends('web-layouts.app')
@section('content')
@section('title'){{ $item->MetaTitle }} @endsection
{{-- <img src="{{ asset('uploads/herobanner/'.$item->hero_banner->Image)}}" alt="{{ $item->hero_banner->Alt  }}" width="100%" class="d-none d-sm-block"/>  --}}
<section class="gray">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 center">
                <h1 class="font-size-28 font-wt-600 animate__animated animate__fadeIn animate__slow">{{$item->Title}}</h1>
            </div>
        </div>
        <br />
        <div class="row">
            <!--<div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-12">
            </div>-->
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="commonbox service animate__animated animate__fadeIn animate__slow">
                            <img src="{{ asset('uploads/services/'.$item->Image) }}" width="100%" />
                            <br /><br />

                            {!! $item->Description !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="commonbox sticky-top1 animate__animated animate__fadeIn animate__slow">
                            <h2 class="font-size-16 lh-25 font-wt-600 text-center">{{ __('msg.InterestService') }}</h2>
                            <hr />

                            @php
                            if(app()->getLocale() == "ar")
                            {
                                $contactinfo=App\Models\ContactInfo::first(['Email','Phone','AddressAr AS Address']);
                            }else{
                                $contactinfo=App\Models\ContactInfo::first(['Email','Phone','Address']);
                            }
                            $contactphone=str_replace('-','',$contactinfo->Phone);
                            @endphp
                            <div class="text-center">
                                <a href="https://wa.me/{{trim($contactphone)}}?text={{ __('msg.whatsappmsg') }}" title="WhatsApp" class="btn btn-outline-gold btn-medium w-100"><i class="fab fa-whatsapp" style="font-size: 1.325em !important">  </i> Whatsapp</a>
                                <br /><br />
                                <a  href="#requestInfo" class="btn btn-gold btn-medium w-100">{{ __('msg.RequestInfo') }}</a>
                            </div>
                            <br />
                           
                            
                            <div class="center d-none d-sm-block">
                                <h2 class="font-size-16 font-wt-600">{{  __('msg.Or') }}</h2>
                                <p class="font-size-16 font-wt-600">{{  __('msg.ContactUsTime') }}</p>
                                <img src="{{asset('images/logo.png')}}" width="60%"/>
                                <a href="tel:{{$contactphone  }}"><p class="mb-1"><i class="material-icons icon-1x">call</i><span dir="ltr">&nbsp;{{ $contactinfo->Phone  }}</span></p></a>
                               <a href="mailto:{{ $contactinfo->Email }}"><p><i class="material-icons icon-1x">email</i>&nbsp;{{ $contactinfo->Email  }}</p></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="commonbox animate__animated animate__fadeIn animate__slow">
                                <h2 class="font-size-18 font-wt-600">{{ __('msg.OtherServices') }}</h2>
                                <hr />
                                @if (count($servicesLimits) > 0)
                                @foreach ($servicesLimits as $bloglimit)
                                <div class="row mb-4">
                                     <div class="col-xl-4 col-lg-4 col-md-12 col-sm-4 col-6">
                                         <a href="{{ route('servicesdetails',[app()->getLocale(),urlencode($bloglimit->Slug)])}}"><img src="{{ URL::asset('uploads/services/'.$bloglimit->Image) }}" width="100%" /></a>
                                     </div>
                                     <div class="col-xl-8 col-lg-8 col-md-12 col-sm-8 col-6">
                                         <a href="{{ route('servicesdetails',[app()->getLocale(),urlencode($bloglimit->Slug)])}}"><p class="font-size-14 font-wt-600 mb-1">{{ $bloglimit->Title }} </p></a>
                                        
                                     </div>
                                 </div>
                                 @endforeach
                                @else
                                    <span>{{ __('msg.CommingSoon') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    
@if(count($Agents) > 0)
<section style="background:url({{ asset('images/building.jpg') }}) no-repeat scroll center center;background-size:cover; background-attachment:fixed;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 center">
                <h3 class="font-size-28 font-wt-700 color-white animate__animated animate__fadeIn animate__slow">{{  __('msg.ConsultOurAgents') }}</h3>
               
            </div>
        </div><br />
        <div class="row">

            @foreach ($Agents as $val)
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12 mb-2">
                    <div class="card center h-100 animate__animated animate__fadeIn animate__slow">
                        <div class="card-body">
                            <img src="{{ ($val->DisplayPhoto)? URL::asset('uploads/agent/'.$val->DisplayPhoto)  :  asset('images/default_agent_image.png')}}" class="img-round-border" alt="">
                            <br /><br />
                            <h4 class="font-size-16 font-wt-600">{{ ($val->DisplayName)? $val->DisplayName : "-"}}</h4>
                            <a href="mailto:{{ $val->DisplayEmail }}"><p class="font-wt-500 color-gold">{{ ($val->DisplayEmail)? $val->DisplayEmail : "-"}}</p></a>
                            <a href="tel:{{ str_replace('-','',$val->DisplayPhone) }}"><p class="font-wt-500" dir="ltr">{{ ($val->DisplayPhone)?$val->DisplayPhone: "-" }}</p></a>
                        </div>
                    </div>
            </div>
            @endforeach
        </div>
        <br/>
        <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 center">
                    <a href="{{ url(app()->getLocale().'/search-properties') . '?' . http_build_query(['adt' => 'Sale']); }}" class="btn btn-gold btn-medium">{{  __('msg.SearchProperties') }}</a>
                </div>
            </div>
    </div>
</section>
@endif

    
    
<!--<section class="white">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 center">
                    <h3 class="font-size-22 font-wt-600 lh-35 animate__animated animate__fadeIn animate__slow">With a Comprehensive and Wide Range of Property Listings, Homes Caters to All Real Estate Enquiries</h2>
                    <p class="font-size-16 color-black animate__animated animate__fadeIn animate__slow">With a large portfolio of properties, we pride ourselves for being the leading real estate agency in the region. Our agents manage a comprehensive list of both commercial and residential properties in Jordan.</p>
                    <a href="{{ url(app()->getLocale().'/search-properties') . '?' . http_build_query(['adt' => 'Sale']); }}" target="_blank" class="btn btn-medium btn-gold animate__animated animate__fadeIn animate__slow">{{  __('msg.SearchProperties') }}</a>
                </div>
            </div>
        </div>
    </section>
-->
    <br/>
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" id="requestInfo">
                <div class="commonbox animate__animated animate__fadeIn animate__slow">
                    @if($message = Session::get('success'))
                    <div class="alert alert-success animate__animated animate__fadeInDown" role="alert">
                        <strong>{{  __('msg.success') }}</strong>
                    </div>
                    @endif
                    @if($message = Session::get('error'))
                    <div class="alert alert-danger animate__animated animate__fadeInDown"  role="alert">
                         <strong>{{  __('msg.error') }}</strong> .
                    </div>
                    @endif
                    @if($message = Session::get('nodata'))
                    <div class="alert alert-danger animate__animated animate__fadeInDown"  role="alert">
                         <strong>{{  __('msg.nodata') }}</strong> .
                    </div>
                    @endif
                    <h2 class="font-size-18 font-wt-600">{{ __('msg.InquireService') }}</h2>
                    <hr />
                    <form action="{{ route('service-rquestInfo') }}" method="Post">
                        @csrf
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6">
                            <input type="text" name="Name" class="form-control" placeholder="{{ __('msg.YourName') }}" />
                            @error('Name')
                            <span class="error">{{ __('msg.NameRequired') }}</span>
                               @enderror
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6">
                            <input type="text"  name="Phone" class="form-control" placeholder="{{ __('msg.YourMobile') }}" />
                            @error('Phone')
                            <span class="error">{{ __('msg.PhoneRequired') }}</span>
                               @enderror
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-6">
                            <input type="email"   name="Email" class="form-control" placeholder="{{ __('msg.YourEmailId') }}" />
                            @error('Email')
                            <span class="error">{{ $message }}</span>
                               @enderror
                        </div>
                        <input type="hidden" name="ServiceID" value="{{ $item->Guid }}"><br>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <textarea name="Message" class="form-control-textarea" placeholder="{{ __('msg.YourMessage') }}"></textarea>
                            @error('Message')
                            <span class="error">{{ $message }}</span>
                               @enderror

                            <div class="col-md-6"> {!! htmlFormSnippet() !!} </div>
                            @error('g-recaptcha-response')
                            <span class="error">{{ __('msg.CaptchaRequired') }}</span>
                            @enderror
                            <br/>
                            <input type="hidden" value="{{ app()->getLocale() }}" name="locale">
                            <button type="submit" class="btn btn-gold btn-medium float-right">{{  __('msg.RequestInfo') }}</button>
                        </div>
                       
                    </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
</section>
<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Service", 
  "name": "%Service_Name%",
  "image": "%Service_Image%",
  "description": "%%Service_Content",
  "brand": {
    "@type": "Brand",
    "name": "Homes Jordan"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "5",
    "bestRating": "5",
    "worstRating": "5",
    "ratingCount": "25"
  }
}
</script>
@endsection()