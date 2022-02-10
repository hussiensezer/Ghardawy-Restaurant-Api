@extends('dashboard.layouts.master')

@section('title')
    @lang('sidebar.create_place')
@endsection
@section('active')
    create_place
@endsection
@section('style')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
@endsection
@section('card_title')
    @lang('sidebar.create_place')
@endsection

@section('content')


    <form method="post" action="{{route("dashboard.places.store")}}" enctype="multipart/form-data" id="createPlace">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert bg-danger alert-icon-left alert-arrow-left alert-dismissible mb-2" role="alert">
                    <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    {{$error}}
                </div>
            @endforeach
        @endif
        {{method_field('post')}}
        @csrf
            <div class="errors">

            </div>
        <div class="form-body">
            <h4 class="form-section"><i class="ft-user"></i>@lang('place.basic_information')</h4>
            <!-- Start Row -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name_ar">@lang('place.name_ar')</label>
                        <input type="text" id="name_ar" class="form-control" placeholder="@lang('place.name_ar')" name="name_ar" value="{{old('name_ar')}}">
                        <div class="alert alert-danger mt-1 d-none" style="color:white !important;"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name_en">@lang('place.name_en')</label>
                        <input type="text" id="name_en" class="form-control" placeholder="@lang('place.name_en')" name="name_en" value="{{old('name_en')}}">
                        <div class="alert alert-danger mt-1 d-none" style="color:white !important;"></div>
                    </div>
                </div>
            </div>
            <!-- End Row-->
            <!-- Start Row-->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="description_ar">@lang('place.description_ar')</label>
                        <textarea class="form-control" name="description_ar" id="description_ar" id="" cols="15" rows="5">{{old("description_ar")}}</textarea>
                        <div class="alert alert-danger mt-1 d-none" style="color:white !important;"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="description_en">@lang('place.description_en')</label>
                        <textarea class="form-control" name="description_en" id="description_en" id="" cols="15" rows="5">{{old("description_en")}}</textarea>
                        <div class="alert alert-danger mt-1 d-none" style="color:white !important;"></div>
                    </div>
                </div>
            </div>
            <!-- End Row-->

            <!-- Start Row -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="country">@lang('place.country')</label>
                        <select name="country" id="country" class="form-control">
                            <option disabled selected>@lang('global.choose') .....</option>
                            @foreach($countries as $country)
                                <option value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                        </select>
                        <div class="alert alert-danger mt-1 d-none" style="color:white !important;"></div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="city">@lang('place.city')</label>
                        <select name="city" id="city" class="form-control">
                            <option disabled selected>@lang('global.choose') .....</option>
                        </select>
                        <div class="alert alert-danger mt-1 d-none" style="color:white !important;"></div>
                    </div>
                </div>
            </div>
            <!-- End Row-->

            <!-- Start Row -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="category">@lang('place.category')</label>
                        <select name="category" id="category" class="form-control">
                            <option disabled selected>@lang('global.choose') .....</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                             @endforeach
                        </select>
                        <div class="alert alert-danger mt-1 d-none" style="color:white !important;"></div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sub_category">@lang('place.sub_category')</label>
                        <select name="sub_category" id="sub_category" class="form-control">
                            <option disabled selected>@lang('global.choose') .....</option>
                        </select>
                        <div class="alert alert-danger mt-1 d-none" style="color:white !important;"></div>
                    </div>
                </div>
            </div>
            <!-- End Row-->

            <!-- Start Row -->
            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="full_address">@lang('place.full_address')</label>
                        <input type="text" id="full_address" class="form-control" placeholder="@lang('place.full_address')" name="full_address" value="{{old('full_address')}}">
                        <div class="alert alert-danger mt-1 d-none" style="color:white !important;"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="longitude">@lang('place.longitude')</label>
                        <input type="number" min="-180" max="180" step=".1" id="longitude" class="form-control" placeholder="@lang('place.longitude')" name="longitude" value="{{old('longitude')}}">
                        <div class="alert alert-danger mt-1 d-none" style="color:white !important;"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="latitude">@lang('place.latitude')</label>
                        <input type="number" min="-90" max="90" step=".1" id="latitude" class="form-control" placeholder="@lang('place.latitude')" name="latitude" value="{{old('latitude')}}">
                        <div class="alert alert-danger mt-1 d-none" style="color:white !important;"></div>
                    </div>
                </div>
            </div>
            <!-- End Row-->

            <!-- Start Row -->
            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="email">@lang('place.email')</label>
                        <input type="email" id="email" class="form-control" placeholder="@lang('place.email')" name="email" value="{{old('email')}}">
                        <div class="alert alert-danger mt-1 d-none" style="color:white !important;"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="website">@lang('place.website')</label>
                        <input type="url" id="website" class="form-control" placeholder="@lang('place.website')" name="website" value="{{old('website')}}">
                        <div class="alert alert-danger mt-1 d-none" style="color:white !important;"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="phone_number">@lang('place.phone_number')</label>
                        <input type="number" id="phone_number" class="form-control" placeholder="@lang('place.phone_number')" name="phone_number" value="{{old('phone_number')}}">
                        <div class="alert alert-danger mt-1 d-none" style="color:white !important;"></div>
                    </div>
                </div>
            </div>
            <!-- End Row-->

            <h4 class="form-section"><i class="la la-globe"></i> @lang('place.dlne_seo')</h4>
            <!-- Start Row -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="seo">@lang('place.seo_title')</label>
                        <input type="text" id="seo" class="form-control" placeholder="@lang('place.seo_title')" name="seo" value="{{old('seo')}}">
                        <div class="alert alert-danger mt-1 d-none" style="color:white !important;"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="meta_description">@lang('place.meta_description')</label>
                        <input type="text" id="meta_description" class="form-control" placeholder="@lang('place.meta_description')" name="meta_desc" value="{{old('seo')}}">
                        <div class="alert alert-danger mt-1 d-none" style="color:white !important;"></div>
                    </div>
                </div>
            </div>
            <!-- End Row -->

            <h4 class="form-section"><i class="la la-globe"></i> @lang('place.amenities')</h4>
            <!-- Start Row -->
            <div class="row" id="amenities">
                <div class="alert alert-danger mt-1 d-none" style="color:white !important;"></div>
            </div>
            <!-- End Row -->

            <h4 class="form-section"><i class="la la-globe"></i> @lang('place.opening_hours')</h4>
            <!-- Start Row -->
            <div class="repeater-default">
                <div data-repeater-list="opening_hours">
                    <div data-repeater-item="">
                        <div class="row mb-1">
                            <div class="col-md-3">
                                <label for="opening_hours" class="">اليوم</label>
                                <select name="days" id="opening_hours" class="form-control">
                                        @foreach($days  as $day)
                                        <option value="{{$day->id}}">{{$day->name}}</option>
                                        @endforeach
                                </select></div>
                            <div class="col-md-4">
                                <label for="am">@lang('place.am')</label>
                                <input type="number" min="1" max="12" name="am" class="form-control" placeholder="@lang('place.am')"></div>
                            <div class="col-md-4">
                                <label for="pm">@lang('place.pm')</label>
                                <input type="number" name="pm" min="1" max="12" class="form-control" placeholder="@lang('place.pm')"></div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-danger" data-repeater-delete=""> <i class="ft-x"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group overflow-hidden mt-1">
                    <div class="col-12">
                        <button type="button" data-repeater-create class="btn btn-primary">
                            <i class="ft-plus"></i>
                            @lang('place.new_day')
                        </button>
                    </div>
                </div>
            </div>
            <!-- End Row -->
            <h4 class="form-section"><i class="la la-globe"></i> @lang('place.social_networks')</h4>
            <div class="repeater-default">
                <div data-repeater-list="social_networks">
                    <div data-repeater-item="">
                        <div class="row">
                            <div class="col-md-4">
                                <select name="socials" id="" class="form-control">
                                    <option disabled selected>@lang('global.choose') ....</option>
                                    @foreach($socials as $social)
                                        <option value="{{$social->id}}">{{$social->name}}</option>
                                    @endforeach
                                </select></div>
                            <div class="col-md-7">
                                <input type="url" name="links" id="" class="form-control" placeholder="@lang("place.link")"></div>
                            <div class="form-group col-md-1 text-center">
                                <button type="button" class="btn btn-danger" data-repeater-delete=""> <i class="ft-x"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group overflow-hidden">
                    <div class="col-12">
                        <button type="button" data-repeater-create class="btn btn-primary">
                            <i class="ft-plus"></i>
                            @lang('place.new_social_link')
                        </button>
                    </div>
                </div>
            </div>

            <!-- End Row -->
            <h4 class="form-section"><i class="la la-globe"></i> @lang('place.image')</h4>
            <!-- Start Row -->
            <div class="row">
                <div class="col-md-6">
                    <label for="thumb" class="">@lang('place.thumbnail_image')</label>
                    <input type="file" name="thumb" id="thumb" class="form-control">
                    <div class="alert alert-danger mt-1 d-none" style="color:white !important;"></div>
                </div>

            </div>
            <!-- End Row -->
        <div class="form-actions row">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-success">
                    <i class="la la-check-square-o"></i>
                    @lang('global.create')
                </button>
            </div>
            <div class="col-md-12 my-2">
                <div class="form-group">
                    <div class="progress d-none">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                        <div class="status">0%</div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </form>
    <div class="swal2-container swal2-rtl swal2-center swal2-fade swal2-shown d-none" style="overflow-y: auto;">
        <div aria-labelledby="swal2-title" aria-describedby="swal2-content" class="swal2-popup swal2-modal swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: flex;">
            <div class="swal2-header"><div class="swal2-icon swal2-error swal2-animate-error-icon" style="display: flex;">
                    <span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span>
                        <span class="swal2-x-mark-line-right"></span>
                    </span>
                </div>
                <h2 class="swal2-title" id="swal2-title" style="display: flex;">@lang('global.error')</h2>
            </div>
            <div class="swal2-content">
                <div id="swal2-content" style="display: block;"> @lang('global.there_some_error_reenter_data')</div>
            </div>
            <div class="swal2-actions" style="display: flex;">
                <button type="button" class="swal2-confirm btn btn-primary" aria-label="">@lang('global.close')</button>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="{{URL::asset("assets/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js")}}"></script>
    <script src="{{URL::asset("assets/app-assets/js/scripts/forms/form-repeater.js")}}"></script>
    <script src="{{URL::asset("assets/app-assets/vendors/js/extensions/sweetalert2.all.min.js")}}"></script>
    <script src="{{URL::asset("assets/app-assets/vendors/js/extensions/polyfill.min.js")}}"></script>
    <script src="{{URL::asset("assets/app-assets/js/scripts/extensions/ex-component-sweet-alerts.js")}}"></script>
    <script>
        $(document).ready(function(){
            $(".swal2-confirm").on('click',function(e) {
                $("div.swal2-container").addClass('d-none');
            });
            $("#createPlace").on('submit',function (e) {
                e.preventDefault();
                let action  = $(this).attr('action'),
                    method  = $(this).attr('method'),
                   formData = new FormData(this);
                $.ajax({
                    xhr: function() {
                        let xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                let percentComplete = Math.ceil(evt.loaded / evt.total  * 100);
                                console.log(percentComplete);
                                $(".progress").removeClass("d-none");
                                $(".progress-bar").css("width", percentComplete+'%', function() {
                                    return $(this).attr("aria-valuenow", percentComplete) + "%";
                                })
                                $(".status").html(percentComplete + "%")
                            }
                        }, false);
                        // }
                        return xhr;
                    },

                    url: action,
                    data: formData,
                    async: true,
                    timeout: 60000,
                    cache:false,
                    contentType: false,
                    processData: false,
                    type: method,
                    success: function (data) {
                        console.log(data);
                        if(data.status == true){
                            alert("تم ادخال الوحدة بنجاح");
                            location.reload();
                        }
                    },// End Success
                    error:function (jqXHR,textStatus,errorThrown) {
                        $(".progress-bar").removeClass("bg-success").addClass("bg-danger");
                        $("div.swal2-container").removeClass("d-none");
                        $('.errors').empty();
                        if(jqXHR.status === 422) {
                            let errors = jqXHR.responseJSON.errors;
                            $.each(errors,function (id,data) {
                                $('.errors').append(`
                                             <div class="alert bg-danger alert-icon-left alert-arrow-left alert-dismissible mb-2" role="alert">
                                            <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                           ${data}
                                </div>`);
                            })

                        }// End If
                    }// End Error
                });// End Ajax
            });// End Create Place

            $("#country").on('change',function (e) {
                e.preventDefault();
                let countryValue = $(this).val(),
                    citySelect = $("#city");
                $.ajax({
                    url: "{{URL::to("dashboard/places/getCity")}}/" + countryValue,
                    type: 'GET',
                    dataType: "json",
                    success: function (data,url) {
                        citySelect.empty();
                        $.each(data,function(index,cities){
                            citySelect.append(`
                                <option value='${cities.id}'> ${cities.cityName}</option>
                            `);
                        });
                    },
                    error:function (jqXHR,textStatus,errorThrown) {
                        alert("Country error to found data Error "  + jqXHR + ' ' + textStatus + ' ' + errorThrown );
                    }
                });
            })//End Country Ajax

            $("#category").on('change', function (e) {
                e.preventDefault();
                let CategoryValue = $(this).val(),
                    subCategorySelect = $('#sub_category');
                $.ajax({
                    url: "{{URL::to("dashboard/places/getSubCategory")}}/" + CategoryValue,
                    type: 'GET',
                    dataType: "json",
                    success: function (data,url) {
                        subCategorySelect.empty();
                        $.each(data,function(index,subCategory){
                            subCategorySelect.append(`
                                <option value='${subCategory.id}'> ${subCategory.subCategoryName}</option>
                            `);
                        });
                    },
                    error:function (jqXHR,textStatus,errorThrown) {
                        alert("SubCategory error to found data Error "  + jqXHR + ' ' + textStatus + ' ' + errorThrown );
                    }
                });// End Ajax
            });// End Get Sub Of Category


            $("#category").on('change', function (e) {
                e.preventDefault();
                let CategoryValue = $(this).val(),
                    amenities = $('#amenities'),
                    iconAmenities = "{{URL::to('public/files/amenities')}}/";

                $.ajax({
                    url: "{{URL::to("dashboard/places/getAmenities")}}/" + CategoryValue,
                    type: 'GET',
                    dataType: "json",
                    success: function (data,url) {
                        amenities.empty();
                        $.each(data,function(index,amenitiesArray){
                           amenities.append(`
                             <div class="col-md-3">
                                <div class="form-group">
                                    <input type="checkbox" name="amenities[]" id="amenity_${amenitiesArray.id}" value="${amenitiesArray.id}">
                                    <label for="amenity_${amenitiesArray.id}"" class="">
                                        ${amenitiesArray.amenityName}
                                        <img src="${iconAmenities + amenitiesArray.icon}" alt="" class="shadow img-thumbnail" style="width: 50px; height:50px ; border-radius: 50%">
                                    </label>
                                </div>
                             </div>
                           `);
                        });

                    },
                    error:function (jqXHR,textStatus,errorThrown) {
                        alert("Amenities error to found data Error "  + jqXHR + ' ' + textStatus + ' ' + errorThrown );
                    }
                });// End Ajax
            });// End Get Sub Of Category

        });// End Document Ready

    </script>
@endsection
