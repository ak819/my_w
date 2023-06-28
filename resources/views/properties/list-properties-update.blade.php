@extends('admin-layouts.app')
@section('content')
<div class="content-inner">
    <div class="bc-box">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="float-left mt-2">
                    <div class="d-inline-flex align-items-center">
                        <h1>Property Updates</h1>
                        <span class="font-size-16 font-wt-600 color-gray count"></span>
                        <ol class="bclink">
                            <li class="breadcrumb-item">
                                <a href="#"><i class="bx bx-home-alt font-size-18 color-gold"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Listing</li>
                        </ol>
                    </div>
                </div>
                <!--<div class="float-right">
                    <a href="" class="btn btn-medium btn-gold ml-2 mr-2 float-right">Add</a>
                </div>-->
                @if ($message = Session::get('success'))
                <div class="alert alert-success animate__animated animate__fadeInDown" role="alert">
                    <strong>Success </strong>{{ $message }}
                </div>
                @endif
                @if ($message = Session::get('error'))
                <div class="alert alert-danger animate__animated animate__fadeInDown" role="alert">
                    <strong>Eror </strong>{{ $message }}
                </div>
                @endif
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
        <label>Status</label>
                        <select id="Status" class="form-control listfilters">
                            <option value="">All</option>
                            <option value="Available">Available</option>
                            <option value="Rented">Rented</option>
                            <option value="Sold">Sold</option>
                            <option value="Pending">Pending</option>
                            <option value="disabled">Disabled</option>
                        </select>
        </div>
    
        @if(Auth::user()->roleid==1)
        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12 float-end">
            <label>&nbsp;</label><br/>
        <a href="{{ route('property.reset.status')}}" class="btn btn-gold reset">Reset Property Status</a> 
        </div>
        @endif      
    </div>
    <div class="row" >
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="table-responsive animate__animated animate__fadeIn animate__slow">
                <table width="100%" cellspacing="0" cellpadding="0" class="table" id="list">
                    <thead>
                        <tr>
                            <th width="5%">Action</th>
                            <th width="60%" style="width:300px;">Property</th>
                            <th>Status</th>
                            <th class="nowrap">Owner Name</th>
                            <th class="nowrap">Owner Phone</th>
                            <th>City</th>
                            <th>Location</th>
                            <th>Type</th>
                            <th class="nowrap" width="15%">Price</th>
                           
                            <!--<th>New Price</th>-->
                            <th class="nowrap" width="15%">Comment</th>
                            <th>CRM Updated?</th>
                            
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
<div class="modal fade" id="PropertyDetailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title1 font-size-16 font-wt-700" id="H1">Additional Details</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" class="propertyUpdateForm" method="post">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <label>Status</label>
                        <select name="Status" class="form-control">
                            <option value="">Select</option>
                            <option value="Available">Available</option>
                            <option value="Rented">Rented</option>
                            <option value="Sold">Sold</option>
                            <option value="Pending">Pending</option>
                            
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <label>New Price</label>
                        <input type="text" name="NewPrice" class="form-control" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <label>Comment</label>
                        <textarea  name="Comment" class="form-control"></textarea>
                    </div>
                </div>
                @if(Auth::user()->roleid==1 || Auth::user()->roleid==2)
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <label>Is CRM Updated?</label>
                        <div class="checkbox checkbox-primary">
                            <input id="IsCrmUpdatedCheck" name="IsCrmUpdated" class="styled" type="checkbox">
                            <label for="IsCrmUpdatedCheck"></label>
                        </div>
                    </div>
                </div>
                @endif
                <input type="hidden" name="PropertyId" id="PropertyId" value=""/>
            </form>
            </div>
           
            <div class="modal-footer">
                <button type="button" class="btn btn-gold" id="property-form-submit">Save Info</button>
                <button type="button" class="btn btn-outline-gold" data-dismiss="modal">Close</button>
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
            "url": "{{route('property-update-list')}}",
            "type": "POST",
            "data": function ( data ) {
             data.CityID=$('#CityID').val();
             data.CommunityID=$('#CommunityID').val();
             data.Status=$('#Status').val();
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
            "targets": [0,5,6,9], //first column / numbering column
            "orderable": false, 
           
        },
        ],
    
    });
    $('#btn-filter').click(function(){ //button filter event click
        table.ajax.reload();  //just reload table
    });
    $('.listfilters').change(function(){ 
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
    
    /* table.on( 'draw', function () {
    
    } );*/
    $('#property-form-submit').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{route('submit-property-update')}}",
                data: $('form.propertyUpdateForm').serialize(),
                success: function(response) {
                    $('#PropertyDetailsModal').modal('hide');;
                    table.ajax.reload( null, false );
                },
                error: function() {
                    
                    table.ajax.reload( null, false );
                }
            });
            return false;
        });
    
    });

    $(document).on("click", ".open-update-form", function () {
     var Id = $(this).data('id');
     $(".modal-body #PropertyId").val(Id);
     // As pointed out in comments, 
     // it is unnecessary to have to manually call the modal.
     // $('#addBookDialog').modal('show');
    });
   
        
      
    </script>
    @endsection()