@extends('admin-layouts.app')
@section('content')
<div class="content-inner">
    <div class="bc-box">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="float-left mt-2">
                    <div class="d-inline-flex align-items-center">
                        <h1>Edit Contact Info</h1>
                        <ol class="bclink">
                            <li class="breadcrumb-item">
                                 <a href="{{ route('admin') }}"><i class="bx bx-home-alt font-size-18 color-gold"></i></a>
                            </li>
                           
                        </ol>
                    </div>
                </div>
                <div class="float-right">
                    <a href="{{ route('admin') }}" class="btn btn-medium btn-outline-gold ml-2 mr-2 float-right">Back</a>
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
                     <strong>Error</strong> An error occurred while adding the contactinfos.
                   
                </div>
            @endif
            <form action="{{ route('contactinfo.update',$contactinfo->Guid) }}" method="post" enctype="multipart/form-data"> 
                   @csrf
                   @method('PUT')
                    <input type="hidden" name="Guid" value="{{ $contactinfo->Guid }}">
            <div class="containerbox p-4 animate__animated animate__fadeIn animate__slow">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <label>Email &nbsp;<span class="color-red">*</span></label>
                                 <input type="text" class="form-control" name="Email" id="Email" value="{{ $contactinfo->Email }}"  />
                                 @error('Email')
                               <span class="error"  style="color:#F30;">{{ $message }}</span>
                                  @enderror
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <label>Phone&nbsp;<span class="color-red">*</span></label>
                                 <input type="text" class="form-control" name="Phone"  value="{{ $contactinfo->Phone }}"  />
                                 @error('Phone')
                               <span class="error"  style="color:#F30;">{{ $message }}</span>
                                  @enderror
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <label>Message&nbsp;<span class="color-red">*</span></label>
                                 <textarea class="form-control description" name="Address">{{ $contactinfo->Address }}</textarea>
                                 @error('Address')
                               <span class="error"  style="color:#F30;">{{ $message }}</span>
                                  @enderror
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <label>Message (Arabic)&nbsp;<span class="color-red">*</span></label>
                                 <textarea class="form-control description" name="AddressAr" >{{ $contactinfo->AddressAr }}</textarea>
                                 @error('AddressAr')
                               <span class="error"  style="color:#F30;">{{ $message }}</span>
                                  @enderror
                            </div>
                    </div>
                    <hr />
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                               <button type="submit" class="btn btn-medium btn-gold" id="submit">Update Info</button>
                            </div>
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
