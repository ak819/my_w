<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=0">
    <meta name="google-site-verification" content="RLeD-tNKfTVDpMyNQgRLy9P5jwudKDM2TGIKCY1u4U8" />
    @if (View::hasSection('title'))
    <title>@yield('title')</title>
    @else
    <title>Welcome to Homes Jordan</title>
    @endif
    @isset($meta)
    @switch($meta)
        @case("property")   
        <meta name='keywords' content='{{ $Data->MetaTitle }}'>
        <meta name="description" content="{{ strip_tags($Data->MetaDesc) }}  {{ Str::limit(strip_tags($Data->Description),160, $end='...')}}">
         <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="{{ $Data->MetaTitle }}" />                         
        <meta property="og:description" content="{{ strip_tags($Data->MetaDesc) }}  {{ Str::limit(strip_tags($Data->Description),160, $end='...')}}" />
        @if($Data->Images->first() && $Data->Images->count() > 1)
        <meta property="og:image" content="{{ asset("uploads/properties/orignal/".$Data->PropertyRefNo."/".$Data->Images[0]->FileName) }}" />
        @endif
        <meta property="og:url" content="{{ url()->full(); }}" />
        <meta property="og:site_name" content="Homes-Jordon" />
        <meta name="twitter:title" content="{{ $Data->MetaTitle }}" />
        <meta name="twitter:description" content="{{ strip_tags($Data->MetaDesc) }}  {{ Str::limit(strip_tags($Data->Description),160, $end='...')}}" />
        <meta name="twitter:site" content="@Homes_jor" />
        @if($Data->Images->first() && $Data->Images->count() > 1)
        <meta name="twitter:image" content="{{ asset("uploads/properties/orignal/".$Data->PropertyRefNo."/".$Data->Images[0]->FileName) }}" />
        @endif
        <meta name="twitter:creator" content="@Homes_jor" />
        @break
        @case("blog")
        <meta name='keywords' content='{{ $item->MetaTitle }}'>
        <meta name="description" content="{{$item->MetaDescription }}">
         <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="{{ $item->MetaTitle }}" />                         
        <meta property="og:description" content="{{ $item->MetaDescription }}" />
        <meta property="og:image" content="{{ asset('uploads/blog/'.$item->Image) }}" />
        <meta property="og:url" content="{{ url()->full(); }}" />
        <meta property="og:site_name" content="Homes-Jordon" />
        <meta name="twitter:title" content="{{ $item->MetaTitle }}" />
        <meta name="twitter:description" content="{{ $item->MetaDescription }}" />
        <meta name="twitter:site" content="@Homes_jor" />
        <meta name="twitter:image" content="{{ asset('uploads/blog/'.$item->Image) }}" />
        <meta name="twitter:creator" content="@Homes_jor" />
        @break
        @case("service")
        <meta name='keywords' content='{{ $item->MetaTitle }}'>
        <meta name="description" content="{{$item->MetaDescription }}">
         <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="{{ $item->MetaTitle }}" />                         
        <meta property="og:description" content="{{ $item->MetaDescription }}" />
        <meta property="og:image" content="{{ asset('uploads/services/'.$item->Image) }}" />
        <meta property="og:url" content="{{ url()->full(); }}" />
        <meta property="og:site_name" content="Homes-Jordon" />
        <meta name="twitter:title" content="{{ $item->MetaTitle }}" />
        <meta name="twitter:description" content="{{ $item->MetaDescription }}" />
        <meta name="twitter:site" content="@Homes_jor" />
        <meta name="twitter:image" content="{{ asset('uploads/services/'.$item->Image) }}" />
        <meta name="twitter:creator" content="@Homes_jor" />
        @break
        @case("pages")
        {{-- @php echo "pages"; print_r($item); @endphp --}}
        <meta name='keywords' content='{{ $item->MetaTitle }}'>
        <meta name="description" content="{{$item->MetaDescription }}">
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="{{ $item->MetaTitle }}" />                         
        <meta property="og:description" content="{{ $item->MetaDescription }}" />
        <meta property="og:image" content="{{asset('images/logo.png')}}" />
        <meta property="og:url" content="{{ url()->full(); }}" />
        <meta property="og:site_name" content="Homes-Jordon" />
        <meta name="twitter:title" content="{{ $item->MetaTitle }}" />
        <meta name="twitter:description" content="{{ $item->MetaDescription }}" />
        <meta name="twitter:site" content="@Homes_jor" />
        <meta name="twitter:image" content="{{asset('images/logo.png')}}" />
        <meta name="twitter:creator" content="@Homes_jor" />
            @break
        @default
            
    @endswitch
    @endisset

    
    <link  href="{{asset('css/app-bundle.css')}}" rel="stylesheet">
    <!--Light Gallery Starts-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.6.4/css/lightgallery.min.css"  rel="stylesheet">
    <!--Light Gallery Ends-->

    <!--External Fonts Start-->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"  rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@400;500;600;700;800;900&display=swap"  rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"  rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css"  rel="stylesheet">
    <!--External Fonts End-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('images/favicon/site.webmanifest')}}">
    <link rel="mask-icon" href="{{asset('images/favicon/safari-pinned-tab.svg')}}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    
    @if(app()->getLocale()=='en')
    <link href="{{asset('css/mainfront.css')}}?v=@php echo date('his') @endphp" rel="stylesheet">
    @else
    <link href="{{asset('css/mainfrontar.css')}}?v=@php echo date('his') @endphp" rel="stylesheet">
    @endif

    <link rel="canonical" href="{{  url()->full(); }}" />
    
    <script src='{{ asset("js/jquery3.2.1.min.js")}}' type="text/javascript"></script>
    <script  src="{{asset('js/jquery-1.11.0.min.js')}}" type="text/javascript"></script>
    {!! ReCaptcha::htmlScriptTagJsApi() !!}
    
    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NK62H7C');</script>
