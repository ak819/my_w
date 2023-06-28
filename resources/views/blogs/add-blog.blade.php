@extends('admin-layouts.app')
@section('content')
<div class="content-inner">
    <div class="bc-box">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="float-left mt-2">
                    <div class="d-inline-flex align-items-center">
                        <h1>Add Blog</h1>
                        <ol class="bclink">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin') }}"><i class="bx bx-home-alt font-size-18 color-gold"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="{{ route('blog.index') }}">All Listing</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Add</li>
                        </ol>
                    </div>
                </div>
                <div class="float-right">
                    <a href="{{ route('blog.index') }}" class="btn btn-medium btn-outline-gold ml-2 mr-2 float-right">Back</a>
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
                <form method="post" action="{{ route('blog.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label>Title (EN)&nbsp;<span class="color-red">*</span></label>
                                    <input type="text" name="Title" class="form-control" value="{{old('Title')}}" />
                                    @error('Title')
                                    <span class="error" style="color:#F30;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                           <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label>Title (AR)&nbsp;<span class="color-red">*</span></label>
                                    <input type="text" name="TitleAr" class="form-control"  value="{{old('TitleAr')}}"/>
                                    @error('TitleAr')
                                    <span class="error" style="color:#F30;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label>Description (EN)&nbsp;<span class="color-red">*</span></label>
                                    <textarea class="description" id="desc1" name="Description">{{old('Description')}}</textarea>
                                    @error('Description')
                                    <span class="error" style="color:#F30;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label>Description (AR)&nbsp;<span class="color-red">*</span></label>
                                    <textarea class="description" id="desc2" name="DescriptionAr">{{old('DescriptionAr')}}</textarea>
                                    @error('DescriptionAr')
                                    <span class="error" style="color:#F30;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label>Meta Title (EN)&nbsp;&nbsp;<span class="color-red"></span></label>
                                    <input type="text" name="MetaTitle" class="form-control" value="{{old('MetaTitle')}}" />
                                    @error('MetaTitle')
                                    <span class="error" style="color:#F30;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label>Meta Title (AR)&nbsp;&nbsp;<span class="color-red"></span></label>
                                    <input type="text" name="MetaTitleAr" class="form-control" value="{{old('MetaTitleAr')}}" />
                                    @error('MetaTitleAr')
                                    <span class="error" style="color:#F30;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label>Meta Description (EN)&nbsp;<span class="color-red"></span></label><br>
                                    <textarea name="MetaDescription" class="form-control" rows="4" cols="110">{{old('MetaDescription')}}</textarea>
                                    @error('MetaDescription')
                                    <span class="error" style="color:#F30;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label>Meta Description (AR)&nbsp;<span class="color-red"></span></label><br>
                                    <textarea name="MetaDescriptionAr" class="form-control" rows="4" cols="110">{{old('MetaDescriptionAr')}}</textarea>
                                    @error('MetaDescriptionAr')
                                    <span class="error" style="color:#F30;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
                                    <label>Cover Image&nbsp;<span class="color-red">*</span></label>
                                    <input type="file" name="Image" id="Image" onchange="readImage(this)">
                                    @error('Image')
                                    <span class="error" style="color:#F30;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 center">
                                    <img src="" id="image_preview" width="150px" />
                                </div>
                            </div>
                            <br />
                            <div class="row">
                               <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <label>Image Alt&nbsp;&nbsp;<span class="color-red"></span></label>
                                    <input type="text" name="Alt" class="form-control" value="{{old('Alt')}}" />
                                    @error('Alt')
                                    <span class="error" style="color:#F30;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                    <button type="submit" class="btn btn-medium btn-gold " id="submit">Save
                                        Info</button>
                                    <button type="reset" class="btn btn-medium btn-outline-gold">
                                        Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

  {{-- <script>
    
          $('.description').each( function () {

        CKEDITOR.replace( this.id , {

    filebrowserBrowseUrl: filemanager.ckBrowseUrl,

});

});
      
  </script> --}}

<script>
    $('.description').summernote({
      tabsize: 2,
      height: 100
    });
  </script>
  
@endsection()