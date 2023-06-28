@extends('admin-layouts.app')
@section('title','Dashboard')
@section('content')
@if(Auth::user()->roleid!==4)
<div class="content-inner">
    <div class="bc-box">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="float-left">
                    <div class="d-inline-flex align-items-center">
                        <h1>Dashboard</h1>
                        <ol class="bclink">
                            <li class="breadcrumb-item"> <a href="{{ route('admin') }}"><i class="bx bx-home-alt font-size-18 color-gold"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
    <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="commonbox">
                            <a href="{{ route('property.index') }}">
                                <div class="float-left">
                                    <i class="material-icons icon-5x color-gold">real_estate_agent</i><br /><br />
                                    <h3 class="font-size-20 font-wt-600 float-right1">{{ $Data->SaleCount }}</h3>
                                    <p class="font-size-16 font-wt-500 float-right1">Sale Properties</p>
                                </div>
                            </a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="commonbox">
                            <a href="{{ route('property.index') }}">
                                <div class="float-left">
                                    <i class="material-icons icon-5x color-gold">apartment</i><br /><br />
                                    <h3 class="font-size-20 font-wt-600 float-right1">{{ $Data->RentCount }}</h3>
                                    <p class="font-size-16 font-wt-500">Rent Properties</p>                                    
                                </div>
                                <!--<div class="float-right">
                                    <p class="font-size-16 font-wt-500">Rent Properties</p>
                                    <h3 class="font-size-20 font-wt-600 float-right">254</h3>
                                </div>-->
                            </a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="commonbox">
                            <a href="{{ route('enquiries.index')}}">
                                <div class="float-left">
                                    <i class="material-icons icon-5x color-gold">face</i><br /><br />
                                    <h3 class="font-size-20 font-wt-600 float-right1">{{ $Data->PropertyEnquiriesCount }}</h3>
                                    <p class="font-size-16 font-wt-500">Customer Enquiries</p>                                    
                                </div>
                                <!--<div class="float-right">
                                    <p class="font-size-16 font-wt-500">Customer Enquiries</p>
                                    <h3 class="font-size-20 font-wt-600 float-right">10</h3>
                                </div>-->
                            </a>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                   @if(Auth::user()->roleid==1 || Auth::user()->roleid==2)
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="commonbox">
                            <a href="{{ route('listyourproperty.index')}}">
                                <div class="float-left">
                                    <i class="material-icons icon-5x color-gold">dns</i><br /><br />
                                    <h3 class="font-size-20 font-wt-600 float-right1">{{ $Data->ListPropertyCount }}</h3>
                                    <p class="font-size-16 font-wt-500">List Requests</p>                                    
                                </div>
                                <!--<div class="float-right">
                                    <p class="font-size-16 font-wt-500">List Requests</p>
                                    <h3 class="font-size-20 font-wt-600 float-right">2</h3>
                                </div>-->
                            </a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    @endif
                </div>   
                        
</div>
@endif    
@endsection()