<!-- End Google Tag Manager -->
</head>
<body onbeforeunload="handleBackFunctionality()">

    
    <div class="sticky-top">
    <div class="topbar @if(Route::current()->getName() !=='home')d-none d-sm-block @endif">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="float-start">
                    </div>
                    <div class="float-end">
                        <div class="float-start" dir="ltr">
                            
                            @if (app()->getLocale() == "ar")
                            <a href="{{ route('changelang','en') }}" class="btn btn-outline-gold me-2">English</a>
                            @else
                            <a href="{{ route('changelang','ar') }}" class="btn btn-outline-gold me-2">عربي</a>
                            @endif
                            
                            <div class="dropdown d-inline me-2">
                                @php $currency = Session::get('currency'); @endphp 
                                <a class="btn btn-outline-gold" href="javascript:void(0)" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"><img src="{{ asset("uploads/currency/".$currency[2]) }}" width="30px" alt="" /> {{ $currency[0] }}</a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    @php
                                    $currencies=App\Models\Currency::where('IsEnable',1)->get();
                                   @endphp
                                        @foreach ($currencies as $item)
                                        <li><a class="dropdown-item" href="{{ route('change-currency',$item->Name) }}"><img src="{{asset("uploads/currency/".$item->flag)}}" width="30px" alt="" />&nbsp;&nbsp;&nbsp;{{ $item->Name }}</a></li>
                                       @endforeach 
                                </ul>
                            </div>
                            
                            
                            <!--<span class="float-left mr-3"><i class="material-icons icon-1x">location_on</i>&nbsp;&nbsp;Building No. 7, King Abdallah Ben Al Hussein Ath Thani St</span>-->
                        </div>
                        <div class="float-end d-none d-sm-block">
                            @php
                            if(app()->getLocale() == "ar")
                            {
                                $contactinfo=App\Models\ContactInfo::first(['Email','Phone','AddressAr AS Address']);
                            }else{
                                $contactinfo=App\Models\ContactInfo::first(['Email','Phone','Address']);
                            }
                            @endphp
                            <a href="tel:{{ $contactinfo->Phone  }}"><span class="d-inline" dir="ltr"><i class="material-icons icon-1x">call</i>&nbsp;&nbsp;{{ $contactinfo->Phone  }}&nbsp;&nbsp;</span></a>
                            <ul class="float-end pt-1 pl-2">
                                <li class="widget-container social_sidebar">
                                    <div class="social_sidebar_internal" dir="ltr">
                                        <a class="btn-social-small btn-whatsapp" href="https://wa.me/{{ str_replace('-','',$contactinfo->Phone)  }}?text={{ __('msg.whatsappmsg') }}" target="_blank"><i class="fab fa-whatsapp icon-1x"></i></a>
                                        <a class="btn-social-small btn-facebook" style="color:#fff;" href="https://www.facebook.com/homes.jor/" target="_blank"><i class="fab fa-facebook-f icon-1x"></i></a>
                                        <a class="btn-social-small btn-instagram" style="color:#fff;" href="https://www.instagram.com/homes.jor/" target="_blank"><i class="fab fa-instagram icon-1x"></i></a>
                                        <a class="btn-social-small btn-linkedin" href="https://www.linkedin.com/company/homes-jor" target="_blank"><i class="fab fa-linkedin icon-1x"></i></a>
                                        <a class="btn-social-small btn-linkedin" href="https://www.youtube.com/@homesjordan2992" target="_blank"><i class="fab fa-youtube icon-1x"></i></a>
                                        {{-- <a class="btn-social-small btn-twitter" style="color:#fff;" href="https://twitter.com/homes_jor" target="_blank"><i class="fab fa-twitter icon-1x"></i></a> --}}
                                        
                                         <!--<a href="https://www.facebook.com/homes.jor/" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                        <a href="https://twitter.com/homes_jor" target="_blank"><i class="fab fa-twitter"></i></a>
                                        <a href="https://www.instagram.com/homes.jor/" target="_blank"><i class="fab fa-instagram"></i></a>
                                        <a href="https://wa.me/{{ $contactinfo->Phone  }}?text={{ __('msg.whatsappmsg') }}" target="_blank"><i class="fab fa-whatsapp"></i></a>
                                        -->
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<nav class="navbar navbar-expand-lg pt-0 pb-2 white sticky-top1" dir="ltr">
    <div class="container-fluid animate__animated animate__fadeIn animate__slow">
        <span>
             <a href="{{ route('home') }}">
                <img src="{{asset('images/logo.png')}}" alt="logo" class="logo">
            </a>
        </span>
        <button class="navbar-toggler btn btn-outline-gold btn-small" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="material-icons">
                    menu
                </i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                @php
                $units=DB::table('property_unit_types')
                ->join('properties', 'property_unit_types.ID', '=', 'properties.UnitTypeID')
                ->where('property_unit_types.IsEnable',1)
                ->groupBy('property_unit_types.ID')
                ->get(['property_unit_types.TypeName','property_unit_types.TypeNameAr','property_unit_types.Slug','property_unit_types.SlugAr','property_unit_types.ID']);
                @endphp

                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle" href="{{  route('search-properties',[app()->getLocale(),'sale']) }}" id="saleDropdown" aria-expanded="false">
                        {{ __('msg.Sale') }}
                    </a>

                    <ul class="dropdown-menu fade-down megamenu">
                      
                        @foreach ($units as $val)
                        @if(app()->getLocale()=="en")
                        <li><a class="dropdown-item" href="{{  route('search-properties',[app()->getLocale(),'sale',urlencode($val->Slug)]) }}">{{$val->TypeName}}</a></li>
                        @else
                        <li><a class="dropdown-item" href="{{  route('search-properties',[app()->getLocale(),'sale',urlencode($val->Slug)]) }}">{{$val->TypeNameAr}}</a></li>
                        @endif
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle" href="{{  route('search-properties',[app()->getLocale(),'rent']) }}" id="rentDropdown"  aria-expanded="false">
                        {{ __('msg.Rent') }}
                    </a>

                    <ul class="dropdown-menu fade-down megamenu">
                      
                        @foreach ($units as $val)
                        @if(app()->getLocale()=="en")
                        <li><a class="dropdown-item" href="{{  route('search-properties',[app()->getLocale(),'rent',urlencode($val->Slug)]) }}">{{$val->TypeName}}</a></li>
                        @else
                        <li><a class="dropdown-item" href="{{  route('search-properties',[app()->getLocale(),'rent',urlencode($val->Slug)]) }}">{{$val->TypeNameAr}}</a></li>
                        @endif
                        @endforeach
                    </ul>
                </li>
            
             
              
                 <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ __('msg.Services') }}
                        </a>

                        <ul class="dropdown-menu fade-down">
                            @php
                                $services= App\Models\Services::where('IsEnable',1)->get(['SubHeading','SubHeadingAr','Slug','SlugAr','Guid']);
                            @endphp
                            @foreach ($services as $item)
                            @if(app()->getLocale()=="en")
                            <li><a class="dropdown-item" href="{{  route('servicesdetails',[app()->getLocale(),urlencode($item->Slug)]) }}">{{$item->SubHeading}}</a></li>
                            @else
                            <li><a class="dropdown-item" href="{{  route('servicesdetails',[app()->getLocale(),urlencode($item->SlugAr)]) }}">{{$item->SubHeadingAr}}</a></li>
                            @endif
                            @endforeach
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('property-evaluation',app()->getLocale())  }}"> {{ __('msg.PropertyEvaluation') }}</a>
                    </li>
               
                <li class="nav-item">
                    <a class="nav-link" href="{{ url(app()->getLocale().'/contact-us#contactform')  }}"> {{ __('msg.Contact') }}</a>
                </li>
               
                <li class="nav-item center">
                    <a class="btn btn-medium btn-gold" href="{{ route('addproperty',app()->getLocale()) }}">{{ __('msg.ListYourProperty') }}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
</div>
<div class="rightleft">
@yield('content')

<div class="modal fade bd-example-modal-sm" tabindex="-1" id="shareModal" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title font-size-16 font-wt-600" id="exampleModalLabel">{{  __('msg.SharePropertyDetails') }}</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row share_options">

                    </div>
                    <!--<ul class="c-share_options" data-title="{{  __('msg.Share') }}">
                    </ul>-->
                    <p  style="display:none" class="copymsg color-red font-wt-600 center">{{  __('msg.LinkCopied') }}</p>
                </div>
                <!--<div class="modal-footer">
                    <button type="button" class="btn btn-gold" data-bs-dismiss="modal">Close</button>
                </div>-->
            </div>
        </div>
    </div>
    
<footer id="footer">
    <div class="container">
        <div class="row d-block d-sm-none">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 pt-12">
                            @if (app()->getLocale() == "ar")
                            <a href="{{ route('changelang','en') }}" class="btn btn-outline-gold me-2">English</a>
                            @else
                            <a href="{{ route('changelang','ar') }}" class="btn btn-outline-gold me-2">عربي</a>
                            @endif
                            
                            <div class="dropdown d-inline me-2">
                                @php $currency = Session::get('currency'); @endphp 
                                <a class="btn btn-outline-gold" href="javascript:void(0)" role="button" id="dropdownFooterMenuLink" data-bs-toggle="dropdown" aria-expanded="false"><img src="{{ asset("uploads/currency/".$currency[2]) }}" width="30px" alt="" /> {{ $currency[0] }}</a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownFooterMenuLink">
                                    @php
                                    $currencies=App\Models\Currency::where('IsEnable',1)->get();
                                   @endphp
                                        @foreach ($currencies as $item)
                                        <li><a class="dropdown-item" href="{{ route('change-currency',$item->Name) }}"><img src="{{asset("uploads/currency/".$item->flag)}}" width="30px" alt="" />&nbsp;&nbsp;&nbsp;{{ $item->Name }}</a></li>
                                       @endforeach 
                                </ul>
                            </div>
        </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 pt-4">
                <p class="font-size-18 font-wt-600 color-gold">{{ __('msg.ContactUs') }}</p>
                <p><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1692.2902542099355!2d35.8343615!3d31.9722753!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151ca14b78d35e6d%3A0x34890875b64df06f!2sHomes%20Jordan!5e0!3m2!1sen!2sin!4v1676264131633!5m2!1sen!2sin" width="250" height="150" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></p>
                <p><a  href="tel:{{ $contactinfo->Phone  }}"><i class="material-icons icon-1x">call</i>&nbsp;<span dir="ltr">{{ $contactinfo->Phone  }}</span></a></p>
                <a href="mailto:{{ $contactinfo->Email  }}"><p><i class="material-icons icon-1x">email</i>&nbsp;{{ $contactinfo->Email  }}</p></a>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 pt-4">
                <p class="font-size-18 font-wt-600 color-gold">{{ __('msg.Properties') }}</p>
                <ul class="arrow">
                    <li>
                        <a href="{{ route('search-properties',[app()->getLocale(),'sale']) }}">{{ __('msg.ForSale') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('search-properties',[app()->getLocale(),'rent']) }}">{{ __('msg.ForRent') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('addproperty',app()->getLocale()) }}">{{ __('msg.ListYourProperty') }}</a>
                    </li>

                    <li>
                        <a  href="{{ route('property-evaluation',app()->getLocale())  }}"> {{ __('msg.PropertyEvaluation') }}</a>
                    </li>
                  

                </ul>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 pt-4">
                <p class="font-size-18 font-wt-600 color-gold">{{ __('msg.QuickLinks') }}</p>
                <ul class="arrow">
                    <li>
                        <a href="{{ route('about-us',app()->getLocale()) }}">{{ __('msg.AboutUs') }}</a>
                    </li>
                   
                    <li>
                        <a href="{{ route('our-services',app()->getLocale()) }}">{{ __('msg.OurServices') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('blogs',app()->getLocale()) }}">{{ __('msg.Blog') }}</a>
                    </li>
                    <li>
                        <a href="{{ url(app()->getLocale().'/contact-us#contactform')  }}">{{ __('msg.ContactUs') }}</a>
                    </li>
                    <!--<li>
                        <a href="#">{{ __('msg.TermsAndConditions') }}</a>
                    </li>
                    <li>
                        <a href="#">{{ __('msg.PrivacyPolicy') }}</a>
                    </li>-->
                </ul>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12 pt-4">
                <p class="font-size-18 font-wt-600 color-gold">{{ __('msg.AboutUs') }}</p>
                <p>{{ __('msg.FooterAboutUs') }}</p>
                <a class="btn-social-small btn-whatsapp" href="https://wa.me/{{ str_replace('-','',$contactinfo->Phone)  }}?text={{ __('msg.whatsappmsg') }}" target="_blank"><i class="fab fa-whatsapp"></i></a>&nbsp;
                <a class="btn-social-small btn-facebook" style="color:#fff;" href="https://www.facebook.com/homes.jor/" target="_blank"><i class="fab fa-facebook-f"></i></a>&nbsp;
                <a class="btn-social-small btn-instagram" style="color:#fff;" href="https://www.instagram.com/homes.jor/" target="_blank"><i class="fab fa-instagram"></i></a>&nbsp;
                <a class="btn-social-small btn-linkedin" href="https://www.linkedin.com/company/homes-jor" target="_blank"><i class="fab fa-linkedin"></i></a>&nbsp;
                  <a class="btn-social-small btn-linkedin" href="https://www.youtube.com/@homesjordan2992" target="_blank"><i class="fab fa-youtube icon-1x"></i></a>
               <!-- <a class="btn-social-small btn-twitter" style="color:#fff;" href="https://twitter.com/homes_jor" target="_blank"><i class="fab fa-twitter"></i></a>-->
            </div>
        </div>
    </div>
    <br /><br />
    <div>
        <p class="center">© {{ date('Y') }} {{ __('msg.CopyRights') }}</p>
    </div>
