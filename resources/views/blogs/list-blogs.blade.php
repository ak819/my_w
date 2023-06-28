@extends('admin-layouts.app')
@section('content')
<div class="content-inner">
    <div class="bc-box">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="float-left mt-2">
                    <div class="d-inline-flex align-items-center">
                        <h1>Blogs</h1><span class="font-size-16 font-wt-600 color-gray">{{count($items)}} Total</span>
                        <ol class="bclink">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin') }}"><i class="bx bx-home-alt font-size-18 color-gold"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All Listing</li>
                        </ol>
                    </div>
                </div>
                <div class="float-right">
                    <a href="{{ route('blog.create')}}" class="btn btn-medium btn-gold ml-2 mr-2 float-right">Add Blog</a>
                </div>
            </div>
        </div>
    </div>
    @if(count($items) == 0)
    <section class="commonbox center">
        <div class="panel-body">
            <i class="material-icons color-gray icon-7x">rss_feed</i><br><br>
            <h3 class="font-size-18 font-wt-600">No blogs available.</h3><br>
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
            <div class="table-responsive animate__animated animate__fadeIn animate__slow">
                <table width="100%" cellspacing="0" cellpadding="0" id="datatable" class="table">
                    <thead>
                        <tr>
                            <th width="15%">Image</th>
                            <th>Title</th>
                            <th>Created</th>
                            <th width="10%">Status</th>
                            <th width="15% ">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td><img src="{{ URL::asset('uploads/blog/'.$item->Image) }}" width="150px" /></td>
                            <td>{{$item->Title}}</td>
                            <td>
                                {{datetime_format($item->CreatedDate)}}
                                <!-- 12-Sept-2021 04:23:00 -->
                            </td>
                            <td>
                                @if ($item->IsEnable)
                                <span class="badge bd-green-lt">Enabled</span>
                                @else
                                <span class="badge bd-red-lt">Disabled</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('blog.destroy',$item->Guid)}}" method="post">
                                    <a href="{{ route('blog.edit',$item->Guid)}}" class="btn btn-small btn-gold-lt" title="Edit Details"><i class="material-icons icon-2x">edit</i></a>
                                    @method('delete')
                                    @csrf
                                  <button type="submit" class="btn btn-small btn-red-lt delete" title="Delete"><i class="material-icons icon-2x">delete_outline</i></button>
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
@endsection()