@extends('web-layouts.app')
@section('content')
<div class="bread-header" style="background: #ffffff url({{asset('uploads/herobanner/'.$Data->hero_banner)}}) center center no-repeat; background-size:cover;">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <h1 class="center font-size-40 font-wt-600">{{ __('msg.AboutUs') }}</h1>
            </div>
        </div>
    </div>
</div>
@if(app()->getLocale() == "ar")
<section class="pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="animate__animated animate__fadeIn animate__slow">
                    <p class="font-size-26 font-wt-600 color-gold">إن لم تطرق الفرصة بابك ، فإن شركة هومز ستجد الباب - وحتى المفتاح - خصيصاً لك </p>
                    <p class="font-size-16">
                        هومز هي وكالة عقارية رائده  تقوم بإدارة العقارات السكنية والتجارية في عمان - الأردن. تهدف هومز والتى  يقع مقرها الرئيسي في دبي -الإمارات العربية المتحدة الى تقديم خدمة مميزه ومختلفه لعملائها في رحلتهم لشراء ، بيع أو تأجير ممتلكاتهم. 
                    </p>                        
                </div>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12 center">
        <h2 class="font-size-30 font-wt-600 pull-left animate__animated animate__fadeIn animate__slow"> مجموعة الخدمات العقارية لدى هومز</h2>
    </div>
</div>
<br /><br />
<section class="gray pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 col order-2 order-md-1 animate__animated animate__fadeIn animate__slow">
                <br /><br /><h2 class="font-size-24 font-wt-600">وكلاء عقاريين متخصصين </h2>
                <p class="font-size-16">
                    في هومز ، نتفهم أن لكل عميل متطلبات مميزه ومختلفه للعقار الذي يرغب به ، لذلك نقوم بتعيين وكيل متخصص لكل فئة من فئات العقارات. سواء كنت تبحث عن شراء ، بيع أو تأجير عقار ، أرض سكنية أوحتى  تجارية ، فلدينا الوكيل المناسب لك.
                </p>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 col order-1 order-md-2 center animate__animated animate__fadeIn animate__slow">
                <img src="{{  asset('uploads/aboutus/'.$Data->images[0]->Image) }}" alt="{{ $Data->images[0]->Alt}}" width="70%" />
            </div>
        </div>
    </div>
</section>
<section class="pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 col order-1 order-md-1 center animate__animated animate__fadeIn animate__slow">
                <img src="{{  asset('uploads/aboutus/'.$Data->images[1]->Image) }}" alt="{{ $Data->images[1]->Alt}}" width="70%" />
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 col order-2 order-md-2 animate__animated animate__fadeIn animate__slow">
                <br /><br /><h2 class="font-size-24 font-wt-600">التسويق العقاري </h2>
                <p class="font-size-16">
                    هومز هي وكالة عقارية رائده  تقوم بإدارة العقارات السكنية والتجارية في عمان - الأردن. تهدف هومزوالتى  يقع مقرها الرئيسي في دبي -الإمارات العربية المتحدة الى تقديم خدمة مميزه ومختلفه لعملائها في رحلتهم لشراء ، بيع أو تأجير ممتلكاتهم. 
                </p>
            </div>
        </div>
    </div>
</section>
<section class="gray pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 col order-2 order-md-1 animate__animated animate__fadeIn animate__slow">
                <br /><br />
                <h2 class="font-size-24 font-wt-600">إدارة الممتلكات العقارية</h2>
                <p class="font-size-16">
                    إدارة الممتلكات في هومز مصممة خصيصا  للعملاء الذين يبحثون عن حل شمولي لإدارة أصول ممتلكاتهم. من الصيانة إلى إدارة التأجير  ، نحن هنا في هومز نهتم بجميع الجوانب المالية والتشغيلية لمحفظتك العقارية.
                </p>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 col order-1 order-md-2 center animate__animated animate__fadeIn animate__slow">
                <img src="{{  asset('uploads/aboutus/'.$Data->images[2]->Image) }}" alt="{{ $Data->images[2]->Alt}}" width="70%" />
            </div>
        </div>
    </div>
</section>
<section style="background:url({{ asset('images/building.jpg') }}) no-repeat scroll center center;background-size:cover; background-attachment:fixed;">
        <br />
        <br />
        <br />
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 center">
                    <h3 class="font-size-28 font-wt-600 color-white animate__animated animate__fadeIn animate__slow">التق بفريقنا الإداري</h3>
                    <!--<p class="font-size-16 color-white animate__animated animate__fadeIn animate__slow">محترفون خلف Homes من أجلك</p>-->
                </div>
            </div>
            <br />
            <div class="row justify-content-center" dir="ltr">
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
                    <div class="card center animate__animated animate__fadeIn animate__slow">
                        <div class="card-body">
                            <img src="{{  asset('images/Maen.jpg') }}" width="100%" alt="">
                            <br />
                            <br />
                            <h2 class="font-size-16 font-wt-600">معن السكر</h2>
                            <p class="font-wt-500 color-gold">المدير الإداري</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
                    <div class="card center animate__animated animate__fadeIn animate__slow">
                        <div class="card-body">
                            <img src="{{  asset('images/Omar.jpg') }}" width="100%" alt="">
                            <br />
                            <br />
                            <h2 class="font-size-16 font-wt-600">عمر العدوان</h2>
                            <p class="font-wt-500 color-gold">مدير المبيعات والعمليات</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
                    <div class="card center animate__animated animate__fadeIn animate__slow">
                        <div class="card-body">
                            <img src="{{  asset('images/Aya.jpg') }}" width="100%" alt="">
                            <br />
                            <br />
                            <h2 class="font-size-16 font-wt-600">آية محاميد</h2>
                            <p class="font-wt-500 color-gold">قسم الشقق</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
                    <div class="card center animate__animated animate__fadeIn animate__slow">
                        <div class="card-body">
                            <img src="{{  asset('images/Alaa.jpg') }}" width="100%" alt="">
                            <br />
                            <br />
                            <h2 class="font-size-16 font-wt-600">الاء أبو ياسين</h2>
                            <p class="font-wt-500 color-gold">قسم التجاري</p>
                        </div>
                    </div>
                </div>

                
            </div>
        </div>
        <br />
        <br />
        <br />
    </section>





@else
<section class="pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="animate__animated animate__fadeIn animate__slow">
                    <p class="font-size-26 font-wt-600 color-gold">If opportunity doesn’t knock, Homes finds the door -and the key- for you</p>
                    <p class="font-size-16">
                        Homes is a leading real estate agency managing residential and commercial properties in Amman-Jordan.
                        Headquartered in Dubai-UAE, Homes aims to provide a unique service to our clients in their journey to purchase, sell or lease their property.
                        We have the key to your home.
                    </p>                        
                </div>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12 center">
        <h2 class="font-size-30 font-wt-600 pull-left animate__animated animate__fadeIn animate__slow">Portfolio Of Services At Homes Jordan</h2>
    </div>
</div>
<br /><br />
<section class="gray pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 col order-2 order-md-1 animate__animated animate__fadeIn animate__slow">
                <br /><br /><h2 class="font-size-24 font-wt-600">Specialized Real Estate Agents</h2>
                <p class="font-size-16">
                    At Homes, we understand that each client comes with unique property requirements, so we assign a dedicated agent for each property type. Whether you are looking to buy, sell or lease a residential or commercial property or land, we have the right agent for you.
                </p>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 col order-1 order-md-2 center animate__animated animate__fadeIn animate__slow">
                <img src="{{  asset('uploads/aboutus/'.$Data->images[0]->Image) }}" alt="{{ $Data->images[0]->Alt}}" width="70%" />
            </div>
        </div>
    </div>
</section>
<section class="pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 col order-1 order-md-1 center animate__animated animate__fadeIn animate__slow">
                <img src="{{  asset('uploads/aboutus/'.$Data->images[1]->Image) }}" alt="{{ $Data->images[1]->Alt}}" width="70%" />
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 col order-2 order-md-2 animate__animated animate__fadeIn animate__slow">
                <br /><br /><h2 class="font-size-24 font-wt-600">Real Estate Marketing</h2>
                <p class="font-size-16">
                    We manage property listings through state-of-the-art solutions to ensure our reach is high and our customers are served promptly. One of our core values is to focus our efforts in online and offline marketing, and that reflects on our pristine quality of service.
                </p>
            </div>
        </div>
    </div>
</section>
<section class="gray pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 col order-2 order-md-1 animate__animated animate__fadeIn animate__slow">
                <br /><br /><h2 class="font-size-24 font-wt-600">Asset Management</h2>
                <p class="font-size-16">
                    Homes property management is for clients looking for an end-to-end solution to manage their property assets. From maintenance to asset lease management, we take care of all financial and operational aspects of your real estate portfolio.
                </p>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 col order-1 order-md-2 center animate__animated animate__fadeIn animate__slow">
                <img src="{{  asset('uploads/aboutus/'.$Data->images[2]->Image) }}" alt="{{ $Data->images[2]->Alt}}" width="70%" />
            </div>
        </div>
    </div>
</section>

<section style="background:url({{ asset('images/building.jpg') }}) no-repeat scroll center center;background-size:cover; background-attachment:fixed;">
        <br />
        <br />
        <br />
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 center">
                    <h3 class="font-size-28 font-wt-600 color-white animate__animated animate__fadeIn animate__slow">Meet Our Leadership Team </h3>
                    <!--<p class="font-size-16 color-white animate__animated animate__fadeIn animate__slow">Professionals behind Homes for you</p>-->
                </div>
            </div>
            <br />
            <div class="row justify-content-center">
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
                    <div class="card center animate__animated animate__fadeIn animate__slow">
                        <div class="card-body">
                            <img src="{{  asset('images/Maen.jpg') }}" width="100%" alt="">
                            <br />
                            <br />
                            <h2 class="font-size-16 font-wt-600">Maen Al Sukkar</h2>
                            <p class="font-wt-500 color-gold">Managing Director</p>
                        </div>
                    </div>
                </div>
               
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
                    <div class="card center animate__animated animate__fadeIn animate__slow">
                        <div class="card-body">
                            <img src="{{  asset('images/Omar.jpg') }}" width="100%" alt="">
                            <br />
                            <br />
                            <h2 class="font-size-16 font-wt-600">Omar Al Adwan</h2>
                            <p class="font-wt-500 color-gold">Director of Sales & Operations</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
                    <div class="card center animate__animated animate__fadeIn animate__slow">
                        <div class="card-body">
                            <img src="{{  asset('images/Aya.jpg') }}" width="100%" alt="">
                            <br />
                            <br />
                            <h2 class="font-size-16 font-wt-600">Aya Mahameed</h2>
                            <p class="font-wt-500 color-gold">Apartments Department</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
                    <div class="card center animate__animated animate__fadeIn animate__slow">
                        <div class="card-body">
                            <img src="{{  asset('images/Alaa.jpg') }}" width="100%" alt="">
                            <br />
                            <br />
                            <h2 class="font-size-16 font-wt-600">Alaa Abu Yassen</h2>
                            <p class="font-wt-500 color-gold">Commercial Department</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br />
        <br />
        <br />
    </section>

@endif
@if(count($Data->Testimonials) > 0)
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 center">
                <h3 class="font-size-28 font-wt-600 animate__animated animate__fadeIn animate__slow">{{  __('msg.WhatClientsSay') }}</h3>
            </div>
        </div><br />
        <div class="row testimonial" dir="ltr">
            @foreach ($Data->Testimonials as $val)
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <i class="material-icons icon-8x color-gold">format_quote</i>
                        <p>{{$val->Message  }}</p>
                        <hr>
                        <div class="row">
                            <!--<div class="col-xl-2 col-lg-3 col-md-3 col-sm-3 col-3">
                                <img src="{{ URL::asset('uploads/testimonial/'.$val->Photo) }}" class="roundborder-lg" alt="">
                            </div>-->
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <p class="font-size-16 font-wt-600">{{$val->CustomerName  }}</p>
                               <!-- <p class="color-gray">{{$val->Designation  }}</p>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
          
        </div>
    </div>
    <br /><br />
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 center">
            <a href="https://g.page/r/CW_wTbZ1CIk0EBM/review" target="_blank" class="btn btn-gold btn-medium">{{  __('msg.AllGoogleReviews') }}</a>
        </div>
    </div>
</section>

@endif
@endsection()