</footer>
<div id="compare" class="white" style="background-color:#ffffff; border-top: 4px solid #ac8952; z-index:99; bottom: 0;position: fixed;width: 100%; display:none;">
    <a href="javascript:void(0)" id="reset-compare" class="compare-close"><i class="material-icons icon-1x">close</i></a>
    <div class="container-fluid">
        <div id="limitmsg" class="alert alert-danger mt-2 p-1 animate__animated animate__fadeInDown hidden" role="alert">
            {{ __('msg.Youcancompare') }}
        </div>
        <div id="singlelimitmsg" class="alert alert-danger mt-2 p-1 animate__animated animate__fadeInDown hidden" role="alert">
            {{ __('msg.YouNeedAddMore') }}
        </div>
        <div class="row mt-3" dir="ltr">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="text-center">
                    <a href="javascript:voide(0)"  onclick="checkCompareCount(); return true;" id="start-compare" class="btn btn-medium btn-gold">{{ __('msg.StartCompare') }}</a>
                    <!--<a href="javascript:void(0)" id="reset-compare" class="btn btn-outline-gold">{{ __('msg.clearcompare') }}</a>-->
                </div>               
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <!--<span class="font-size-18 font-wt-600 float-start">{{ __('msg.CompareProperties') }}</span>-->
            </div>
        </div>
        <br />
        
        <!--<hr /> -->
        <div class="row mt-3 mb-3" id="comparelist" style="display:none">
        </div>
    </div>
