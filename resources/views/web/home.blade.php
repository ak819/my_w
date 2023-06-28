<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laravel Pagination Demo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h3> </h3>
        <table class="table table-bordered mb-5">
            <thead>
                <tr class="table-success">
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">price</th>
                    <th scope="col">city</th>
                    <th scope="col">Category</th>
                    <th scope="col"> Type</th>
                  
                </tr>
            </thead>
            <tbody>
                @foreach($records as $data)
                <tr>
                    <th scope="row">{{ $data->PropertyRefNo }}</th>
                    <td>{{ $data->PropertyTitle }}</td>
                    <td>{{ $data->Price }}</td>
                    <td>{{ $data->CityName }}</td>
                    <td>{{ $data->CatergoryName }}</td>
                    <td>{{ $data->TypeName }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <form action="{{ route('search-properties') }}" method="get">
            @csrf
            <lable>Rfe no</lable>
            <input type="text" palceholder="category title" name="ref_no"><br>
            <lable>Min price</lable>
            <input type="text" palceholder="category title" name="min_price"><br>
            <lable>Max price</lable>
            <input type="text" palceholder="category title" name="max_price"><br>

            <lable>Min Bed</lable>
            <input type="text" palceholder="category title" name="min_bed"><br>
            <lable>Max Bed</lable>
            <input type="text" palceholder="category title" name="max_bed"><br>

            <lable>Min Built-up area</lable>
            <input type="text" palceholder="category title" name="min_built_area"><br>
            <lable>Max Built-up area</lable>
            <input type="text" palceholder="category title" name="max_built_area"><br>

            <lable>Min Land area</lable>
            <input type="text" palceholder="category title" name="min_land_area"><br>
            <lable>Max Land area</lable>
            <input type="text" palceholder="category title" name="max_land_area"><br>
           
            <lable>Property Types</lable>
            <select name="unit_types">
                <option value="" class="">select type</option>
                @foreach($records->PropertyUnitTypes as $unittypes)
                <option value="{{ $unittypes->ID }}">{{ $unittypes->TypeName }}</option>
                @endforeach
            </select><br>
            
            <lable>Apartment Types</lable>
            <select name="">
                <option value="" class="">select type</option>
                @foreach (config('constants.ApartmentType') as $apttype)
                <option value="{{ $apttype }}" >{{ $apttype }}</option> 
                @endforeach
            </select><br>

            <lable>Apartment Types Ar</lable>
            <select name="apt_types">
                <option value="" class="">select type</option>
                @foreach (config('constants.ApartmentType') as $apttype)
                <option value="{{ $apttype }}" {{ (app('request')->input('apt_types') == $apttype)? "selected": "" }}>{{ config('constants.ApartmentTypeAr.'.trim($apttype))  }}</option> 
                @endforeach
            </select><br>

            <lable>Furnished ?</lable>
            <input type="checkbox" name="furnished" value="yes" /><br>


            <lable>search location</lable>
            @php
            $locations=app('request')->input('locations');
                
            @endphp
            <select name="locations[]" class="select2" multiple="multiple">
                <option class="">select location</option>
                @foreach($records->City as $city)
                <option value="{{ 'c-'.$city->ID }}" {{ ($locations && in_array('c-'.$city->ID, $locations))? "selected" : "" }}>{{ $city->CityName }}</option>
                @endforeach
                @foreach($records->Communities as $community)
                <option value="{{ 'cm-'.$community->ID }}" {{ ($locations && in_array('cm-'.$community->ID, $locations))? "selected" : "" }}>{{ $community->CommunityName }}</option>
                @endforeach
            </select><br>

             <lable>City</lable>
            <select name="city" class="select2 city" >
                <option value="">select city</option>
                @foreach($records->City as $city)
                <option value="{{ $city->ID }}">{{ $city->CityName }}</option>
                @endforeach
            </select><br>

            <lable>Locations</lable>
            <select name="locations[]" class="select2 locationlist" multiple="multiple">
                <option value="">select location</option>
                @foreach($records->Communities as $community)
                <option value="{{ $community->ID }}" >{{ $community->CommunityName }}</option>
                @endforeach
            </select><br>
            <button type="submit">Submit</button>
            
            </form>
            <form action="{{ route('rquestInfo') }}" method="Post">
                @csrf
              <input type="text" name="Name"><br> 
              <input type="text" name="Phone"><br> 
              <input type="text" name="Email"><br> 
              <textarea name="Message"></textarea>
              <input type="hidden" name="PropertyID" value="b8fce887-7363-4a83-95b0-4c148605352b"><br> 
              <button type="submit">Request info</button>


            </form>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {{  $records->withQueryString()->links(); }}
        </div>
    </div>
</body>
<script>

const txt = '{"name":"John", "age":30, "city":"New York"}'
const obj = JSON.parse(txt);
console.log( obj.name);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.select2').select2();
    $(".city").change(function(){
        var cityid=$(this).val();
        $.ajax({
                url:'{{route('locationlist')}}',
                type:'POST',
                dataType:'json',
                data:{"_token": "{{ csrf_token() }}",cityid:cityid},
                success: function(response){
                    if(response)
                    { 
                        $(".locationlist").empty();
                        var optionsAsString = "";
                        $.each(response.locations, function (key, value) {
                        optionsAsString += "<option value='" + value.id + "'>" + value.CommunityName + "</option>";
                        });
                        $('<option value="">Select</option>').appendTo('.locationlist');
                    $('.locationlist').append( optionsAsString );
                    $('.locationlist').select2({
                    placeholder: "Select Location",
                    });
                    

                    }
                }

          });
 });
</script>    

</html>