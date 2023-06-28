@extends('admin-layouts.app')
@section('content')
<div class="content-inner">
    <div class="bc-box animate__animated animate__fadeIn animate__slow">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="float-left mt-2">
                    <div class="d-inline-flex align-items-center">
                        <h1>Import Custom fields</h1>
                        {{-- <ol class="bclink">                                        
                            <li class="breadcrumb-item">
                                <a href="#">List</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Add</li>
                        </ol> --}}
                    </div>
                </div>
                <a href="{{ route('admin') }}" class="btn btn-medium btn-outline-gold ml-2 mr-2 float-right">Back</a>
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
                    <strong>Error</strong> An error occurred while adding.
                </div>
            @endif
            <div class="containerbox p-4 animate__animated animate__fadeIn animate__slow">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h1 class="font-size-18 font-wt-600">Update custom fields using Excel</h1>
                    </div>
                </div>
                <hr />
                <form action="{{ route('import-excel-customfields') }}" method="post" enctype="multipart/form-data"> 
                    @csrf
                <div class="row">
                 
                   
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <label>Select Excel File&nbsp;<span class="color-red">*</span></label>
                        <input type="file" name="File1" class="form-control" />
                        @error('File1')
                        <span class="error"  style="color:#F30;">{{ $message }}</span>
                        @enderror 
                    </div>
                  
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                        <label>&nbsp;</label><br />
                        <button type="submit" class="btn btn-medium btn-gold">Upload</button>
                    </div>
                </div>
              </form>
                <br />
             
          
               
            </div>
        </div>
    </div>
</div>
@endsection()