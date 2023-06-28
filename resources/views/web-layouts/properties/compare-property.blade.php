@extends('web-layouts.app')
@section('content')
<section class="white pt-5 pb-5">
    <div class="container-fluid">
        <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 center">
                    <h1 class="float-start font-size-26 font-wt-600">{{ __('msg.CompareProperties') }}</h1>
                    <a href="{{ URL::previous() }}" class="btn btn-gold btn-medium float-end">{{ __('msg.Back') }}</a>
                </div>
            </div>

             <br>
            <div class="table-responsive animate__animated animate__fadeIn animate__slow d-block d-xl-none d-lg-none d-md-none d-sm-none">
                <table width="100%" cellspacing="0" cellpadding="0" class="table table-normal">
                    <tr>
                        <!--<td>Features</td>-->
                     
                        <td width="25%">
                            @if ($Data[0]->FileName && $Data[0]->IsDownloaded==1)
                             <img src="{{ asset("uploads/properties/orignal/".$Data[0]->PropertyRefNo."/".$Data[0]->FileName) }}" width="100%" alt="{{ $Data[0]->ImgAlt }}">
                            @else
                            <img src="{{ asset('images/noimg.jpg')}}" width="30%" alt="no image">
                            @endif
                            <br />
                            <!--<p class="font-size-12 font-wt-500 mt-2 mb-2">Villa with pool for saleVilla with pool for saleVilla with pool for saleVilla with pool for saleVilla with pool for saleVilla with pool for saleVilla with pool for sale</p>-->
                            <p class="font-wt-600 mb-0 color-gold">{{ currency_format($Data[0]->Price) }} </p>
                        </td>
                        @if (!empty($Data[1]))
                        <td width="25%">
                            @if ($Data[1]->FileName && $Data[1]->IsDownloaded==1)
                             <img src="{{ asset("uploads/properties/orignal/".$Data[1]->PropertyRefNo."/".$Data[1]->FileName) }}" width="100%" alt="{{ $Data[1]->ImgAlt }}">
                            @else
                            <img src="{{ asset('images/noimg.jpg')}}" width="30%" alt="no image">
                            @endif
                            <br />
                            <!--<p class="font-size-12 font-wt-500 mt-2 mb-2">Villa with pool for saleVilla with pool for saleVilla with pool for saleVilla with pool for saleVilla with pool for saleVilla with pool for saleVilla with pool for sale</p>-->
                            <p class="font-wt-600 mb-0 color-gold">{{ currency_format($Data[1]->Price) }} </p>
                        </td>
                        @endif
                        @if (!empty($Data[2]))
                        <td width="25%">
                            @if ($Data[0]->FileName && $Data[02]->IsDownloaded==1)
                             <img src="{{ asset("uploads/properties/orignal/".$Data[2]->PropertyRefNo."/".$Data[2]->FileName) }}" width="100%" alt="{{ $Data[2]->ImgAlt }}">
                            @else
                            <img src="{{ asset('images/noimg.jpg')}}" width="30%" alt="no image">
                            @endif
                            <br />
                            <!--<p class="font-size-12 font-wt-500 mt-2 mb-2">Villa with pool for saleVilla with pool for saleVilla with pool for saleVilla with pool for saleVilla with pool for saleVilla with pool for saleVilla with pool for sale</p>-->
                            <p class="font-wt-600 mb-0 color-gold">{{ currency_format($Data[2]->Price) }}</p>
                        </td>
                        @endif
                        @if (!empty($Data[3]))
                        <td width="25%">
                            @if ($Data[0]->FileName && $Data[3]->IsDownloaded==1)
                             <img src="{{ asset("uploads/properties/orignal/".$Data[3]->PropertyRefNo."/".$Data[0]->FileName) }}" width="100%" alt="{{ $Data[3]->ImgAlt }}">
                            @else
                            <img src="{{ asset('images/noimg.jpg')}}" width="30%" alt="no image">
                            @endif
                            <br />
                            <!--<p class="font-size-12 font-wt-500 mt-2 mb-2">Villa with pool for saleVilla with pool for saleVilla with pool for saleVilla with pool for saleVilla with pool for saleVilla with pool for saleVilla with pool for sale</p>-->
                            <p class="font-wt-600 mb-0 color-gold">{{ currency_format($Data[3]->Price) }}</p>
                        </td>
                        @endif
                    </tr>
                    @if(app()->getLocale()=="en")
                    <tr>
                        <th colspan="100" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.ReferenceNo') }}</span></th>
                    </tr>
                    <tr>
                        @if (!empty($Data[0]))<td>{{ ($Data[0]->PropertyRefNo) }}</td>@endif
                        @if (!empty($Data[1]))<td>{{ ($Data[1]->PropertyRefNo) }}</td>@endif
                        @if (!empty($Data[2]))<td>{{ ($Data[1]->PropertyRefNo) }}</td>@endif
                        @if (!empty($Data[3]))<td>{{ ($Data[1]->PropertyRefNo) }}</td>@endif
                    </tr>
                    <tr>
                        <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.City') }}</span></th>
                    </tr>
                    <tr>
                        @if (!empty($Data[0]))<td>{{ $Data[0]->CityName }}</td>@endif
                        @if (!empty($Data[1]))<td>{{ $Data[1]->CityName }}</td>@endif
                        @if (!empty($Data[2]))<td>{{ $Data[2]->CityName }}</td>@endif
                        @if (!empty($Data[3]))<td>{{ $Data[3]->CityName }}</td>@endif
                    </tr>
                    <tr>
                        <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.Location') }}</span></th>
                    </tr>
                    <tr>
                        @if (!empty($Data[0]))<td>{{ ($Data[0]->CommunityName)?$Data[0]->CommunityName:"-" }}</td>@endif
                        @if (!empty($Data[1]))<td>{{ ($Data[1]->CommunityName)?$Data[1]->CommunityName:"-" }}</td>@endif
                        @if (!empty($Data[2]))<td>{{ ($Data[2]->CommunityName)?$Data[2]->CommunityName:"-" }}</td>@endif
                        @if (!empty($Data[3]))<td>{{ ($Data[3]->CommunityName)?$Data[3]->CommunityName:"-" }}</td>@endif
                    </tr>

                    <tr>
                        <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.BuiltupArea') }}  (Sq m.)</span></th>
                    </tr>
                    <tr>
                        @if (!empty($Data[0]))<td>{{ ($Data[0]->UnitBuiltupArea)?number_format($Data[0]->UnitBuiltupArea, 2):"-" }}</td>@endif
                        @if (!empty($Data[1]))<td>{{ ($Data[1]->UnitBuiltupArea)?number_format($Data[1]->UnitBuiltupArea, 2):"-" }}</td>@endif
                        @if (!empty($Data[2]))<td>{{ ($Data[2]->UnitBuiltupArea)?number_format($Data[2]->UnitBuiltupArea, 2):"-" }}</td>@endif
                        @if (!empty($Data[3]))<td>{{ ($Data[3]->UnitBuiltupArea)?number_format($Data[3]->UnitBuiltupArea, 2):"-" }}</td>@endif
                    </tr>
                    <tr>
                        <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.Bedrooms') }}</span></th>
                    </tr>
                    <tr>
                        @if (!empty($Data[0]))<td>{{ ($Data[0]->NoBedrooms)?$Data[0]->NoBedrooms:"-" }}</td>@endif
                        @if (!empty($Data[1]))<td>{{ ($Data[1]->NoBedrooms)?$Data[1]->NoBedrooms:"-" }}</td>@endif
                        @if (!empty($Data[2]))<td>{{ ($Data[2]->NoBedrooms)?$Data[2]->NoBedrooms:"-" }}</td>@endif
                        @if (!empty($Data[3]))<td>{{ ($Data[3]->NoBedrooms)?$Data[3]->NoBedrooms:"-" }}</td>@endif
                    </tr>

                    <tr>
                        <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.Bathrooms') }}</span></th>
                    </tr>
                    <tr>
                        @if (!empty($Data[0]))<td>{{ ($Data[0]->NoBathrooms)?$Data[0]->NoBathrooms:"-" }}</td>@endif
                        @if (!empty($Data[1]))<td>{{ ($Data[1]->NoBathrooms)?$Data[1]->NoBathrooms:"-" }}</td>@endif
                        @if (!empty($Data[2]))<td>{{ ($Data[2]->NoBathrooms)?$Data[2]->NoBathrooms:"-" }}</td>@endif
                        @if (!empty($Data[3]))<td>{{ ($Data[3]->NoBathrooms)?$Data[3]->NoBathrooms:"-" }}</td>@endif
                    </tr>

                    <tr>
                        <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.Furnished') }}</span></th>
                    </tr>
                    <tr>
                        @if (!empty($Data[0]))<td>{{ ($Data[0]->Furnished)? config('constants.Furnished.'.$Data[0]->Furnished) :  "-"}}</td>@endif
                        @if (!empty($Data[1]))<td>{{ ($Data[1]->Furnished)? config('constants.Furnished.'.$Data[1]->Furnished)  :  "-"}}</td>@endif
                        @if (!empty($Data[2]))<td>{{ ($Data[2]->Furnished)? config('constants.Furnished.'.$Data[2]->Furnished)  :   "-" }}</td>@endif
                        @if (!empty($Data[3]))<td>{{ ($Data[3]->Furnished)? config('constants.Furnished.'.$Data[3]->Furnished)  :  "-" }}</td>@endif
                    </tr>

                    <tr>
                        <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.Swimming Pool') }}</span></th>
                    </tr>
                    <tr>
                        @if (!empty($Data[0]))<td>{{ ($Data[0]->SwimmingPool)? "Yes" :"No" }}</td>@endif
                        @if (!empty($Data[1]))<td>{{ ($Data[1]->SwimmingPool)? "Yes" :"No" }}</td>@endif
                        @if (!empty($Data[2]))<td>{{ ($Data[2]->SwimmingPool)? "Yes" :"No" }}</td>@endif
                        @if (!empty($Data[3]))<td>{{ ($Data[3]->SwimmingPool)? "Yes" :"No" }}</td>@endif
                    </tr>

                    <tr>
                        <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.Apartment Type') }}</span></th>
                    </tr>
                    <tr>
                        @if (!empty($Data[0]))<td>{{ ($Data[0]->ApartmentType)?$Data[0]->ApartmentType:"-" }}</td>@endif
                        @if (!empty($Data[1]))<td>{{ ($Data[1]->ApartmentType)?$Data[1]->ApartmentType:"-" }}</td>@endif
                        @if (!empty($Data[2]))<td>{{ ($Data[2]->ApartmentType)?$Data[2]->ApartmentType:"-" }}</td>@endif
                        @if (!empty($Data[3]))<td>{{ ($Data[3]->ApartmentType)?$Data[3]->ApartmentType:"-" }}</td>@endif
                    </tr>

                    <tr>
                        <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.Outdoor Area') }}</span></th>
                    </tr>
                    <tr>
                        @if (!empty($Data[0]))<td>{{ ($Data[0]->OutdoorArea)? "Yes" :"No" }}</td>@endif
                        @if (!empty($Data[1]))<td>{{ ($Data[1]->OutdoorArea)? "Yes" :"No" }}</td>@endif
                        @if (!empty($Data[2]))<td>{{ ($Data[2]->OutdoorArea)? "Yes" :"No" }}</td>@endif
                        @if (!empty($Data[3]))<td>{{ ($Data[3]->OutdoorArea)? "Yes" :"No" }}</td>@endif
                    </tr>

                    <tr>
                        <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.Number of Floors') }}</span></th>
                    </tr>
                    <tr>
                        @if (!empty($Data[0]))<td>{{ ($Data[0]->NoFloors)?$Data[0]->NoFloors:"-" }}</td>@endif
                        @if (!empty($Data[1]))<td>{{ ($Data[1]->NoFloors)?$Data[1]->NoFloors:"-" }}</td>@endif
                        @if (!empty($Data[2]))<td>{{ ($Data[2]->NoFloors)?$Data[2]->NoFloors:"-" }}</td>@endif
                        @if (!empty($Data[3]))<td>{{ ($Data[3]->NoFloors)?$Data[3]->NoFloors:"-" }}</td>@endif
                    </tr>

                    <tr>
                        <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.PlotArea') }}  (Sq m.)</span></th>
                    </tr>
                    <tr>
                        @if (!empty($Data[0]))<td>{{ ($Data[0]->PlotSize)?number_format($Data[0]->PlotSize, 2):"-" }}</td>@endif
                        @if (!empty($Data[1]))<td>{{ ($Data[1]->PlotSize)?number_format($Data[1]->PlotSize, 2):"-" }}</td>@endif
                        @if (!empty($Data[2]))<td>{{ ($Data[2]->PlotSize)?number_format($Data[2]->PlotSize, 2):"-" }}</td>@endif
                        @if (!empty($Data[3]))<td>{{ ($Data[3]->PlotSize)?number_format($Data[3]->PlotSize, 2):"-" }}</td>@endif
                    </tr>

                    <tr>
                        <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.Villa Type') }}</span></th>
                    </tr>
                    <tr>
                        @if (!empty($Data[0]))<td>{{ ($Data[0]->VillaType)?$Data[0]->VillaType:"-" }}</td>@endif
                        @if (!empty($Data[1]))<td>{{ ($Data[1]->VillaType)?$Data[1]->VillaType:"-" }}</td>@endif
                        @if (!empty($Data[2]))<td>{{ ($Data[2]->VillaType)?$Data[2]->VillaType:"-" }}</td>@endif
                        @if (!empty($Data[3]))<td>{{ ($Data[3]->VillaType)?$Data[3]->VillaType:"-" }}</td>@endif
                    </tr>

                
                    <tr>
                        <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.Rented') }}</span></th>
                    </tr>
                    <tr>
                        @if (!empty($Data[0]))<td>{{ ($Data[0]->Rented)? "Yes" :"No" }}</td>@endif
                        @if (!empty($Data[1]))<td>{{ ($Data[1]->Rented)? "Yes" :"No" }}</td>@endif
                        @if (!empty($Data[2]))<td>{{ ($Data[2]->Rented)? "Yes" :"No" }}</td>@endif
                        @if (!empty($Data[3]))<td>{{ ($Data[3]->Rented)? "Yes" :"No" }}</td>@endif
                    </tr>

                    <tr>
                        <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.Floor Number') }}</span></th>
                    </tr>
                    <tr>
                        @if (!empty($Data[0]))<td>{{ ($Data[0]->Floor!=="")?config('constants.FloorNumber.'.$Data[0]->Floor):"-" }}</td>@endif
                        @if (!empty($Data[1]))<td>{{ ($Data[1]->Floor!=="")?config('constants.FloorNumber.'.$Data[1]->Floor):"-" }}</td>@endif
                        @if (!empty($Data[2]))<td>{{ ($Data[2]->Floor!=="")?config('constants.FloorNumber.'.$Data[2]->Floor):"-" }}</td>@endif
                        @if (!empty($Data[3]))<td>{{ ($Data[3]->Floor!=="")?config('constants.FloorNumber.'.$Data[3]->Floor):"-" }}</td>@endif
                    </tr>

                    <tr>
                        <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.Number of Streets') }}</span></th>
                    </tr>
                    <tr>
                        @if (!empty($Data[0]))<td>{{ ($Data[0]->Nostreets)?$Data[0]->Nostreets:"-" }}</td>@endif
                        @if (!empty($Data[1]))<td>{{ ($Data[1]->Nostreets)?$Data[1]->Nostreets:"-" }}</td>@endif
                        @if (!empty($Data[2]))<td>{{ ($Data[2]->Nostreets)?$Data[2]->Nostreets:"-" }}</td>@endif
                        @if (!empty($Data[3]))<td>{{ ($Data[3]->Nostreets)?$Data[3]->Nostreets:"-" }}</td>@endif
                    </tr>
                    <tr>
                        <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.Serviced') }}</span></th>
                    </tr>
                    <tr>
                        @if (!empty($Data[0]))<td>{{ ($Data[0]->Serviced)? "Yes" :"No" }}</td>@endif
                        @if (!empty($Data[1]))<td>{{ ($Data[1]->Serviced)? "Yes" :"No" }}</td>@endif
                        @if (!empty($Data[2]))<td>{{ ($Data[2]->Serviced)? "Yes" :"No" }}</td>@endif
                        @if (!empty($Data[3]))<td>{{ ($Data[3]->Serviced)? "Yes" :"No" }}</td>@endif
                    </tr>
                    <tr>
                        <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.Commercial Type') }}</span></th>
                    </tr>
                    <tr>
                        @if (!empty($Data[0]))<td>{{ ($Data[0]->CommercialType)?$Data[0]->CommercialType:"-" }}</td>@endif
                        @if (!empty($Data[1]))<td>{{ ($Data[1]->CommercialType)?$Data[1]->CommercialType:"-" }}</td>@endif
                        @if (!empty($Data[2]))<td>{{ ($Data[2]->CommercialType)?$Data[2]->CommercialType:"-" }}</td>@endif
                        @if (!empty($Data[3]))<td>{{ ($Data[3]->CommercialType)?$Data[3]->CommercialType:"-" }}</td>@endif
                    </tr>
                    <tr>
                        <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.Building Percentage Number') }}</span></th>
                    </tr>
                    <tr>
                        @if (!empty($Data[0]))<td>{{ ($Data[0]->BuildPercentageNumber)?$Data[0]->BuildPercentageNumber:"-" }}</td>@endif
                        @if (!empty($Data[1]))<td>{{ ($Data[1]->BuildPercentageNumber)?$Data[1]->BuildPercentageNumber:"-" }}</td>@endif
                        @if (!empty($Data[2]))<td>{{ ($Data[2]->BuildPercentageNumber)?$Data[2]->BuildPercentageNumber:"-" }}</td>@endif
                        @if (!empty($Data[3]))<td>{{ ($Data[3]->BuildPercentageNumber)?$Data[3]->BuildPercentageNumber:"-" }}</td>@endif
                    </tr>
                    <tr>
                        <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.Facade Number') }}</span></th>
                    </tr>
                    <tr>
                        @if (!empty($Data[0]))<td>{{ ($Data[0]->FacadeNumber)?$Data[0]->FacadeNumber:"-" }}</td>@endif
                        @if (!empty($Data[1]))<td>{{ ($Data[1]->FacadeNumber)?$Data[1]->FacadeNumber:"-" }}</td>@endif
                        @if (!empty($Data[2]))<td>{{ ($Data[2]->FacadeNumber)?$Data[2]->FacadeNumber:"-" }}</td>@endif
                        @if (!empty($Data[3]))<td>{{ ($Data[3]->FacadeNumber)?$Data[3]->FacadeNumber:"-" }}</td>@endif
                    </tr>
                    <tr>
                        <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.Residential Land Type') }}</span></th>
                    </tr>
                    <tr>
                        @if (!empty($Data[0]))<td>{{ ($Data[0]->ResidentialLandType)?$Data[0]->ResidentialLandType:"-" }}</td>@endif
                        @if (!empty($Data[1]))<td>{{ ($Data[1]->ResidentialLandType)?$Data[1]->ResidentialLandType:"-" }}</td>@endif
                        @if (!empty($Data[2]))<td>{{ ($Data[2]->ResidentialLandType)?$Data[2]->ResidentialLandType:"-" }}</td>@endif
                        @if (!empty($Data[3]))<td>{{ ($Data[3]->ResidentialLandType)?$Data[3]->ResidentialLandType:"-" }}</td>@endif
                    </tr>
                    <tr>
                        <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.Building Facade Type') }}</span></th>
                    </tr>
                    <tr>
                        @if (!empty($Data[0]))<td>{{ ($Data[0]->BuildFacadeType)?$Data[0]->BuildFacadeType:"-" }}</td>@endif
                        @if (!empty($Data[1]))<td>{{ ($Data[1]->BuildFacadeType)?$Data[1]->BuildFacadeType:"-" }}</td>@endif
                        @if (!empty($Data[2]))<td>{{ ($Data[2]->BuildFacadeType)?$Data[2]->BuildFacadeType:"-" }}</td>@endif
                        @if (!empty($Data[3]))<td>{{ ($Data[3]->BuildFacadeType)?$Data[3]->BuildFacadeType:"-" }}</td>@endif
                    </tr>
                    <tr>
                        <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.FloorType') }}</span></th>
                    </tr>
                    <tr>
                        @if (!empty($Data[0]))<td>{{ ($Data[0]->FloorType)?$Data[0]->FloorType:"-" }}</td>@endif
                        @if (!empty($Data[1]))<td>{{ ($Data[1]->FloorType)?$Data[1]->FloorType:"-" }}</td>@endif
                        @if (!empty($Data[2]))<td>{{ ($Data[2]->FloorType)?$Data[2]->FloorType:"-" }}</td>@endif
                        @if (!empty($Data[3]))<td>{{ ($Data[3]->FloorType)?$Data[3]->FloorType:"-" }}</td>@endif
                    </tr>
                   @else
                   <tr>
                    <th colspan="100" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.ReferenceNo') }}</span></th>
                </tr>
                <tr>
                    @if (!empty($Data[0]))<td>{{ $Data[0]->PropertyRefNo }}</td>@endif
                    @if (!empty($Data[1]))<td>{{ $Data[1]->PropertyRefNo }}</td>@endif
                    @if (!empty($Data[2]))<td>{{ $Data[2]->PropertyRefNo }}</td>@endif
                    @if (!empty($Data[3]))<td>{{ $Data[3]->PropertyRefNo }}</td>@endif
                </tr>
                <tr>
                    <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.City') }}</span></th>
                </tr>
                <tr>
                    @if (!empty($Data[0]))<td>{{ $Data[0]->CityName }}</td>@endif
                    @if (!empty($Data[1]))<td>{{ $Data[1]->CityName }}</td>@endif
                    @if (!empty($Data[2]))<td>{{ $Data[2]->CityName }}</td>@endif
                    @if (!empty($Data[3]))<td>{{ $Data[3]->CityName }}</td>@endif
                </tr>
                <tr>
                    <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.Location') }}</span></th>
                </tr>
                <tr>
                    @if (!empty($Data[0]))<td>{{ ($Data[0]->CommunityName)?$Data[0]->CommunityName:"-" }}</td>@endif
                    @if (!empty($Data[1]))<td>{{ ($Data[1]->CommunityName)?$Data[1]->CommunityName:"-" }}</td>@endif
                    @if (!empty($Data[2]))<td>{{ ($Data[2]->CommunityName)?$Data[2]->CommunityName:"-" }}</td>@endif
                    @if (!empty($Data[3]))<td>{{ ($Data[3]->CommunityName)?$Data[3]->CommunityName:"-" }}</td>@endif
                </tr>

                <tr>
                    <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.BuiltupArea') }}  (Sq m.)</span></th>
                </tr>
                <tr>
                    @if (!empty($Data[0]))<td>{{ ($Data[0]->UnitBuiltupArea)?number_format($Data[0]->UnitBuiltupArea, 2):"-" }}</td>@endif
                    @if (!empty($Data[1]))<td>{{ ($Data[1]->UnitBuiltupArea)?number_format($Data[1]->UnitBuiltupArea, 2):"-" }}</td>@endif
                    @if (!empty($Data[2]))<td>{{ ($Data[2]->UnitBuiltupArea)?number_format($Data[2]->UnitBuiltupArea, 2):"-" }}</td>@endif
                    @if (!empty($Data[3]))<td>{{ ($Data[3]->UnitBuiltupArea)?number_format($Data[3]->UnitBuiltupArea, 2):"-" }}</td>@endif
                </tr>
                <tr>
                    <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.Bedrooms') }}</span></th>
                </tr>
                <tr>
                    @if (!empty($Data[0]))<td>{{ ($Data[0]->NoBedrooms)?$Data[0]->NoBedrooms:"-" }}</td>@endif
                    @if (!empty($Data[1]))<td>{{ ($Data[1]->NoBedrooms)?$Data[1]->NoBedrooms:"-" }}</td>@endif
                    @if (!empty($Data[2]))<td>{{ ($Data[2]->NoBedrooms)?$Data[2]->NoBedrooms:"-" }}</td>@endif
                    @if (!empty($Data[3]))<td>{{ ($Data[3]->NoBedrooms)?$Data[3]->NoBedrooms:"-" }}</td>@endif
                </tr>

                <tr>
                    <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.Bathrooms') }}</span></th>
                </tr>
                <tr>
                    @if (!empty($Data[0]))<td>{{ ($Data[0]->NoBathrooms)?$Data[0]->NoBathrooms:"-" }}</td>@endif
                    @if (!empty($Data[1]))<td>{{ ($Data[1]->NoBathrooms)?$Data[1]->NoBathrooms:"-" }}</td>@endif
                    @if (!empty($Data[2]))<td>{{ ($Data[2]->NoBathrooms)?$Data[2]->NoBathrooms:"-" }}</td>@endif
                    @if (!empty($Data[3]))<td>{{ ($Data[3]->NoBathrooms)?$Data[3]->NoBathrooms:"-" }}</td>@endif
                </tr>

                <tr>
                    <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.Furnished') }}</span></th>
                </tr>
                <tr>
                    @if (!empty($Data[0]))<td>{{ ($Data[0]->Furnished)? config('constants.FurnishedAr.'.$Data[0]->Furnished) :  "-"}}</td>@endif
                    @if (!empty($Data[1]))<td>{{ ($Data[1]->Furnished)? config('constants.FurnishedAr.'.$Data[1]->Furnished)  :  "-"}}</td>@endif
                    @if (!empty($Data[2]))<td>{{ ($Data[2]->Furnished)? config('constants.FurnishedAr.'.$Data[2]->Furnished)  :   "-" }}</td>@endif
                    @if (!empty($Data[3]))<td>{{ ($Data[3]->Furnished)? config('constants.FurnishedAr.'.$Data[3]->Furnished)  :  "-" }}</td>@endif
                </tr>

                <tr>
                    <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.Swimming Pool') }}</span></th>
                </tr>
                <tr>
                
                    @if (!empty($Data[0]))<td>{{ ($Data[0]->SwimmingPool == "Yes")? config('constants.YesNoAr.Yes')  :   config('constants.YesNoAr.No')}}</td>@endif
                    @if (!empty($Data[1]))<td>{{ ($Data[1]->SwimmingPool == "Yes")? config('constants.YesNoAr.Yes')  :   config('constants.YesNoAr.No')}}</td>@endif
                    @if (!empty($Data[2]))<td>{{ ($Data[2]->SwimmingPool == "Yes")? config('constants.YesNoAr.Yes')  :   config('constants.YesNoAr.No') }}</td>@endif
                    @if (!empty($Data[3]))<td>{{ ($Data[3]->SwimmingPool == "Yes")? config('constants.YesNoAr.Yes')  :   config('constants.YesNoAr.No') }}</td>@endif
                </tr>

                {{-- <tr>
                    <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.Apartment Type') }}</span></th>
                </tr>
                <tr>
                    @if (!empty($Data[0]))<td>{{ ($Data[0]->ApartmentType)?config('constants.ApartmentTypeAr.'.$Data[0]->ApartmentType):"-" }}</td>@endif
                    @if (!empty($Data[1]))<td>{{ ($Data[1]->ApartmentType)?config('constants.ApartmentTypeAr.'.$Data[1]->ApartmentType):"-" }}</td>@endif
                    @if (!empty($Data[2]))<td>{{ ($Data[2]->ApartmentType)?config('constants.ApartmentTypeAr.'.$Data[2]->ApartmentType):"-" }}</td>@endif
                    @if (!empty($Data[3]))<td>{{ ($Data[3]->ApartmentType)?config('constants.ApartmentTypeAr.'.$Data[3]->ApartmentType):"-" }}</td>@endif
                </tr> --}}

                <tr>
                    <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.Outdoor Area') }}</span></th>
                </tr>
                <tr>
                    @if (!empty($Data[0]))<td>{{ ($Data[0]->OutdoorArea == "Yes")? config('constants.YesNoAr.Yes')  :   config('constants.YesNoAr.No')}}</td>@endif
                    @if (!empty($Data[1]))<td>{{ ($Data[1]->OutdoorArea == "Yes")? config('constants.YesNoAr.Yes')  :   config('constants.YesNoAr.No')}}</td>@endif
                    @if (!empty($Data[2]))<td>{{ ($Data[2]->OutdoorArea == "Yes")? config('constants.YesNoAr.Yes')  :   config('constants.YesNoAr.No') }}</td>@endif
                    @if (!empty($Data[3]))<td>{{ ($Data[3]->OutdoorArea == "Yes")? config('constants.YesNoAr.Yes')  :   config('constants.YesNoAr.No') }}</td>@endif
                </tr>

                <tr>
                    <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.Number of Floors') }}</span></th>
                </tr>
                <tr>
                    @if (!empty($Data[0]))<td>{{ ($Data[0]->NoFloors)?$Data[0]->NoFloors:"-" }}</td>@endif
                    @if (!empty($Data[1]))<td>{{ ($Data[1]->NoFloors)?$Data[1]->NoFloors:"-" }}</td>@endif
                    @if (!empty($Data[2]))<td>{{ ($Data[2]->NoFloors)?$Data[2]->NoFloors:"-" }}</td>@endif
                    @if (!empty($Data[3]))<td>{{ ($Data[3]->NoFloors)?$Data[3]->NoFloors:"-" }}</td>@endif
                </tr>

                <tr>
                    <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.PlotArea') }}  (Sq m.)</span></th>
                </tr>
                <tr>
                    @if (!empty($Data[0]))<td>{{ ($Data[0]->PlotSize)?number_format($Data[0]->PlotSize, 2):"-" }}</td>@endif
                    @if (!empty($Data[1]))<td>{{ ($Data[1]->PlotSize)?number_format($Data[1]->PlotSize, 2):"-" }}</td>@endif
                    @if (!empty($Data[2]))<td>{{ ($Data[2]->PlotSize)?number_format($Data[2]->PlotSize, 2):"-" }}</td>@endif
                    @if (!empty($Data[3]))<td>{{ ($Data[3]->PlotSize)?number_format($Data[3]->PlotSize, 2):"-" }}</td>@endif
                </tr>

                <tr>
                    <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.Villa Type') }}</span></th>
                </tr>
                <tr>
                    @if (!empty($Data[0]))<td>{{ ($Data[0]->VillaType)?config('constants.VillaTypeAr.'.$Data[0]->VillaType):"-" }}</td>@endif
                    @if (!empty($Data[1]))<td>{{ ($Data[1]->VillaType)?config('constants.VillaTypeAr.'.$Data[1]->VillaType):"-" }}</td>@endif
                    @if (!empty($Data[2]))<td>{{ ($Data[2]->VillaType)?config('constants.VillaTypeAr.'.$Data[2]->VillaType):"-" }}</td>@endif
                    @if (!empty($Data[3]))<td>{{ ($Data[3]->VillaType)?config('constants.VillaTypeAr.'.$Data[3]->VillaType):"-" }}</td>@endif
                </tr>

                
           
                <tr>
                    <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.Rented') }}</span></th>
                </tr>
                <tr>
                    @if (!empty($Data[0]))<td>{{ ($Data[0]->Rented == "Yes")? config('constants.YesNoAr.Yes')  :   config('constants.YesNoAr.No')}}</td>@endif
                    @if (!empty($Data[1]))<td>{{ ($Data[1]->Rented == "Yes")? config('constants.YesNoAr.Yes')  :   config('constants.YesNoAr.No')}}</td>@endif
                    @if (!empty($Data[2]))<td>{{ ($Data[2]->Rented == "Yes")? config('constants.YesNoAr.Yes')  :   config('constants.YesNoAr.No') }}</td>@endif
                    @if (!empty($Data[3]))<td>{{ ($Data[3]->Rented == "Yes")? config('constants.YesNoAr.Yes')  :   config('constants.YesNoAr.No') }}</td>@endif
                </tr>

                <tr>
                    <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.Floor Number') }}</span></th>
                </tr>
                <tr>
                    @if (!empty($Data[0]))<td>{{ ($Data[0]->Floor!=="")?config('constants.FloorNumberAr.'.$Data[0]->Floor):"-" }} </td>@endif
                    @if (!empty($Data[1]))<td>{{ ($Data[1]->Floor!=="")?config('constants.FloorNumberAr.'.$Data[1]->Floor):"-" }} </td>@endif
                    @if (!empty($Data[2]))<td>{{ ($Data[2]->Floor!=="")?config('constants.FloorNumberAr.'.$Data[2]->Floor):"-" }} </td>@endif
                    @if (!empty($Data[3]))<td>{{ ($Data[3]->Floor!=="")?config('constants.FloorNumberAr.'.$Data[3]->Floor):"-" }} </td>@endif
                </tr>

                <tr>
                    <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.Number of Streets') }}</span></th>
                </tr>
                <tr>
                    @if (!empty($Data[0]))<td>{{ ($Data[0]->Nostreets)?$Data[0]->Nostreets:"-" }}</td>@endif
                    @if (!empty($Data[1]))<td>{{ ($Data[1]->Nostreets)?$Data[1]->Nostreets:"-" }}</td>@endif
                    @if (!empty($Data[2]))<td>{{ ($Data[2]->Nostreets)?$Data[2]->Nostreets:"-" }}</td>@endif
                    @if (!empty($Data[3]))<td>{{ ($Data[3]->Nostreets)?$Data[3]->Nostreets:"-" }}</td>@endif
                </tr>
                <tr>
                    <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.Serviced') }}</span></th>
                </tr>
                <tr>
                    @if (!empty($Data[0]))<td>{{ ($Data[0]->Serviced == "Yes")? config('constants.YesNoAr.Yes')  :   config('constants.YesNoAr.No')}}</td>@endif
                    @if (!empty($Data[1]))<td>{{ ($Data[1]->Serviced == "Yes")? config('constants.YesNoAr.Yes')  :   config('constants.YesNoAr.No')}}</td>@endif
                    @if (!empty($Data[2]))<td>{{ ($Data[2]->Serviced == "Yes")? config('constants.YesNoAr.Yes')  :   config('constants.YesNoAr.No') }}</td>@endif
                    @if (!empty($Data[3]))<td>{{ ($Data[3]->Serviced == "Yes")? config('constants.YesNoAr.Yes')  :   config('constants.YesNoAr.No') }}</td>@endif
                </tr>
                <tr>
                    <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.Commercial Type') }}</span></th>
                </tr>
                <tr>
                    @if (!empty($Data[0]))<td>{{ ($Data[0]->CommercialType)?config('constants.CommercialTypeAr.'.$Data[0]->CommercialType):"-" }}</td>@endif
                    @if (!empty($Data[1]))<td>{{ ($Data[1]->CommercialType)?config('constants.CommercialTypeAr.'.$Data[1]->CommercialType):"-" }}</td>@endif
                    @if (!empty($Data[2]))<td>{{ ($Data[2]->CommercialType)?config('constants.CommercialTypeAr.'.$Data[2]->CommercialType):"-" }}</td>@endif
                    @if (!empty($Data[3]))<td>{{ ($Data[3]->CommercialType)?config('constants.CommercialTypeAr.'.$Data[3]->CommercialType):"-" }}</td>@endif
                </tr>
                <tr>
                    <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.Building Percentage Number') }}</span></th>
                </tr>
                <tr>
                    @if (!empty($Data[0]))<td>{{ ($Data[0]->BuildPercentageNumber)?$Data[0]->BuildPercentageNumber:"-" }}</td>@endif
                    @if (!empty($Data[1]))<td>{{ ($Data[1]->BuildPercentageNumber)?$Data[1]->BuildPercentageNumber:"-" }}</td>@endif
                    @if (!empty($Data[2]))<td>{{ ($Data[2]->BuildPercentageNumber)?$Data[2]->BuildPercentageNumber:"-" }}</td>@endif
                    @if (!empty($Data[3]))<td>{{ ($Data[3]->BuildPercentageNumber)?$Data[3]->BuildPercentageNumber:"-" }}</td>@endif
                </tr>
                <tr>
                    <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.Facade Number') }}</span></th>
                </tr>
                <tr>
                    @if (!empty($Data[0]))<td>{{ ($Data[0]->FacadeNumber)?$Data[0]->FacadeNumber:"-" }}</td>@endif
                    @if (!empty($Data[1]))<td>{{ ($Data[1]->FacadeNumber)?$Data[1]->FacadeNumber:"-" }}</td>@endif
                    @if (!empty($Data[2]))<td>{{ ($Data[2]->FacadeNumber)?$Data[2]->FacadeNumber:"-" }}</td>@endif
                    @if (!empty($Data[3]))<td>{{ ($Data[3]->FacadeNumber)?$Data[3]->FacadeNumber:"-" }}</td>@endif
                </tr>
                <tr>
                    <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.Residential Land Type') }}</span></th>
                </tr>
                <tr>
                    @if (!empty($Data[0]))<td>{{ ($Data[0]->ResidentialLandType)?config('constants.ResidentialLandTypeAr.'.$Data[0]->ResidentialLandType):"-" }}</td>@endif
                    @if (!empty($Data[1]))<td>{{ ($Data[1]->ResidentialLandType)?config('constants.ResidentialLandTypeAr.'.$Data[1]->ResidentialLandType):"-" }}</td>@endif
                    @if (!empty($Data[2]))<td>{{ ($Data[2]->ResidentialLandType)?config('constants.ResidentialLandTypeAr.'.$Data[2]->ResidentialLandType):"-" }}</td>@endif
                    @if (!empty($Data[3]))<td>{{ ($Data[3]->ResidentialLandType)?config('constants.ResidentialLandTypeAr.'.$Data[3]->ResidentialLandType):"-" }}</td>@endif
                </tr>
                <tr>
                    <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.Building Facade Type') }}</span></th>
                </tr>
                <tr>
                    @if (!empty($Data[0]))<td>{{ ($Data[0]->BuildFacadeType)? config('constants.BuildingFacadeTypeAr.'.$Data[0]->BuildFacadeType):"-" }}</td>@endif
                    @if (!empty($Data[1]))<td>{{ ($Data[1]->BuildFacadeType)? config('constants.BuildingFacadeTypeAr.'.$Data[1]->BuildFacadeType):"-" }}</td>@endif
                    @if (!empty($Data[2]))<td>{{ ($Data[2]->BuildFacadeType)? config('constants.BuildingFacadeTypeAr.'.$Data[2]->BuildFacadeType):"-" }}</td>@endif
                    @if (!empty($Data[3]))<td>{{ ($Data[3]->BuildFacadeType)? config('constants.BuildingFacadeTypeAr.'.$Data[3]->BuildFacadeType):"-" }}</td>@endif
                </tr>
                <tr>
                    <th colspan="4" align="center"><span class="font-size-16 font-wt-600">{{ __('msg.FloorType') }}</span></th>
                </tr>
                <tr>
                    @if (!empty($Data[0]))<td>{{ ($Data[0]->FloorType)?config('constants.FloorTypeAr.'.$Data[0]->FloorType):"-" }}</td>@endif
                    @if (!empty($Data[1]))<td>{{ ($Data[1]->FloorType)?config('constants.FloorTypeAr.'.$Data[1]->FloorType):"-" }}</td>@endif
                    @if (!empty($Data[2]))<td>{{ ($Data[2]->FloorType)?config('constants.FloorTypeAr.'.$Data[2]->FloorType):"-" }}</td>@endif
                    @if (!empty($Data[3]))<td>{{ ($Data[3]->FloorType)?config('constants.FloorTypeAr.'.$Data[3]->FloorType):"-" }}</td>@endif
                </tr>
                   @endif
                </table>
            </div>


        <div class="table-responsive animate__animated animate__fadeIn animate__slow d-none d-sm-block">
            <table width="100%" cellspacing="0" cellpadding="0" class="table">
                <tbody>
                    <tr>
                        <td width="20%" class="ps-0 pe-0 pt-0">
                            <ul class="list-group">
                                <li class="list-group-item height-180 center">
                                </li>
                                <li class="list-group-item">{{ __('msg.ReferenceNo') }}</li>
                                <li class="list-group-item">{{ __('msg.City') }}</li>
                                <li class="list-group-item">{{ __('msg.Location') }}</li>
                                <li class="list-group-item">{{ __('msg.BuiltupArea') }} (Sq m.)</li>
                                <li class="list-group-item">{{ __('msg.Bedrooms') }}</li>
                                <li class="list-group-item">{{ __('msg.Bathrooms') }}</li>
                                <li class="list-group-item">{{ __('msg.Furnished') }}</li>
                                {{-- <li class="list-group-item">Parking</li> --}}
                                <li class="list-group-item">{{ __('msg.Swimming Pool') }}</li>
                                <li class="list-group-item">{{ __('msg.Apartment Type') }}</li>
                                <li class="list-group-item">{{ __('msg.Outdoor Area') }}</li>
                                <li class="list-group-item">{{ __('msg.Number of Floors') }}</li>
                                <li class="list-group-item">{{ __('msg.PlotArea') }} (Sq m.)</li>
                                <li class="list-group-item">{{ __('msg.Villa Type') }}</li>
                                <li class="list-group-item">{{ __('msg.Rented') }}</li>
                                <li class="list-group-item">{{ __('msg.Floor Number') }}</li>
                                <li class="list-group-item">{{ __('msg.Number of Streets') }}</li>
                                <li class="list-group-item">{{ __('msg.Serviced') }}</li>
                                <li class="list-group-item">{{ __('msg.Commercial Type') }}</li>
                                <li class="list-group-item">{{ __('msg.Building Percentage Number') }}</li>
                                <li class="list-group-item">{{ __('msg.Facade Number') }}</li>
                                <li class="list-group-item">{{ __('msg.Residential Land Type') }}</li>
                                <li class="list-group-item">{{ __('msg.Building Facade Type') }}</li>
                                <li class="list-group-item">{{ __('msg.FloorType') }}</li>
                            </ul>
                        </td>
                        @if($Data->first())
                         @foreach ($Data as $val)
                         @if(app()->getLocale()=="en")
                                <td class="ps-0 pe-0 pt-0">
                                    <ul class="list-group">
                                        <li class="list-group-item height-180 center">
                                            @if ($val->FileName && $val->IsDownloaded==1) 
                                            <img src="{{ asset("uploads/properties/orignal/".$val->PropertyRefNo."/".$val->FileName) }}" width="30%" alt="{{ $val->ImgAlt }}">
                                            @else
                                            <img src="{{ asset('images/noimg.jpg')}}" width="30%" alt="no image">
                                            @endif
                                            <br />
                                            <p class="font-size-12 font-wt-500 mt-2 mb-2">{{ Str::limit(trim(preg_replace('/\s\s+/', ' ', $val->PropertyTitle)),70, $end='...')}}</p>
                                            <p class="font-size-16 font-wt-600 mb-0 color-gold">{{ currency_format($val->Price) }} </p>
                                        </li>
                                        <li class="list-group-item">{{  config('constants.AdTypeshort.'.$val->AdType)}}-{{   preg_replace('/[^0-9]/', '', $val->PropertyRefNo);   }}</li>
                                        <li class="list-group-item"> {{ $val->CityName }}</li>
                                        <li class="list-group-item"> {{ ($val->CommunityName)? $val->CommunityName : "-"}}</li>
                                        <li class="list-group-item">{{ ($val->UnitBuiltupArea)? number_format($val->UnitBuiltupArea, 2) : "-" }} </li>
                                        <li class="list-group-item">{{ ($val->NoBedrooms)? $val->NoBedrooms  :  "-" }}</li>
                                        <li class="list-group-item">{{ ($val->NoBathrooms)? $val->NoBathrooms  :  "-" }}</li>
                                        <li class="list-group-item">{{ ($val->Furnished)? config('constants.Furnished.'.$val->Furnished)  :  "-" }}</li>
                                        {{-- <li class="list-group-item">{{ ($val->Parking)? $val->Parking  :  "No" }}</li> --}}
                                        <li class="list-group-item">{{ ($val->SwimmingPool)? "Yes"  :  "No" }}</li>
                                        <li class="list-group-item">{{ ($val->ApartmentType)? $val->ApartmentType  :  "-" }}</li>
                                        <li class="list-group-item">{{ ($val->OutdoorArea)? "Yes"  :  "No" }}</li>
                                        <li class="list-group-item">{{ ($val->NoFloors)? $val->NoFloors  :  "-" }}</li>
                                        <li class="list-group-item">{{ ($val->PlotSize)?  number_format($val->PlotSize, 2) :  "-" }}</li>
                                        <li class="list-group-item">{{ ($val->VillaType)? $val->VillaType  :  "-" }}</li>
                                        <li class="list-group-item">{{ ($val->Rented)? "Yes"  :  "No" }}</li>
                                        <li class="list-group-item">{{ (config('constants.FloorNumber.'.$val->Floor))?config('constants.FloorNumber.'.$val->Floor)  :  "-" }}</li>
                                        <li class="list-group-item">{{ ($val->Nostreets)? $val->Nostreets  :  "-" }}</li>
                                        <li class="list-group-item">{{ ($val->Serviced)? "Yes"  :  "No" }}</li>
                                        <li class="list-group-item">{{ ($val->CommercialType)? $val->CommercialType  :  "-" }}</li>
                                        <li class="list-group-item">{{ ($val->BuildPercentageNumber)? $val->BuildPercentageNumber  :  "-" }}</li>
                                        <li class="list-group-item">{{ ($val->FacadeNumber)? $val->FacadeNumber  :  "-" }}</li>
                                        <li class="list-group-item">{{ ($val->ResidentialLandType)? $val->ResidentialLandType  :  "-" }}</li>
                                        <li class="list-group-item">{{ ($val->BuildFacadeType)? $val->BuildFacadeType  :  "-" }}</li>
                                        <li class="list-group-item">{{ ($val->FloorType)? $val->FloorType  :  "-" }}</li>
                                       
                                    </ul>
                                </td>
                            @else
                            <td class="ps-0 pe-0 pt-0">
                                <ul class="list-group">
                                    <li class="list-group-item height-180 center">
                                        @if ($val->FileName)
                                        <img src="{{ asset("uploads/properties/orignal/".$val->PropertyRefNo."/".$val->FileName) }}" width="30%" alt="{{ $val->ImgAlt }}">
                                        @else
                                        <img src="{{ asset('images/noimg.jpg')}}" width="30%" alt="">
                                        @endif
                                        <br />
                                        <p class="font-size-12 font-wt-500 mt-2 mb-2">{{ Str::limit(trim(preg_replace('/\s\s+/', ' ', $val->PropertyTitle)),70, $end='...')}}</p>
                                        <p class="font-size-16 font-wt-600 mb-0 color-gold">{{ currency_format($val->Price) }} </p>
                                    </li>
                                    <li class="list-group-item">{{  config('constants.AdTypeshort.'.$val->AdType)}}-{{   preg_replace('/[^0-9]/', '', $val->PropertyRefNo);   }}</li>
                                    <li class="list-group-item"> {{ $val->CityName }}</li>
                                    <li class="list-group-item"> {{ ($val->CommunityName)? $val->CommunityName : "-"}}</li>
                                    <li class="list-group-item">{{ ($val->UnitBuiltupArea)? number_format($val->UnitBuiltupArea, 2) : "-" }} </li>
                                    <li class="list-group-item">{{ ($val->NoBedrooms)? $val->NoBedrooms  :  "-" }}</li>
                                    <li class="list-group-item">{{ ($val->NoBathrooms)? $val->NoBathrooms  :  "-" }}</li>
                                    <li class="list-group-item">{{ ($val->Furnished)? config('constants.FurnishedAr.'.$val->Furnished)  :  "-" }}</li>
                                    {{-- <li class="list-group-item">{{ ($val->Parking)? $val->Parking  :  "No" }}</li> --}}
                                    <li class="list-group-item">{{ ($val->SwimmingPool== "Yes")? config('constants.YesNoAr.Yes')  :  config('constants.YesNoAr.No') }}</li>
                                    <li class="list-group-item">{{ ($val->ApartmentType)? config('constants.ApartmentTypeAr.'.$val->ApartmentType)  :  "-" }}</li>
                                    <li class="list-group-item">{{ ($val->OutdoorArea== "Yes")? config('constants.YesNoAr.Yes')  :   config('constants.YesNoAr.No') }}</li>
                                    <li class="list-group-item">{{ ($val->NoFloors)? $val->NoFloors  :  "-" }}</li>
                                    <li class="list-group-item">{{ ($val->PlotSize)? number_format($val->PlotSize, 2) :  "-" }}</li>
                                    <li class="list-group-item">{{ ($val->VillaType)? config('constants.VillaTypeAr.'.$val->VillaType)  :  "-" }}</li>
                                    <li class="list-group-item">{{ ($val->Rented== "Yes")? config('constants.YesNoAr.Yes')  :   config('constants.YesNoAr.No') }}</li>
                                    <li class="list-group-item">{{ (config('constants.FloorNumberAr.'.$val->Floor))?config('constants.FloorNumberAr.'.$val->Floor)  :  "-" }}</li>
                                    <li class="list-group-item">{{ ($val->Nostreets)? $val->Nostreets  :  "-" }}</li>
                                    <li class="list-group-item">{{ ($val->Serviced== "Yes")? config('constants.YesNoAr.Yes')  :   config('constants.YesNoAr.No') }}</li>
                                    <li class="list-group-item">{{ ($val->CommercialType)?  config('constants.CommercialTypeAr.'.$val->CommercialType)  :  "-" }}</li>
                                    <li class="list-group-item">{{ ($val->BuildPercentageNumber)? $val->BuildPercentageNumber  :  "-" }}</li>
                                    <li class="list-group-item">{{ ($val->FacadeNumber)? $val->FacadeNumber  :  "-" }}</li>
                                    <li class="list-group-item">{{ ($val->ResidentialLandType)?  config('constants.ResidentialLandTypeAr.'.$val->ResidentialLandType) :  "-" }}</li>
                                    <li class="list-group-item">{{ ($val->BuildFacadeType)? config('constants.BuildingFacadeTypeAr.'.$val->BuildFacadeType)  :  "-" }}</li>
                                    <li class="list-group-item">{{ ($val->FloorType)? config('constants.FloorTypeAr.'.$val->FloorType)  :  "-" }}</li>
                                </ul>
                            </td>
                            @endif
                         @endforeach
                        @else
                        <h1 class="font-size-28 font-wt-600 animate__animated animate__fadeIn animate__slow">No properties available to compare</h1>
                        @endif
                    </tr>                     
                </tbody>
            </table>
        </div>
    </div>
</section>    
</section>    
@endsection