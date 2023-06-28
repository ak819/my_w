@php $PropertyeId=app('request')->input('t');  @endphp
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="collapse" id="collapseExample">
                 {{-- Apartment --}}
                  <div class="row afilters hidden g-3" id="f-1">
                       
                        
                        
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6 ps-2 pe-2">
                            <div class="form-floating">
                            <select  name="mnbt" class="form-select" aria-label="Floating label select example">
                                <option value=""> {{  __('msg.Select') }}</option>
                                @foreach (config('constants.BathRooms') as $key=>$baths)
                                <option value="{{ $key }}" {{ (app('request')->input('mnbt') == $key)? "selected": "" }}>{{ $baths  }}</option> 
                                @endforeach
                            </select>
                            <label>{{ __('msg.MinBathroom') }}</label>
                           </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <select name="mxbt" class="form-select" aria-label="Floating label select example">
                                    <option value=""> {{  __('msg.Select') }}</option>
                                    @foreach (config('constants.BathRooms') as $key=>$baths)
                                    <option value="{{ $key }}" {{ (app('request')->input('mxbt') == $key)? "selected": "" }}>{{ $baths  }}</option> 
                                    @endforeach
                                </select>
                            <label>{{ __('msg.MaxBathroom') }}</label>
                            </div>
                        </div>
                        
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6 ps-2 pe-2">
                            <div class="form-floating">
                            <input type="text" name="mnblt" class="form-control" placeholder="" value="{{ app('request')->input('mnblt') }}">
                            <label >{{ __('msg.MinBuiltUpArea') }}</label>
                           </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6 ps-2 pe-2">
                            <div class="form-floating">
                            <input type="text" name="mxblt" class="form-control" placeholder="" value="{{ app('request')->input('mxblt') }}">
                            <label >{{ __('msg.MaxBuiltUpArea') }}</label>
                           </div>
                        </div>
                        
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <select name="fn" class="form-select" aria-label="Floating label select example">
                                    <option value="" selected> {{  __('msg.Select') }}</option>
                                    @if(app()->getLocale()=="ar")
                                    @foreach (config('constants.FloorNumberAr') as  $key =>$floorNumbers)
                                    <option value="{{ $key }}" {{ (is_numeric(app('request')->input('fn')) && app('request')->input('fn') == $key)? "selected": "-" }}>{{ $floorNumbers  }}</option> 
                                    @endforeach
                                    @else
                                    @foreach (config('constants.FloorNumber') as $key =>$floorNumbers)
                                    <option value="{{ $key }}" {{ (is_numeric(app('request')->input('fn')) && app('request')->input('fn') == $key)? "selected": "-" }}>{{  $floorNumbers }}</option> 
                                    @endforeach
                                    @endif
                                  </select>
                              <label>{{ __('msg.Floor Number') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <select name="frsh" class="form-select" aria-label="Floating label select example">
                                    <option value=""> {{  __('msg.Select') }}</option>
                                    @foreach (config('constants.YesNo') as $val)
                                    <option value="{{ $val }}" {{ (app('request')->input('frsh') == $val)? "selected": "" }}>{{ (app()->getLocale()=="ar")? config('constants.YesNoAr.'.$val) :$val  }}</option> 
                                    @endforeach
                                </select>
                                <label>{{ __('msg.Furnished') }}</label>
                           </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <select  name="swm" class="form-select" aria-label="Floating label select example">
                                    <option value="">{{  __('msg.Select') }}</option>
                                    @foreach (config('constants.YesNo') as $val)
                                    <option value="{{ $val }}" {{ (app('request')->input('swm') == $val)? "selected": "" }}>{{ (app()->getLocale()=="ar")? config('constants.YesNoAr.'.$val) :$val  }}</option> 
                                    @endforeach
                                </select>
                                <label>{{ __('msg.Swimming Pool') }}</label>
                            </div>
                        </div>
                        {{-- <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <select name="apt"  class="form-select" aria-label="Floating label select example">
                                    <option value="">{{  __('msg.Select') }}</option>
                                    @foreach (config('constants.ApartmentType') as $apttype)
                                    <option value="{{ $apttype }}" {{ (app('request')->input('apt') == $apttype)? "selected": "" }}>{{ (app()->getLocale()=="ar")? config('constants.ApartmentTypeAr.'.$apttype) :$apttype  }}</option> 
                                    @endforeach
                                </select>
                                <label>{{ __('msg.Apartment Type') }}</label>
                            </div>
                        </div> --}}
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <select name="flt" class="form-select" aria-label="Floating label select example">
                                  <option value=""> {{  __('msg.Select') }}</option>
                                  @foreach (config('constants.FloorType') as $floortype)
                                  <option value="{{ $floortype }}" {{ (app('request')->input('flt') == $floortype)? "selected": "" }}>{{ (app()->getLocale()=="ar")? config('constants.FloorTypeAr.'.$floortype) : $floortype  }}</option> 
                                  @endforeach
                                </select>
                                <label>{{ __('msg.FloorType') }}</label>
                              </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <select name="oa" class="form-select" aria-label="Floating label select example">
                                    <option value="">{{  __('msg.Select') }}</option>
                                    @foreach (config('constants.YesNo') as $val)
                                    <option value="{{ $val }}" {{ (app('request')->input('oa') == $val)? "selected": "" }}>{{(app()->getLocale()=="ar")? config('constants.YesNoAr.'.$val) :$val  }}</option> 
                                    @endforeach
                                </select>
                                <label>{{ __('msg.Outdoor Area') }}</label>
                            </div>
                        </div>
                    </div>
                       {{-- Land Residential --}}
                  <div class="row afilters hidden g-3" id="f-2">
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <input type="text" name="mnplt" class="form-control" placeholder="" value="{{ app('request')->input('mnplt') }}">
                                <label >{{ __('msg.MinPlotArea') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <input type="text" name="mxplt" class="form-control" placeholder="" value="{{ app('request')->input('mxplt') }}">
                                <label >{{ __('msg.MaxPlotArea') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <input type="text" name="mnsrt" class="form-control" placeholder="" value="{{ app('request')->input('mnsrt') }}">
                                <label >{{ __('msg.MinStreets') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <input type="text" name="mxsrt" class="form-control" placeholder="" value="{{ app('request')->input('mxsrt') }}">
                                <label >{{ __('msg.MaxStreets') }}</label>
                            </div>
                        </div>
                        
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <input type="text" name="mnfc" class="form-control" placeholder=""  value="{{ app('request')->input('mnfc') }}">
                                <label>{{ __('msg.MinFacade') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <input type="text" name="mxfc" class="form-control" placeholder=""  value="{{ app('request')->input('mxfc') }}">
                                <label>{{ __('msg.MaxFacade') }}</label>
                            </div>
                        </div>
                        
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-12 ps-2 pe-2">
                            <div class="form-floating">
                                <select name="rsdt" class="form-select" aria-label="Floating label select example">
                                    <option value="">{{  __('msg.Select') }}</option>
                                    @foreach (config('constants.ResidentialLandType') as $reslandtype)
                                    <option value="{{ $reslandtype }}" {{ (app('request')->input('rsdt') == $reslandtype)? "selected": "" }}>{{ (app()->getLocale()=="ar")? config('constants.ResidentialLandTypeAr.'.$reslandtype) :$reslandtype  }}</option> 
                                    @endforeach
                                </select>
                                <label >{{ __('msg.Residential Land Type') }}</label>
                           </div>
                        </div>
                        {{-- <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <input type="text" name="mnbpc" class="form-control" placeholder=""
                                value="{{ app('request')->input('mnbpc') }}">
                                <label >{{ __('msg.MinBuilding%') }}</label>
                            </div>
                        </div> --}}
                        {{-- <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <input type="text" name="mxbpc" class="form-control" placeholder="" value="{{ app('request')->input('mxbpc') }}">
                                <label>{{ __('msg.MaxBuilding%') }}</label>
                            </div>
                        </div> --}}
                        
                        
                  </div>
                    {{--Land Commercial --}}
                  <div class="row afilters hidden g-3" id="f-3">
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <input type="text" name="mnplt" class="form-control" placeholder="" value="{{ app('request')->input('mnplt') }}">
                                <label >{{ __('msg.MinPlotArea') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <input type="text" name="mxplt" class="form-control" placeholder="" value="{{ app('request')->input('mxplt') }}">
                                <label >{{ __('msg.MaxPlotArea') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <input type="text" name="mnsrt" class="form-control" placeholder="" value="{{ app('request')->input('mnsrt') }}">
                                <label >{{ __('msg.MinStreets') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <input type="text" name="mxsrt" class="form-control" placeholder="" value="{{ app('request')->input('mxsrt') }}">
                                <label >{{ __('msg.MaxStreets') }}</label>
                            </div>
                        </div>
                        
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <input type="text" name="mnfc" class="form-control" placeholder=""  value="{{ app('request')->input('mnfc') }}">
                                <label>{{ __('msg.MinFacade') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <input type="text" name="mxfc" class="form-control" placeholder=""  value="{{ app('request')->input('mxfc') }}">
                                <label>{{ __('msg.MaxFacade') }}</label>
                            </div>
                        </div>
                       
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <select name="ct" class="form-select" aria-label="Floating label select example">
                                    <option value="">{{  __('msg.Select') }}</option>
                                    @foreach (config('constants.CommercialType') as $commtype)
                                    <option value="{{ $commtype }}" {{ (app('request')->input('ct') == $commtype)? "selected": "" }}>{{ (app()->getLocale()=="ar")? config('constants.CommercialTypeAr.'.$commtype) :$commtype }}</option> 
                                    @endforeach
                                </select>
                                <label>{{ __('msg.Commercial Type') }}</label>
                            </div>
                        </div>
                        {{-- <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <input type="text" name="mnbpc" class="form-control" placeholder=""
                                value="{{ app('request')->input('mnbpc') }}">
                                <label >{{ __('msg.MinBuilding%') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <input type="text" name="mxbpc" class="form-control" placeholder="" value="{{ app('request')->input('mxbpc') }}">
                                <label>{{ __('msg.MaxBuilding%') }}</label>
                            </div>
                        </div> --}}
                        
                  </div>
                  
                   {{--Office &  Commercial Full Floor--}}
                 <div class="row afilters hidden g-3" id="f-4-7">
                        
                        
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <select  name="mnbt" class="form-select" aria-label="Floating label select example">
                                    <option value=""> {{  __('msg.Select') }}</option>
                                    @foreach (config('constants.BathRooms') as $key=>$baths)
                                    <option value="{{ $key }}" {{ (app('request')->input('mnbt') == $key)? "selected": "" }}>{{ $baths  }}</option> 
                                    @endforeach
                                </select>
                                <label>{{ __('msg.MinBathroom') }}</label>
                               </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                    <select name="mxbt" class="form-select" aria-label="Floating label select example">
                                        <option value=""> {{  __('msg.Select') }}</option>
                                        @foreach (config('constants.BathRooms') as $key=>$baths)
                                        <option value="{{ $key }}" {{ (app('request')->input('mxbt') == $key)? "selected": "" }}>{{ $baths  }}</option> 
                                        @endforeach
                                    </select>
                                    <label>{{ __('msg.MaxBathroom') }}</label>
                            </div>
                        </div>
                        
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <input type="text" name="mnblt" class="form-control" placeholder="" value="{{ app('request')->input('mnblt') }}">
                                <label >{{ __('msg.MinBuiltUpArea') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <input type="text" name="mxblt" class="form-control" placeholder="" value="{{ app('request')->input('mxblt') }}">
                                <label >{{ __('msg.MaxBuiltUpArea') }}</label>
                            </div>
                        </div>
                        
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <select name="ft" class="form-select" aria-label="Floating label select example">
                                    <option value="">{{  __('msg.Select') }}</option>
                                    @foreach (config('constants.YesNo') as $val)
                                    <option value="{{ $val }}" {{ (app('request')->input('ft') == $key)? "selected": "" }}>{{ (app()->getLocale()=="ar")? config('constants.YesNoAr.'.$val) :$val  }}</option> 
                                    @endforeach
                                </select>
                                <label>{{ __('msg.Fitted') }}</label>
                           </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <select name="fn" class="form-select" aria-label="Floating label select example">
                                    <option value="" selected> {{  __('msg.Select') }}</option>
                                    @if(app()->getLocale()=="ar")
                                    @foreach (config('constants.FloorNumberAr') as  $key =>$floorNumbers)
                                    <option value="{{ $key }}" {{ (is_numeric(app('request')->input('fn')) && app('request')->input('fn') == $key)? "selected": "-" }}>{{ $floorNumbers  }}</option> 
                                    @endforeach
                                    @else
                                    @foreach (config('constants.FloorNumber') as $key =>$floorNumbers)
                                    <option value="{{ $key }}" {{ (is_numeric(app('request')->input('fn')) && app('request')->input('fn') == $key)? "selected": "-" }}>{{  $floorNumbers }}</option> 
                                    @endforeach
                                    @endif
                                  </select>
                                <label>{{ __('msg.Floor Number') }}</label>
                              </div>
                        </div>
                        
                        
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <select name="frsh" class="form-select" aria-label="Floating label select example">
                                    <option value=""> {{  __('msg.Select') }}</option>
                                    @foreach (config('constants.YesNo') as $val)
                                    <option value="{{ $val }}" {{ (app('request')->input('frsh') == $val)? "selected": "" }}>{{ (app()->getLocale()=="ar")? config('constants.YesNoAr.'.$val) :$val  }}</option> 
                                    @endforeach
                                </select>
                                <label>{{ __('msg.Furnished') }}</label>
                           </div>
                        </div>
                       
                        @if(app('request')->input('adt') == "2")
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <select name="rd"  class="form-select" aria-label="Floating label select example">
                                    <option value="">{{  __('msg.Select') }}</option>
                                    @foreach (config('constants.YesNo') as $val)
                                    <option value="{{ $val }}" {{ (app('request')->input('rd') == $val)? "selected": "" }}>{{ (app()->getLocale()=="ar")? config('constants.YesNoAr.'.$val):  $val  }}</option> 
                                    @endforeach
                                </select>
                                <label>{{ __('msg.Rented') }}</label>
                            </div>
                        </div>
                        @endif

                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <select name="flt" class="form-select" aria-label="Floating label select example">
                                  <option value=""> {{  __('msg.Select') }}</option>
                                  @foreach (config('constants.FloorType') as $floortype)
                                  <option value="{{ $floortype }}" {{ (app('request')->input('flt') == $floortype)? "selected": "" }}>{{ (app()->getLocale()=="ar")? config('constants.FloorTypeAr.'.$floortype) : $floortype  }}</option> 
                                  @endforeach
                                </select>
                                <label>{{ __('msg.FloorType') }}</label>
                              </div>
                        </div>
                 </div>

                 {{--Show Room &  Warehouse--}}
                 <div class="row afilters hidden g-3" id="f-5-10">
                        
                        
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                        <div class="form-floating">
                            <select  name="mnbt" class="form-select" aria-label="Floating label select example">
                                <option value=""> {{  __('msg.Select') }}</option>
                                @foreach (config('constants.BathRooms') as $key=>$baths)
                                <option value="{{ $key }}" {{ (app('request')->input('mnbt') == $key)? "selected": "" }}>{{ $baths  }}</option> 
                                @endforeach
                            </select>
                            <label>{{ __('msg.MinBathroom') }}</label>
                           </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                        <div class="form-floating">
                                <select name="mxbt" class="form-select" aria-label="Floating label select example">
                                    <option value=""> {{  __('msg.Select') }}</option>
                                    @foreach (config('constants.BathRooms') as $key=>$baths)
                                    <option value="{{ $key }}" {{ (app('request')->input('mxbt') == $key)? "selected": "" }}>{{ $baths  }}</option> 
                                    @endforeach
                                </select>
                                <label>{{ __('msg.MaxBathroom') }}</label>
                        </div>
                    </div>
                    
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                        <div class="form-floating">
                            <input type="text" name="mnblt" class="form-control" placeholder="" value="{{ app('request')->input('mnblt') }}">
                            <label >{{ __('msg.MinBuiltUpArea') }}</label>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                        <div class="form-floating">
                            <input type="text" name="mxblt" class="form-control" placeholder="" value="{{ app('request')->input('mxblt') }}">
                            <label >{{ __('msg.MaxBuiltUpArea') }}</label>
                        </div>
                    </div>
                    
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                        <div class="form-floating">
                            <select name="ft" class="form-select" aria-label="Floating label select example">
                                <option value="">{{  __('msg.Select') }}</option>
                                @foreach (config('constants.YesNo') as $val)
                                <option value="{{ $val }}" {{ (app('request')->input('ft') == $key)? "selected": "" }}>{{ (app()->getLocale()=="ar")? config('constants.YesNoAr.'.$val) :$val  }}</option> 
                                @endforeach
                            </select>
                            <label>{{ __('msg.Fitted') }}</label>
                       </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                        <div class="form-floating">
                            <select name="fn" class="form-select" aria-label="Floating label select example">
                                <option value="" selected> {{  __('msg.Select') }}</option>
                                @if(app()->getLocale()=="ar")
                                @foreach (config('constants.FloorNumberAr') as  $key =>$floorNumbers)
                                <option value="{{ $key }}" {{ (is_numeric(app('request')->input('fn')) && app('request')->input('fn') == $key)? "selected": "-" }}>{{ $floorNumbers  }}</option> 
                                @endforeach
                                @else
                                @foreach (config('constants.FloorNumber') as $key =>$floorNumbers)
                                <option value="{{ $key }}" {{ (is_numeric(app('request')->input('fn')) && app('request')->input('fn') == $key)? "selected": "-" }}>{{  $floorNumbers }}</option> 
                                @endforeach
                                @endif
                              </select>
                            <label>{{ __('msg.Floor Number') }}</label>
                          </div>
                    </div>
                    
                    
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                        <div class="form-floating">
                            <select name="frsh" class="form-select" aria-label="Floating label select example">
                                <option value=""> {{  __('msg.Select') }}</option>
                                @foreach (config('constants.YesNo') as $val)
                                <option value="{{ $val }}" {{ (app('request')->input('frsh') == $val)? "selected": "" }}>{{ (app()->getLocale()=="ar")? config('constants.YesNoAr.'.$val) :$val  }}</option> 
                                @endforeach
                            </select>
                            <label>{{ __('msg.Furnished') }}</label>
                       </div>
                    </div>
                   
                    @if(app('request')->input('adt') == "2")
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                        <div class="form-floating">
                            <select name="rd"  class="form-select" aria-label="Floating label select example">
                                <option value="">{{  __('msg.Select') }}</option>
                                @foreach (config('constants.YesNo') as $val)
                                <option value="{{ $val }}" {{ (app('request')->input('rd') == $val)? "selected": "" }}>{{ (app()->getLocale()=="ar")? config('constants.YesNoAr.'.$val):  $val  }}</option> 
                                @endforeach
                            </select>
                            <label>{{ __('msg.Rented') }}</label>
                        </div>
                    </div>
                    @endif

                    
             </div>
                  
                  {{-- Villa --}}
                 <div class="row afilters hidden g-3" id="f-6">
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                             <div class="form-floating">
                                <select  name="mnbt" class="form-select" aria-label="Floating label select example">
                                <option value=""> {{  __('msg.Select') }}</option>
                                @foreach (config('constants.BathRooms') as $key=>$baths)
                                <option value="{{ $key }}" {{ (app('request')->input('mnbt') == $key)? "selected": "" }}>{{ $baths  }}</option> 
                                @endforeach
                            </select>
                            <label>{{ __('msg.MinBathroom') }}</label>
                           </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <select name="mxbt" class="form-select" aria-label="Floating label select example">
                                    <option value=""> {{  __('msg.Select') }}</option>
                                    @foreach (config('constants.BathRooms') as $key=>$baths)
                                    <option value="{{ $key }}" {{ (app('request')->input('mxbt') == $key)? "selected": "" }}>{{ $baths  }}</option> 
                                    @endforeach
                                </select>
                                <label>{{ __('msg.MaxBathroom') }}</label>
                           </div>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <input type="text" name="mnfn" class="form-control" placeholder="" value="{{ app('request')->input('mnfn') }}">
                                <label>{{ __('msg.MinNumberOfFloors') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <input type="text" name="mxfn" class="form-control" placeholder="" value="{{ app('request')->input('mxfn') }}">
                                <label>{{ __('msg.MaxNumberOfFloors') }}</label>
                            </div>
                        </div>
                       
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <input type="text" name="mnblt" class="form-control" placeholder="" value="{{ app('request')->input('mnblt') }}">
                                <label >{{ __('msg.MinBuiltUpArea') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <input type="text" name="mxblt" class="form-control" placeholder="" value="{{ app('request')->input('mxblt') }}">
                                <label >{{ __('msg.MaxBuiltUpArea') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <input type="text" name="mnplt" class="form-control" placeholder="" value="{{ app('request')->input('mnplt') }}">
                                <label >{{ __('msg.MinPlotArea') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <input type="text" name="mxplt" class="form-control" placeholder="" value="{{ app('request')->input('mxplt') }}">
                                <label >{{ __('msg.MaxPlotArea') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <select name="frsh" class="form-select" aria-label="Floating label select example">
                                    <option value=""> {{  __('msg.Select') }}</option>
                                    @foreach (config('constants.YesNo') as $val)
                                    <option value="{{ $val }}" {{ (app('request')->input('frsh') == $val)? "selected": "" }}>{{ (app()->getLocale()=="ar")? config('constants.YesNoAr.'.$val) :$val  }}</option> 
                                    @endforeach
                                </select>
                                <label>{{ __('msg.Furnished') }}</label>
                           </div>
                        </div>
                      
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <select  name="swm" class="form-select" aria-label="Floating label select example">
                                    <option value="">{{  __('msg.Select') }}</option>
                                    @foreach (config('constants.YesNo') as $val)
                                    <option value="{{ $val }}" {{ (app('request')->input('swm') == $val)? "selected": "" }}>{{ (app()->getLocale()=="ar")? config('constants.YesNoAr.'.$val) :$val  }}</option> 
                                    @endforeach
                                </select>
                                <label>{{ __('msg.Swimming Pool') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <select name="vt" class="form-select" aria-label="Floating label select example">
                                    <option value="">{{__('msg.Select') }}</option>
                                    @foreach (config('constants.VillaType') as $villatype)
                                    <option value="{{ $villatype }}" {{ (app('request')->input('vt') == $villatype)? "selected": "" }}>{{ (app()->getLocale()=="ar")? config('constants.VillaTypeAr.'.$villatype) : $villatype  }}</option> 
                                    @endforeach
                                </select>
                                <label>{{ __('msg.Villa Type') }}</label>
                            </div>
                        </div>
                 </div>
                {{-- Commercial Full Building --}}
                 <div class="row afilters hidden g-3" id="f-8">
                   <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                        <div class="form-floating">
                            <input type="text" name="mnfn" class="form-control" placeholder="" value="{{ app('request')->input('mnfn') }}">
                            <label>{{ __('msg.MinNumberOfFloors') }}</label>
                        </div>
                    </div> 
                   <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                        <div class="form-floating">
                            <input type="text" name="mxfn" class="form-control" placeholder="" value="{{ app('request')->input('mxfn') }}">
                            <label>{{ __('msg.MaxNumberOfFloors') }}</label>
                        </div>
                    </div> 
                        {{-- <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <select  name="mnbt" class="form-select" aria-label="Floating label select example">
                                    <option value=""> {{  __('msg.Select') }}</option>
                                    @foreach (config('constants.BathRooms') as $key=>$baths)
                                    <option value="{{ $key }}" {{ (app('request')->input('mnbt') == $key)? "selected": "" }}>{{ $baths  }}</option> 
                                    @endforeach
                                </select>
                                <label>{{ __('msg.MinBathroom') }}</label>
                               </div>
                        </div> --}}
                        {{-- <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                             <div class="form-floating">
                                    <select name="mxbt" class="form-select" aria-label="Floating label select example">
                                        <option value=""> {{  __('msg.Select') }}</option>
                                        @foreach (config('constants.BathRooms') as $key=>$baths)
                                        <option value="{{ $key }}" {{ (app('request')->input('mxbt') == $key)? "selected": "" }}>{{ $baths  }}</option> 
                                        @endforeach
                                    </select>
                                    <label>{{ __('msg.MaxBathroom') }}</label>
                            </div>
                        </div> --}}
                        
                        
                        
                       
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <input type="text" name="mnblt" class="form-control" placeholder="" value="{{ app('request')->input('mnblt') }}">
                                <label >{{ __('msg.MinBuiltUpArea') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <input type="text" name="mxblt" class="form-control" placeholder="" value="{{ app('request')->input('mxblt') }}">
                                <label >{{ __('msg.MaxBuiltUpArea') }}</label>
                            </div>
                        </div>
                        
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <input type="text" name="mnplt" class="form-control" placeholder="" value="{{ app('request')->input('mnplt') }}">
                                <label >{{ __('msg.MinPlotArea') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <input type="text" name="mxplt" class="form-control" placeholder="" value="{{ app('request')->input('mxplt') }}">
                                <label >{{ __('msg.MaxPlotArea') }}</label>
                            </div>
                        </div>
                        
                        {{-- <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <select name="fn" class="form-select" aria-label="Floating label select example">
                                    <option value="" selected> {{  __('msg.Select') }}</option>
                                    @if(app()->getLocale()=="ar")
                                    @foreach (config('constants.FloorNumberAr') as  $key =>$floorNumbers)
                                    <option value="{{ $key }}" {{ (is_numeric(app('request')->input('fn')) && app('request')->input('fn') == $key)? "selected": "-" }}>{{ $floorNumbers  }}</option> 
                                    @endforeach
                                    @else
                                    @foreach (config('constants.FloorNumber') as $key =>$floorNumbers)
                                    <option value="{{ $key }}" {{ (is_numeric(app('request')->input('fn')) && app('request')->input('fn') == $key)? "selected": "-" }}>{{  $floorNumbers }}</option> 
                                    @endforeach
                                    @endif
                                  </select>
                                <label>{{ __('msg.Floor Number') }}</label>
                              </div>
                        </div> --}}
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <select name="frsh" class="form-select" aria-label="Floating label select example">
                                    <option value=""> {{  __('msg.Select') }}</option>
                                    @foreach (config('constants.YesNo') as $val)
                                    <option value="{{ $val }}" {{ (app('request')->input('frsh') == $val)? "selected": "" }}>{{ (app()->getLocale()=="ar")? config('constants.YesNoAr.'.$val) :$val  }}</option> 
                                    @endforeach
                                </select>
                                <label>{{ __('msg.Furnished') }}</label>
                           </div>
                        </div>
                     
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <select name="ct" class="form-select" aria-label="Floating label select example">
                                    <option value="">{{  __('msg.Select') }}</option>
                                    @foreach (config('constants.CommercialType') as $commtype)
                                    <option value="{{ $commtype }}" {{ (app('request')->input('ct') == $commtype)? "selected": "" }}>{{ (app()->getLocale()=="ar")? config('constants.CommercialTypeAr.'.$commtype) :$commtype }}</option> 
                                    @endforeach
                                </select>
                                <label>{{ __('msg.Commercial Type') }}</label>
                            </div>
                        </div>
                        @if(app('request')->input('adt') == "2")
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <select name="rd"  class="form-select" aria-label="Floating label select example">
                                    <option value="">{{  __('msg.Select') }}</option>
                                    @foreach (config('constants.YesNo') as $val)
                                    <option value="{{ $val }}" {{ (app('request')->input('rd') == $val)? "selected": "" }}>{{ (app()->getLocale()=="ar")? config('constants.YesNoAr.'.$val):  $val  }}</option> 
                                    @endforeach
                                </select>
                                <label>{{ __('msg.Rented') }}</label>
                            </div>
                        </div>
                        @endif
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <select name="bft" class="form-control">
                                    <option value="">{{  __('msg.Select') }}</option>
                                    @foreach (config('constants.BuildingFacadeType') as $builfacade)
                                    <option value="{{ $builfacade }}" {{ (app('request')->input('bft') == $builfacade)? "selected": "" }}>{{ (app()->getLocale()=="ar")? config('constants.BuildingFacadeTypeAr.'.$builfacade) : $builfacade  }}</option> 
                                    @endforeach
                                </select>
                                <label>{{ __('msg.Building Facade Type') }}</label>
                            </div>
                        </div>
                 </div>
                   {{-- Residential Building --}}
                 <div class="row afilters hidden g-3" id="f-9">
                    
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                        <div class="form-floating">
                            <select  name="mnbt" class="form-select" aria-label="Floating label select example">
                                <option value=""> {{  __('msg.Select') }}</option>
                                @foreach (config('constants.BathRooms') as $key=>$baths)
                                <option value="{{ $key }}" {{ (app('request')->input('mnbt') == $key)? "selected": "" }}>{{ $baths  }}</option> 
                                @endforeach
                            </select>
                            <label>{{ __('msg.MinBathroom') }}</label>
                           </div>
                    </div>
                    
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                        <div class="form-floating">
                                    <select name="mxbt" class="form-select" aria-label="Floating label select example">
                                        <option value=""> {{  __('msg.Select') }}</option>
                                        @foreach (config('constants.BathRooms') as $key=>$baths)
                                        <option value="{{ $key }}" {{ (app('request')->input('mxbt') == $key)? "selected": "" }}>{{ $baths  }}</option> 
                                        @endforeach
                                    </select>
                                    <label>{{ __('msg.MaxBathroom') }}</label>
                            </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                        <div class="form-floating">
                            <input type="text" name="mnfn" class="form-control" placeholder="" value="{{ app('request')->input('mnfn') }}">
                            <label>{{ __('msg.MinNumberOfFloors') }}</label>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                        <div class="form-floating">
                            <input type="text" name="mxfn" class="form-control" placeholder="" value="{{ app('request')->input('mxfn') }}">
                            <label>{{ __('msg.MaxNumberOfFloors') }}</label>
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                        <div class="form-floating">
                            <input type="text" name="mnblt" class="form-control" placeholder="" value="{{ app('request')->input('mnblt') }}">
                            <label >{{ __('msg.MinBuiltUpArea') }}</label>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                        <div class="form-floating">
                            <input type="text" name="mxblt" class="form-control" placeholder="" value="{{ app('request')->input('mxblt') }}">
                            <label >{{ __('msg.MaxBuiltUpArea') }}</label>
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                        <div class="form-floating">
                            <input type="text" name="mnplt" class="form-control" placeholder="" value="{{ app('request')->input('mnplt') }}">
                            <label >{{ __('msg.MinPlotArea') }}</label>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                        <div class="form-floating">
                            <input type="text" name="mxplt" class="form-control" placeholder="" value="{{ app('request')->input('mxplt') }}">
                            <label >{{ __('msg.MaxPlotArea') }}</label>
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                        <div class="form-floating">
                            <select name="frsh" class="form-select" aria-label="Floating label select example">
                                <option value=""> {{  __('msg.Select') }}</option>
                                @foreach (config('constants.YesNo') as $val)
                                <option value="{{ $val }}" {{ (app('request')->input('frsh') == $val)? "selected": "" }}>{{ (app()->getLocale()=="ar")? config('constants.YesNoAr.'.$val) :$val  }}</option> 
                                @endforeach
                            </select>
                            <label>{{ __('msg.Furnished') }}</label>
                       </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                        <div class="form-floating">
                            <select  name="swm" class="form-select" aria-label="Floating label select example">
                                <option value="">{{  __('msg.Select') }}</option>
                                @foreach (config('constants.YesNo') as $val)
                                <option value="{{ $val }}" {{ (app('request')->input('swm') == $val)? "selected": "" }}>{{ (app()->getLocale()=="ar")? config('constants.YesNoAr.'.$val) :$val  }}</option> 
                                @endforeach
                            </select>
                            <label>{{ __('msg.Swimming Pool') }}</label>
                        </div>
                    </div>
                    @if(app('request')->input('adt') == "2")
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <select name="rd"  class="form-select" aria-label="Floating label select example">
                                    <option value="">{{  __('msg.Select') }}</option>
                                    @foreach (config('constants.YesNo') as $val)
                                    <option value="{{ $val }}" {{ (app('request')->input('rd') == $val)? "selected": "" }}>{{ (app()->getLocale()=="ar")? config('constants.YesNoAr.'.$val):  $val  }}</option> 
                                    @endforeach
                                </select>
                                <label>{{ __('msg.Rented') }}</label>
                            </div>
                        </div>
                        @endif
                    
                </div>
                    
                
                 {{-- Commercial Commercial Villa --}}

                 <div class="row afilters hidden g-3" id="f-11">
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <select  name="mnbt" class="form-select" aria-label="Floating label select example">
                                    <option value=""> {{  __('msg.Select') }}</option>
                                    @foreach (config('constants.BathRooms') as $key=>$baths)
                                    <option value="{{ $key }}" {{ (app('request')->input('mnbt') == $key)? "selected": "" }}>{{ $baths  }}</option> 
                                    @endforeach
                                </select>
                                <label>{{ __('msg.MinBathroom') }}</label>
                               </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                             <div class="form-floating">
                                    <select name="mxbt" class="form-select" aria-label="Floating label select example">
                                        <option value=""> {{  __('msg.Select') }}</option>
                                        @foreach (config('constants.BathRooms') as $key=>$baths)
                                        <option value="{{ $key }}" {{ (app('request')->input('mxbt') == $key)? "selected": "" }}>{{ $baths  }}</option> 
                                        @endforeach
                                    </select>
                                    <label>{{ __('msg.MaxBathroom') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <input type="text" name="mnfn" class="form-control" placeholder="" value="{{ app('request')->input('mnfn') }}">
                                <label>{{ __('msg.MinNumberOfFloors') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <input type="text" name="mxfn" class="form-control" placeholder="" value="{{ app('request')->input('mxfn') }}">
                                <label>{{ __('msg.MaxNumberOfFloors') }}</label>
                            </div>
                        </div>
                       
                       
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <input type="text" name="mnblt" class="form-control" placeholder="" value="{{ app('request')->input('mnblt') }}">
                                <label >{{ __('msg.MinBuiltUpArea') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <input type="text" name="mxblt" class="form-control" placeholder="" value="{{ app('request')->input('mxblt') }}">
                                <label >{{ __('msg.MaxBuiltUpArea') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <input type="text" name="mnplt" class="form-control" placeholder="" value="{{ app('request')->input('mnplt') }}">
                                <label >{{ __('msg.MinPlotArea') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <input type="text" name="mxplt" class="form-control" placeholder="" value="{{ app('request')->input('mxplt') }}">
                                <label >{{ __('msg.MaxPlotArea') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <select  name="swm" class="form-select" aria-label="Floating label select example">
                                    <option value="">{{  __('msg.Select') }}</option>
                                    @foreach (config('constants.YesNo') as $val)
                                    <option value="{{ $val }}" {{ (app('request')->input('swm') == $val)? "selected": "" }}>{{ (app()->getLocale()=="ar")? config('constants.YesNoAr.'.$val) :$val  }}</option> 
                                    @endforeach
                                </select>
                                <label>{{ __('msg.Swimming Pool') }}</label>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <select name="frsh" class="form-select" aria-label="Floating label select example">
                                    <option value=""> {{  __('msg.Select') }}</option>
                                    @foreach (config('constants.YesNo') as $val)
                                    <option value="{{ $val }}" {{ (app('request')->input('frsh') == $val)? "selected": "" }}>{{ (app()->getLocale()=="ar")? config('constants.YesNoAr.'.$val) :$val  }}</option> 
                                    @endforeach
                                </select>
                                <label>{{ __('msg.Furnished') }}</label>
                           </div>
                        </div>
                      
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <select name="ct" class="form-select" aria-label="Floating label select example">
                                    <option value="">{{  __('msg.Select') }}</option>
                                    @foreach (config('constants.CommercialType') as $commtype)
                                    <option value="{{ $commtype }}" {{ (app('request')->input('ct') == $commtype)? "selected": "" }}>{{ (app()->getLocale()=="ar")? config('constants.CommercialTypeAr.'.$commtype) :$commtype }}</option> 
                                    @endforeach
                                </select>
                                <label>{{ __('msg.Commercial Type') }}</label>
                            </div>
                        </div>

                        @if(app('request')->input('adt') == "2")
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-6 ps-2 pe-2">
                            <div class="form-floating">
                                <select name="rd"  class="form-select" aria-label="Floating label select example">
                                    <option value="">{{  __('msg.Select') }}</option>
                                    @foreach (config('constants.YesNo') as $val)
                                    <option value="{{ $val }}" {{ (app('request')->input('rd') == $val)? "selected": "" }}>{{ (app()->getLocale()=="ar")? config('constants.YesNoAr.'.$val):  $val  }}</option> 
                                    @endforeach
                                </select>
                                <label>{{ __('msg.Rented') }}</label>
                            </div>
                        </div>
                        @endif
                 </div>
               
            
        </div>
    </div>
</div>