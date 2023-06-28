@extends('admin-layouts.app')
@section('title', 'Signature-Report')
@section('content')
<div class="content-inner">
    <div class="bc-box">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="float-left mt-2">
                    <div class="d-inline-flex align-items-center">
                        <h1>Signature Report</h1>
                        <span class="font-size-16 font-wt-600 color-gray">{{ count($reportlist)  }} Total</span>
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
            </div>
        </div>
    </div> 
    <form action="{{ route('property-updates-reports') }}" method="GET">
    <div class="row">
        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
            <label>From Date</label>
            <input type="text" name="fromdate" value="{{ (isset($_GET['fromdate']))? $_GET['fromdate'] : "" }}" class="form-control datepicker" required>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
            <label>To Date</label>
            <input type="text" name="toddate" value="{{ (isset($_GET['toddate']))? $_GET['toddate'] : "" }}"  class="form-control datepicker" required>
         
        </div>
        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-12">
            <label>&nbsp;</label><br/>
            <button  type="submit" class="btn btn-gold">Search</button>
        </div>
         
    </div>     
  </form>      
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="table-responsive animate__animated animate__fadeIn animate__slow">
                <table width="100%" cellspacing="0" id="ExportDatatable" cellpadding="0" class="table">
                    <thead>
                        <tr>
                            <th class="show_excel">Ref No</th>
                            <th class="show_excel">Status</th>
                            <th class="show_excel">New Price</th>
                            <th class="show_excel">Comment</th>
                            <th class="show_excel">CRM Updated?</th>
                            <th class="show_excel">Assigned User</th>
                            <th class="show_excel">Event Date</th>
                        </tr>
                    </thead>
                        <tbody>
                         @foreach ($reportlist as $val)
                             
                         
                        <tr>
                            <td>{{ $val->PropertyRefNo }}</td>
                            <td> @if($val->Status=="Available")
      
                                <span class="badge bd-green-lt">Available</span>
                              @elseif($val->Status=="Rented")
                              
                             <span class="badge bd-blue-lt">Rented</span>
                              @elseif($val->Status=="Sold")
                              
                                <span class="badge bd-red-lt">Sold</span>
                              @elseif($val->Status=="Pending")
                             <span class="badge bd-orange-lt">Pending</span>
                              @else
                              -
                              @endif</td>
                            <td>{{  ($val->NewPrice)? $val->NewPrice.' JOD'   : "-" }}</td>
                            <td>{{ $val->Comment }}</td>
                            <td>{{ ($val->IsCrmUpdated==1)? "Yes"  : "No" }}</td>
                            <td>{{ $val->name }}</td>
                            <td>{{ datetime_format($val->CreatedDate) }}</td>
                        </tr>
                        @endforeach  
                     
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</div>

@endsection()