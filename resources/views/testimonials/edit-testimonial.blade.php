@extends('admin-layouts.app')
@section('content')
<div class="content-inner">
    <div class="bc-box">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="float-left mt-2">
                    <div class="d-inline-flex align-items-center">
                        <h1>Edit Testimonial</h1>
                        <ol class="bclink">
                            <li class="breadcrumb-item">
                                 <a href="{{ route('admin') }}"><i class="bx bx-home-alt font-size-18 color-gold"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="{{ route('testimonial.index') }}">All Listing</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </div>
                </div>
                <div class="float-right">
                    <a href="{{ route('testimonial.index') }}" class="btn btn-medium btn-outline-gold ml-2 mr-2 float-right">Back</a>
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
                     <strong>Error</strong> An error occurred while adding the testimonials.
                   
                </div>
            @endif
            <form action="{{ route('testimonial.update',$testimonial->Guid) }}" method="post" enctype="multipart/form-data"> 
                   @csrf
                   @method('PUT')
                    <input type="hidden" name="Guid" value="{{ $testimonial->Guid }}">
            <div class="containerbox p-4 animate__animated animate__fadeIn animate__slow">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="row">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                <label>Customer Name (English)</label>
                                 <input type="text" class="form-control" name="CustomerName" id="CustomerName" value="{{ $testimonial->CustomerName }}"  />
                                 @error('CustomerName')
                               <span class="error"  style="color:#F30;">{{ $message }}</span>
                                  @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <label>Message (English)</label>
                                 <textarea class="form-control description" name="Message" id="Message">{{ $testimonial->Message }}</textarea>
                                 @error('Message')
                               <span class="error"  style="color:#F30;">{{ $message }}</span>
                                  @enderror
                            </div>
                        </div>
                        
                        <hr/>
                        
                        <div class="row">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                <label>Customer Name (Arabic)</label>
                                 <input type="text" class="form-control" name="CustomerNameAr"  value="{{ $testimonial->CustomerNameAr }}"  />
                                 @error('CustomerNameAr')
                               <span class="error"  style="color:#F30;">{{ $message }}</span>
                                  @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <label>Message (Arabic)</label>
                                 <textarea class="form-control description" name="MessageAr" >{{ $testimonial->MessageAr }}</textarea>
                                 @error('MessageAr')
                               <span class="error"  style="color:#F30;">{{ $message }}</span>
                                  @enderror
                            </div>
                           <!-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <label>Designation&nbsp; <span class="color-red">*</span> </label>
                                <input type="text" class="form-control" name="Designation" id="Designation" value="{{ $testimonial->Designation }}" />
                                 @error('Designation')
                               <span class="error"  style="color:#F30;">{{ $message }}</span>
                                  @enderror
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <label>Designation (Arabic)&nbsp;<span class="color-red">*</span></label>
                                <input type="text" class="form-control" name="DesignationAr"  value="{{ $testimonial->DesignationAr }}" />
                                 @error('DesignationAr')
                               <span class="error"  style="color:#F30;">{{ $message }}</span>
                                  @enderror
                            </div>
                             <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
                                <label>Rating&nbsp;<span class="color-red">*</span></label>
                                <select class="form-control" name="Rating" id="Rating" value="{{ $testimonial->Rating }}" >
                                     <option value=""> Select </option>
                                     <option {{ ($testimonial->Rating) == '1' ? 'selected' : '' }}  value="1">1</option>
                                     <option {{ ($testimonial->Rating) == '1.5' ? 'selected' : '' }}  value="1.5">1.5</option>
                                      <option {{ ($testimonial->Rating) == '2' ? 'selected' : '' }}  value="2">2</option>
                                      <option {{ ($testimonial->Rating) == '2.5' ? 'selected' : '' }}  value="2.5">2.5</option>
                                      <option {{ ($testimonial->Rating) == '3' ? 'selected' : '' }}  value="3">3</option>
                                      <option {{ ($testimonial->Rating) == '3.5' ? 'selected' : '' }}  value="3.5">3.5</option>
                                      <option {{ ($testimonial->Rating) == '4' ? 'selected' : '' }}  value="4">4</option>
                                       <option {{ ($testimonial->Rating) == '4.5' ? 'selected' : '' }}  value="4.5">4.5</option>
                                       <option {{ ($testimonial->Rating) == '5' ? 'selected' : '' }}  value="5">5</option>
                                </select>
                                 @error('Rating')
                               <span class="error"  style="color:#F30;">{{ $message }}</span>
                                  @enderror
                            </div> 
                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
                                <label>Photo</label>
                                <input type="file" class="form-control"  name="Photo" id="Photo" onchange="readImage(this)" />
                                 <input type="hidden" name="prev_image" value="{{ $testimonial->Photo }}">
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 center">
                                <img src="{{ URL::asset('uploads/testimonial/'.$testimonial->Photo) }}" width="150px" id="image_preview" />
                            </div>-->
                        </div>
                         <div class="row">
                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
                             <div class="checkbox checkbox-primary">
                             <input type="checkbox" name="IsEnable" id="IsEnable" class="styled" {{ $testimonial->IsEnable == 1 ? 'checked' : null }} />
                             <label for="IsEnable">Is Enabled?</label>
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
