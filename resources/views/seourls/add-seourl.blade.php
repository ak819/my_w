@extends('admin-layouts.app')
@section('content')
<div class="content-inner">
    <div class="bc-box">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="float-left mt-2">
                    <div class="d-inline-flex align-items-center">
                        <h1>Add Seo Url</h1>
                        <ol class="bclink">
                            <li class="breadcrumb-item">
                                <a href="#"><i class="bx bx-home-alt font-size-18 color-gold"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="{{  route('seourl.index') }}">All Listing</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Add</li>
                        </ol>
                    </div>
                </div>
                <div class="float-right">
                    <a href="{{ route('seourl.index') }}" class="btn btn-medium btn-outline-gold ml-2 mr-2 float-right">Back</a>
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
                <div class="alert alert-danger animate__animated animate__fadeInDown"  role="alert">
                     <strong>Error</strong> An error occured while saving user.
                   
                </div>
            @endif
            <div class="containerbox p-4 animate__animated animate__fadeIn animate__slow">
                <form method="post" action="{{ route('seourl.store') }}" enctype="multipart/form-data" >
                    @csrf
                <div class="row">
                    <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">

                        <div class="row">
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                                <label>Property Type&nbsp;<span class="color-red">*</span></label>
                                 <select class="form-control"  name="property_type" id="userrole">
                                    <option value="">Select</option>
                                    @foreach ($property_type as $val)
                                    <option value="{{ $val->ID }}" {{ (collect(old('property_type'))->contains($val->ID)) ? 'selected':'' }}>{{ $val->TypeName }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @error('property_type')
                        <span class="error"  style="color:#F30;">{{ $message }}</span>
                        @enderror

                        <div class="row">
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                                <label>Add Type&nbsp;<span class="color-red">*</span></label>
                                 <select class="form-control" name="add_type" id="userrole"">
                                    <option value="">Select</option>
                                    @foreach (config('constants.AdType') as $key => $val)
                                    <option value="{{ $val }}" {{ (collect(old('add_type'))->contains($val)) ? 'selected':'' }}>{{ $key }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @error('add_type')
                        <span class="error"  style="color:#F30;">{{ $message }}</span>
                        @enderror


                        <div class="row">
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                                <label>Title&nbsp;<span class="color-red">*</span></label>
                                <input type="text" name="title"  value="{{ Request::old('title') }}" class="form-control" />
                            </div>
                        </div>
                        @error('title')
                        <span class="error"  style="color:#F30;">{{ $message }}</span>
                        @enderror
                        <div class="row">
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                                <label>Title (Arabic)&nbsp;<span class="color-red">*</span></label>
                                <input type="text" name="title_arabic"  value="{{ Request::old('title_arabic') }}" class="form-control" />
                            </div>
                        </div>
                        @error('title_arabic')
                        <span class="error"  style="color:#F30;">{{ $message }}</span>
                        @enderror
                        <div class="row">
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                                <label>Link</label>
                                <input type="text"  name="link"  value="{{ Request::old('link') }}" class="form-control" />
                            </div>
                        </div>
                        
                        @error('link')
                        <span class="error"  style="color:#F30;">{{ $message }}</span>
                        @enderror
                        
                       
                    </div>
                    
                <hr />
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <button type="submit" class="btn btn-medium btn-gold">Save Info</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection()

