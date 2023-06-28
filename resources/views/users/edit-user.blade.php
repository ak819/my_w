@extends('admin-layouts.app')
@section('content')
<div class="content-inner">
    <div class="bc-box">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="float-left mt-2">
                    <div class="d-inline-flex align-items-center">
                        <h1>Edit Users</h1>
                        <ol class="bclink">
                            <li class="breadcrumb-item">
                                <a href="#"><i class="bx bx-home-alt font-size-18 color-gold"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="{{  route('users.index') }}">All Listing</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                <form method="post" action="{{ route('users.update',$user->guid) }}" enctype="multipart/form-data" >
                    @csrf
                    @method('PATCH')
                <div class="row">
                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="row">
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                                <label>Name&nbsp;<span class="color-red">*</span></label>
                                <input type="text" name="name"class="form-control" value="{{ $user->name }}" />
                            </div>
                        </div>
                        @error('name')
                        <span class="error"  style="color:#F30;">{{ $message }}</span>
                        @enderror
                        <div class="row">
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                                <label>Email Id&nbsp;<span class="color-red">*</span></label>
                                <input type="text" name="email" class="form-control" value="{{ $user->email }}"/>
                            </div>
                        </div>
                        @error('email')
                        <span class="error"  style="color:#F30;">{{ $message }}</span>
                        @enderror
                        <div class="row">
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                                <label>Mobile No</label>
                                <input type="text"  name="mobileno"class="form-control"  value="{{ $user->mobile }}"/>
                            </div>
                        </div>
                        
                      
                      <div class="row">
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                                <label>Status</label><br />
                                <div class="checkbox checkbox-primary">
                                    <input id="checkbox1" name="IsEnable" class="styled" type="checkbox" @if($user->IsEnable==1) checked @endif>
                                    <label for="checkbox1">Is Enabled</label>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="row">
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                                <label>User Type&nbsp;<span class="color-red">*</span></label>
                                 <select class="form-control" name="user_type" id="userrole">
                                    <option value="">Select</option>
                                    @foreach ($userRoles as $val)
                                    <option value="{{ $val->ID }}" {{ ($val->ID == $user->roleid)? "selected": "" }}>{{ $val->Role }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @error('user_type')
                        <span class="error"  style="color:#F30;">{{ $message }}</span>
                        @enderror
                        <br />
                        <br />
                        <div id="propertyType"  @if ( $errors->get('Property_Type') || count($userAgentTypes) > 0)
                        style="display:block;"
                        @else
                        style="display:none;"
                        @endif >
                        @php 
                        $userAgentTypesArray=array_column($userAgentTypes,'PropertyAgentID');
                      
                        @endphp
                        <label>Property type &nbsp;<span class="color-red">*</span></label>
                        <div class="row">
                            @foreach ($propetyTypes as $val)
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="checkbox checkbox-primary mb-2">
                                    <input id="{{ $val->Guid }}" name="Property_Type[]" class="styled" value="{{ $val->ID }}" @if(in_array($val->ID,$userAgentTypesArray)) checked @endif type="checkbox">
                                    <label for="{{ $val->Guid }}">{{ $val->Name }}</label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @error('Property_Type')
                        <span class="error"  style="color:#F30;">{{ $message }}</span>
                        @enderror
                      </div>
                      <div id="cities"  @if ( $errors->get('cities')|| count($userCities) > 0)
                        style="display:block;"
                        @else
                        style="display:none;"
                        @endif >
                        @php 
                        $userCitiesArray=array_column($userCities,'CityID');
                      
                        @endphp
                        <label>Cities &nbsp;<span class="color-red">*</span></label>
                        <div class="row">
                           
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                                <select id="CityID"   name="cities[]" class="form-control selectto listfilters" multiple>
                                    <option value="">Select</option>
                                    @foreach ($cities as $val)
                                    <option value="{{ $val->ID }}"  @if(in_array($val->ID,$userCitiesArray)) selected @endif>{{ $val->CityName }}</option>
                                    @endforeach
                                   
                                   
                                </select>
                            </div>
                        </div>
                        @error('cities')
                        <span class="error"  style="color:#F30;">{{ $message }}</span>
                        @enderror
                      </div>
                      <div id="locations"  @if ( $errors->get('locations') || count($userLocations) > 0)
                        style="display:block;"
                        @else
                        style="display:none;"
                        @endif >
                        <label>Locations &nbsp;<span class="color-red">*</span></label>
                        @php 
                        $userLocationArray=array_column($userLocations,'CommunityID');
                        $userLocationJson=json_encode ($userLocationArray);
                        @endphp
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
      $("#propertyType *").prop('disabled',false);
      $('#propertyType').css('display','block');
      $("#cities *").prop('disabled',false);
      $('#cities').css('display','block');
      
      
    }else{
        
        $("#propertyType *").prop('disabled',true);
        $('#propertyType').css('display','none');
        $("#cities *").prop('disabled',true);
        $('#cities').css('display','none');
       
    }
    
});
getLocations();
});
$("#CityID").change(function(){
    getLocations();
});  
function getLocations()
{ 
    const locationarray=JSON.parse('{{  $userLocationJson }}');
    var cityid=$('#CityID').val();
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
                        if(locationarray.includes(Number(value.id)))
                        { 
                            optionsAsString += "<option value='" + value.id + "'selected>" + value.CommunityName + "</option>";

                        }else{
                            
                            optionsAsString += "<option value='" + value.id + "'>" + value.CommunityName + "</option>";
                        }
                   
                    });
                    //$('<option value="">Select Multiple Location</option>').appendTo('.locationlist');
                $('.assign-locationlist').append( optionsAsString );
                 $('.assign-locationlist').select2({
                 pagination: {more: true}
                 });
                

                }
            }

      });

    return true;
}  
</script>
@endsection()

