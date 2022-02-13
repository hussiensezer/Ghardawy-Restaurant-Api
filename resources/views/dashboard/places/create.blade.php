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
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name_ar">@lang('place.name_ar')</label>
                        <input type="text" id="name_ar" class="form-control" placeholder="@lang('place.name_ar')" name="name_ar" value="{{old('name_ar')}}">
                        <div class="alert alert-danger mt-1 d-none" style="color:white !important;"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name_en">@lang('place.name_en')</label>
                        <input type="text" id="name_en" class="form-control" placeholder="@lang('place.name_en')" name="name_en" value="{{old('name_en')}}">
                        <div class="alert alert-danger mt-1 d-none" style="color:white !important;"></div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name_ru">@lang('place.name_ru')</label>
                        <input type="text" id="name_ru" class="form-control" placeholder="@lang('place.name_ru')" name="name_ru" value="{{old('name_ru')}}">
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
                        <label for="owner">@lang('place.owner')</label>
                        <input type="text" class="form-control" name="owner" id="owner" placeholder="@lang('place.owner')">
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
                        <label for="email">@lang('place.email')</label>
                        <input type="email" id="email" class="form-control" placeholder="@lang('place.email')" name="email" value="{{old('email')}}">
                        <div class="alert alert-danger mt-1 d-none" style="color:white !important;"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="phone_number">@lang('place.phone_number')</label>
                        <input type="number" id="phone_number" class="form-control" placeholder="@lang('place.phone_number')" name="phone" value="{{old('phone')}}">
                        <div class="alert alert-danger mt-1 d-none" style="color:white !important;"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="working_hours">@lang('place.working_hours')</label>
                        <input type="number" id="working_hours" class="form-control" placeholder="@lang('place.working_hours')" name="working_hours" value="{{old('working_hours')}}">
                        <div class="alert alert-danger mt-1 d-none" style="color:white !important;"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address">@lang('place.address')</label>
                        <input type="text" id="address" class="form-control" placeholder="@lang('place.address')" name="address" value="{{old('address')}}">
                        <div class="alert alert-danger mt-1 d-none" style="color:white !important;"></div>
                    </div>
                </div>
            </div>

            <!-- End Row-->

            <!-- Start Row -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="longitude">@lang('place.longitude')</label>
                        <input type="number" min="-180" max="180" step=".1" id="longitude" class="form-control" placeholder="@lang('place.longitude')" name="longitude" value="{{old('longitude')}}">
                        <div class="alert alert-danger mt-1 d-none" style="color:white !important;"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="latitude">@lang('place.latitude')</label>
                        <input type="number" min="-90" max="90" step=".1" id="latitude" class="form-control" placeholder="@lang('place.latitude')" name="latitude" value="{{old('latitude')}}">
                        <div class="alert alert-danger mt-1 d-none" style="color:white !important;"></div>
                    </div>
                </div>
            </div>

            </div>
            <!-- End Row-->

            <h4 class="form-section"><i class="la la-globe"></i> @lang('place.expenses')</h4>
            <!-- Start Row-->
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="tax">@lang('place.tax')</label>
                        <input type="number" id="tax" class="form-control" placeholder="@lang('place.tax')" name="tax" value="{{old('tax')}}">
                        <div class="alert alert-danger mt-1 d-none" style="color:white !important;"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="fees">@lang('place.fees')</label>
                        <input type="number" id="fees" class="form-control" placeholder="@lang('place.fees')" name="fees" value="{{old('fees')}}">
                        <div class="alert alert-danger mt-1 d-none" style="color:white !important;"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="phone_number">@lang('place.delivers')</label>
                        <input type="number" id="delivers" class="form-control" placeholder="@lang('place.delivers')" name="delivers" value="{{old('delivers')}}">
                        <div class="alert alert-danger mt-1 d-none" style="color:white !important;"></div>
                    </div>
                </div>
            </div>
            <!-- End Row-->

            <h4 class="form-section"><i class="la la-globe"></i> @lang('place.image')</h4>
            <!-- Start Row -->
            <div class="row">
                <div class="col-md-6">
                    <label for="thumb" class="">@lang('place.thumbnail_image')</label>
                    <input type="file" name="thumb" id="thumb" class="form-control">
                    <div class="alert alert-danger mt-1 d-none" style="color:white !important;"></div>
                </div>

                <div class="col-md-6">
                    <label for="banner" class="">@lang('place.banner_image')</label>
                    <input type="file" name="banner" id="banner" class="form-control">
                    <div class="alert alert-danger mt-1 d-none" style="color:white !important;"></div>
                </div>
            </div>
            <!-- End Row -->

            <h4 class="form-section"><i class="la la-globe"></i> @lang('place.setting')</h4>
            <div class="form-group">
                <label class="label-control" for="status">@lang('global.status')</label>
                <div class="">
                    <select id="status" name="status" class="form-control">
                        <option disabled selected>@lang('global.choose') ... </option>
                        <option value="1"  {{old('status') === 1 ? 'selected' :''}}>@lang('global.active')</option>
                        <option value="0" {{old('status') === 0 ? 'selected' :''}}>@lang('global.deactivated')</option>
                    </select>
                </div>
            </div>

        <div class="form-actions row">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-success">
                    <i class="la la-check-square-o"></i>
                    @lang('global.create')
                </button>
            </div>
        </div>
        </div>
    </form>
@endsection


@section('script')
@endsection
