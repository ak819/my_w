@extends('admin-layouts.app')
@section('content')
<div class="content-inner">
    <div class="bc-box">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="float-left mt-2">
                    <div class="d-inline-flex align-items-center">
                        <h1>Add Media</h1><span class="font-size-16 font-wt-600 color-gray"></span>
                        <ol class="bclink">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin') }}"><i class="bx bx-home-alt font-size-18 color-gold"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="{{ route('media.index') }}">All Listing</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Add</li>
                        </ol>
                    </div>
                </div>
                <div class="float-right">
                    <a href="{{ route('media.index') }}" class="btn btn-medium btn-outline-gold ml-2 mr-2 float-right">Back</a>
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
                 <strong>Error</strong> An error occurred while adding the media.
               
            </div>
        @endif
              
            <div class="containerbox p-4 animate__animated animate__fadeIn animate__slow">
                 <form method="post" action="{{ route('media.store') }}" enctype="multipart/form-data" >
                   @csrf
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-8 col-sm-8 col-12">
                        <label>Image&nbsp;<span class="color-red">*</span></label><br />
                        <span class="btn btn-gold btn-file">
                            Select File <input type="file" name="Image" id="Image" onchange="readImage(this)">
                        </span>
                        <img src="{{ asset('images/sample.png') }}" width="45%" class="float-right" id="image_preview" />
                    </div>
                </div>
                @error('Image')
                        <span class="error"  style="color:#F30;">{{ $message }}</span>
                 @enderror
                 
                <hr />
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <button type="submit" class="btn btn-medium btn-gold float-right" id="submit">Save Info</button>
                       <!--  <a href="" class="btn btn-medium btn-gold float-right">Save Info</a> -->
                    </div>
                </div>
                 </form>
            </div>
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