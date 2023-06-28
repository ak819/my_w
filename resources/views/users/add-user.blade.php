@extends('admin-layouts.app')
@section('content')
<div class="content-inner">
    <div class="bc-box">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="float-left mt-2">
                    <div class="d-inline-flex align-items-center">
                        <h1>Add Users</h1>
                        <ol class="bclink">
                            <li class="breadcrumb-item">
                                <a href="#"><i class="bx bx-home-alt font-size-18 color-gold"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="{{  route('users.index') }}">All Listing</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Add</li>
                        </ol>
                    </div>
                </div>
                <div class="float-right">
                    <a href="{{ route('users.index') }}" class="btn btn-medium btn-outline-gold ml-2 mr-2 float-right">Back</a>
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
                <form method="post" action="{{ route('users.store') }}" enctype="multipart/form-data" >
                    @csrf
                <div class="row">
                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="row">
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                                <label>Name&nbsp;<span class="color-red">*</span></label>
                                <input type="text" name="name"class="form-control" />
                            </div>
                        </div>
                        @error('name')
                        <span class="error"  style="color:#F30;">{{ $message }}</span>
                        @enderror
                        <div class="row">
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                                <label>Email Id&nbsp;<span class="color-red">*</span></label>
                                <input type="text" name="email" class="form-control" />
                            </div>
                        </div>
                        @error('email')
                        <span class="error"  style="color:#F30;">{{ $message }}</span>
                        @enderror
                        <div class="row">
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                                <label>Mobile No</label>
                                <input type="text"  name="mobileno"class="form-control" />
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                                <label>Password&nbsp;<span class="color-red">*</span></label>
                                <input type="password" name="password" class="form-control" />
                            </div>
                        </div>
                        @error('password')
                        <span class="error"  style="color:#F30;">{{ $message }}</span>
                        @enderror
                        <div class="row">
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                                <label>Confirm Password&nbsp;<span class="color-red">*</span></label>
                                <input type="password" name="confirm_password" class="form-control" />
                            </div>
                        </div>
                        @error('confirm_password')
                        <span class="error"  style="color:#F30;">{{ $message }}</span>
                        @enderror
                        {{-- <div class="row">
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                                <label>Status</label><br />
                                <div class="checkbox checkbox-primary">
                                    <input id="checkbox1" class="styled" type="checkbox">
                                    <label for="checkbox1">Is Enabled</label>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="row">
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                                <label>User Type&nbsp;<span class="color-red">*</span></label>
                                 <select class="form-control" name="user_type" id="userrole"">
                                    <option value="">Select</option>
                                    @foreach ($userRoles as $val)
                                    <option value="{{ $val->ID }}">{{ $val->Role }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @error('user_type')
                        <span class="error"  style="color:#F30;">{{ $message }}</span>
                        @enderror
                        <br />
                        <br />
                       
                        <div id="propertyType"  @if ( $errors->get('Property_Type'))
                        style="display:block;"
                        @else
                        style="display:none;"
                        @endif >
                        <label>Property type &nbsp;<span class="color-red">*</span></label>
                        <div class="row">
                            @foreach ($propetyTypes as $val)
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="checkbox checkbox-primary mb-2">
                                    <input id="{{ $val->Guid }}" name="Property_Type[]" class="styled" value="{{ $val->ID }}" type="checkbox">
                                    <label for="{{ $val->Guid }}">{{ $val->Name }}</label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @error('Property_Type')
                        <span class="error"  style="color:#F30;">{{ $message }}</span>
                        @enderror
                      </div>
                      <br />
                     
                    <div id="cities"  @if ( $errors->get('cities'))
                        style="display:block;"
                        @else
                        style="display:none;"
                        @endif >
                        <label>Cities &nbsp;<span class="color-red">*</span></label>
                        <div class="row">
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                            <select id="CityID"   name="cities[]" class="form-control selectto assigncity listfilters" multiple>
                                <option value="">Select</option>
                                @foreach ($cities as $val)
                                <option value="{{ $val->ID }}">{{ $val->CityName }}</option>
                                @endforeach
                               
                               
                            </select>
                        </div>
                        </div>
                        @error('cities')
                        <span class="error"  style="color:#F30;">{{ $message }}</span>
                        @enderror
                      </div>
                    <br/>
                    <div id="locations"  @if ( $errors->get('locations'))
                        style="display:block;"
                        @else
                        style="display:none;"
                        @endif >
                        <label>Locations &nbsp;<span class="color-red">*</span></label>
                        <div class="row">
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                                <select id="CommunityID" name="locations[]" class="form-control selectto assign-locationlist listfilters" multiple>
                                    <option value="">Select</option>
                                   
                                </select>
                        </div>
                        </div>
                        @error('locations')
                        <span class="error"  style="color:#F30;">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
              

                </div>
                <hr />
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
<script type="text/javascript">
    $(document).ready(function() {
    $("#userrole").change(function() {   
    var val=$(this).val();
    if(val==2 || val==3)
    {
      $('#propertyType').css('display','block');
      $('#cities').css('display','block');
      $('#locations').css('display','block');

    }else{

        $('#propertyType').css('display','none');
        $('#cities').css('display','none');
        $('#locations').css('display','none');
    }
   
});
});  

$(".assigncity").change(function(){
    var cityid=$(this).val();
    $.ajax({
            url:'{{route('muli-locationlist')}}',
            type:'POST',
            dataType:'json',
            data:{"_token": "{{ csrf_token() }}",cityid:cityid},
            success: function(response){
                if(response)
                { 
                    $(".assign-locationlist").empty();
                    var optionsAsString = "";
                    $.each(response.locations, function (key, value) {
                    optionsAsString += "<option value='" + value.id + "'>" + value.CommunityName + "</option>";
                    });
                    //$('<option value="">Select Multiple Location</option>').appendTo('.locationlist');
                $('.assign-locationlist').append( optionsAsString );
                 $('.assign-locationlist').select2({
                 pagination: {more: true}
                 });
                

                }
            }

      });
});
</script>
@endsection()

