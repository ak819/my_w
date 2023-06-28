@extends('admin-layouts.app')
@section('content')
<div class="content-inner">
    <div class="bc-box">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="float-left mt-2">
                    <div class="d-inline-flex align-items-center">
                        <h1>Edit Service</h1>
                        <ol class="bclink">
                            <li class="breadcrumb-item">
                                 <a href="{{ route('admin') }}"><i class="bx bx-home-alt font-size-18 color-gold"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="{{ route('service.index') }}">All Listing</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </div>
                </div>
                <div class="float-right">
                    <a href="{{ route('service.index') }}" class="btn btn-medium btn-outline-gold ml-2 mr-2 float-right">Back</a>
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
            <div class="containerbox p-4 animate__animated animate__fadeIn animate__slow">
                <form method="post" action="{{ route('service.update', $service->Guid) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label>Sub Heading (Link) (EN)&nbsp;&nbsp;<span class="color-red">*</span></label>
                                    <input type="text" name="SubHeading" class="form-control" value="{{ Request::old('SubHeading', $service->SubHeading) }}" />
                                    @error('SubHeading')
                                    <span class="error" style="color:#F30;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label>Sub Heading (Link) (AR)&nbsp;&nbsp;<span class="color-red">*</span></label>
                                    <input type="text" name="SubHeadingAr" class="form-control" value="{{ Request::old('SubHeadingAr', $service->SubHeadingAr) }}" />
                                    @error('SubHeadingAr')
                                    <span class="error" style="color:#F30;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label>Title (EN)&nbsp;<span class="color-red">*</span></label>
                                    <input type="text" name="Title" class="form-control" value="{{ Request::old('Title', $service->Title) }}" />
                                    @error('Title')
                                    <span class="error" style="color:#F30;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label>Title (AR)&nbsp;<span class="color-red">*</span></label>
                                    <input type="text" name="TitleAr" class="form-control" value="{{ Request::old('TitleAr', $service->TitleAr) }}" />
                                    @error('TitleAr')
                                    <span class="error" style="color:#F30;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label>Description (EN)&nbsp;<span class="color-red">*</span></label>
                                    <textarea class="description" name="Description">
                                    {{html_entity_decode(Request::old('Description', $service->Description))}}
                                    </textarea>
                                    @error('Description')
                                    <span class="error" style="color:#F30;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label>Description (AR)&nbsp;<span class="color-red">*</span></label>
                                    <textarea class="description" name="DescriptionAr">
                                    {{html_entity_decode(Request::old('DescriptionAr', $service->DescriptionAr))}}
                                    </textarea>
                                    @error('DescriptionAr')
                                    <span class="error" style="color:#F30;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label>Meta Title (EN)&nbsp;&nbsp;<span class="color-red"></span></label>
                                    <input type="text" name="MetaTitle" class="form-control" value="{{ Request::old('MetaTitle', $service->MetaTitle) }}" />
                                    @error('MetaTitle')
                                    <span class="error" style="color:#F30;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label>Meta Title (AR)&nbsp;&nbsp;<span class="color-red"></span></label>
                                    <input type="text" name="MetaTitleAr" class="form-control" value="{{ Request::old('MetaTitleAr', $service->MetaTitleAr) }}" />
                                    @error('MetaTitleAr')
                                    <span class="error" style="color:#F30;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label>Meta Description (EN)&nbsp;<span class="color-red"></span></label><br>
                                    <textarea name="MetaDescription" class="form-control" rows="4" cols="110">{{html_entity_decode(Request::old('MetaDescription', $service->MetaDescription))}}</textarea>
                                    @error('MetaDescription')
                                    <span class="error" style="color:#F30;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label>Meta Description (AR)&nbsp;<span class="color-red"></span></label><br>
                                    <textarea name="MetaDescriptionAr" class="form-control" rows="4" cols="110">{{html_entity_decode(Request::old('MetaDescriptionAr', $service->MetaDescriptionAr))}}</textarea>
                                    @error('MetaDescriptionAr')
                                    <span class="error" style="color:#F30;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
                                    <label>Cover Image&nbsp;<span class="color-red">*</span></label>
                                    <input type="file" name="Image" id="Image" onchange="readImage(this)">
                                    @error('Image')
                                    <span class="error" style="color:#F30;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 center">
                                    <img src="{{ URL::asset('uploads/services/'.$service->Image) }}" id="image_preview" width="150px" />
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <label>Image Alt &nbsp;&nbsp;<span class="color-red"></span></label>
                                    <input type="text" name="Alt" class="form-control" value="{{ Request::old('Alt', $service->Alt) }}" />
                                    @error('Alt')
                                    <span class="error" style="color:#F30;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
                                    <label>Status</label><br />
                                    <div class="checkbox checkbox-primary">
                                        <input id="checkbox1" class="styled" type="checkbox" name="IsEnable" @if($service->IsEnable) checked @endif />
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
<script>
    $('.description').summernote({
      tabsize: 2,
      height: 100
    });
  </script>
@endsection()