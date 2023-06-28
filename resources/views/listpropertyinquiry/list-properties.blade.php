@extends('admin-layouts.app')
@section('title','List-Property-Requests')
@section('content')
<div class="content-inner">
    <div class="bc-box">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="float-left mt-2">
                    <div class="d-inline-flex align-items-center">
                        <h1>List Property Requests</h1><span class="font-size-16 font-wt-600 color-gray">{{count($items)}} Total</span>
                        <ol class="bclink">
                            <li class="breadcrumb-item">
                                 <a href="{{ route('admin') }}"><i class="bx bx-home-alt font-size-18 color-gold"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Listing</li>
                        </ol>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @if(count($items) == 0)
    <section class="commonbox center">
        <div class="panel-body">
            <i class="material-icons color-gray icon-7x">rss_feed</i><br><br>
            <h3 class="font-size-18 font-wt-600">No Data available.</h3><br>
        </div>
    </section>
    @else
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            @if ($message = Session::get('success'))
            <div class="alert alert-success animate__animated animate__fadeInDown" role="alert">
                <strong>{{ $message }}</strong>
            </div>
            @endif
            @if ($message = Session::get('error'))
            <div class="alert alert-danger animate__animated animate__fadeInDown" role="alert">
                <strong>{{ $message }}</strong>
            </div>
            @endif
            @if (count($errors) > 0)
            <div class="alert alert-danger animate__animated animate__fadeInDown"  role="alert">
                <strong>Error</strong> An error occured while saving note.
            
            </div>
             @endif
            <div class="table-responsive animate__animated animate__fadeIn animate__slow">
                <table width="100%" cellspacing="0" cellpadding="0" id="ExportDatatable" class="table">
                    <thead>
                        <tr>
                            <th class="show_excel" width="10%">Name</th>
                            <th class="show_excel" width="10%">Mobile No</th>
                            <th class="show_excel" width="10%">Email Id</th>
                            <th class="show_excel" width="20%">Message</th>
                            <th class="show_excel" width="20%">Notes</th>
                            <th class="show_excel" width="10%">Created</th>
                            <th class="show_excel" >Followup</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>{{$item->Name}}</td>
                            <td>{{$item->Mobile}}</td>
                            <td>{{$item->Email}}</td>
                            <td>{{$item->Message}}</td>
                          
                            <td>
                                @if($item->Note)
                                {{ $item->Note }}
                                @else
                                <a href="javascript:void(0)" class="color-blue addnote" data-id="{{ $item->Guid }}" data-toggle="modal" data-target="#AddNoteModal">Add Note</a>
                                @endif
                            </td> 
                            <td><span style="display:none;">{{ strtotime($item->CreatedDate) }}</span>{{ datetime_format($item->CreatedDate)}}</td>
                            <td>
                                @if ($item->IFollowup == 0)
                                <span class="badge bd-red-lt">Pending</span>
                                @else
                                <span class="badge bd-green-lt">Done</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('listyourproperty.destroy',$item->Guid)}}" method="post">
                                    @method('delete')
                                    @csrf
                                @if ($item->IFollowup == 0)

                                <a href="{{ route('editpropertydetail',[1,$item->Guid])}}" class="btn btn-small btn-gold-lt" title="Edit Details"><i class="material-icons icon-2x">done</i></a>

                                @else
                                <a href="{{ route('editpropertydetail',[0,$item->Guid])}}"  class="btn btn-small btn-gold-lt" title="Undo Status"><i class="material-icons icon-2x">undo</i></a>
                                @endif
                                @if(Auth::user()->roleid==1)
                                <button type="submit"  class="btn btn-small btn-red-lt delete" title="Delete"><i class="material-icons icon-2x">delete_outline</i></button>
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
<div class="modal fade" id="AddNoteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title1 font-size-16 font-wt-700" id="H1">Add Note</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('editpropertynote') }}" method="post">
                @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <!--<label>Enter Note</label>-->
                        <textarea type="text" name="note" class="form-control" required="1">
                        </textarea>
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