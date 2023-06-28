@extends('web-layouts.app')
@section('content')
@section('title'){{ $item->MetaTitle }} @endsection
<form id="searchform" action="{{ route('all-exclusive-properties',app()->getLocale()) }}" method="get">
            <input type="hidden" id="layout-option" name="ly" value="{{ app('request')->input('ly')}}">
            <input type="hidden" id="orderby-option" name="odr" value="{{ app('request')->input('odr')}}">
</form>
<section class="gray">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 center">
                <h1 class="font-size-28 font-wt-600 animate__animated animate__fadeIn animate__slow">{{ __('msg.ExclusiveProperties') }}</h1>

            </div>
        </div>
        <br />
        {{-- <div class="row">
            <div class="col-xl-7 col-lg-7 col-md-5 col-sm-5 col-12">

                    
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
        </div><br /> --}}
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
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <div class="card animate__animated animate__fadeIn animate__slow">
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
                                        <h2 class="font-size-16 font-wt-600">{{ Str::limit(trim(preg_replace('/\s\s+/', ' ', $val->PropertyTitle)),50, $end='...')}}</h2>
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
        <br>
        <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 center">
            <a href="{{ url(app()->getLocale().'/search-properties') . '?' . http_build_query(['adt' => 'Sale']); }}" class="btn btn-medium btn-gold animate__animated animate__fadeIn animate__slow">{{  __('msg.SearchProperties') }}</a>
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




<script>
    $(".layouts").click(function(){
       const option=$(this).data('type');
       $('#layout-option').val(option);
       $('#searchform').submit();
    });
    $("#orderby").change(function(){
        const option=$(this).val();
        $('#orderby-option').val(option);
        $('#searchform').submit();
    })

    $("#clearsearch").click(function() {
        $(':input','#searchform')
        .not(':button, :submit, :reset, :hidden')
        .val(''); 
       $('select').val(null).trigger('change');
    });
</script>
@endsection()