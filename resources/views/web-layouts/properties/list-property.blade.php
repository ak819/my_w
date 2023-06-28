@extends('web-layouts.app')
@section('content')
@section('title'){{ $item->MetaTitle }} @endsection
 {{-- @if(app()->getLocale()=="en")
<img src="{{asset('uploads/list-your-property-banners/en.jpg')}}" width="100%" class="d-none d-sm-block"/>
@else
<img src="{{asset('uploads/list-your-property-banners/ar.jpg')}}" width="100%" class="d-none d-sm-block"/>
@endif
<img src="{{ asset('uploads/herobanner/'.$item->hero_banner->Image)}}" alt="{{ $item->hero_banner->Alt  }}" width="100%" class="d-none d-sm-block"/>  --}}
<section class="gray">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 center">
                <h1 class="font-size-28 font-wt-600 animate__animated animate__fadeIn animate__slow">{{  __('msg.ListPropertyHeading') }}</h1>
                <p class="font-size-16 color-black animate__animated animate__fadeIn animate__slow">{{  __('msg.ListPropertyTagline') }}</p>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="commonbox animate__animated animate__fadeIn animate__slow">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success animate__animated animate__fadeInDown" role="alert">
                        <strong>{{  __('msg.listpropertymsg') }}</strong>
                    </div>
                    @endif
                    <h2 class="font-size-18 font-wt-600">{{  __('msg.GiveYourDetails') }}</h2>
                    <hr />
                    <form action="{{ route('addnewproperty') }}" method="post">
                        @csrf

                        <div class="row">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                <input type="text" name="Name" value="{{old('Name')}}" class="form-control" placeholder="{{  __('msg.YourName') }}" />
                                @error('Name')
                                <span class="error" style="color:#F30;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                <input type="text" name="Mobile" value="{{old('Mobile')}}"  class="form-control" placeholder="{{  __('msg.YourMobile') }}" />
                                @error('Mobile')
                                <span class="error" style="color:#F30;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                <input type="email" name="Email" value="{{old('Email')}}"  class="form-control" placeholder="{{  __('msg.YourEmailId') }}" />
                                @error('Email')
                                <span class="error" style="color:#F30;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <textarea class="form-control-textarea"  name="Message" placeholder="{{  __('msg.YourMessage') }}">{{old('Message')}}</textarea>
                                @error('Message')
                                <span class="error" style="color:#F30;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="col-md-6"> {!! htmlFormSnippet() !!} </div>
                                @error('g-recaptcha-response')
                                <span class="error">{{ $message }}</span>
                                   @enderror
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <button type="submit" class="btn btn-gold float-right" id="submit">
                                    {{  __('msg.Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection