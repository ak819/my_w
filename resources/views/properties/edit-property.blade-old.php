@extends('admin-layouts.app')
@section('content')
<div class="content-inner">
                <div class="bc-box">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="float-left mt-2">
                                <div class="d-inline-flex align-items-center">
                                    <h1>Edit Property</h1>
                                    <ol class="bclink">
                                        <li class="breadcrumb-item">
                                            <a href="{{ route('admin') }}"><i class="bx bx-home-alt font-size-18 color-gold"></i></a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">All Listing</li>
                                    </ol>
                                </div>
                            </div>
                            <div class="float-right">
                                <a href="{{ route('property.index') }}" class="btn btn-medium btn-outline-gold ml-2 mr-2 float-right">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">

                        @if ($message = Session::get('success'))
                        <div class="alert alert-success animate__animated animate__fadeInDown" role="alert">
                            <strong>Success</strong>{{ $message }}
                        </div>
                        @endif
                        <div class="containerbox p-4 animate__animated animate__fadeIn animate__slow">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-info-tab" data-toggle="pill" href="#pills-info" role="tab" aria-controls="pills-info" aria-selected="true">Basic Info</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('propertyImages.edit',$Property->Guid) }}" >Images</a>
                                        </li>
                                        <!--<li class="nav-item">
                                            <a class="nav-link" id="pills-image-tab" data-toggle="pill" href="#pills-image" role="tab" aria-controls="pills-image" aria-selected="true">3. Topics</a>
                                        </li>-->
                                    </ul>

                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-info" role="tabpanel" aria-labelledby="pills-select-tab">
                                            
                                            <div class="row">
                                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                                    <label>Property Ref No</label>
                                                    <p>{{ $Property->PropertyRefNo }}</p>
                                                </div>
                                                <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-12">
                                                    <label>Property Name</label>
                                                    <p>{{ $Property->PropertyTitle }}</p>
                                                </div>
                                            </div>
                                            
                                            <hr/>
                                            
                                            <form action="{{ route('property.update',$Property->Guid) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="row">
                                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                                    <label>Number of Floors</label>
                                                    <input type="text" name="NoFloors" class="form-control" value="{{ $Property->NoFloors }}" />
                                                </div>
                                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                                    <label>Floor Number</label>
                                                    <select class="form-control" name="FloorNumber">
                                                        <option value="">Select</option>
                                                        @foreach (config('constants.FloorNumberAr') as $floorNumbers => $arabic)
                                                        <option value="{{ $floorNumbers }}" {{ ($Property->FloorNumber == $floorNumbers)? "selected": "" }}>{{ $floorNumbers  }} - {{ $arabic  }}</option> 
                                                        @endforeach
                                                        </select>
                                                </div>
                                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                                    <label>Apartment Type</label>
                                                    <select class="form-control" name="ApartmentType">
                                                        <option value="">Select</option>
                                                        @foreach (config('constants.ApartmentTypeAr') as $apttype => $arabic)
                                                        <option value="{{ $apttype }}" {{ ($Property->ApartmentType == $apttype)? "selected": "" }}>{{ $apttype  }} - {{ $arabic  }}</option> 
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                                    <label>Villa Type</label>
                                                    <select class="form-control" name="VillaType">
                                                        <option value="">Select</option>
                                                        @foreach (config('constants.VillaTypeAr') as $villatype => $arabic)
                                                        <option value="{{ $villatype }}" {{ ($Property->VillaType == $villatype)? "selected": "" }}>{{ $villatype  }} - {{ $arabic  }}</option> 
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                                    <label>Commercial Type</label>
                                                    <select class="form-control" name="CommercialType">
                                                        <option value="">Select</option>
                                                        @foreach (config('constants.CommercialTypeAr') as $commtype => $arabic)
                                                        <option value="{{ $commtype }}" {{ ($Property->CommercialType == $commtype)? "selected": "" }}>{{ $commtype  }} - {{ $arabic  }}</option> 
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                                    <label>Residential Land Type</label>
                                                    <select class="form-control" name="ResidentialLandType">
                                                        <option value="">Select</option>
                                                        @foreach (config('constants.ResidentialLandTypeAr') as $reslandtype  => $arabic)
                                                        <option value="{{ $reslandtype }}" {{ ($Property->ResidentialLandType == $reslandtype)? "selected": "" }}>{{ $reslandtype  }} - {{ $arabic  }}</option> 
                                                        @endforeach
                                                        
                                                    </select>
                                                </div>
                                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                                    <label>Swimming Pool</label>
                                                    <select class="form-control" name="SwimmingPool">
                                                        <option value="">Select</option>
                                                        @foreach (config('constants.YesNoAr') as $val  => $arabic)
                                                        <option value="{{ $val }}" {{ ($Property->SwimmingPool == $val)? "selected": "" }}>{{ $val  }} - {{ $arabic  }}</option> 
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                                    <label>Outdoor Area</label>
                                                    <select class="form-control" name="OutdoorArea">
                                                        <option value="">Select</option>
                                                        @foreach (config('constants.YesNoAr') as $val  => $arabic)
                                                        <option value="{{ $val }}" {{ ($Property->OutdoorArea == $val)? "selected": "" }}>{{ $val  }} - {{ $arabic  }}</option> 
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                                    <label>Rented</label>
                                                    <select class="form-control" name="Rented">
                                                        <option value="">Select</option>
                                                        @foreach (config('constants.YesNoAr') as $val  => $arabic)
                                                        <option value="{{ $val }}" {{ ($Property->Rented == $val)? "selected": "" }}>{{ $val  }} - {{ $arabic  }}</option> 
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                                    <label>Number of Streets</label>
                                                    <input type="text" class="form-control" name="Nostreets" value="{{ $Property->Nostreets }}"/>
                                                </div>
                                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                                    <label>Serviced</label>
                                                    <select class="form-control" name="Serviced">
                                                        <option value="">Select</option>
                                                        @foreach (config('constants.YesNoAr') as $val  => $arabic)
                                                        <option value="{{ $val }}" {{ ($Property->Serviced == $val)? "selected": "" }}>{{ $val  }} - {{ $arabic  }}</option> 
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                                    <label>Building Percentage Number</label>
                                                    <input type="text" class="form-control"  name="BuildPercentageNumber" value="{{ $Property->BuildPercentageNumber }}"/>
                                                </div>
                                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                                    <label>Facade Number</label>
                                                    <input type="text" class="form-control"  name="FacadeNumber" value="{{ $Property->FacadeNumber }}"/>
                                                </div>
                                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                                    <label>Building Facade Type</label>
                                                    <select class="form-control" name="BuildFacadeType">
                                                        <option value="">Select</option>
                                                        @foreach (config('constants.BuildingFacadeTypeAr') as $builfacade => $arabic)
                                                        <option value="{{ $builfacade }}" {{ ($Property->BuildFacadeType == $builfacade)? "selected": "" }}>{{ $builfacade  }} - {{ $arabic  }}</option> 
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                                    <label>Floor Type</label>
                                                    <select class="form-control" name="FloorType">
                                                        <option value="">Select</option>
                                                        @foreach (config('constants.FloorTypeAr') as $floortype => $arabic)
                                                        <option value="{{ $floortype }}" {{ ($Property->FloorType == $floortype)? "selected": "" }}>{{ $floortype  }} - {{ $arabic  }}</option> 
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                                    <label>Video</label>
                                                    <input type="text" class="form-control"  name="Video" value="{{ $Property->Video }}"/>
                                                </div>
                                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                                    <label>Owner Name</label>
                                                    <input type="text" class="form-control"  name="OwnerName" value="{{ $Property->OwnerName }}"/>
                                                </div>
                                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                                    <label>Owner No</label>
                                                    <input type="text" class="form-control"  name="OwnerNo" value="{{ $Property->OwnerNo }}"/>
                                                </div>
                                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                                    <label>Land No</label>
                                                    <input type="text" class="form-control"  name="LandNo" value="{{ $Property->LandNo }}"/>
                                                </div>
                                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                                    <label>Land District</label>
                                                    <input type="text" class="form-control"  name="LandDistrict" value="{{ $Property->LandDistrict }}"/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">

                                                    <div class="checkbox checkbox-primary">
                                                        <input id="checkbox1" class="styled" type="checkbox" name="IsFeatured" @if($Property->IsFeatured) checked @endif />
                                                        <label for="checkbox1">Is Featured</label>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">

                                                    <div class="checkbox checkbox-primary">
                                                        <input id="checkbox2" class="styled" type="checkbox" name="IsExclusive" @if($Property->IsExclusive) checked @endif />
                                                        <label for="checkbox2">Is Exclusive</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <button  type="submit" class="btn btn-medium btn-gold float-right">Save Info</button>
                                                </div>
                                            </div>
                                        </form>
                                        </div>
                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
@endsection()