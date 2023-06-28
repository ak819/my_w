@extends('admin-layouts.app')
@section('content')
            <div class="content-inner">
                <div class="bc-box">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="float-left mt-2">
                                <div class="d-inline-flex align-items-center">
                                    <h1>Edit Location</h1>
                                    <ol class="bclink">
                                        <li class="breadcrumb-item">
                                             <a href="{{ route('admin') }}"><i class="bx bx-home-alt font-size-18 color-gold"></i></a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            <a href="{{ route('communities.index') }}">All Listing</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Add</li>
                                    </ol>
                                </div>
                            </div>
                            <div class="float-right">
                                <a href="{{ route('communities.index') }}" class="btn btn-medium btn-outline-gold ml-2 mr-2 float-right">Back</a>
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
                                 <strong>Error</strong>  An error occurred while updating the location.
                               
                            </div>
                        @endif
                          <form action="{{ route('communities.update',$community->Guid) }}" method="post" enctype="multipart/form-data"> 

                   @csrf
                   @method('PUT')
                    <input type="hidden" name="Guid" value="{{ $community->Guid }}">
                        <div class="containerbox p-4 animate__animated animate__fadeIn animate__slow">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                            <label>Location English&nbsp;<span class="color-red">*</span></label>
                                            <input type="text" class="form-control" name="CommunityName" id="CommunityName" value="{{ $community->CommunityName }}"  disabled/>
                                             @error('CommunityName')
                                           <span class="error"  style="color:#F30;">{{ $message }}</span>
                                              @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                            <label>Location Arabic&nbsp;<span class="color-red">*</span></label>
                                            <input type="text" class="form-control" name="CommunityNameAr" id="CommunityNameAr" value="{{ $community->CommunityNameAr }}" />
                                             @error('CommunityNameAr')
                                           <span class="error"  style="color:#F30;">{{ $message }}</span>
                                              @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-8 col-sm-8 col-12">
                                            <label>Image&nbsp;(300 X 300)<span class="color-red">*</span></label><br />
                                             <span class="btn btn-gold btn-file">
                                                Select File <input type="file" name="Image" id="Image" onchange="readImage(this)">
                                            </span>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                                            @if($community->Image)
                                            <img src="{{ URL::asset('uploads/communities/'.$community->Image) }}" width="45%" id="image_preview" />
                                            <input type="hidden" name="prev_image" value="{{ $community->Image }}">
                    
                                            @else
                                            <img src="{{ asset('images/noimg.jpg') }}" width="45%" class="float-right" id="image_preview" />
                                            @endif
                                        </div>
                                    </div>
                                    <br/>
                                     @error('Image')
                                            <span class="error"  style="color:#F30;">{{ $message }}</span>
                                     @enderror

                                     <br>
                                     <div class="row">
                                         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                             <label>Image Alt &nbsp;&nbsp;<span class="color-red"></span></label>
                                             <input type="text" name="Alt" class="form-control" value="{{ Request::old('Alt', $community->Alt) }}" />
                                             @error('Alt')
                                             <span class="error" style="color:#F30;">{{ $message }}</span>
                                             @enderror
                                         </div>
                                     </div>
                                     
                                     <div class="row">
                                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
                                        <div class="checkbox checkbox-primary">
                                       <input id="checkbox2" class="styled" type="checkbox" name="IsFeatured" @if($community->IsFeatured) checked @endif />
                                       <label for="checkbox2">Is Featured</label>
                                       </div>
                                   </div>
                                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
                                         <div class="checkbox checkbox-primary">
                                        <input id="checkbox1" class="styled" type="checkbox" name="IsEnable" @if($community->IsEnable) checked @endif />
                                        <label for="checkbox1">Is Enabled</label>
                                        </div>
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
        </div>
    </div>
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
      @endsection()