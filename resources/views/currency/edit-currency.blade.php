@extends('admin-layouts.app')
@section('content')
            <div class="content-inner">
                <div class="bc-box">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="float-left mt-2">
                                <div class="d-inline-flex align-items-center">
                                    <h1>Edit Currency</h1>
                                    <ol class="bclink">
                                        <li class="breadcrumb-item">
                                             <a href="{{ route('admin') }}"><i class="bx bx-home-alt font-size-18 color-gold"></i></a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            <a href="{{ route('currency.index') }}">All Listing</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Add</li>
                                    </ol>
                                </div>
                            </div>
                            <div class="float-right">
                                <a href="{{ route('currency.index') }}" class="btn btn-medium btn-outline-gold ml-2 mr-2 float-right">Back</a>
                            </div>
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
                     <strong>Error</strong> An error occurred while adding the currency.
                   
                </div>
            @endif  
             <form action=" {{ route('currency.update',$Currency->Guid) }}" method="post"> 

                   @csrf
                   @method('PUT')
                        <div class="containerbox p-4 animate__animated animate__fadeIn animate__slow">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                            <label>{{ $Currency->Name }}&nbsp;<span class="color-red">*</span></label>
                                            <input type="text"  class="form-control" name="Value" id="CityName" value="{{ $Currency->Value }}" />
                                             @error('Value')
                                           <span class="error"  style="color:#F30;">{{ $message }}</span>
                                              @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
                                         <div class="checkbox checkbox-primary">
                                         <input type="checkbox" name="IsEnable" id="IsEnable" class="styled" {{ $Currency->IsEnable == 1 ? 'checked' : null }} />
                                         <label for="IsEnable">Is Enabled?</label>
                                         </div>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <button type="submit" class="btn btn-medium btn-gold" id="submit">Update Info</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection()