
@extends('admin-layouts.app')
@section('content')
<div class="content-inner">
    <div class="bc-box">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="float-left mt-2">
                    <div class="d-inline-flex align-items-center">
                        <h1>Add Agent</h1><span class="font-size-16 font-wt-600 color-gray">23 Total</span>
                        <ol class="bclink">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin') }}"><i class="bx bx-home-alt font-size-18 color-gold"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="{{ route('agent.index') }}">All Listing</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Add</li>
                        </ol>
                    </div>
                </div>
                <div class="float-right">
                    <a href="{{ route('agent.index') }}" class="btn btn-medium btn-outline-gold ml-2 mr-2 float-right">Back</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="alert alert-success animate__animated animate__fadeInDown" role="alert">
                <strong>Success</strong> Agent has been saved successfully.
            </div>
            <div class="alert alert-danger animate__animated animate__fadeInDown" role="alert">
                <strong>Error</strong> An error occured while saving agent.
            </div>
            <div class="containerbox p-4 animate__animated animate__fadeIn animate__slow">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="row">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                <label>Agent Name&nbsp;<span class="color-red">*</span></label>
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                <label>Email Id&nbsp;<span class="color-red">*</span></label>
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                <label>Mobile No&nbsp;<span class="color-red">*</span></label>
                                <input type="text" class="form-control" />
                            </div>
                        </div>                                                                      
                        <div class="row">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                <label>Photo&nbsp;<span class="color-red">*</span></label>
                                <input type="file" class="form-control" />
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 center">
                                <img src="{{ asset('images/u1.jpg') }}" width="150px" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
                                <label>Status</label><br />
                                <div class="checkbox checkbox-primary">
                                    <input id="checkbox1" class="styled" type="checkbox">
                                    <label for="checkbox1">Is Enabled</label>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <a href="" class="btn btn-medium btn-gold float-right">Save Info</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection()