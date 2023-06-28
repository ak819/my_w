@extends('admin-layouts.app')
@section('content')
<div class="content-inner">
    <div class="bc-box">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="float-left mt-2">
                    <div class="d-inline-flex align-items-center">
                        <h1>Hero Banners</h1><span class="font-size-16 font-wt-600 color-gray">{{ count($banners) }} Total</span>
                        <ol class="bclink">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin') }}"><i class="bx bx-home-alt font-size-18 color-gold"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Listing</li>
                        </ol>
                    </div>
                </div>
                {{-- <div class="float-right">
                    <a href="{{ route('banner.create') }}" class="btn btn-medium btn-gold ml-2 mr-2 float-right">Add Banner</a>
                </div> --}}
            </div>
        </div>
    </div>
    @if(count($banners) < 1) 
    <section class="commonbox center">
        <div class="panel-body">
            <i class="material-icons color-gray icon-7x">collections</i><br><br>
            <h3 class="font-size-18 font-wt-600">No Hero banners available.</h3><br>
        </div>
    </section>
    @endif
    @if(count($banners) >=1) 
    <div class="row">
    
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        @if ($message = Session::get('success'))

<div class="alert alert-success animate__animated animate__fadeInDown" role="alert">

        <strong>{{ $message }}</strong>
</div>
     @endif

@if (count($errors) > 0)
    <div class="alert alert-danger animate__animated animate__fadeInDown"  role="alert">
         <strong>Error</strong> An error occured while saving banner.
       
    </div>
@endif
            <div class="table-responsive animate__animated animate__fadeIn animate__slow">
                <table width="100%" cellspacing="0" cellpadding="0" class="table" id="datatable">
                  
                   <thead>
                        <tr>
                            <th>Image</th>
                            <th width="25%">Page Name</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banners as $banner)
                        <tr>
                            <td><img src="{{ URL::asset('uploads/herobanner/'.$banner->Image) }}" width="200px" /></td>
                             <td>
                               {{ $banner->PageName }}
                            </td>
                           
                               
                                <td>
                                        <a href="{{ route('hero-banner.edit',$banner->Guid) }}" class="btn btn-small btn-gold-lt" title="Edit Details"><i class="material-icons icon-2x">edit</i></a>
                                       
                                </td>
                            
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