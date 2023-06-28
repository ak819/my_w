@extends('web-layouts.app')
@if(!empty($Data))
@section('title'){{ $Data->PropertyTitle }} {{'Homes-Jordan'}} @endsection
@endif
@section('content')
@if(!empty($Data))
<section class="gray">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                @if($flag=="sold")
        <div class="scroll-text"><span class="font-size-20 font-wt-600 color-red"> {{ __('msg.BeenSold') }}</span></div>
        @else
        <div class="scroll-text"><span class="font-size-20 font-wt-600 color-red"> {{ __('msg.BeenRented') }}</span></div>
        @endif
        <br/>
                <div class="commonbox animate__animated animate__fadeIn animate__slow">
                    <div class="row">
                        <div class="col-xl-9 col-lg-9 col-md-8 col-sm-8 col-12">
                            <h1 class="font-size-18 font-wt-600 lh-25 mb-1">{{ $Data->PropertyTitle }}</h1>
                            <p class="mb-1"><i class="material-icons icon-1x">location_on</i> {{ $Data->CommunityName }},  {{ $Data->CityName }}, {{ __('msg.Jordan') }}</p>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
                            <h2 class="font-size-24 lh-25 color-gold font-wt-700 float-end d-none d-sm-block"> {{ currency_format($Data->Price) }}</h2>
                            <h2 class="font-size-24 lh-25 color-gold font-wt-700 d-block d-xl-none d-lg-none d-md-none d-sm-none"> {{ currency_format($Data->Price) }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-block d-xl-none d-lg-none d-md-none d-sm-none">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center mb-2">
                    @if($Data->AdType==2)
                    <a href="{{ route('search-properties',[app()->getLocale(),'sale',strtolower($Data->TypeName)]) }}" class="btn btn-gold w-100">{{ __('msg.SearchSimilarProperties') }}</a>
                    @else
                    <a href="{{ route('search-properties',[app()->getLocale(),'rent',strtolower($Data->TypeName)] )}}" class="btn btn-gold w-100">{{ __('msg.SearchSimilarProperties') }}</a>
                    @endif
                </div>
            </div>
                                </div>
                                <br/>
        <div class="row">
            <!--<div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-12">
            </div>-->
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                @if($Data->Images->first() && $Data->Images->count() > 1)
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" dir="ltr">
                        <div class="animate__animated animate__fadeIn animate__slow">
                            
                            <div class="slider-for" id="aniimated-thumbnials1">
                                @foreach ($Data->Images as $img)
                             
                                        <a href="{{ asset("uploads/properties/orignal/".$Data->PropertyRefNo."/".$img->FileName) }}">
                                            <img src="{{ asset("uploads/properties/orignal/".$Data->PropertyRefNo."/".$img->FileName) }}" alt="{{ $img->ImgAlt }}" class="card-img-top">
                                            @if($flag=="sold")
                                            <div class="sold">
                                                <img src="{{ asset('images/sold.png') }}" height="200px"/>
                                            </div>
                                            @else
                                            <div class="sold">
                                                <img src="{{ asset('images/rented.png') }}" height="200px"/>
                                            </div>
                                            @endif
                                        </a>
                             
                                <!--<div class="item"><img src="{{ asset("uploads/properties/orignal/".$Data->PropertyRefNo."/".$img->FileName) }}" width="100%"  alt="{{ $img->ImgAlt }}"/></div>-->
                                @endforeach
                               
                            </div>
                            <div class="slider-nav">
                                @foreach ($Data->Thumbs as $img)
                                <div class="item"><img src="{{ asset("uploads/properties/thumb/".$Data->PropertyRefNo."/".$img->FileName) }}" width="100%"  alt="{{ $img->ImgAlt }}"/></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @elseif($Data->Images->first() && $Data->Images->count() == 1)
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="commonbox animate__animated animate__fadeIn animate__slow">
                            <div class="slider-for" id="aniimated-thumbnials">
                                 @foreach ($Data->Images as $img)
                                <a href="{{ asset("uploads/properties/orignal/".$Data->PropertyRefNo."/".$img->FileName) }}">
                                    <img src="{{ asset("uploads/properties/orignal/".$Data->PropertyRefNo."/".$img->FileName) }}" width="100%"  alt="{{ $img->ImgAlt }}" />
                                    @if($flag=="sold")
                                    <div class="sold">
                                        <img src="{{ asset('images/sold.png') }}"/>
                                    </div>
                                    @else
                                    <div class="sold">
                                        <img src="{{ asset('images/rented.png') }}"/>
                                    </div>
                                    @endif
                                </a>
                                @endforeach
                            </div>
                            
                            
                            
                            <!--<div class="slider-for">
                                @foreach ($Data->Images as $img)
                                <div class="item"><img src="{{ asset("uploads/properties/orignal/".$Data->PropertyRefNo."/".$img->FileName) }}" width="100%"  alt="{{ $img->ImgAlt }}"/></div>
                                @endforeach
                            </div>-->
                        </div>
                    </div>
                </div>
                @endif
                <br/>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-block d-xl-none1 d-lg-none1 d-md-none1 d-sm-none1">
                        <div class="commonbox animate__animated animate__fadeIn animate__slow">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 center">
                                    <p>
                                    <span class="font-size-18 font-wt-600">{{  __('msg.PropertyID') }}: </span>
                                    <span class="font-size-20 font-wt-700 color-red">{{  config('constants.AdTypeshort.'.$Data->AdType)}}-{{   preg_replace('/[^0-9]/', '', $Data->PropertyRefNo);   }}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                @php $DetailsViewFields=explode(',',$Data->DetailsViewFields) @endphp
                                {{-- @if($Data->ApartmentType)
                                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-6 center">
                                    <span class="font-wt-600">{{  __('msg.Apartment') }}</span><br />
                                    <p>{{ $Data->ApartmentType }}</p>
                                </div>
                                @endif --}}
                                
                                @if(in_array('bed',$DetailsViewFields))
                                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-6 center">
                                    <i class="material-icons icon-3x color-gold" title="Bedroom">king_bed</i>
                                    <p><span class="font-wt-600">{{ $Data->NoBedrooms }} </span>{{  __('msg.Bedrooms') }}</p>
                                </div>
                                @endif
                                @if(in_array('bath',$DetailsViewFields))
                                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-6 center">
                                    <i class="material-icons icon-3x color-gold" title="Bathroom">shower</i>
                                    <p><span class="font-wt-600">{{ $Data->NoBathrooms }} </span>{{  __('msg.Bathrooms') }}</p>
                                </div>
                                @endif
                                
                                @if(in_array('builtup',$DetailsViewFields))
                                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-6 center">
                                    <i class="material-icons  icon-3x color-gold" title="Built Up Area">foundation</i>
                                    <p><span class="font-wt-600">{{ number_format($Data->UnitBuiltupArea, 2) }}</span> Sq m.</p>
                                </div>
                                @endif
                                @if(in_array('plot',$DetailsViewFields))
                                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-6 center">
                                    <i class="material-icons icon-3x color-gold" title="Plot Area">aspect_ratio</i>
                                    @if($Data->PlotSize > 0)
                                    <p><span class="font-wt-600">{{ number_format($Data->PlotSize+0, 2) }}</span> Sq m.</p>
                                    @endif
                                </div>
                                @endif
                                
                            </div>
                            </div>
                        </div>
                    </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-none d-sm-block stickymenu">
                        <nav class="navbar navbar-property navbar-expand-lg pt-0 pb-0 black">
                            <button class="navbar-toggler btn btn-outline-gold btn-small" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                                <i class="material-icons">
                                    more_vert
                                </i>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                                <ul class="navbar-nav ms-0 mt-2 mt-lg-0">
                                    <li class="hidden">
                                        <a class="page-scroll" href="#page-top"></a>
                                    </li>
                                    <li>
                                        <a class="page-scroll" href="#description"><i class="icon-note"></i>{{  __('msg.Description') }}</a>
                                    </li>
                                    <li>
                                        <a class="page-scroll" href="#features"><i class="icon-rocket"></i>{{  __('msg.Features') }}</a>
                                    </li>
                                    {{-- <li>
                                        <a class="page-scroll" href="#info"><i class="icon-trophy"></i> Additional Info</a>
                                    </li> --}}
                                    @if(empty(!$Data->Video))
                                    <li>
                                        <a class="page-scroll" href="#videos"><i class="icon-social-youtube"></i>{{  __('msg.Videos') }}</a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </nav>
                    </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <section id="description" class="commonbox animate__animated animate__fadeIn animate__slow">
                            <h3 class="font-size-18 font-wt-700"><!--<i class="material-icons icon-1x1">description</i>-->{{  __('msg.Description') }}</h3>
                            <hr />
                            @php  
                            $Data->Description=str_replace(['&amp;','nbsp;'],' ', $Data->Description); 
                            $limitedText=Str::limit($Data->Description,400,'...');
                            @endphp 

                              <div id="half-desc" class="font-wt-500">{!!  closetags($limitedText)  !!}</div>
                              <div id="full-desc" style="display:none" class="font-wt-500">{!! $Data->Description !!}</div>
                           
                            <button onclick="showMoreDescrition()" id="myBtn" class="btn btn-small btn-outline-gold">{{  __('msg.ReadMore') }}</button>
                        </section>

                        @if(app()->getLocale()=="en")
                        <section id="features" class="commonbox animate__animated animate__fadeIn animate__slow">
                            <h3 class="font-size-18 font-wt-700"><!--<i class="material-icons icon-1x1">description</i>-->{{  __('msg.Features') }}</h3>
                            <hr />
                            <div class="row">
                                @if($Data->UnitBuiltupArea > 0)
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-600">{{  __('msg.BuiltupArea') }}:</p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-500">{{  number_format($Data->UnitBuiltupArea, 2) }} Sq m.</p>
                                </div>
                                @endif
                                @if($Data->PlotSize > 0)
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-600">{{  __('msg.PlotArea') }}:</p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-500">{{ number_format($Data->PlotSize+0, 2) }} Sq m.</p>
                                </div>
                                @endif
                            </div>
                            <div class="row">
                                @if($Data->Furnished || $Data->Furnished!==2)
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-600">{{  __('msg.Furnished') }}:</p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-500">{{ config('constants.Furnished.'.$Data->Furnished)   }}</p>
                                </div>
                                @endif
                                @if($Data->Parking)
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-600">Parking:</p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-500">{{  $Data->Parking }}</p>
                                </div>
                                @endif
                            </div>
                            <div class="row">
                                @if($Data->NoFloors)
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-600">{{  __('msg.Number of Floors') }}:</p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-500">{{ $Data->NoFloors }}</p>
                                </div>
                                @endif
                    
                                @if($Data->Floor!=="")
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-600">{{  __('msg.Floor Number') }}:</p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-500">{{ config('constants.FloorNumber.'.$Data->Floor)  }}</p>
                                </div>
                                @endif
                            </div>
                            <div class="row">
                                @if($Data->ApartmentType)
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-600">{{  __('msg.Apartment') }}:</p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-500">{{ $Data->ApartmentType }}</p>
                                </div>
                                @endif
                                @if($Data->VillaType)
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-600">{{  __('msg.Villa Type') }}:</p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-500">{{ $Data->VillaType }}</p>
                                </div>
                                @endif
                            </div>
                            <div class="row">
                                @if($Data->CommercialType)
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-600">{{  __('msg.Commercial Type') }}:</p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-500">{{ $Data->CommercialType }}</p>
                                </div>
                                @endif
                                @if($Data->ResidentialLandType)
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-600">{{  __('msg.Residential Land Type') }}:</p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-500">{{ $Data->ResidentialLandType }}</p>
                                </div>
                                @endif
                            </div>
                            <div class="row">
                                @if($Data->SwimmingPool)
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-600">{{  __('msg.Swimming Pool') }}:</p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-500">{{  $Data->SwimmingPool }}</p>
                                </div>
                                @endif
                                @if($Data->OutdoorArea)
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-600">{{  __('msg.Outdoor Area') }}:</p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-500">{{  $Data->OutdoorArea }}</p>
                                </div>
                                @endif
                            </div>
                            <div class="row">
                                @if($Data->Rented)
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-600">{{  __('msg.Rented') }}:</p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-500">{{  $Data->Rented }}</p>
                                </div>
                                @endif
                                @if($Data->Nostreets)
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-600">{{  __('msg.Number of Streets') }}:</p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-500">{{  $Data->Nostreets }}</p>
                                </div>
                                @endif
                            </div>
                            <div class="row">
                                @if($Data->Serviced)
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-600">{{  __('msg.Serviced') }}:</p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-500">{{  $Data->Serviced }}</p>
                                </div>
                                @endif
                                @if($Data->BuildPercentageNumber)
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-600">{{  __('msg.Building Percentage Number') }}:</p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-500">{{ 	$Data->BuildPercentageNumber }} %</p>
                                </div>
                                @endif
                            </div>
                            <div class="row">
                                @if($Data->FacadeNumber)
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-600">{{  __('msg.Facade Number') }}:</p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-500">{{ 	$Data->FacadeNumber }}</p>
                                </div>
                                @endif
                                @if($Data->BuildFacadeType)
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-600">{{  __('msg.Building Facade Type') }}:</p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-500">{{ 	$Data->BuildFacadeType }}</p>
                                </div>
                                @endif
                                @if($Data->FloorType)
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-600">{{  __('msg.FloorType') }}:</p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-500">{{ 	$Data->FloorType }}</p>
                                </div>
                                @endif
                            </div>                                
                        </section>
                       @else
                       <section id="features" class="commonbox animate__animated animate__fadeIn animate__slow">
                        <h3 class="font-size-18 font-wt-700"><!--<i class="material-icons icon-1x1">description</i>-->{{  __('msg.Features') }}</h3>
                        <hr />
                        <div class="row">
                            @if($Data->UnitBuiltupArea > 0)
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <p class="font-wt-600">{{  __('msg.BuiltupArea') }}:</p>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <p class="font-wt-500">{{  number_format($Data->UnitBuiltupArea, 2) }} Sq m.</p>
                            </div>
                            @endif
                            @if($Data->PlotSize > 0)
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <p class="font-wt-600">{{  __('msg.PlotArea') }}:</p>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <p class="font-wt-500">{{ number_format($Data->PlotSize+0, 2) }} Sq m.</p>
                            </div>
                            @endif
                        </div>
                        <div class="row">
                            @if($Data->Furnished || $Data->Furnished!==2)
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-600">{{  __('msg.Furnished') }}:</p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-500">{{ config('constants.FurnishedAr.'.$Data->Furnished)   }}</p>
                                </div>
                                @endif
                            @if($Data->Parking)
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <p class="font-wt-600">Parking:</p>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <p class="font-wt-500">{{ $Data->Parking  }}</p>
                            </div>
                            @endif
                        </div>
                        <div class="row">
                            @if($Data->NoFloors)
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <p class="font-wt-600">{{  __('msg.Number of Floors') }}:</p>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <p class="font-wt-500">{{ $Data->NoFloors }}</p>
                            </div>
                            @endif
                            @if($Data->Floor!==" ")
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <p class="font-wt-600">{{  __('msg.Floor Number') }}:</p>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <p class="font-wt-500">{{ config('constants.FloorNumberAr.'.$Data->Floor)  }}</p>
                            </div>
                            @endif
                        </div>
                        <div class="row">
                            {{-- @if($Data->ApartmentType)
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <p class="font-wt-600">{{  __('msg.Apartment') }}:</p>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <p class="font-wt-500">{{  config('constants.ApartmentTypeAr.'.$Data->ApartmentType) }}</p>
                            </div>
                            @endif --}}
                            @if($Data->VillaType)
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <p class="font-wt-600">{{  __('msg.Villa Type') }}:</p>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <p class="font-wt-500">{{  config('constants.VillaTypeAr.'.$Data->VillaType) }}</p>
                            </div>
                            @endif
                        </div>
                        <div class="row">
                            @if($Data->CommercialType)
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <p class="font-wt-600">{{  __('msg.Commercial Type') }}:</p>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <p class="font-wt-500">{{  config('constants.CommercialTypeAr.'.$Data->CommercialType) }}</p>
                            </div>
                            @endif
                            @if($Data->ResidentialLandType)
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <p class="font-wt-600">{{  __('msg.Residential Land Type') }}:</p>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <p class="font-wt-500">{{  config('constants.ResidentialLandTypeAr.'.$Data->ResidentialLandType) }}</p>
                            </div>
                            @endif
                        </div>
                        <div class="row">
                            @if($Data->SwimmingPool)
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <p class="font-wt-600">{{  __('msg.Swimming Pool') }}:</p>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <p class="font-wt-500">{{ ($Data->SwimmingPool == "Yes")? config('constants.YesNoAr.Yes')  :   config('constants.YesNoAr.No') }}</p>
                            </div>
                            @endif
                            @if($Data->OutdoorArea)
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <p class="font-wt-600">{{  __('msg.Outdoor Area') }}:</p>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <p class="font-wt-500">{{  $Data->OutdoorArea }}</p>
                            </div>
                            @endif
                        </div>
                        <div class="row">
                            @if($Data->Rented)
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <p class="font-wt-600">{{  __('msg.Rented') }}:</p>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <p class="font-wt-500">{{ ($Data->Rented == "Yes")? config('constants.YesNoAr.Yes')  :   config('constants.YesNoAr.No') }}</p>
                            </div>
                            @endif
                            @if($Data->Nostreets)
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <p class="font-wt-600">{{  __('msg.Number of Streets') }}:</p>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <p class="font-wt-500">{{  $Data->Nostreets }}</p>
                            </div>
                            @endif
                        </div>
                        <div class="row">
                            @if($Data->Serviced)
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <p class="font-wt-600">{{  __('msg.Serviced') }}:</p>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <p class="font-wt-500">{{ ($Data->Serviced == "Yes")? config('constants.YesNoAr.Yes')  :   config('constants.YesNoAr.No') }}</p>
                            </div>
                            @endif
                            @if($Data->BuildPercentageNumber)
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <p class="font-wt-600">{{  __('msg.Building Percentage Number') }}:</p>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <p class="font-wt-500">{{ 	$Data->BuildPercentageNumber }} %</p>
                            </div>
                            @endif
                        </div>
                        <div class="row">
                            @if($Data->FacadeNumber)
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <p class="font-wt-600">{{  __('msg.Facade Number') }}:</p>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <p class="font-wt-500">{{ 	$Data->FacadeNumber }}</p>
                            </div>
                            @endif
                            @if($Data->BuildFacadeType)
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <p class="font-wt-600">{{  __('msg.Building Facade Type') }}:</p>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <p class="font-wt-500">{{  config('constants.BuildingFacadeTypeAr.'.$Data->BuildFacadeType) }}</p>
                            </div>
                            @endif
                            @if($Data->FloorType)
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-600">{{  __('msg.FloorType') }}:</p>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                    <p class="font-wt-500">{{ 	$Data->FloorType }}</p>
                                </div>
                                @endif
                        </div>                                
                    </section>
                       @endif
                       @if(empty(!$Data->Video))
                        <section id="videos" class="commonbox animate__animated animate__fadeIn animate__slow">
                            <h3 class="font-size-18 font-wt-700"><!--<i class="material-icons icon-1x1">description</i>-->{{  __('msg.Videos') }}</h3>
                            <hr />
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    @if ($Data->Video)
                                    <iframe width="100%" height="420" src="{{ $Data->Video  }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> 
                                    @else
                                        <h5>{{  __('msg.NoVideo') }}</h5>
                                    @endif
                                </div>
                            </div>
                        </section>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                        <div class="commonbox animate__animated animate__fadeIn animate__slow stickymenu" style="z-index:0;">
                         
                            <div class="center">
                               
                                <p class="font-size-16 font-wt-600">{{  __('msg.ContactUsTime') }}</p>
                                 @if($Data->DisplayPhoto)
                                 <img src="{{  URL::asset('uploads/agent/'.$Data->DisplayPhoto)  }}" class="img-round-border mb-3"/>
                                 @endif
                                 @if($Data->DisplayName)
                                <p class="font-size-16 lh-25 font-wt-600">{{ $Data->DisplayName }}</p>
                                @endif
                                @if($Data->DisplayPhone)
                                <a href="tel:{{ str_replace('-','',$Data->DisplayPhone) }}"><p class="mb-1"><i class="material-icons icon-1x">call</i><span dir="ltr">&nbsp;{{ $Data->DisplayPhone }}</span></p></a>
                                @endif
                                @if($Data->DisplayEmail)
                                <a href="mailto:{{ $Data->DisplayEmail }}"><p><i class="material-icons icon-1x">email</i>&nbsp;{{ $Data->DisplayEmail }}</p></a>
                                @endif
                                

                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center mb-2">
                                        @if($Data->AdType==2)
                                    <a href="{{ route('search-properties',[app()->getLocale(),'sale',strtolower($Data->TypeName)]) }}" class="btn btn-gold w-100">{{ __('msg.SearchSimilarProperties') }}</a>
                                    @else
                                    <a href="{{ route('search-properties',[app()->getLocale(),'rent',strtolower($Data->TypeName)] )}}" class="btn btn-gold w-100">{{ __('msg.SearchSimilarProperties') }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
            </div><br />
            
        </div>
    
    </div>
</section>
@else
<section class="gray">
    <h2><center> No Details Available</center></h2>
</section>
@endif

<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "%Product_Name%",
  "image": "%Product_Image%",
  "description": "%Product_Content%",
  "brand": {
    "@type": "Brand",
    "name": "Homes Jordan"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "5",
    "bestRating": "5",
    "worstRating": "5",
    "ratingCount": "125"
  }
}
</script>
@endsection