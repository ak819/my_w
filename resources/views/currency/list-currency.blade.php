@extends('admin-layouts.app')
@section('content')
<div class="content-inner">
                <div class="bc-box">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="float-left mt-2">
                                <div class="d-inline-flex align-items-center">
                                    <h1>Currency</h1><span class="font-size-16 font-wt-600 color-gray">{{ count($Currency) }} Total</span>
                                    <ol class="bclink">
                                        <li class="breadcrumb-item">
                                             <a href="{{ route('admin') }}"><i class="bx bx-home-alt font-size-18 color-gold"></i></a>
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
                @if(count($Currency) < 1) 
                <section class="commonbox center">
                    <div class="panel-body">
                        <i class="material-icons color-gray icon-7x">location_on</i><br><br>
                        <h3 class="font-size-18 font-wt-600">No currency available.</h3><br>
                    </div>
                </section>
                 @endif
   
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="table-responsive animate__animated animate__fadeIn animate__slow">
                            <table width="100%" cellspacing="0" cellpadding="0" class="table" id="datatable">
                                 <thead>
                                      <tr>
                                        <th>Currency</th>
                                        <th>Value Per JOD</th>
                                        <th width="10%">Status</th>
                                        <th width="15%">Action</th>
                                    </tr>
                               </thead>
                                <tbody>
                                     @foreach ($Currency as $val)
                                    <tr>
                                        <td>{{$val->Name}}</td>
                                        <td>{{$val->Value}}</td>
                                         <td>
                                        @if($val->IsEnable == 1)
                                        <span class="badge bd-green-lt">Enabled</span>
                                        @else
                                        <span class="badge bd-red-lt">Disabled</span>
                                        @endif
                                         </td>
                                        <td>
                                            <a href="{{ route('currency.edit',$val->Guid) }}" class="btn btn-small btn-gold-lt" title="Edit Details"><i class="material-icons icon-2x">edit</i></a>
                                           
                                        </td>
                                    </tr>
                                     @endforeach
                                </tbody>
                            </table>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
   @endsection()