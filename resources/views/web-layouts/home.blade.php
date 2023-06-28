@extends('web-layouts.app')
@section('content')
@section('title'){{ $item->MetaTitle }} @endsection
@if($Data->Banners->first())
<section id="main-slider" class="no-margin d-none d-sm-block">
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @php $i=1; @endphp
            @foreach($Data->Banners as $val)
           <div class="carousel-item @if($i==1) active @endif">

               <img class="d-block w-100" src="{{ URL::asset('uploads/banner/'.$val->Image) }}" alt="{{ $val->Alt }}">
           </div>
             @php $i++; @endphp
             @endforeach
        </div>
        {{-- <button class="carousel-control-prev d-none d-sm-block" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next d-none d-sm-block" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button> --}}
    </div>
</section>
@endif
<div class="animate__animated animate__fadeIn animate__slow">
    <div class="container">
        <div class="searchbox">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-sale-tab" data-bs-toggle="pill" data-bs-target="#pills-sale" type="button" role="tab" aria-controls="pills-sale" aria-selected="true">{{ __('msg.Sale') }}</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-rent-tab" data-bs-toggle="pill" data-bs-target="#pills-rent" type="button" role="tab" aria-controls="pills-rent" aria-selected="false">{{ __('msg.Rent') }}</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-sale" role="tabpanel" aria-labelledby="pills-sale-tab">
                    <form  id="sale_form" action="{{ route('search-properties',[app()->getLocale(),'sale','','']) }}" method="get">
                        <input type="hidden" id="sale_form_url" value="{{ route('search-properties',[app()->getLocale(),'sale','','']) }}">
                    <div class="row g-3">
                        <div class="col-xl-3 col-lg-2 col-md-6 col-sm-6 col-12">
                            <div class="form-floating">
                                <select name="t" class="form-select saleurlfilter" id="sale-type" aria-label="Floating label select example">
                                    <option value="">{{  __('msg.Select') }}</option>
                                    @foreach($Data->PropertyUnitTypes as $unitypes)
                                    <option value="{{ $unitypes->ID }}" data-char="{{ strtolower(preg_replace('/[^A-Za-z0-9\-]/', '-',$unitypes->TypeNameEng))  }}">{{ $unitypes->TypeName }}</option>
                                    @endforeach
                                </select>
                                <label>{{  __('msg.PropertyType') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="form-floating">
                                <select name="c"  id="sale-city" class="form-select select2 city saleurlfilter"   data-type="sale" aria-label="Floating label select example">
                                    <option value="">{{  __('msg.Select') }}</option>
                                    @foreach($Data->City as $city)
                                    <option value="{{ $city->ID }}" data-char="{{ strtolower(preg_replace('/[^A-Za-z0-9\-]/', '-', $city->CityNameEng)) }}">{{ $city->CityName }}</option>
                                    @endforeach
                                </select>
                                <label >{{  __('msg.City') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-5 col-md-6 col-sm-6 col-12">
                            <div class="form-floating">
                                <select name="" class="form-select select2 locationlist saleurlfilter" id="sale-locationlist" data-type="sale" multiple="multiple"  aria-label="Floating label select example">
                                    <option value="">{{  __('msg.Select') }}</option>
                                    @foreach($Data->Communities as $Communities)
                                    <option value="{{ $Communities->ID }}" data-char="{{ strtolower(preg_replace('/[^A-Za-z0-9\-]/', '-', $Communities->CommunityNameEng)) }}"  data-cityid="{{ $Communities->CityID }}">{{ $Communities->CommunityName }}</option>
                                    @endforeach
                                </select>
                                <label>{{  __('msg.SelectMultipleLocations') }}</label>
                            </div>
                            <input type="hidden" name="l" id="sale-selected-locations">
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-12">
                            <div class="form-floating">
                                <input type="text"  name="rfn" class="form-control" placeholder="">
                                <label>{{  __('msg.ReferenceNo') }}</label>
                                <input type="hidden"  name="adt" value="{{ config('constants.AdType.Sale') }}">
                                <input type="hidden"  name="ly" value="1">
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">
                            <div class="form-floating">
                                <select name="mnpr" class="form-select" aria-label="Floating label select example">
                                    <option value="" selected>{{  __('msg.Select') }}</option>
                                    <option value="0">{{ currency_format(0)  }}</option> 
                                    @foreach (config('constants.MinPrice') as $key=>$minprice)
                                    <option value="{{ $key }}">{{ currency_format($key)  }}</option> 
                                    @endforeach
                                </select>
                                <label>{{  __('msg.MinPrice') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">
                            <div class="form-floating">
                                <select name="mxpr" class="form-select" aria-label="Floating label select example">
                                    <option value="" selected>{{  __('msg.Select') }}</option>
                                    @foreach (config('constants.MaxPrice') as $key=>$maxprice)
                                    <option value="{{ $key }}">{{ currency_format($key)  }}@if($key==100000000)+@endif</option> 
                                    @endforeach
                                </select>
                                <label>{{  __('msg.MaxPrice') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">
                            <div class="form-floating">
                                <select name="mnbd"  class="form-select" aria-label="Floating label select example">
                                    <option value='' selected>{{  __('msg.Select') }}</option>
                                    @foreach (config('constants.BedRooms') as $key=>$beds)
                                    <option value="{{ $key }}" {{ (app('request')->input('mnbd') == $key)? "selected": "" }}>{{ $beds  }}</option> 
                                    @endforeach
                                </select>
                                <label >{{  __('msg.MinBed') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">
                            <div class="form-floating">
                                <select   name="mxbd" class="form-select" aria-label="Floating label select example">
                                    <option value="" selected>{{  __('msg.Select') }}</option>
                                    @foreach (config('constants.BedRooms') as $key=>$beds)
                                    <option value="{{ $key }}" {{ (app('request')->input('mxbd') == $key)? "selected": "" }}>{{ $beds  }}</option> 
                                    @endforeach
                                </select>
                                <label>{{  __('msg.MaxBed') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-12">
                            <button class="btn btn-large w-100 btn-gold btn-block" type="submit">{{  __('msg.Search') }}</button>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="pills-rent" role="tabpanel" aria-labelledby="pills-rent-tab">
                    <form id="rent_form" action="{{ route('search-properties',[app()->getLocale(),'rent','','']) }}" method="get">
                        <input type="hidden" id="rent_form_url" value="{{ route('search-properties',[app()->getLocale(),'rent','','']) }}">
                    <div class="row g-3">
                        <div class="col-xl-3 col-lg-2 col-md-6 col-sm-6 col-12">
                            <div class="form-floating">
                                <select name="t"  id="rent-type" class="form-select renturlfilter" aria-label="Floating label select example">
                                    <option value="">{{  __('msg.Select') }}</option>
                                    @foreach($Data->PropertyUnitTypes as $unitypes)
                                    @if($unitypes->ID== 2)
                                    @else
                                    <option value="{{ $unitypes->ID }}" data-char="{{ strtolower(preg_replace('/[^A-Za-z0-9\-]/', '-',$unitypes->TypeNameEng)) }}">{{ $unitypes->TypeName }}</option>
                                    @endif
                                    @endforeach
                                </select>
                                <label>{{  __('msg.PropertyType') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="form-floating">
                                <select name="c" id="rent-city" class="form-select select2 city renturlfilter"  data-type="rent" aria-label="Floating label select example">
                                    <option value="">{{  __('msg.Select') }}</option>
                                    @foreach($Data->City as $city)
                                    <option value="{{ $city->ID }}"  data-char="{{ strtolower(preg_replace('/[^A-Za-z0-9\-]/', '-', $city->CityNameEng)) }}">{{ $city->CityName }}</option>
                                    @endforeach
                                </select>
                                <label >{{  __('msg.City') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-5 col-md-6 col-sm-6 col-12">
                            <div class="form-floating">
                                <select name="" class="form-select select2 locationlist" id="rent-locationlist" data-type="rent" multiple="multiple"  aria-label="Floating label select example">
                                    @foreach($Data->Communities as $Communities)
                                    <option value="{{ $Communities->ID }}" data-char="{{ strtolower(preg_replace('/[^A-Za-z0-9\-]/', '-', $Communities->CommunityNameEng)) }}" data-cityid="{{ $Communities->CityID }}">{{ $Communities->CommunityName }}</option>
                                    @endforeach
                                </select>
                                <label>Select Multiple Location</label>
                            </div>
                            <input type="hidden" name="l" id="rent-selected-locations">
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-12">
                            <div class="form-floating">
                                <input type="text"  name="rfn" class="form-control"   placeholder="">
                                <label>{{  __('msg.ReferenceNo') }}</label>
                                <input type="hidden"  name="adt" value="{{ config('constants.AdType.Rent') }}">
                                <input type="hidden"  name="ly" value="1">
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">
                            <div class="form-floating">
                                <select name="mnpr" class="form-select" aria-label="Floating label select example">
                                    <option value="" selected>{{  __('msg.Select') }}</option>
                                    <option value="0">{{ currency_format(0)  }}</option> 
                                    @foreach (config('constants.MinPriceRent') as $key=>$minprice)
                                    <option value="{{ $key }}">{{ currency_format($key)  }}</option> 
                                    @endforeach
                                </select>
                                <label>{{  __('msg.MinPrice') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">
                            <div class="form-floating">
                                <select name="mxpr" class="form-select" aria-label="Floating label select example">
                                    <option value="" selected>{{  __('msg.Select') }}</option>
                                    @foreach (config('constants.MaxPriceRent') as $key=>$maxprice)
                                    <option value="{{ $key }}">{{ currency_format($key)  }}@if($key==2000000)+@endif</option> 
                                    @endforeach
                                </select>
                                <label>{{  __('msg.MaxPrice') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">
                            <div class="form-floating">
                                <select name="mnbd"  class="form-select" aria-label="Floating label select example">
                                    <option value='' selected>{{  __('msg.Select') }}</option>
                                    @foreach (config('constants.BedRooms') as $key=>$beds)
                                    <option value="{{ $key }}" {{ (app('request')->input('mnbd') == $key)? "selected": "" }}>{{ $beds  }}</option> 
                                    @endforeach
                                </select>
                                <label >{{  __('msg.MinBed') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">
                            <div class="form-floating">
                                <select   name="mxbd" class="form-select" aria-label="Floating label select example">
                                    <option value="" selected>{{  __('msg.Select') }}</option>
                                    @foreach (config('constants.BedRooms') as $key=>$beds)
                                    <option value="{{ $key }}" {{ (app('request')->input('mxbd') == $key)? "selected": "" }}>{{ $beds  }}</option> 
                                    @endforeach
                                </select>
                                <label>{{  __('msg.MaxBed') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-12">
                            <button class="btn btn-large w-100 btn-gold btn-block" type="submit">{{  __('msg.Search') }}</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    @if(count($Data->Exclusive) > 0)
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 center">
                    <h2 class="font-size-28 font-wt-700 animate__animated animate__fadeIn animate__slow">{{  __('msg.ExclusiveOnHomes') }}</h2>
                </div>
            </div>
            <br />
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="row" dir="ltr">

                        @foreach ($Data->Exclusive as $val)
                        @php //$PropertyLinkTitle=trim(preg_replace("/[^A-Za-z0-9\-]/", '-', $val->PropertyLinkTitle)); 
                                $val->Description=str_replace(['&amp;','nbsp;'],'', $val->Description);
                                $formatedRefNo=preg_replace('/[^0-9]/', '', $val->PropertyRefNo);
                                $val->Description=str_replace($formatedRefNo,$formatedRefNo.' ', $val->Description);
                                $DisplayPhone=str_replace('-','',$val->DisplayPhone);
                                @endphp
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <div class="card  animate__animated animate__fadeIn animate__slow h-100">
                                <span class="ribbon">{{  __('msg.Exclusive') }}</span>
                                <figure>
                                    <a href="{{ route('property-details',[app()->getLocale(),$Data->AdTypeText[$val->AdType],$val->Plural,$val->Slug,$val->PropertyRefNo]) }}">
                                        @if ($val->FileName && $val->IsDownloaded==1)
                                        <img src="{{ asset("uploads/properties/orignal/".$val->PropertyRefNo."/".$val->FileName) }}" class="card-img-top listing-card-img" alt="{{ $val->ImgAlt }}">
                                        <div class="list-overlay"></div>  
                                    @else
                                        <img src="{{ asset("images/noimg.jpg")}}" class="card-img-top listing-card-img" alt="no image">
                                        <div class="list-overlay"></div>  
                                        
                                    @endif
                                    </a>
                                    <p class="location font-size-12 color-white"><i class="material-icons icon-1x">location_on</i> {{ $val->CommunityName }}, {{ $val->CityName }}, {{  __('msg.Jordan') }}</p>
                                </figure>
                                <div class="card-body">
                                    @php  
                                    $PropertyTitle=Str::limit($val->PropertyTitle,40,'...');
                                    @endphp 
                                    <a href="{{ route('property-details',[app()->getLocale(),$Data->AdTypeText[$val->AdType],$val->Plural,$val->Slug,$val->PropertyRefNo]) }}">
                                        <h2 class="font-size-16 font-wt-600 lh-25">{!!  closetags($PropertyTitle)  !!}</h2>
                                    </a>
                                    <p class="font-size-18 font-wt-700 color-gold float-left">{{  currency_format($val->Price) }}</p>
                                    <div class="clearfix"></div>
                                    <div class="row pl-2 pr-2">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 pl-0 pr-0 pt-1 pb-1" style="display: flex;flex-wrap: wrap; line-height:2;">
                                            @php $CardViewFields=explode(',',$val->CardViewFields) @endphp
                                            @if(in_array('bed',$CardViewFields))
                                            <i class="material-icons icon-2x color-gray pe-1" title="Bedroom">king_bed</i>
                                            <span class="font-size-12 font-wt-500">{{ $val->NoBedrooms }}</span>
                                            @endif
                                            @if(in_array('bath',$CardViewFields))
                                            <i class="material-icons icon-2x color-gray ps-1 pe-1" title="Bathroom">shower</i>
                                            <span class="font-size-12 font-wt-500">{{ $val->NoBathrooms }}</span>
                                            @endif
                                            {{-- @if(in_array('builtup',$CardViewFields))
                                            <i class="material-icons icon-2x color-gray ps-1 pe-1" title="Built Up Area">foundation</i>
                                            <span class="font-size-12 font-wt-500" title="Built Up Area">{{ number_format($val->UnitBuiltupArea, 2) }} Sqm.</span>
                                            @endif --}}
                                             @if(in_array('plot',$CardViewFields))
                                            <i class="material-icons icon-2x color-gray ps-1 pe-1" title="Plot Area">aspect_ratio</i>
                                            <!--<span class="font-size-12 font-wt-500" title="Plot Area">{{ number_format($val->PlotSize+0, 2)  }} Sqm.</span>-->
                                            <span class="font-size-12 font-wt-500" title="Plot Area">{{ $val->PlotSize+0  }} Sqm.</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 center">
                            <a href="{{ route('all-exclusive-properties',app()->getLocale()) }}" class="btn btn-gold btn-medium">{{  __('msg.AllExclusiveProperties') }}</a>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    @if(count($Data->Feautured) > 0)
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 center">
                    <h2 class="font-size-28 font-wt-700 animate__animated animate__fadeIn animate__slow">{{  __('msg.FeaturedProperties') }}</h2>
                    <!--<p class="font-size-16 color-black animate__animated animate__fadeIn animate__slow">{{  __('msg.FeaturedText') }}</p>-->
                </div>
            </div>
            <br />
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="row" dir="ltr">

                        @foreach ($Data->Feautured as $val)
                        @php //$PropertyLinkTitle=trim(preg_replace("/[^A-Za-z0-9\-]/", '-', $val->PropertyLinkTitle)); 
                                $val->Description=str_replace(['&amp;','nbsp;'],'', $val->Description);
                                $formatedRefNo=preg_replace('/[^0-9]/', '', $val->PropertyRefNo);
                                $val->Description=str_replace($formatedRefNo,$formatedRefNo.' ', $val->Description);
                                $DisplayPhone=str_replace('-','',$val->DisplayPhone);
                                @endphp
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <div class="card animate__fadeIn animate__slow h-100">
                                <span class="ribbon">{{  __('msg.Featured') }}</span>
                                <figure>
                                    <a href="{{ route('property-details',[app()->getLocale(),$Data->AdTypeText[$val->AdType],$val->Plural,$val->Slug,$val->PropertyRefNo]) }}">

                                        @if ($val->FileName && $val->IsDownloaded==1)
                                        <img src="{{ asset("uploads/properties/orignal/".$val->PropertyRefNo."/".$val->FileName) }}" class="card-img-top listing-card-img" alt="{{ $val->ImgAlt }}">
                                        <div class="list-overlay"></div>  
                                    @else
                                        <img src="{{ asset("images/noimg.jpg")}}" class="card-img-top listing-card-img" alt="no image">
                                        <div class="list-overlay"></div>  
                                        
                                    @endif
                                    </a>
                                    <p class="location font-size-12 color-white"><i class="material-icons icon-1x">location_on</i> {{ $val->CommunityName }}, {{ $val->CityName }}, {{  __('msg.Jordan') }}</p>
                                </figure>
                                <div class="card-body">
                                    @php  
                                    $PropertyTitle=Str::limit($val->PropertyTitle,40,'...');
                                    @endphp 
                                    <a href="{{ route('property-details',[app()->getLocale(),$Data->AdTypeText[$val->AdType],$val->Plural,$val->Slug,$val->PropertyRefNo]) }}">
                                        <h2 class="font-size-16 font-wt-600 lh-25">{!!  closetags($PropertyTitle)  !!}</h2>
                                    </a>
                                    <p class="font-size-18 font-wt-700 color-gold float-left">{{  currency_format($val->Price) }}</p>
                                    <div class="clearfix"></div>
                                    <div class="row pl-2 pr-2">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 pl-0 pr-0 pt-1 pb-1">
                                            @php $CardViewFields=explode(',',$val->CardViewFields) @endphp
                                            @if(in_array('bed',$CardViewFields))
                                            <i class="material-icons icon-2x color-gray" title="Bedroom">king_bed</i>
                                            <span class="font-size-12 font-wt-600">{{ $val->NoBedrooms }}</span>
                                            @endif
                                            @if(in_array('bath',$CardViewFields))
                                            <i class="material-icons icon-2x color-gray pl-2" title="Bathroom">shower</i>
                                            <span class="font-size-12 font-wt-600">{{ $val->NoBathrooms }}</span>
                                            @endif
                                            {{-- @if(in_array('builtup',$CardViewFields))
                                            <i class="material-icons icon-2x color-gray pl-2" title="Built Up Area">foundation</i>
                                            <span class="font-size-12 font-wt-600" title="Built Up Area">{{ number_format($val->UnitBuiltupArea, 2) }} Sqm.</span>
                                            @endif --}}
                                             @if(in_array('plot',$CardViewFields))
                                            <i class="material-icons icon-2x color-gray pl-2" title="Plot Area">aspect_ratio</i>
                                            <!--<span class="font-size-12 font-wt-600" title="Plot Area">{{ number_format($val->PlotSize+0, 2)  }} Sqm.</span>-->
                                             <span class="font-size-12 font-wt-500" title="Plot Area">{{ $val->PlotSize+0  }} Sqm.</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 center">
                            <a href="{{ route('all-feautred-properties',app()->getLocale()) }}" class="btn btn-gold btn-medium">{{  __('msg.AllFeaturedProperties') }}</a>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
   @if(count($Data->FeaturedLocations)>0)
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 center">
                    <h2 class="font-size-28 font-wt-700 animate__animated animate__fadeIn animate__slow">{{  __('msg.FeaturedLocationInAmman') }}</h2>
                    <!--<p class="font-size-16 color-black animate__animated animate__fadeIn animate__slow">Get the most recent and best property as per the need!!!</p>-->
                </div>
            </div>
            <br />
            <!-- DEMO 2-->
            <div class="py-3">
                <div class="row">
                    <!-- DEMO 2 Item-->
                    @foreach ($Data->FeaturedLocations as $location)
                  
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-12 mb-3">
                        <a href="{{ route('search-properties',[app()->getLocale(),'sale',strtolower(preg_replace('/[^A-Za-z0-9\-]/', '-', $location->CommunityNameEng)),'c'=>$location->CityID,'l'=>$location->ID,'adt'=>2]) }}">
                        <div class="hover hover-2 text-white">
                            @if ($location->Image && $val->IsDownloaded==1)
                            <img src="{{ asset("uploads/communities/".$location->Image) }}" alt="{{ $location->Alt }}">                           
                            @else
                            <img src="{{ asset("images/noimg.jpg")}}">
                            @endif
                            <div class="hover-overlay"></div>
                            <div class="hover-2-content px-5 py-4">
                                <h2 class="hover-2-title font-wt-600 mb-0"><span class="font-weight-light">{{ $location->CommunityName }} </span></h2>
                                <p class="hover-2-description mb-0">
                                    {{ $location->properties_rent_count+0 }} {{  __('msg.propertiesforrent') }}
                                    <br />
                                    {{ $location->properties_sale_count+0 }} {{  __('msg.propertiesforsale') }}
                                    <br />
                                    {{  __('msg.PricesStartingFrom') }}  {{ currency_format($location->min_sale_price) }}
                                </p>
                            </div>
                        </div>
                    </a>
                    </div>
                  
                    @endforeach

                </div>
            </div>
        </div>
    </section>
 @endif


<section class="gray pt-5 pb-5 d-none d-sm-block"  style="background: #fff url('images/back8.png') no-repeat scroll center center;background-size:100%;background-origin: content-box;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12 center">
                <p class="font-size-28 font-wt-700 pull-left animate__animated animate__fadeIn animate__slow">{{ __('msg.headline') }}</p>
            </div>
        </div>
        <br /><br /><br /><br /><br />
        <div class="row" dir="ltr">
            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-12">
            </div>
            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12 mb-3 animate__animated animate__slideInLeft animate__slow">
                <img src="images/slide2.jpg" width="90%" style="border-radius:10px;" />
            </div>
            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12 mb-3">
                {!! __('msg.welcome') !!}
                <a href="{{ route('search-properties',[app()->getLocale(),'sale']) }}" class="btn btn-medium btn-gold animate__animated animate__fadeIn animate__slow">{{  __('msg.SearchProperties') }}</a>
            </div>
        </div>
    </div>
    <br /><br /><br /><br /><br />
</section>
<!-- This is for Mobile -->
<section class="pt-5 pb-5 d-block d-xl-none d-lg-none d-md-none d-sm-none">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12 center">
                <h1 class="font-size-28 font-wt-700 lh-40 pull-left animate__animated animate__fadeIn animate__slow">{{ __('msg.headline') }}</h1>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-1 center mb-3 animate__animated animate__slideInLeft animate__slow">
                <img src="images/slide2.jpg" width="90%" style="border-radius:10px;" />
            </div>
            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5 col-12 mb-3 center">
                {!! __('msg.welcome') !!}
                <a href="{{ route('search-properties',[app()->getLocale(),'sale']) }}" class="btn btn-medium btn-gold animate__animated animate__fadeIn animate__slow">{{  __('msg.SearchProperties') }}</a>
            </div>
        </div>
    </div>
</section>
@if(count($Data->Services) > 0)
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 center">
                <h2 class="font-size-28 font-wt-700 pb-3 animate__animated animate__fadeIn animate__slow">{{ __('msg.OurServices') }}</h2>
                <p class="font-size-16 color-black animate__animated animate__fadeIn animate__slow">{!! __('msg.OurServicesText') !!}</p>
            </div>
        </div><br />
        <div class="row">
            @foreach ($Data->Services as $val)
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="card animate__animated animate__fadeIn animate__slow">
                    <figure>
                
                        <a href="{{route('servicesdetails',[app()->getLocale(),urlencode($val->Slug)])}}">
                            <img src="{{ URL::asset('uploads/services/'.$val->Image) }}" class="card-img-top listing-card-img" alt="{{ $val->Alt }}">
                            <div class="list-overlay"></div>
                        </a>
                    </figure>
                    <div class="card-body">
                        <a href="{{route('servicesdetails',[app()->getLocale(),urlencode($val->Slug)])}}">
                            <h2 class="font-size-16 font-wt-600">{!! Str::limit(strip_tags($val->Title),30, $end='...')  !!}</h2>
                        </a>
                        <p class="font-size-12 font-wt-500 color-gray">{!! Str::limit(strip_tags($val->Description),80, $end='.......')  !!}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 center">
                    <a href="{{ route('our-services',app()->getLocale()) }}" class="btn btn-gold btn-medium">{{  __('msg.AllServices') }}</a>
                   
                </div>
            </div>
    </div>
</section>
@endif


@if(count($Data->Agents) > 0)
<section style="background:url({{ asset('images/building.jpg') }}) no-repeat scroll center center;background-size:cover; background-attachment:fixed;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 center">
                <h2 class="font-size-28 font-wt-700 color-white animate__animated animate__fadeIn animate__slow">{{  __('msg.ConsultOurAgents') }}</h2>
               
            </div>
        </div><br />
        <div class="row">

            @foreach ($Data->Agents as $val)
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12 mb-2">
                    <div class="card center h-100 animate__animated animate__fadeIn animate__slow">
                        <div class="card-body">
                            <img src="{{ ($val->DisplayPhoto)? URL::asset('uploads/agent/'.$val->DisplayPhoto)  :  asset('images/default_agent_image.png')}}" class="img-round-border" alt="">
                            <br /><br />
                            <h2 class="font-size-16 font-wt-600">{{ ($val->DisplayName)? $val->DisplayName : "-"}}</h2>
                            <a href="mailto:{{ $val->DisplayEmail }}"><p class="font-wt-500 color-gold">{{ ($val->DisplayEmail)? $val->DisplayEmail : "-"}}</p></a>
                            <a href="tel:{{ str_replace('-','',$val->DisplayPhone) }}"><p class="font-wt-500" dir="ltr">{{ ($val->DisplayPhone)?$val->DisplayPhone: "-" }}</p></a>
                            <!--@if (app()->getLocale()=='ar')
                            <h4><a href="{{ url(app()->getLocale().'/search-properties') . '?' . http_build_query(['adt' => 'Sale']); }}"><span class="badge rounded-pill gold">{{ ($val->PropertyType)? config('constants.AgentPropertyTypeAr.'.$val->PropertyType): "-" }}</span></a></h4>
                            @else
                            <h4><a href="{{ url(app()->getLocale().'/search-properties') . '?' . http_build_query(['adt' => 'Sale']); }}"><span class="badge rounded-pill gold">{{ ($val->PropertyType)?$val->PropertyType: "-" }}</span></a></h4>  
                            @endif-->
                        </div>
                    </div>
            </div>
            @endforeach
        </div>
        <br/>
        <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 center">
                    <a href="{{ url(app()->getLocale().'/properties/sale') . '?' . http_build_query(['adt' => '2']); }}" class="btn btn-gold btn-medium">{{  __('msg.SearchProperties') }}</a>
                </div>
            </div>
    </div>
</section>
@endif
@if(count($Data->Testimonials) > 0)
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 center">
                <h3 class="font-size-28 font-wt-700 animate__animated animate__fadeIn animate__slow">{{  __('msg.WhatClientsSay') }}</h3>
            </div>
        </div><br />
        <div class="row testimonial" dir="ltr">
            @foreach ($Data->Testimonials as $val)
         
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <i class="material-icons icon-8x color-gold">format_quote</i>
                        <p>{{$val->Message  }}</p>
                        <hr>
                        <div class="row">
                            <!--<div class="col-xl-2 col-lg-3 col-md-3 col-sm-3 col-3">
                                <img src="{{ URL::asset('uploads/testimonial/'.$val->Photo) }}" class="roundborder-lg" alt="">
                            </div>-->
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <p class="font-size-16 font-wt-600">{{$val->CustomerName  }}</p>
                               <!-- <p class="color-gray">{{$val->Designation  }}</p>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
            @endforeach
          
        </div>
        
    </div>
    
</section>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 center">
        <a href="https://g.page/r/CW_wTbZ1CIk0EBM/review" target="_blank" class="btn btn-gold btn-medium">{{  __('msg.AllGoogleReviews') }}</a>
    </div>
</div>
@endif
@if(count($Data->Blogs) > 0)
<section class="white">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 center">
                <h3 class="font-size-28 font-wt-700 animate__animated animate__fadeIn animate__slow">{{  __('msg.OurBlogs') }}</h3>
            </div>
        </div><br />
        <div class="row">
            @foreach ($Data->Blogs as $val)
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="card animate__animated animate__fadeIn animate__slow">
                    <figure>
                
                        <a href="{{route('blogdetails',[app()->getLocale(),urlencode($val->Slug)])}}">
                            <img src="{{ URL::asset('uploads/blog/'.$val->Image) }}" class="card-img-top listing-card-img" alt="{{ $val->Alt }}">
                            <div class="list-overlay"></div>
                        </a>
                    </figure>
                    <div class="card-body">
                        <a href="{{route('blogdetails',[app()->getLocale(),urlencode($val->Slug)])}}">
                            <h2 class="font-size-16 font-wt-600">{!! Str::limit(strip_tags($val->Title),30, $end='...')  !!}</h2>
                        </a>
                        <p class="font-size-12 font-wt-500 color-gray">{!! Str::limit(strip_tags($val->Description),80, $end='.......')  !!}</p>
                        <p class="font-size-14 font-wt-500 color-gold  mb-1"><span dir="ltr">{{ date("d-M-Y",strtotime($val->CreatedDate));  }}</span></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 center">
                    <a href="{{ route('blogs',app()->getLocale()) }}" class="btn btn-gold btn-medium">{{  __('msg.AllBlogs') }}</a>
                </div>
            </div>
    </div>
</section>
@endif

<div class="">
               
    <div class="container">
                      
       <div class="row p-3">
           <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
                     <li class="nav-item" role="presentation">
                         <button class="nav-link active" id="pills-sale-tab1" data-bs-toggle="pill" data-bs-target="#pills-sale1" type="button" role="tab" aria-controls="pills-sale1" aria-selected="true">{{ __('msg.Sale') }}</button>
                     </li>
                     <li class="nav-item" role="presentation">
                         <button class="nav-link" id="pills-rent-tab1" data-bs-toggle="pill" data-bs-target="#pills-rent1" type="button" role="tab" aria-controls="pills-rent1" aria-selected="false">{{ __('msg.Rent') }}</button>
                     </li>
           </ul>
           <div class="tab-content" id="pills-tabContent">
                     <div class="tab-pane fade show active" id="pills-sale1" role="tabpanel" aria-labelledby="pills-sale-tab1">
                         <div class="row">
                          
                             @foreach ($Data->UrlUnitTypes as $val)
                             @if($val->sale_count > 0)
                             @php 
                             $salecondition=array('UnitTypeID' =>$val->ID,'AdType'=>'2');
                             @endphp 
                             @if(app()->getLocale()=='en')
                             <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
                                <p class="title font-wt-700 font-size-16">{{ $val->TypeNameEng }}</p>
                                @php 
                                 $seolinks=$Data->Seourl;
                                $links=array_values(multi_array_search($Data->Seourl, $salecondition));
                                @endphp
                                <ul>
                                   @for ($i=0;$i<count($links);$i++)
                                   @php 
                                    $linkdata=$seolinks[$links[$i]];
                                   @endphp
                                   <li class="pb-1"><a href="{{ $linkdata['Link'] }}">{{ $linkdata['Title'] }}</a></li>
                                   @endfor
                                </ul>
                             </div>
                             @else
                             <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
                                <p class="title font-wt-700 font-size-16">{{ $val->TypeNameAr }}</p>
                                @php 
                                 $seolinks=$Data->Seourl;
                                $links=array_values(multi_array_search($Data->Seourl, $salecondition));
                                @endphp
                                <ul>
                                   @for ($i=0;$i<count($links);$i++)
                                   @php 
                                    $linkdata=$seolinks[$links[$i]];
                                   @endphp
                                   <li class="pb-1"><a href="{{ str_replace('en','ar',$linkdata['LinkAr']) }}">{{ $linkdata['TitleAr'] }}</a></li>
                                   @endfor
                                </ul>
                             </div>
                             @endif
                             @endif
                             @endforeach
                            
                             
            
                         </div>
                     </div>
                     <div class="tab-pane fade" id="pills-rent1" role="tabpanel" aria-labelledby="pills-rent-tab1">
                         <div class="row">
                             @foreach ($Data->UrlUnitTypes as $val)
                             @if($val->rent_count > 0)
                             @php 
                             $rentcondition=array('UnitTypeID' =>$val->ID,'AdType'=>'1');
                             @endphp 
                             @if(app()->getLocale()=='en')
                             <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
                                <p class="title font-wt-700 font-size-16">{{ $val->TypeNameEng }}</p>
                                @php 
                                 $seolinks=$Data->Seourl;
                                $links=array_values(multi_array_search($Data->Seourl, $rentcondition));
                                @endphp
                                <ul>
                                   @for ($i=0;$i<count($links);$i++)
                                   @php 
                                    $linkdata=$seolinks[$links[$i]];
                                   @endphp
                                   <li class="pb-1"><a href="{{ $linkdata['Link'] }}">{{ $linkdata['Title'] }}</a></li>
                                   @endfor
                                </ul>
                             </div>
                             @else
                             <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
                                <p class="title font-wt-700 font-size-16">{{ $val->TypeNameAr }}</p>
                                @php 
                                 $seolinks=$Data->Seourl;
                                $links=array_values(multi_array_search($Data->Seourl, $rentcondition));
                                @endphp
                                <ul>
                                   @for ($i=0;$i<count($links);$i++)
                                   @php 
                                    $linkdata=$seolinks[$links[$i]];
                                   @endphp
                                   <li class="pb-1"><a href="{{ str_replace('en','ar',$linkdata['LinkAr']) }}">{{ $linkdata['TitleAr'] }}</a></li>
                                   @endfor
                                </ul>
                             </div>
                             @endif
                             @endif
                             @endforeach
                           
                         </div>
                     </div>
           </div>       
       </div>   
    </div>
 </div>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "GeneralContractor",
  "name": "Homes Jordan",
  "image": "https://www.homes-jordan.com/",
  "@id": "",
  "url": "https://www.homes-jordan.com/",
  "telephone": "+962-79-2222140",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "King Abdullah Bin Al Hussein II Street (Medical City Street) - King Hussein Business Complex, Building No. 7",
    "addressLocality": "Amman",
    "postalCode": "",
    "addressCountry": "JO"
  },
  "openingHoursSpecification": {
    "@type": "OpeningHoursSpecification",
    "dayOfWeek": [
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday",
      "Saturday",
      "Sunday"
    ],
    "opens": "00:00",
    "closes": "23:59"
  },
  "sameAs": [
    "https://www.facebook.com/homes.jor/",
    "https://www.instagram.com/homes.jor/",
    "https://www.linkedin.com/company/homes-jor"
  ] 
}
</script>
@endsection()