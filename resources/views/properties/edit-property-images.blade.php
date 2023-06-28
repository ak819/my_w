
@extends('admin-layouts.app')
@section('content')
<div class="content-inner">
    <div class="bc-box">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="float-left mt-2">
                    <div class="d-inline-flex align-items-center">
                        <h1>Edit Property</h1>
                        <ol class="bclink">
                            <li class="breadcrumb-item">
                                 <a href="{{ route('admin') }}"><i class="bx bx-home-alt font-size-18 color-gold"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Listing</li>
                        </ol>
                    </div>
                </div>
                @php
                    $Property_Guid=\Request::segment(3);
                @endphp
                <div class="float-right">
                    <a href="{{ route('property.edit', $Property_Guid) }}" class="btn btn-medium btn-outline-gold ml-2 mr-2 float-right">Back</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            @if ($message = Session::get('success'))
            <div class="alert alert-success animate__animated animate__fadeInDown" role="alert">
                <strong>Success</strong>{{ $message }}
            </div>
            @endif
            <div class="containerbox p-4 animate__animated animate__fadeIn animate__slow">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link"  href="{{ route('property.edit', $Property_Guid) }}" >Basic Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-image-tab" data-toggle="pill" href="#pills-image" role="tab" aria-controls="pills-image" aria-selected="true">Images</a>
                            </li>
                            <!--<li class="nav-item">
                                <a class="nav-link" id="pills-image-tab" data-toggle="pill" href="#pills-image" role="tab" aria-controls="pills-image" aria-selected="true">3. Topics</a>
                            </li>-->
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-image" role="tabpanel" aria-labelledby="pills-availability-tab">
                                @if (count($Images)<1)
                                <section class="commonbox center">
                                    <div class="panel-body">
                                        <i class="material-icons color-gray icon-7x">collections</i><br><br>
                                        <h3 class="font-size-18 font-wt-600">No photos available.</h3><br>
                                    </div>
                                </section>
                                    
                                @else
                                <form action="{{ route('propertyImages.update',$Images->PropertyID) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="table-responsive animate__animated animate__fadeIn animate__slow">
                                            <table width="100%" cellspacing="0" cellpadding="0" class="table table-normal">
                                                <tbody>
                                                    <tr>
                                                        <th>Image</th>
                                                        <th width="30%">Alt English</th>
                                                        <th width="30%">Alt Arabic</th>
                                                    </tr>
                                                    @foreach ($Images as $img)
                                                    <tr>
                                                        <td><img src="{{ URL::asset('uploads/properties/orignal/'.$Images->PropertyRefNo.'/'.$img->FileName) }}" width="200px" /></td>
                                                        <td><input type="text"  name="ImageNameEn[]" class="form-control"  value="{{ $img->ImageNameEn }}"/></td>
                                                        <td>
                                                            <input type="text" name="ImageNameAr[]" class="form-control" value="{{ $img->ImageNameAr }}"/>
                                                        </td>
                                                        <input type="hidden" name="Guid[]" value="{{ $img->Guid }}">
                                                    </tr>
                                                        
                                                    @endforeach
                                                    
                                                   
                                                    
                                                </tbody>
                                            </table>
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
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection()