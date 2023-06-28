@extends('admin-layouts.app')
@section('content')
<div class="content-inner">
    <div class="bc-box">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="float-left mt-2">
                    <div class="d-inline-flex align-items-center">
                        <h1>Properties</h1><span class="font-size-16 font-wt-600 color-gray count"></span>
                        <ol class="bclink">
                            <li class="breadcrumb-item">
                                 <a href="{{ route('admin') }}"><i class="bx bx-home-alt font-size-18 color-gold"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Listing</li>
                        </ol>
                    </div>
                </div>
                <!--<div class="float-right">
                    <a href="#" class="btn btn-medium btn-gold ml-2 mr-2 float-right">Add Property</a>
                </div>-->
            </div>
        </div>
    </div>
     <section class="commonbox center" style="display:none" id="norecord">
        <div class="panel-body">
            <i class="material-icons color-pink icon-7x">maps_home_work</i><br><br>
            <h3 class="font-size-18 font-wt-600">No properties available.</h3><br>
        </div>
    </section>
    <div id="listingsection">
    <div class="row">
        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
            <label>Property Type</label>
            <select id="UnitTypeID" class="form-control listfilters">
                <option value="">Select</option>
                @foreach ($propertyTypes as $val)
                <option value="{{ $val->ID  }}">{{ $val->TypeName }}</option>
                @endforeach
               
            </select>
        </div>
       @if (Auth::user()->roleid==1)
        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
            <label>City</label>
            <select id="CityID" class="form-control selectto city listfilters">
                <option value="">Select</option>
                @foreach ($cities as $val)
                <option value="{{ $val->ID }}">{{ $val->CityName }}</option>
                @endforeach
               
               
            </select>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
            <label>Location</label>
            <select id="CommunityID" class="form-control selectto locationlist listfilters">
                <option value="">Select</option>
               
            </select>
        </div>
        @endif
        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
            <label>Property Status</label>
            <select id="AdType" class="form-control listfilters">
                <option value="">Select</option>
                <option value="1">Rent</option>
                <option value="2">Sale</option>
            </select>
        </div>   
        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
            <label>Listing Status</label>
            <select id="listingstatus" class="form-control listfilters">
                <option value="">Select</option>
                <option value="properties.IsExclusive">Exclusive</option>
                <option value="properties.IsFeatured">Featured</option>
                <option value="enabled">Enabled</option>
                <option value="disabled">Disabled</option>
            </select>
        </div>                 
    </div>
    <div class="row" >
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="table-responsive animate__animated animate__fadeIn animate__slow">
                <table width="100%" cellspacing="0" cellpadding="0" class="table table-normal" id="list">
                    <thead>
                        <tr>
                            <th width="10%">Image</th>
                            <th>Property</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                     <tbody>
                     
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<script type="text/javascript">

$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
$( document ).ready(function() {
var table = $('#list').DataTable({ 
    //"dom": 'Bfrtip',
    "processing": true, //Feature control the processing indicator.
    "serverSide": true,
    "stateSave": true,
    
    //"ordering": true, //Feature control DataTables' server-side processing mode.
    "order": [], //Initial no order.
    // Load data for the table's content from an Ajax source
    "ajax": {
        "url": "{{route('propertylist')}}",
        "type": "POST",
        "data": function ( data ) {
             data.UnitTypeID=$('#UnitTypeID').val();
             data.CityID=$('#CityID').val();
             data.CommunityID=$('#CommunityID').val();
             data.AdType=$('#AdType').val();
             data.listingstatus=$('#listingstatus').val();
            }
    },

    mark: true,
    //dom: 'Bfrtip',
    "lengthMenu": [
        [10, 25, 50, 100, -1],['10 rows', '25 rows', '50 rows', '100 rows', 'Show All']
    ],
    
    //Set column definition initialisation properties.
   "columnDefs": [
    { 
        "targets": [0,2], //first column / numbering column
        "orderable": false, 
       
    },
    ],

});
$('#btn-filter').click(function(){ //button filter event click
    table.ajax.reload();  //just reload table
});
table.on('draw', function (data) {
    $rocorddisplay=table.page.info().recordsDisplay;
    $totalcount=table.page.info().recordsTotal;
    if($totalcount)
    {
     $('.count').text($totalcount+' Total');
     $('#norecord').css('display','none');
     $('#listingsection').css('display','block');
    }else{
        $('#norecord').css('display','block');
        $('#listingsection').css('display','none');
    }
});
$('.listfilters').change(function(){ 
        table.ajax.reload();  //just reload table
    });


});
</script>
@endsection()