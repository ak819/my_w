@extends('admin-layouts.app')
@section('content')
<div class="content-inner">
    <div class="bc-box">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="float-left mt-2">
                    <div class="d-inline-flex align-items-center">
                        <h1>Testimonials</h1><span class="font-size-16 font-wt-600 color-gray">{{ count($testimonials) }} Total</span>
                        <ol class="bclink">
                            <li class="breadcrumb-item">
                                 <a href="{{ route('admin') }}"><i class="bx bx-home-alt font-size-18 color-gold"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Listing</li>
                        </ol>
                    </div>
                </div>
                <div class="float-right">
                    <a href="{{ route('testimonial.create')}}" class="btn btn-medium btn-gold ml-2 mr-2 float-right">Add Testimonial</a>
                </div>
            </div>
        </div>
    </div>
    @if(count($testimonials) < 1) 
    <section class="commonbox center">
        <div class="panel-body">
            <i class="material-icons color-gray icon-7x">stars</i><br><br>
            <h3 class="font-size-18 font-wt-600">No testimonials available.</h3><br>
        </div>
    </section>
    @endif
        @if(count($testimonials) >=1) 

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
                           <!--  <th width="10%">Photo</th> -->
                            <th>Name (EN)</th>
                            <th width="30%">Message (EN)</th>
                            <th>Name (AR)</th>
                            <th width="30%">Message (AR)</th>
                           <!--  <th>Rating</th> -->
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($testimonials as $testimonial)
                        <tr>
                            <!-- <td><img src="{{ URL::asset('uploads/testimonial/'.$testimonial->Photo) }}" width="50px" /></td> -->
                            <td>{{$testimonial->CustomerName}}</td>
                            <td>{{$testimonial->Message}}</td>
                            <td>{{$testimonial->CustomerNameAr}}</td>
                            <td>{{$testimonial->MessageAr}}</td>
                            <!-- <td>{{$testimonial->Rating}}</td> -->
                            <td>
                                <form action="{{ route('testimonial.destroy',$testimonial->Guid)}}" method="post">
                                    <a href="{{ route('testimonial.edit',$testimonial->Guid) }}" class="btn btn-small btn-gold-lt" title="Edit Details"><i class="material-icons icon-2x">edit</i></a>
                                    @method('delete')
                                    @csrf
                                    @if(Auth::user()->roleid==1)
                                  <button type="submit" class="btn btn-small btn-red-lt delete" title="Delete"><i class="material-icons icon-2x">delete_outline</i></button>
                                    @endif
                                </form>
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
</div>
</div>
<div class="modal fade" id="interestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
<div class="modal-dialog modal-dialog-slideout" role="document">
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title font-size-22 font-wt-700 color-white" id="exampleModalLabel">Add Interest</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <label>Interest Name&nbsp;<span class="color-red">*</span></label>
                        <input type="text" class="form-control" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <label>Image&nbsp;<span class="color-red">*</span></label>
                        <input type="file" class="form-control" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <label>Status</label><br />
                        <div class="checkbox checkbox-primary">
                            <input id="checkbox1" class="styled" type="checkbox">
                            <label for="checkbox1">Is Enabled</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-medium btn-pink" data-dismiss="modal">Save Info</button>
    </div>
</div>
@endsection()