</div>

<script src="{{asset('js/app-bundle.js')}}"></script>
<!-- All Jquery Here -->
<script src="{{asset('js/footer.js')}}"></script>

<script>

   $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('select').select2();

$(".locationlist").change(function(){
   
    let type=$(this).data("type");
    if(type){
        cityid=$(this).find(":selected").data("cityid");
        $('#'+type+'-city').val(cityid).change();
    }else{
    let cityid=$('.city').val();
    if(!cityid) // already exitst city 
    { 
         cityid=$(this).find(":selected").data("cityid");
    }
    $('.city').val(cityid).change();

    }
    
});
$(".city").change(function(){
    let type=$(this).data("type");
    if(type)
    {
        var cityid=$(this).val();
    let selectedLocation=[];
    if(cityid) // city present
    {
       selectedLocation=$("#"+type+"-locationlist").val();
    }
    $.ajax({
            url:'{{route('locationlist')}}',
            type:'POST',
            dataType:'json',
            data:{"_token": "{{ csrf_token() }}",cityid:cityid,lang:"<?= app()->getLocale()?>"},
            success: function(response){
                if(response)
                { 
                    $("#"+type+"-locationlist").empty();
                    var optionsAsString = "";
                    $.each(response.locations, function (key, value) {
                    optionsAsString += "<option value=" + value.id +  " data-cityid="+value.CityID+" data-char="+value.CommunityNameEng.replace(/[^A-Z0-9]/ig, "-").toLowerCase()+">" + value.CommunityName + "</option>";
                    });
                    //$('<option value="">Select Multiple Location</option>').appendTo('.locationlist');
                $("#"+type+"-locationlist").append( optionsAsString );
                $("#"+type+"-locationlist").val(selectedLocation);
                $("#"+type+"-locationlist").select2({
                pagination: {more: true}
                });
                }
            }
      });

    }else{

        var cityid=$(this).val();
    let selectedLocation=[];
    if(cityid) // city present
    {
       selectedLocation=$(".locationlist").val();
    }
    $.ajax({
            url:'{{route('locationlist')}}',
            type:'POST',
            dataType:'json',
            data:{"_token": "{{ csrf_token() }}",cityid:cityid,lang:"<?= app()->getLocale()?>"},
            success: function(response){
                if(response)
                { 
                    $(".locationlist").empty();
                    var optionsAsString = "";
                    $.each(response.locations, function (key, value) {
                    optionsAsString += "<option value=" + value.id + " data-cityid="+value.CityID+" data-char="+value.CommunityNameEng.replace(/[^A-Z0-9]/ig, "-").toLowerCase()+">" + value.CommunityName + "</option>";
                    });
                    //$('<option value="">Select Multiple Location</option>').appendTo('.locationlist');
                $('.locationlist').append(optionsAsString );
                $('.locationlist').val(selectedLocation);
                $('.locationlist').select2({
                pagination: {more: true}
                });
                }
            }
      });
    }
  
});
<!--- compare property-- !>
@if(session('comparelist') && Request::segment(2)!=="compare")
ShowCompareTab();
@endif()
$(document).on("click",".compare",function() {
   const currentelement=$(this);
   const property_no=$(this).data('no');
   const hideid=$(this).attr('id');
   const showid="remove_compare_"+property_no;
   $.ajax({
            url:'{{route('setcomparelist')}}',
            type:'POST',
            dataType:'json',
            data:{"_token": "{{ csrf_token() }}",property_no:property_no},
            success: function(response){
                if(response.status)
                {   
                   const innerhtml='<i class="material-icons">done</i>'; 
                   currentelement.html(innerhtml);
                   currentelement.removeClass('btn-gold me-2 compare');
                   currentelement.addClass('btn-outline-gold me-2 remove-compare');
                   ShowCompareTab();
                }else{
                    ShowCompareTab();
                } 
            }

      });
});
$(document).on("click",".remove-compare",function() {
   const currentelement=$(this);
   const property_no=$(this).data('no');
   const hideid=$(this).attr('id');
   const showid="compare_"+property_no;
   $.ajax({
            url:'{{route('removefromcompare')}}',
            type:'POST',
            dataType:'json',
            data:{"_token": "{{ csrf_token() }}",property_no:property_no},
            success: function(response){
                if(response)
                {  
                    const innerhtml='<i class="material-icons">compare_arrows</i> {{  __('msg.Compare') }}'; 
                    currentelement.html(innerhtml);
                    currentelement.removeClass('btn-outline-gold me-2 remove-compare');
                    currentelement.addClass('btn-gold me-2 compare');
                    ShowCompareTab();
                }
            }
      });
});
function checkCompareCount()
{
    
    var count = $("#comparelist img").length;
    if(count > 1)
    { 
        window.location.replace("{{ route('compare',app()->getLocale()) }}");
      return true;
    }else{
        return false;
    }
}
function ShowCompareTab()
{   
    $('#comparelist').empty(); 
    $.ajax({
            url:'{{route('showcomparelist')}}',
            type:'get',
            dataType:'json',
            data:{lang:"<?= app()->getLocale()?>"},
            success: function(response){
                if(response.status)
                { 
                 $('#comparelist').append(response.html);
                 if(response.singlelimitmsg)
                 {
                    $('#singlelimitmsg').removeClass('hidden');   
                 }else{
                    $('#singlelimitmsg').addClass('hidden');   
                 }
                 if(response.limitmsg)
                 {
                    $('#limitmsg').removeClass('hidden');   
                 }else{
                    $('#limitmsg').addClass('hidden');
                 }
                
                 if(!$('#comparelist').is(':visible'))
                 {
                    $('#compare').css('display','block');
                 }
                 
                  return true;
                }else{

                    $('#compare').css('display','none');
                    
                }
            }

      });
}

