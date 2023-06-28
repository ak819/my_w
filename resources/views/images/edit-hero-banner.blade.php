@extends('admin-layouts.app')
@section('content')
<div class="content-inner">
    <div class="bc-box">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="float-left mt-2">
                    <div class="d-inline-flex align-items-center">
                        <h1>Edit  {{ $banner->PageName }} </h1><span class="font-size-16 font-wt-600 color-gray"></span>
                        <ol class="bclink">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin') }}"><i class="bx bx-home-alt font-size-18 color-gold"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="{{ route('hero-banners-list') }}">All Listing</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </div>
                </div>
                <div class="float-right">
                    <a href="{{ route('hero-banners-list') }}" class="btn btn-medium btn-outline-gold ml-2 mr-2 float-right">Back</a>
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
                 <strong>Error</strong>  An error occurred while updating the banner.
               
            </div>
        @endif
        <form action="{{ route('hero-banner.update',$banner->Guid) }}" method="post" enctype="multipart/form-data"> 
                   @csrf
                   @method('PUT')
                      <input type="hidden" name="Guid" value="{{ $banner->Guid }}">
            <div class="containerbox p-4 animate__animated animate__fadeIn animate__slow">
                <div class="row">
               
                    <div class="col-xl-6 col-lg-6 col-md-8 col-sm-8 col-12">
                        <label>Image  (1600 X 200) &nbsp;<span class="color-red">*</span></label><br />
                         <span class="btn btn-gold btn-file">
                            Select File <input type="file" name="Image" id="Image" onchange="readImage(this)">
                        </span>
                        @if($banner->Image)
                        <img src="{{ URL::asset('uploads/herobanner/'.$banner->Image) }}" width="45%" class="float-right" id="image_preview" />
                        @else
                         <img src="{{ URL::asset('images/noimg.jpg') }}" width="45%" class="float-right" id="image_preview" />
                        @endif
                       
                        <input type="hidden" name="prev_image" value="{{ $banner->Image }}">
                    </div>
                </div>
                 @error('Image')
                        <span class="error"  style="color:#F30;">{{ $message }}</span>
                 @enderror

                 <br>
                 <div class="row">
                     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                         <label>Image Alt &nbsp;&nbsp;<span class="color-red"></span></label>
                         <input type="text" name="Alt" class="form-control" value="{{ Request::old('Alt', $banner->Alt) }}" />
                         @error('Alt')
                         <span class="error" style="color:#F30;">{{ $message }}</span>
                         @enderror
                     </div>
                 </div>
                 
                <hr />
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <!-- <a href="" class="btn btn-medium btn-gold float-right">Update Info</a> -->
                        <button type="submit" class="btn btn-medium btn-gold float-right" id="submit">Update Info</button>
                    </div>
                </div>
            
            </div>
            </form>
        </div>
    </div>
</div>
@endsection()
<script>

function readImage(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#image_preview').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

    </script>