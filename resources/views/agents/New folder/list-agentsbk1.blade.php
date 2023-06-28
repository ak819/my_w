@extends('admin-layouts.app')
@section('content')
            <div class="content-inner">
                <div class="bc-box">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="float-left mt-2">
                                <div class="d-inline-flex align-items-center">
                                    <h1>User Enquiries</h1><span class="font-size-16 font-wt-600 color-gray">{{ count($enquiries) }} Total</span>
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
                 @if(count($enquiries) < 1) 
                <section class="commonbox center">
                    <div class="panel-body">
                        <i class="material-icons color-gray icon-7x">contact_phone</i><br><br>
                        <h3 class="font-size-18 font-wt-600">No enquiries available.</h3><br>
                    </div>
                </section>
                 @endif
        @if(count($enquiries) >=1) 
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="table-responsive animate__animated animate__fadeIn animate__slow">
                            <table width="100%" cellspacing="0" cellpadding="0" class="table table-normal" id="datatable">
                                <thead>
                                <tr>
                                        <th>Name</th>
                                        <th>Mobile No</th>
                                        <th>Email Id</th>
                                        <th>Message</th>
                                        <th>Property</th>
                                        <th>Created</th>
                                        <!--<th width="15%">Action</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                     @foreach ($enquiries as $enquirie)
                                    <tr>
                                        <td>{{$enquirie->Name}}</td>
                                        <td>{{$enquirie->Phone}}</td>
                                        <td>{{$enquirie->Email}}</td>
                                        <td>{{$enquirie->Message}}</td>
                                        <td>Property Ref No</td>
                                        <td>{{$enquirie->CreatedDate}}</td>
                                        <!--<td>
                                            <a href="" class="btn btn-small btn-gold-lt" title="Edit Details"><i class="material-icons icon-2x">edit</i></a>
                                        </td>-->
                                    </tr>
                                     @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                      
                    </div>
                </div>
                @endif
            </div>
      @endsection()