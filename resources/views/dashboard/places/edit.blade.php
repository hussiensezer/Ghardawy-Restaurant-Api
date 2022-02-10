@extends('dashboard.layouts.master')

@section('title')
    @lang('place.edit_place')
@endsection
@section('active')
    places
@endsection
@section('card_title')
    @lang('place.edit_place')
@endsection

@section('content')


    <form method="post" action="{{route("dashboard.places.update", $place->id)}}" enctype="multipart/form-data">
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
        {{method_field('put')}}
        @csrf
        <div class="form-body">
            <h4 class="form-section"><i class="ft-user"></i>@lang('place.basic_information')</h4>
            <!-- Start Row -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name_ar">@lang('place.name_ar')</label>
                        <input type="text" id="name_ar" class="form-control" placeholder="@lang('place.name_ar')" name="name_ar" value="{{$place->getTranslation('name', 'ar')}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name_en">@lang('place.name_en')</label>
                        <input type="text" id="name_en" class="form-control" placeholder="@lang('place.name_en')" name="name_en" value="{{$place->getTranslation('name', 'en')}}">
                    </div>
                </div>
            </div>
            <!-- End Row-->
            <!-- Start Row-->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="description_ar">@lang('place.description_ar')</label>
                        <textarea class="form-control" name="description_ar" id="description_ar" id="" cols="15" rows="5">{{$place->getTranslation('description', 'ar')}}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="description_en">@lang('place.description_en')</label>
                        <textarea class="form-control" name="description_en" id="description_en" id="" cols="15" rows="5">{{$place->getTranslation('description', 'en')}}</textarea>
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
                                <option value="{{$country->id}}" {{$place->country_id == $country->id ? 'selected' : ''}}>{{$country->name}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="city">@lang('place.city')</label>
                        <select name="city" id="city" class="form-control">
                            <option disabled selected>@lang('global.choose') .....</option>
                            @foreach($cities as $city)
                                <option value="{{$city->id}}" {{$place->city_id == $city->id ? 'selected' : ''}}>{{$city->name}}</option>
                            @endforeach
                        </select>
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
                                <option value="{{$category->id}}" {{$place->category_id  == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                             @endforeach
                        </select>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sub_category">@lang('place.sub_category')</label>
                        <select name="sub_category" id="sub_category" class="form-control">
                            <option disabled selected>@lang('global.choose') .....</option>
                            @foreach($subCategories as $subCategory)
                                <option value="{{$subCategory->id}}" {{$place->subcategory_id == $subCategory->id ? 'selected' : ''}}>{{$subCategory->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <!-- End Row-->

            <!-- Start Row -->
            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="full_address">@lang('place.full_address')</label>
                        <input type="text" id="full_address" class="form-control" placeholder="@lang('place.full_address')" name="full_address" value="{{$place->full_address}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="longitude">@lang('place.longitude')</label>
                        <input type="number" min="-180" max="180" step=".1" id="longitude" class="form-control" placeholder="@lang('place.longitude')" name="longitude" value="{{$place->longitude}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="latitude">@lang('place.latitude')</label>
                        <input type="number" min="-90" max="90" step=".1" id="latitude" class="form-control" placeholder="@lang('place.latitude')" name="latitude" value="{{$place->latitude}}">
                    </div>
                </div>
            </div>
            <!-- End Row-->

            <!-- Start Row -->
            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="email">@lang('place.email')</label>
                        <input type="email" id="email" class="form-control" placeholder="@lang('place.email')" name="email" value="{{$place->email}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="website">@lang('place.website')</label>
                        <input type="url" id="website" class="form-control" placeholder="@lang('place.website')" name="website" value="{{$place->website}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="phone_number">@lang('place.phone_number')</label>
                        <input type="number" id="phone_number" class="form-control" placeholder="@lang('place.phone_number')" name="phone_number" value="{{$place->phone_number}}">
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
                        <input type="text" id="seo" class="form-control" placeholder="@lang('place.seo_title')" name="seo" value="{{$place->seo_title}}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="meta_description">@lang('place.meta_description')</label>
                        <input type="text" id="meta_description" class="form-control" placeholder="@lang('place.meta_description')" name="meta_desc" value="{{$place->meta_description}}">
                    </div>
                </div>
            </div>
            <!-- End Row -->

            <h4 class="form-section"><i class="la la-globe"></i> @lang('place.amenities')</h4>
            <!-- Start Row -->
            <div class="row" id="amenities">
               @foreach($amenities as $amenity)
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="checkbox" name="amenities[]" id="amenity_{{$amenity->id}}" value="{{$amenity->id}}" {{in_array($amenity->id, $placeAmenities) ? 'checked' : ''}}>
                            <label for="amenity_{{$amenity->id}}" class="">
                                {{$amenity->name}}
                                <img src="{{URL::to('public/files/amenities/' . $amenity->icon)}}" alt="{{$amenity->name}}" class="shadow img-thumbnail" style="width: 50px; height:50px ; border-radius: 50%">
                            </label>
                        </div>
                    </div>
               @endforeach
            </div>
            <!-- End Row -->

            <!-- End Row -->
            <h4 class="form-section"><i class="la la-globe"></i> @lang('place.image')</h4>
            <!-- Start Row -->
            <div class="row">
                <div class="col-md-6">
                    <label for="thumb" class="">@lang('place.thumbnail_image')</label>
                    <input type="file" name="thumb" id="thumb" class="form-control">
                </div>
                <div class="col-md-2">
                    <img  class="w-75 img-thumbnail" src="{{URL::to('public/files/places/thumb/'. $place->thumb)}}" alt="{{$place->getTranslation('name', 'en')}}">
                </div>
            </div>
            <!-- End Row -->
        <div class="form-actions row">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="la la-check-square-o"></i>
                    @lang('global.edit')
                </button>
            </div>
        </div>
        </div>
    </form>

@endsection


@section('script')
    <script src="{{URL::asset("assets/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js")}}"></script>
    <script src="{{URL::asset("assets/app-assets/js/scripts/forms/form-repeater.js")}}"></script>
    <script src="{{URL::asset("assets/main-assets/js/ajax/placeAjax.js")}}"></script>
    <script>
        $(document).ready(function(){

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
                       let langName = "{{App::getLocale()}}";
                        $.each(data,function(index,amenitiesArray){
                           amenities.append(`
                             <div class="col-md-3">
                                <div class="form-group">
                                    <input type="checkbox" name="amenities[]" id="amenity_${amenitiesArray.id}" value="${amenitiesArray.id}">
                                    <label for="amenity_${amenitiesArray.id}" class="">
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
