@extends('admin-layouts.app')
@section('content')
<div class="content-inner">
    <div class="bc-box">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="float-left mt-2">
                    <div class="d-inline-flex align-items-center">
                        <h1>Edit Agent</h1><span class="font-size-16 font-wt-600 color-gray"></span>
                        <ol class="bclink">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin') }}"><i class="bx bx-home-alt font-size-18 color-gold"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="{{ route('agent.index') }}">All Listing</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </div>
                </div>
                <div class="float-right">
                    <a href="{{ route('agent.index') }}" class="btn btn-medium btn-outline-gold ml-2 mr-2 float-right">Back</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            @if ($message = Session::get('success'))
            <div class="alert alert-success animate__animated animate__fadeInDown" role="alert">
                <strong>{{ $message }}</strong>
            </div>
            @endif

            @if (count($errors) > 0)
            <div class="alert alert-danger animate__animated animate__fadeInDown" role="alert">
                <strong>Error</strong> An error occurred while updating the agent.

            </div>
            @endif
            <div class="containerbox p-4 animate__animated animate__fadeIn animate__slow">
                <form action="{{ route('agent.update',$Data->Guid) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <label>Display Agent Name&nbsp;<span class="color-red">*</span></label>
                                    <input type="text" Name="DisplayName" value="{{ Request::old('DisplayName', $Data->DisplayName) }}" class="form-control" />
                                    @error('DisplayName')
                                    <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <label>Display Agent Name (Arabic)&nbsp;<span class="color-red">*</span></label>
                                    <input type="text" Name="DisplayNameAr" value="{{ Request::old('DisplayNameAr', $Data->DisplayNameAr) }}" class="form-control" />
                                    @error('DisplayNameAr')
                                    <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <label>Display Email Id&nbsp;<span class="color-red">*</span></label>
                                    <input type="text" Name="DisplayEmail" value="{{ Request::old('DisplayEmail', $Data->DisplayEmail) }}" class="form-control" />
                                    @error('DisplayEmail')
                                    <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <label>Display Mobile No&nbsp;<span class="color-red">*</span></label>
                                    <input type="text" Name="DisplayPhone" value="{{ Request::old('DisplayPhone', $Data->DisplayPhone) }}" class="form-control" />
                                    @error('DisplayPhone')
                                    <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                             {{-- <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                       <label>Property Type&nbsp;<span class="color-red">*</span></label>
                                    <select name="property" class="form-control">
                             
                                       <option value="">Property Type</option>
                                        <option value="Residential Villas" @if($Data->PropertyType == 'Residential Villas') selected @endif>Residential Villas</option>
                                        <option value="Residential Apartments"  @if($Data->PropertyType == "Residential Apartments") selected @endif>Residential Apartments</option>
                                        <option value="Commercial"  @if($Data->PropertyType == "Commercial") selected @endif>Commercial</option> 
                                        <option value="Lands"  @if($Data->PropertyType == "Lands") selected @endif>Lands</option>
                                    </select>
                                        
                                </div>
                            </div> --}}
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                    <label>Display Agent Photo&nbsp;<span class="color-red">*</span></label>
                                    <input type="file" Name="Photo" class="form-control" id="Image" onchange="readImage(this)" />
                                    @error('Photo')
                                    <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 center">
                                    @if($Data->DisplayPhoto)
                                    <img src="{{ URL::asset('uploads/agent/'.$Data->DisplayPhoto) }}" width="150px" id="image_preview" />
                                    @else
                                    <img src="{{ asset('images/sample.png') }}" width="150px" id="image_preview" />
                                    @endif

                                    <input type="hidden" name="prev_image" value="{{ $Data->DisplayPhoto }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
                                    <label>Status</label><br />
                                    <div class="checkbox checkbox-primary">
                                        <input id="checkbox1" class="styled" type="checkbox" name="IsEnable" @if($Data->IsEnable) checked @endif />
                                        <label for="checkbox1">Is Enabled</label>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                    <button type="submit" class="btn btn-medium btn-gold" id="submit">Update
                                        Info</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection()