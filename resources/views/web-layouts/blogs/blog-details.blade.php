@extends('web-layouts.app')
@section('content')
@section('title'){{ $item->MetaTitle }} @endsection
<section class="gray">
        <div class="container">
            <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <div class="commonbox animate__animated animate__fadeIn animate__slow">
                    <div class="row">
                        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                            <h1 class="font-size-20 font-wt-600 mb-1">{{$item->Title}}</h1>
                            <span><!--{{ __('msg.Postedon') }}:--><span dir="ltr"> {{date('d-M-Y', strtotime($item->CreatedDate))}}</span></span>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
                            <a href="javascript:void(0)" data-no="{{ $item->Guid}}" title="share" class="btn btn-outline-gold sharebloglinks"><i class="material-icons">share</i>{{ __('msg.shareblog') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="row">
                <div class="col-xl-8 col-lg-7 col-md-7 col-sm-7 col-12">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="commonbox blog animate__animated animate__fadeIn animate__slow">
                                <img src="{{ URL::asset('uploads/blog/'.$item->Image) }}" alt="{{ $item->Alt  }}" width="100%" />
                                <br />
                                <div class="row">
                                     {!!  $item->Description  !!}
                                </div>
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <a href="javascript:void(0)" data-no="{{ $item->Guid}}" title="share" class="btn btn-outline-gold sharebloglinks"><i class="material-icons">share</i>{{ __('msg.shareblog') }}</a>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                 <div class="row stickymenu">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="commonbox animate__animated animate__fadeIn animate__slow">
                                <h2 class="font-size-18 font-wt-600">{{ __('msg.OtherPosts') }}</h2>
                                <hr />
                                @if (count($blogLimits) > 0)
                                @foreach ($blogLimits as $bloglimit)
                                <div class="row mb-4">
                                     <div class="col-xl-4 col-lg-4 col-md-12 col-sm-4 col-6">
                                         <a href="{{ route('blogdetails',[app()->getLocale(),urlencode($bloglimit->Slug)])}}"><img src="{{ URL::asset('uploads/blog/'.$bloglimit->Image) }}"  alt="{{ $bloglimit->Alt  }}" width="100%" /></a>
                                     </div>
                                     <div class="col-xl-8 col-lg-8 col-md-12 col-sm-8 col-6">
                                         <a  title="" href="{{ route('blogdetails',[app()->getLocale(),urlencode($bloglimit->Slug)])}}"><p class="font-size-14 font-wt-600 mb-1">{{ $bloglimit->Title }} </p></a>
                                         <p class="font-size-12 font-wt-500 mb-1"><!-- {{ __('msg.Postedon') }}:--> <span dir="ltr"> {{date('d-M-Y', strtotime($bloglimit->CreatedDate))}}</span></p>
                                     </div>
                                 </div>
                                 @endforeach
                                 <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 center">
                                        <a  title="" href="{{ route('blogs',app()->getLocale()) }}" class="btn btn-gold btn-medium">{{  __('msg.AllBlogs') }}</a>
                                    </div>
                                </div>
                                @else
                                    <span>{{ __('msg.CommingSoon') }}</span>
                                @endif
                               
                            </div>
                        </div>
                    </div>
                </div><br />
            </div>
        </div>
    </section>

    <div class="modal fade bd-example-modal-sm" tabindex="-1" id="shareBlogModal" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-size-16 font-wt-600" id="exampleModalLabel">{{ __('msg.shareblog') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row share_options">
                        
                    </div>
                    <!--<ul class="c-share_options" data-title="{{  __('msg.Share') }}">
                    </ul>-->
                    <p  style="display:none" class="copymsg color-red font-wt-600 center">{{  __('msg.LinkCopied') }}</p>
                </div>
                <!--<div class="modal-footer">
                    <button type="button" class="btn btn-gold" data-bs-dismiss="modal">Close</button>
                </div>-->
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
jQuery(document).ready(function($){
    $('p > img').unwrap();
});
</script>

    <script>
        /// copy link
           var $tempinput = $("<input>");
           $(document).on("click","#shareBlogModal .blogclipboard",function() {
            $("#shareBlogModal").append($tempinput);
             var url= $(this).data('tocopyshorturl');
             $tempinput.val(url).select();
             document.execCommand("copy");
             $tempinput.remove();
             $("#shareBlogModal .copymsg").css("display",'block');
       
           });
       
            // property listing social media links
            $(".sharebloglinks").click(function(){
               $("#shareBlogModal .copymsg").css("display",'none');
               const blogid=$(this).data('no');
               const locale="<?= app()->getLocale() ?>";
               $.ajax({
                   url:'{{route('share-blog-link')}}',
                   type:'POST',
                   dataType:'json',
                   data:{"_token": "{{ csrf_token() }}",blogid:blogid,locale:locale},
                   success: function(response){
                       if(response.status)
                       { 
                        $("shareBlogModal .share_options").empty();
                       $('#shareBlogModal .share_options').append(response.html);
                       $('#shareBlogModal').modal('show');
                       }
                   }
       
             });
       
           })

    </script>
    @endsection()