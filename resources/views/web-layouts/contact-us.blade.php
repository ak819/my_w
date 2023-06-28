@extends('web-layouts.app')
@section('content')
@section('title'){{ $item->MetaTitle }} @endsection
<section class="gray">
    <div class="container">
      
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 center">
                <h1 class="center font-size-40 font-wt-600">{{ __('msg.ContactUs') }}</h1>
            </div>
        </div>
    </div>
</section>
<section class="pt-0 pb-0">
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13538.470583898932!2d35.8350421!3d31.9712681!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x34890875b64df06f!2sHomes%20Jordan!5e0!3m2!1sen!2sin!4v1650527194660!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</section>
<section class="gray pt-5 pb-5" id="contactform">
    <div class="container">
      
        <div class="row">
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                <div class="row">                        
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="commonbox animate__animated animate__fadeIn animate__slow">
                            @if($message = Session::get('success'))
                    <div class="alert alert-success animate__animated animate__fadeInDown" role="alert">
                        <strong>{{  __('msg.success') }}</strong>
                    </div>
                    @endif
                    @if($message = Session::get('error'))
                    <div class="alert alert-danger animate__animated animate__fadeInDown"  role="alert">
                         <strong>{{  __('msg.error') }}</strong> .
                    </div>
                    @endif
                    @if($message = Session::get('nodata'))
                    <div class="alert alert-danger animate__animated animate__fadeInDown"  role="alert">
                         <strong>{{  __('msg.nodata') }}</strong> .
                    </div>
                    @endif
                            <h2 class="font-size-20 font-wt-600">{{ __('msg.ContactFormheading') }}</h2>
                            <form action="{{ route('contact-info') }}" method="Post">
                                @csrf
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                    <input type="text" name="Name" class="form-control" placeholder="{{ __('msg.YourName') }}" />
                                    @error('Name')
                                    <span class="error">{{ __('msg.NameRequired') }}</span>
                                       @enderror
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                    <input type="text" name="Phone" class="form-control" placeholder="{{ __('msg.YourMobile') }}" />
                                    @error('Phone')
                                    <span class="error">{{ __('msg.PhoneRequired') }}</span>
                                       @enderror
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                    <input type="email" name="Email" class="form-control" placeholder="{{ __('msg.YourEmailId') }}" />
                                    @error('Email')
                                    <span class="error">{{ $message }}</span>
                                       @enderror
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <textarea class="form-control-textarea" name="Message" placeholder="{{ __('msg.YourMessage') }}"></textarea>
                                    @error('Message')
                                    <span class="error">{{ $message }}</span>
                                       @enderror
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="col-md-6"> {!! htmlFormSnippet() !!} </div>
                                    @error('g-recaptcha-response')
                                    <span class="error">{{ __('msg.CaptchaRequired') }}</span>
                                       @enderror
                                </div>
                                <input type="hidden" value="{{ app()->getLocale() }}" name="locale">
                            </div>
                            <br/>
                            <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <button type="submit" class="btn btn-gold btn-medium">{{  __('msg.Submit') }}</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="commonbox animate__animated animate__fadeIn animate__slow">
                            <p class="font-size-20 font-wt-700">{{ __('msg.OfficeAddress') }}</p>
                            @php
                            if(app()->getLocale() == "ar")
                            {
                                $contactinfo=App\Models\ContactInfo::first(['Email','Phone','AddressAr AS Address']);
                            }else{
                                $contactinfo=App\Models\ContactInfo::first(['Email','Phone','Address']);
                            }
                            $contactno=str_replace('-','',$contactinfo->Phone);
                            @endphp
                            <p class="mb-2"><i class="material-icons icon-1x">location_on</i>&nbsp;{{ $contactinfo->Address  }}</p>
                            <a href="tel:{{  $contactno  }}"><p class="mb-2"><i class="material-icons icon-1x">call</i>&nbsp;<span dir="ltr">{{ $contactinfo->Phone  }}</span></p></a>
                            <a href="mailto:{{ $contactinfo->Email }}"><p class="mb-2"><i class="material-icons icon-1x">email</i>&nbsp;{{ $contactinfo->Email  }}</p></a>
                            <p class="mb-2"><i class="material-icons icon-1x">public</i>&nbsp;www.homes-jordan.com</p>
                            <p class="mb-2"><i class="material-icons icon-1x">watch_later</i>&nbsp;09:00 AM To 06:00 PM</p>
                            <hr />
                             <a class="btn-social-small btn-whatsapp" href="https://wa.me/{{ $contactno}}?text=Hello Homes! I would like to enquire about your services." href="#"><i class="fab fa-whatsapp"></i></a>&nbsp;
                            <a class="btn-social-small btn-facebook" style="color:#fff;" href="https://www.facebook.com/homes.jor/"><i class="fab fa-facebook-f" target="_blank"></i></a>&nbsp;
                            <a class="btn-social-small btn-instagram" style="color:#fff;" href="https://www.instagram.com/homes.jor/" target="_blank"><i class="fab fa-instagram"></i></a>&nbsp;
                            <a class="btn-social-small btn-linkedin" href="https://www.linkedin.com/company/homes-jor" target="_blank"><i class="fab fa-linkedin icon-1x"></i></a>
                           
                           
                            <br /><br />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection()