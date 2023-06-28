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
                <h1 class="font-size-28 font-wt-600 animate__animated animate__fadeIn animate__slow"> {{ __('msg.PropertyEvaluationH1') }}</h1>
                {!! __('msg.PropertyEvaluationP1') !!}                
                <hr />
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
                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger animate__animated animate__fadeInDown" role="alert">
                        <strong>{{  __('msg.error') }}</strong>
                    </div>
                    @endif
                    @if ($message = Session::get('nodata'))
                    <div class="alert alert-danger animate__animated animate__fadeInDown" role="alert">
                        <strong>{{  __('msg.nodata') }}</strong>
                    </div>
                    @endif
                    
                    <form action="{{ route('add-evaluation',app()->getLocale()) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                                        <!--<label for="category">{{  __('msg.Category') }}</label>-->
                                         <select class="form-control" name="Category" id="category">
                                            @if(app()->getLocale()=="en")
                                            @foreach ($propertype as $val)
                                             <optgroup label="{{ $val->Type }}">
                                                @foreach ($val->category as $cat)
                                                <option value="{{ $cat->Guid }}">{{ $cat->Name }}</option>
                                                 @endforeach
                                              </optgroup>
                                            @endforeach
                                            @else
                                            @foreach ($propertype as $val)
                                            <optgroup label="{{ $val->TypeAr }}">
                                               @foreach ($val->category as $cat)
                                               <option value="{{ $cat->Guid }}">{{ $cat->NameAr }}</option>
                                                @endforeach
                                             </optgroup>
                                           @endforeach
                                            @endif
                                           </select>
                                           @error('category')
                                           <span class="error" style="color:#F30;">{{ $message }}</span>
                                           @enderror
                                     </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                                        <!--<label for="city">{{  __('msg.City') }}</label>-->
                                        <select class="form-control" name="City" id="city">
                                            <option value="">{{  __('msg.Select') }} {{  __('msg.City') }}</option>
                                              @if(app()->getLocale()=="en")
                                              @foreach ($city as $val)
                                              <option value="{{ $val->City }}">{{ $val->City }}</option>
                                             @endforeach
                                             @else
                                             @foreach ($city as $val)
                                             <option value="{{ $val->City }}">{{ $val->CityAr }}</option>
                                            @endforeach
                                             @endif
                                          </select>
                                          @error('city')
                                          <span class="error" style="color:#F30;">{{ $message }}</span>
                                          @enderror
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                                        <div class="form-floating">
                                        <input type="text" name="Name" class="form-control" value="{{old('Name')}}">
                                        <label>{{  __('msg.Name') }}</label>
                                        </div>
                                        <!--<input type="text" name="Name" value="{{old('Name')}}" class="form-control" placeholder="{{  __('msg.Name') }}" />-->
                                        @error('Name')
                                        <span class="error" style="color:#F30;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                                        <div class="form-floating">
                                        <input type="text" name="Mobile" class="form-control" value="{{old('Mobile')}}">
                                        <label>{{  __('msg.PhoneNumber') }}</label>
                                        </div>
                                        <!--<input type="text" name="Mobile" value="{{old('Mobile')}}"  class="form-control" placeholder="{{  __('msg.PhoneNumber') }}" />-->
                                        @error('Mobile')
                                        <span class="error" style="color:#F30;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                                        <div class="form-floating">
                                        <input type="text" name="Email" class="form-control" value="{{old('Email')}}">
                                        <label>{{  __('msg.Email') }}</label>
                                        </div>
                                        <!--<input type="email" name="Email" value="{{old('Email')}}"  class="form-control" placeholder="{{  __('msg.Email') }}" />-->
                                        @error('Email')
                                        <span class="error" style="color:#F30;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                                        <div class="form-floating">
                                        <input type="text" name="Area" class="form-control" value="{{old('area')}}">
                                        <label>{{  __('msg.EvaluationArea') }}</label>
                                        </div>
                                        <!--<input type="text" name="Area" value="{{old('area')}}"  class="form-control" placeholder="{{  __('msg.EvaluationArea') }}" />-->
                                        @error('area')
                                        <span class="error" style="color:#F30;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!--<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <input type="text" id="price1" value=""  class="form-control" placeholder="Pricing"  readonly/>
                                    </div>-->
                                     <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                         <div class="form-floating">
                                             <input type="text" name="Message" class="form-control" value="{{old('PurposeEvaluation')}}">
                                          <label for="floatingTextarea">{{  __('msg.PurposeEvaluation') }}</label>
                                        </div>
                                        @error('Message')
                                        <span class="error" style="color:#F30;">{{ $message }}</span>
                                        @enderror 
                                        
                                        <!-- 
                                        <textarea class="form-control-textarea"  name="Message" placeholder="{{  __('msg.PurposeEvaluation') }}">{{old('PurposeEvaluation')}}</textarea>
                                        @error('Message')
                                        <span class="error" style="color:#F30;">{{ $message }}</span>
                                        @enderror -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 text-center">
                                <p class="font-size-15 font-wt-600">{{  __('msg.PropertyEvaluationP2') }}</span></p>
                                <p class="font-size-30 font-wt-700">JOD <span id="price"></span></p>
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

<script>
 const category=@php echo json_encode($category) @endphp;
 $(function() {
    let cat=$("#category").val();
    let index = category.findIndex(c => c.Token == cat);
    const price=category[index]['Price'];
    $('#price').text(price);
});
$("#category").change(function(){
    
    let cat=$(this).val();
    let index = category.findIndex(c => c.Token == cat);
    const price=category[index]['Price'];
    $('#price').text(price);

    
});


</script>
@endsection