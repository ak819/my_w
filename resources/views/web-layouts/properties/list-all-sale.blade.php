@extends('web-layouts.app')
@section('content')
@section('title'){{ $item->MetaTitle }} @endsection
<section class="pb-3" style="background:url({{ asset('images/building.jpg') }}) no-repeat scroll center center;background-size:cover;">
    <div class="container animate__animated animate__fadeIn animate__slow">
      
        <form id="searchform" action="{{ route('search-properties',[app()->getLocale(),'sale']) }}" method="get">
            <input type="hidden" id="form_url" value="{{ route('search-properties',[app()->getLocale(),'sale','','']) }}">
        <div class="row g-3">

           <div class="col-xl-3 col-lg-2 col-md-6 col-sm-6 col-12">
            <div class="form-floating">
                @php
                $PropertyTypeName="";
                @endphp
                <select name="t" id="propertyType" class="form-select urlfilters" aria-label="Floating label select example">
                    <option value="">{{  __('msg.Select') }}</option>
                    @foreach($Data->PropertyUnitTypes as $unitypes)

                    @if(app('request')->input('adt') == '1' && $unitypes->ID == 2 )

                    @else
                    <option value="{{ $unitypes->ID }}" data-char="{{ strtolower(preg_replace('/[^A-Za-z0-9\-]/', '-',$unitypes->TypeNameEng)) }}" data-filterid="{{ $unitypes->FilterDivId }}"  @php if($UnitType && $UnitType->ID == $unitypes->ID){ $PropertyTypeName.=$unitypes->TypeName;  echo  "selected";} @endphp >{{ $unitypes->TypeName }}</option>
                    @endif
                    @endforeach
                </select>
                <label>{{  __('msg.PropertyType') }}</label>
            </div>
         </div>

            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="form-floating">
                    @php
                    $city=app('request')->input('c');
                    $CityName="";
                    @endphp
                    <select  name="c"  id="city" class="form-select select2 city urlfilters" aria-label="Floating label select example">
                        <option value="">{{  __('msg.Select') }}</option>
                        @foreach($Data->City as $city)
                        <option value="{{ $city->ID }}" data-char="{{ strtolower(preg_replace('/[^A-Za-z0-9\-]/', '-', $city->CityNameEng)) }}" @php if(app('request')->input('c') == $city->ID) { $CityName.=$city->CityName;  echo "selected"; } @endphp>{{ $city->CityName }}</option>
                        @endforeach
                    </select>
                    <label >{{  __('msg.City') }}</label>
                </div>
            </div>

            <div class="col-xl-6 col-lg-5 col-md-6 col-sm-6 col-12">
                <div class="form-floating">
                    @php
                    $locations=explode('-',app('request')->input('l'));
                    $LocationsName="";
                    @endphp
                    <select name="" class="form-select select2 locationlist" multiple="multiple" aria-label="Floating label select example">
                        @if ($Data->Locations->first())
                            @foreach($Data->Locations as $location)
                            <option value="{{ $location->ID }}"  data-cityid="{{ $location->CityID }}" data-char="{{ strtolower(preg_replace('/[^A-Za-z0-9\-]/', '-', $location->CommunityNameEng)) }}"  @php if($locations && in_array($location->ID, $locations)){ $LocationsName.=$location->CommunityName.','; echo"selected"; }  @endphp>{{ $location->CommunityName }}</option>
                            @endforeach
                        @endif
                    </select>
                    <label>{{  __('msg.SelectMultipleLocations') }}</label>
                </div>
                <input type="hidden" name="l" id="list-selected-locations" value="{{ app('request')->input('l') }}">
            </div>
           
            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-12">
                <div class="form-floating">
                <input type="text" name="rfn" class="form-control" value="{{ app('request')->input('rfn')}}">
                <label >{{  __('msg.ReferenceNo') }}</label>
                </div>
                <input type="hidden"  name="adt" value="2">
                <input type="hidden" id="layout-option" name="ly" value="{{ app('request')->input('ly')}}">
                <input type="hidden" id="orderby-option" name="odr" value="{{ app('request')->input('odr')}}">
            </div>


            @if(app('request')->input('adt') == '2')

            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">
                <div class="form-floating">
                    <select name="mnpr" class="form-select"  aria-label="Floating label select example">
                    <option value=""> {{  __('msg.Select') }}</option>
                    <option value="0"  {{ (app('request')->input('mnpr') == "0")? "selected": "" }}>{{ currency_format(0)  }}</option>
                    @foreach (config('constants.MinPrice') as $key=>$minprice)
                    <option value="{{ $key }}" {{ (app('request')->input('mnpr') == $key)? "selected": "" }}>{{ currency_format($key)  }}</option> 
                    @endforeach
                    </select>
                    <label>{{  __('msg.MinPrice') }}</label>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">
                <div class="form-floating">
                    <select name="mxpr" class="form-select" aria-label="Floating label select example">
                        <option value="">{{  __('msg.Select') }}</option>
                        @foreach (config('constants.MaxPrice') as $key=>$maxprice)
                        <option value="{{ $key }}" {{ (app('request')->input('mxpr') == $key)? "selected": "" }}>{{ currency_format($key)  }}@if($key==100000000)+@endif</option> 
                        @endforeach
                    </select>
                    <label>{{  __('msg.MaxPrice') }}</label>
                </div>
            </div>
            @else
            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">
                <div class="form-floating">
                    <select name="mnpr" class="form-select" aria-label="Floating label select example">
                        <option value="">{{  __('msg.Select') }}</option>
                    <option value="0"  {{ (app('request')->input('mnpr') == "0")? "selected": "" }}>{{ currency_format(0)  }}</option>
                    @foreach (config('constants.MinPriceRent') as $key=>$minprice)
                    <option value="{{ $key }}" {{ (app('request')->input('mnpr') == $key)? "selected": "" }}>{{ currency_format($key)  }}</option> 
                    @endforeach
                    </select>
                    <label>{{  __('msg.MinPrice') }}</label>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">
                <div class="form-floating">
                    <select name="mxpr" class="form-select" aria-label="Floating label select example">
                        <option value="">{{  __('msg.Select') }}</option>
                        @foreach (config('constants.MaxPriceRent') as $key=>$maxprice)
                        <option value="{{ $key }}" {{ (app('request')->input('mxpr') == $key)? "selected": "" }}>{{ currency_format($key)  }}@if($key==2000000)+@endif</option> 
                        @endforeach
                    </select>
                    <label>{{  __('msg.MaxPrice') }}</label>
                </div>
            </div>
            @endif
            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">
                <div class="form-floating">
                    <select name="mnbd" class="form-select" aria-label="Floating label select example">
                    <option value="">{{  __('msg.Select') }}</option>
                    @foreach (config('constants.BedRooms') as $key=>$beds)
                    <option value="{{ $key }}" {{ (app('request')->input('mnbd') == $key)? "selected": "" }}>{{ $beds  }}</option> 
                    @endforeach
                    </select>
                    <label >{{  __('msg.MinBed') }}</label>
                </div>
            </div>
            
            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6">
                <div class="form-floating">
                    <select name="mxbd" class="form-select" aria-label="Floating label select example">
                    <option value="">{{  __('msg.Select') }}</option>
                    @foreach (config('constants.BedRooms') as $key=>$beds)
                    <option value="{{ $key }}" {{ (app('request')->input('mxbd') == $key)? "selected": "" }}>{{ $beds  }}</option> 
                    @endforeach
                    </select>
                    <label>{{  __('msg.MaxBed') }}</label>
                </div>
            </div>

            <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-12 center">
                <button class="btn btn-large w-100 btn-gold btn-block" type="submit">{{  __('msg.Search') }}</button>
            </div>
            <div class="col-xl-12 col-lg-4 col-md-4 col-sm-4 col-12 mb-2">
                <div class="float-end">
                <a class="btn btn-outline-white"  @if(!$UnitType) style="display:none" @endif  data-bs-toggle="collapse" id="advance-search" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    {{  __('msg.AdvancedSearch') }}
                </a>
                <a id="clearsearch" href="javascript:void(0)" class="btn btn-outline-white">
                    {{  __('msg.clearsearch') }}
                </a>
                </div>
            </div>
        </div>
          
        @include('web-layouts.properties.advance-filter')
        
    </form>
    </div>
</section>

<div id="list"></div>
<section class="gray">
    <div class="container">
        <div class="row">
            <div class="col-xl-7 col-lg-7 col-md-5 col-sm-5 col-12">
                <h1 class="font-size-18 font-wt-600 animate__animated animate__fadeIn animate__slow">{{$Data->Count }} 
                    @if($PropertyTypeName)
                    {{ $PropertyTypeName }}
                    {{ __('msg.ForSale') }}
                    @else
                    {{  __('msg.propertiesforsale') }} 
                    @endif
                   
                   
               </h1>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-7">
                <div class="float-end d-none d-sm-block">
                    <a href="javascript:void(0)"class="btn btn-sm {{ (app('request')->input('ly')==1 || (!app('request')->input('ly')))? "color-gold": "" }} layouts" data-type="1">
                        <i class="material-icons icon-2x">grid_view</i> {{  __('msg.Grid') }}
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm {{ (app('request')->input('ly')==2)? "color-gold": ""}} layouts" data-type="2">
                        <i class="material-icons icon-2x">reorder</i> {{  __('msg.List') }}
                    </a>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-3 col-12">
                <select class="form-control" id="orderby">
                    <option>{{  __('msg.Filter') }}</option>
                    <option value="new" {{ (app('request')->input('odr') == "new")? "selected": "" }}>{{  __('msg.ByNewest') }}</option>
                    <option value="old" {{ (app('request')->input('odr') == "old")? "selected": "" }}>{{  __('msg.ByOldest') }}</option>
                    <option value="p-asc"  {{ (app('request')->input('odr') == "p-asc")? "selected": "" }}>{{  __('msg.ByPriceAsc') }}</option>
                    <option value="p-desc"  {{ (app('request')->input('odr') == "p-desc")? "selected": "" }}>{{  __('msg.ByPriceDesc') }}</option>
                </select>
            </div>
        </div><br />
        @php  $comparelist=session('comparelist');@endphp
        @if((app('request')->input('ly') == 1) || (!app('request')->input('ly')))
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row">
                    @foreach ($Data->Result as $val)
                         @php ///$PropertyLinkTitle=trim(preg_replace("/[^A-Za-z0-9\-]/", '-', $val->PropertyLinkTitle)); 
                          $val->Description=str_replace(['&amp;','nbsp;'],'', $val->Description);
                          $formatedRefNo=preg_replace('/[^0-9]/', '', $val->PropertyRefNo);
                          $val->Description=str_replace($formatedRefNo,$formatedRefNo.' ', $val->Description);
                         @endphp
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12 mb-4">
                            <div class="card animate__animated animate__fadeIn animate__slow h-100">
                                <figure>
                                    <a href="{{ route('property-details',[app()->getLocale(),$AdTypeText[$val->AdType],$val->Plural,$val->Slug,$val->PropertyRefNo]) }}">
                                        @if ($val->FileName && $val->IsDownloaded==1)
                                            <img src="{{ asset("uploads/properties/orignal/".$val->PropertyRefNo."/".$val->FileName) }}" class="card-img-top listing-card-img" alt="{{ $val->ImgAlt }}">
                                            <div class="list-overlay"></div>  
                                        @else
                                            <img src="{{ asset("images/noimg.jpg")}}" class="card-img-top listing-card-img" alt="no image">
                                            <div class="list-overlay"></div>  
                                            
                                        @endif
                                       
                                    </a>
                                    <p class="location color-white"><i class="material-icons icon-1x">location_on</i>{{ $val->CommunityName }}, {{ $val->CityName }}, {{  __('msg.Jordan') }}</p>
                                </figure>
                                <div class="card-body">
                                    <a href="{{ route('property-details',[app()->getLocale(),$AdTypeText[$val->AdType],$val->Plural,$val->Slug,$val->PropertyRefNo]) }}">
                                        <h2 class="font-size-16 font-wt-600 lh-25">{{ Str::limit(trim(preg_replace('/\s\s+/', ' ', $val->PropertyTitle)),60, $end='...')}}</h2>
                                    </a>
                                    <p class="font-size-16 font-wt-700 color-gold"> {{ currency_format($val->Price) }}</p>
                                    <div class="clearfix"></div>
                                    <p class="font-size-12 font-wt-500 color-gray">{!! Str::limit(strip_tags(preg_replace('/\s\s+/', ' ', $val->Description)),80, $end='...')  !!}</p>
                                    <div class="row ps-2 pe-2">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ps-0 pe-0 pt-1 pb-3" style="display: flex;flex-wrap: wrap; line-height:2;">
                                            @php $CardViewFields=explode(',',$val->CardViewFields) @endphp
                                            @if(in_array('bed',$CardViewFields))
                                            <i class="material-icons icon-2x color-gray ps-0 pe-0" title="Bedroom">king_bed</i>
                                            <span class="font-size-12 ps-0 pe-0">{{ $val->NoBedrooms }}</span>&nbsp;&nbsp;&nbsp;
                                            @endif
                                            @if(in_array('bath',$CardViewFields))
                                            <i class="material-icons icon-2x color-gray ps-0 pe-0" title="Bathroom">shower</i>
                                            <span class="font-size-12 ps-0 pe-0">{{ $val->NoBathrooms }}</span>&nbsp;&nbsp;&nbsp;
                                            @endif
                                            @if(in_array('builtup',$CardViewFields))
                                            <i class="material-icons icon-2x color-gray ps-0 pe-0" title="Built Up Area">foundation</i>
                                            <!--<span class="font-size-12" title="Built Up Area">{{ number_format($val->UnitBuiltupArea, 2) }} Sqm.</span>-->
                                            <span class="font-size-12 ps-0 pe-0" title="Built Up Area">{{ $val->UnitBuiltupArea+0 }} Sqm.</span>&nbsp;&nbsp;&nbsp;
                                            @endif
                                            @if(in_array('plot',$CardViewFields))
                                            <i class="material-icons icon-2x1 color-gray ps-0 pe-0" title="Plot Area">aspect_ratio</i>
                                            <!--<span class="font-size-12" title="Plot Area">{{ number_format($val->PlotSize+0, 2) }} Sqm.</span>-->
                                            <span class="font-size-12 ps-0 pe-0" title="Plot Area">{{ $val->PlotSize+0 }} Sqm.</span>&nbsp;
                                            @endif
                                        </div>
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ps-0 pe-0 pt-1 pb-1 center">
                                            <a href="javascript:void(0)" data-no="{{ $val->PropertyRefNo }}" class="btn btn-small1 btn-outline-gold me-2 sharelinks"><i class="material-icons">share</i></a>
                                            <a href="tel:{{ str_replace('-','',$val->DisplayPhone) }}" class="btn btn-small1 btn-outline-gold me-2"><i class="material-icons">phone</i></a>
                                            {{-- <a href="mailto:{{ $val->DisplayEmail }}" class="btn btn-small1 btn-outline-gold me-2"><i class="material-icons">whatsapp</i></a> --}}
                                            @php 
                                            if(app()->getLocale()=="en")
                                            {
                                            $wamsg="Hello, Homes! Property ".$val->PropertyRefNo ." has got my attention, and I'd want to know more about it.";
                                            }else{
                                                $wamsg="مرحبا Homes! الخاصية ".$val->PropertyRefNo ." على اهتمامي ، وأريد معرفة المزيد عنها";
                
                                            }
                                            @endphp
                                            <!--<a href="https://wa.me/{{trim(str_replace('-','',$val->DisplayPhone))}}?text={{ $wamsg }}" class="btn btn-small1 btn-outline-gold me-2"><i class="material-icons">whatsapp</i></a> -->
                                            <a href="https://wa.me/{{trim(str_replace('-','',$val->DisplayPhone))}}?text={{ $wamsg }}" class="btn btn-small1 btn-outline-gold me-2"><i class="fab fa-whatsapp" style="font-size: 1.325em !important"></i></a>
                                         
                                            @if(empty(!$comparelist) && in_array($val->PropertyRefNo,$comparelist))
                                            {{-- <a href="javascript:void(0)" data-no="{{ $val->PropertyRefNo }}"  class="btn btn-small1 btn-outline-gold me-2 compare"><i class="material-icons">compare_arrows</i> {{  __('msg.Comparing') }}</a> --}}
                                            <a href="javascript:void(0)" data-no="{{ $val->PropertyRefNo }}" class="btn btn-outline-gold me-2 compare"><i class="material-icons">done</i></a>
                                            @else
                                            <a href="javascript:void(0)" data-no="{{ $val->PropertyRefNo }}"  class="btn btn-small1 btn-gold me-2 compare"><i class="material-icons">compare_arrows</i> {{  __('msg.Compare') }}</a>
                                            @endif
                                            <!--<a href="javascript:void(0)" data-no="{{ $val->PropertyRefNo }}" class="font-size-14 font-wt-500 color-gold compare"><i class="material-icons">compare_arrows</i> {{  __('msg.Compare') }}</a>-->
                                        </div>
                                        <!--<div class="col-xl-4 col-lg-12 col-md-4 col-sm-4 col-4 ps-0 pe-0 pt-1 pb-1">
                                            <a href="javascript:void(0)" data-no="{{ $val->PropertyRefNo }}" class="font-size-14 font-wt-500 float-end compare"><i class="material-icons">compare_arrows</i> {{  __('msg.Compare') }}</a>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
              
            </div>
        </div>
        @endif()
        @if(app('request')->input('ly') == 2)
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row">
                    @foreach ($Data->Result as $val)
                    @php //$PropertyLinkTitle=trim(preg_replace("/[^A-Za-z0-9\-]/", '-', $val->PropertyLinkTitle)); 
                    $val->Description=str_replace(['&amp;','nbsp;'],'', $val->Description);
                    $formatedRefNo=preg_replace('/[^0-9]/', '', $val->PropertyRefNo);
                    $val->Description=str_replace($formatedRefNo,$formatedRefNo.' ', $val->Description);
                    @endphp
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card card-list animate__animated animate__fadeIn animate__slow">
                            <div class="row card-body">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <figure>
                                        <a href="{{ route('property-details',[app()->getLocale(),$AdTypeText[$val->AdType],$val->Plural,$val->Slug,$val->PropertyRefNo]) }}">
                                        @if ($val->FileName && $val->IsDownloaded==1)
                                            <img src="{{ asset("uploads/properties/orignal/".$val->PropertyRefNo."/".$val->FileName) }}" class="card-img-top listing-card-img" alt="{{ $val->ImgAlt }}">
                                            <div class="list-overlay"></div>  
                                        @else
                                            <img src="{{ asset("images/noimg.jpg")}}" class="card-img-top listing-card-img" alt="no image">
                                            <div class="list-overlay"></div>  
                                            
                                        @endif
                                        </a>
                                    </figure>
                                </div>
                                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12 pt-3">
                                    <a href="{{ route('property-details',[app()->getLocale(),$AdTypeText[$val->AdType],$val->Plural,$val->Slug,$val->PropertyRefNo]) }}">
                                        <h2 class="font-size-16 font-wt-600 mb-2">{{ Str::limit(trim(preg_replace('/\s\s+/', ' ', $val->PropertyTitle)),50, $end='...')}}</h2>
                                    </a>
                                    <p class="mb-2"><i class="material-icons icon-1x align-middle">location_on</i> {{ $val->CommunityName }}, {{ $val->CityName }}, {{  __('msg.Jordan') }}</p>
                                    <p class="font-size-16 font-wt-700 color-gold float-start mb-2">{{ currency_format($val->Price) }}</p>
                                    <div class="clearfix"></div>
                                    <p class="font-size-12 font-wt-500 color-gray">{!! Str::limit(strip_tags(preg_replace('/\s\s+/', ' ', $val->Description)),100, $end='...')  !!}</p>
                                    <div class="row ps-2 pe-2">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8 ps-0 pe-0 pt-1 pb-1">

                                            @php $CardViewFields=explode(',',$val->CardViewFields) @endphp
                                            @if(in_array('bed',$CardViewFields))
                                            <i class="material-icons icon-3x color-gray ps-2" title="Bedroom">king_bed</i>
                                            <span class="font-wt-500">{{ $val->NoBedrooms }}</span>
                                            @endif
                                            @if(in_array('bath',$CardViewFields))
                                            <i class="material-icons icon-3x color-gray ps-2" title="Bathroom">shower</i>
                                            <span class="font-wt-500">{{ $val->NoBathrooms }}</span>
                                            @endif
                                            @if(in_array('builtup',$CardViewFields))
                                            <i class="material-icons color-gray ps-2" title="Built Up Area">foundation</i>
                                            <!--<span class="font-wt-500" title="Built Up Area">{{  number_format($val->UnitBuiltupArea, 2) }} Sqm.</span>-->
                                              <span class="font-wt-500" title="Built Up Area">{{ $val->UnitBuiltupArea+0 }} Sqm.</span>
                                            @endif
                                             @if(in_array('plot',$CardViewFields))
                                            <i class="material-icons color-gray ps-2" title="Plot Area">aspect_ratio</i>
                                            <!--<span class="font-wt-500" title="Plot Area">{{ number_format($val->PlotSize+0, 2) }} Sqm.</span>-->
                                             <span class="font-wt-500" title="Plot Area">{{ $val->PlotSize+0 }} Sqm.</span>
                                            @endif
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ps-0 pe-0 pt-1 pb-1">
                                            <a href="javascript:void(0)" data-no="{{ $val->PropertyRefNo }}" class="btn btn-small1 btn-outline-gold me-2 sharelinks"><i class="material-icons">share</i></a>
                                            <a href="tel:{{ str_replace('-','',$val->DisplayPhone) }}" class="btn btn-small1 btn-outline-gold me-2"><i class="material-icons">phone</i></a>
                                            {{-- <a href="mailto:{{ $val->DisplayEmail }}" class="btn btn-small1 btn-outline-gold me-2"><i class="material-icons">whatsapp</i></a> --}}
                                            @php 
                                            if(app()->getLocale()=="en")
                                            {
                                            $wamsg="Hello, Homes! Property ".$val->PropertyRefNo ." has got my attention, and I'd want to know more about it.";
                                            }else{
                                                $wamsg="مرحبا Homes! الخاصية ".$val->PropertyRefNo ." على اهتمامي ، وأريد معرفة المزيد عنها";
                
                                            }
                                            @endphp
                                            <!--<a href="https://wa.me/{{trim(str_replace('-','',$val->DisplayPhone))}}?text={{ $wamsg }}" class="btn btn-small1 btn-outline-gold me-2"><i class="material-icons">whatsapp</i></a>-->
                                            <a href="https://wa.me/{{trim(str_replace('-','',$val->DisplayPhone))}}?text={{ $wamsg }}" class="btn btn-small1 btn-outline-gold me-2"><i class="fab fa-whatsapp" style="font-size: 1.325em !important"></i></a>
                                          
                                            @if(empty(!$comparelist) && in_array($val->PropertyRefNo,$comparelist))
                                            {{-- <a href="javascript:void(0)" data-no="{{ $val->PropertyRefNo }}"  class="btn btn-small1 btn-outline-gold me-2 compare"><i class="material-icons">compare_arrows</i> {{  __('msg.Comparing') }}</a> --}}
                                            <a href="javascript:void(0)" data-no="{{ $val->PropertyRefNo }}" class="btn btn-outline-gold me-2 compare"><i class="material-icons">done</i></a>
                                            @else
                                            <a href="javascript:void(0)" data-no="{{ $val->PropertyRefNo }}"  class="btn btn-small1 btn-gold me-2 compare"><i class="material-icons">compare_arrows</i> {{  __('msg.Compare') }}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif()
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
         {{-- Pagination --}}
         <div class="d-flex1 justify-content-center">
            {{  $Data->Result->withQueryString()->links(); }}
        </div>
        </div>
        </div>
    </div>
</section>

<!--<div class="modal fade bd-example-modal-sm" tabindex="-1" id="shareModal" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-size-16 font-wt-600" id="exampleModalLabel">Share</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row share_options">
                    </div>
                </div>
            </div>
        </div>
</div>-->

@include('web-layouts.properties.list-js-script')



@endsection()