$("#reset-compare").click(function(){
   $.ajax({
            url:'{{route('removecomparelist')}}',
            type:'delete',
            dataType:'json',
            data:{"_token": "{{ csrf_token() }}"},
            success: function(response){
                if(response)
                { 
                    $(".remove-compare").each(function() {
                    
                    let currentelement=$(this);
                    let innerhtml='<i class="material-icons">compare_arrows</i> {{  __('msg.Compare') }}'; 
                    currentelement.html(innerhtml);
                    console.log(currentelement);
                    currentelement.removeClass('btn-outline-gold me-2 remove-compare');
                    currentelement.addClass('btn-gold me-2 compare');
                     });
                    $('#compare').css('display','none');
                }
            }
      });
});
<!--- compare property-- !>
$(document).on('submit','form',function(){
    $(this).find('select').filter(function(){
 return !$.trim(this.value).length;  
}).prop('disabled',true); 
$(this).find(':input').filter(function(){
 return !$.trim(this.value).length;  
}).prop('disabled',true);
});
</script>

<script>
 /// copy link
    var $temp = $("<input>");
    $(document).on("click",".clipboard",function() {
     $(".share_options").append($temp);
      var url= $(this).data('tocopyshorturl');
      $temp.val(url).select();
      document.execCommand("copy");
      $temp.remove();
      $(".copymsg").css("display",'block');

    });

     // property listing social media links
     $(".sharelinks").click(function(){
        $(".copymsg").css("display",'none');
        const propertyno=$(this).data('no');
        const locale="<?= app()->getLocale() ?>";
        $.ajax({
            url:'{{route('sharelink')}}',
            type:'POST',
            dataType:'json',
            data:{"_token": "{{ csrf_token() }}",propertyno:propertyno,locale:locale},
            success: function(response){
                if(response.status)
                { 
                 $(".share_options").empty();
                $('.share_options').append(response.html);
                $('#shareModal').modal('show');
                }
            }
      });
    })
  
    $(".saleurlfilter").change(function(){
        console.log('yes');
    let url = $("#sale_form_url").val();
    let type=$('#sale-type').children("option:selected").data('char');
    let city=$('#sale-city').children("option:selected").data('char');
    let locations=$("#sale-locationlist option:selected").map(function() {
            return $(this).val();
            }).get();
    let locationstring=locations.map(element=>element).join("-");
    $('#sale-selected-locations').val(locationstring);
    let locations_names=$("#sale-locationlist option:selected").map(function() {
            return $(this).data("char");
            }).get();
    locationstring=locations_names.map(element=>element).join(",");
    if(type)
    { 
        url=url+'/'+type;
    }
    if(city)
    {
        url=url+'/'+city;
    }
    if(locations)
    {
        url=url+'/'+locationstring;
    }
    $("#sale_form").attr("action",url);
    });
    $(".renturlfilter").change(function(){
        console.log('yes');
    let url = $("#rent_form_url").val();
    let type=$('#rent-type').children("option:selected").data('char');
    let city=$('#rent-city').children("option:selected").data('char');
    let locations=$("#rent-locationlist option:selected").map(function() {
            return $(this).val();
            }).get();
    let locationstring=locations.map(element=>element).join("-");
    $('#rent-selected-locations').val(locationstring);
    let locations_names=$("#rent-locationlist option:selected").map(function() {
            return $(this).data("char");
            }).get();
    locationstring=locations_names.map(element=>element).join(",");
    if(type)
    { 
        url=url+'/'+type;
    }
    if(city)
    {
        url=url+'/'+city;
    }
    if(locations)
    {
        url=url+'/'+locationstring;
    }
    $("#rent_form").attr("action",url);
    });
    
    </script>
</div>
</body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NK62H7C"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</html>