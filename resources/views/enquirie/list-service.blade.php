@extends('admin-layouts.app')
@section('title','Service-Enquiries')
@section('content')
            <div class="content-inner">
                <div class="bc-box">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="float-left mt-2">
                                <div class="d-inline-flex align-items-center">
                                    <h1>Service Enquiries</h1><span class="font-size-16 font-wt-600 color-gray">{{ count($enquiries) }} Total</span>
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
                            @if ($message = Session::get('success'))

                            <div class="alert alert-success animate__animated animate__fadeInDown" role="alert">
                
                                    <strong>{{ $message }}</strong>
                            </div>
                                 @endif
                                 @if (count($errors) > 0)
                                 <div class="alert alert-danger animate__animated animate__fadeInDown"  role="alert">
                                     <strong>Error</strong> An error occured while saving note.
                                 
                                 </div>
                                  @endif
                            <table width="100%" cellspacing="0" cellpadding="0" class="table" id="ExportDatatable">
                                <thead>
                                <tr>     
                                        <th class="show_excel">Service</th>
                                        <th class="show_excel">Name</th>
                                        <th class="show_excel">Mobile No</th>
                                        <th class="show_excel">Email Id</th>
                                        <th class="show_excel" >Message</th>
                                        <th class="show_excel">Created</th>
                                        <th class="show_excel" width="20%">Notes</th>
                                        <th class="show_excel" width="15%">Followup</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @foreach ($enquiries as $enquirie)
                                    <tr>
                                        <td>{{$enquirie->Service}}</td>
                                        <td>{{$enquirie->Name}}</td>
                                        <td>{{$enquirie->Mobile}}</td>
                                        <td>{{$enquirie->Email}}</td>
                                        @php  
                                        $enquirie->Message=str_replace(['&amp;','nbsp;'],' ', $enquirie->Message); 
                                        $limitedText=Str::limit($enquirie->Message,100,'...');
                                        @endphp 
                                        <td> <div id="half-desc" class="font-wt-500">{!!  $limitedText  !!}</div>
                                            <div id="full-desc" style="display:none" class="font-wt-500">{!! $enquirie->Message !!}</div>
                                         
                                          <button onclick="showMoreDescrition()" id="myBtn" class="btn btn-small btn-outline-gold">Read More</button></td>
                                        <td><span style="display:none;">{{ strtotime($enquirie->CreatedDate) }}</span>{{ datetime_format($enquirie->CreatedDate)}}</td>
                                        <td>
                                            @if($enquirie->Note)
                                            {{ $enquirie->Note }}
                                            @else
                                            <a href="javascript:void(0)" class="color-blue addnote" data-id="{{ $enquirie->Guid }}" data-toggle="modal" data-target="#AddNoteModal">Add Note</a>
                                            @endif
                                        </td> 
                                        <td>
                                            @if ($enquirie->Isfollowed)
                                           
                                            <span  class="badge bd-green-lt">Done</span>
                                           @else
                                            
                                           <span class="badge bd-red-lt">Pending</span>
                                           @endif
                                        </td>
                                        <td>
                                          

                                         
                                            <form action="{{ route('service-enquiry.followup',$enquirie->Guid)}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                @if ($enquirie->Isfollowed)
                                                <input type="hidden" name="Isfollowed" value="">   
                                                <button type="submit" class="btn btn-small btn-gold-lt" title="Undo Status"><i class="material-icons icon-2x">undo</i></button>
                                                @else
                                                <input type="hidden" name="Isfollowed" value="1">   
                                                <button type="submit" class="btn btn-small btn-gold-lt"><i class="material-icons icon-2x">done</i></button>
                                                @endif
                                               
                                            @if(Auth::user()->roleid==1)
                                            <a href="{{ route('service-enquiry.destroy',$enquirie->Guid)}}"  class="btn btn-small btn-red-lt delete" title="Delete"><i class="material-icons icon-2x">delete_outline</i></a>
                                            @endif
                                        </form> 
                                        </td>
                                           
                                           
                            
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
            <div class="modal fade" id="AddNoteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title1 font-size-16 font-wt-700" id="H1">Add Note</span>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('service-enquiry.update') }}" method="post">
                            @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <!--<label>Enter Note</label>-->
                                    <textarea type="text" name="note" class="form-control" required="1"></textarea>
                                    <input type="hidden" id="PropertyId" name="id" value="">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-gold">Save</button>
                            <button type="button" class="btn btn-outline-gold" data-dismiss="modal">Close</button>
                        </div>
                     </form>
                    </div>
                </div>
            </div>
            <script>
            
            $(document).on("click", ".addnote", function () {
                 var Id = $(this).data('id');
                 $("#AddNoteModal #PropertyId").val(Id);
                 // As pointed out in comments, 
                 // it is unnecessary to have to manually call the modal.
                 // $('#addBookDialog').modal('show');
                });
            
            </script>
           
      @endsection()