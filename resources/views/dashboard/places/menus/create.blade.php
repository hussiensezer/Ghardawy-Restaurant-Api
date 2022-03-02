@extends('dashboard.layouts.master')

@section('title')
    @lang('place.add_menu')  {{ ' '. $place->name}}
@endsection
@section('active')
    places
@endsection
@section('card_title')
    @lang('place.add_menu')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>{{$place->name}}</h1>
        </div>
    </div>
    <form action="{{route('dashboard.place.menu.store', $place->id)}}" method="post" class="form-group"  enctype="multipart/form-data">
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
        <!-- End Row -->
        <h4 class="form-section"><i class="la la-globe"></i> @lang('place.add_menu')</h4>
        <div class="row">
            <div class="col-md-4">
                <label for="name_ar">@lang('place.menu_name_ar')</label>
                <input type="text" class="form-control" id="name_ar" name="name_ar" placeholder="@lang('place.menu_name_ar')" value="{{old('name_ar')}}">
            </div>
            <div class="col-md-4">
                <label for="name_en">@lang('place.menu_name_en')</label>
                <input type="text" class="form-control" id="name_en" name="name_en" placeholder="@lang('place.menu_name_en')" value="{{old('name_en')}}">
            </div>
            <div class="col-md-4">
                <label for="name_en">@lang('place.menu_name_ru')</label>
                <input type="text" class="form-control" id="name_ru" name="name_ru" placeholder="@lang('place.menu_name_ru')" value="{{old('name_ru')}}">
            </div>
        </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="description_ar">@lang('place.menu_description_ar')</label>
                    <textarea name="description_ar" id="description_ar" cols="30" rows="5" class="form-control">{{old('description_ar')}}</textarea>
                </div>
                <div class="col-md-4">
                    <label for="description_en">@lang('place.menu_description_en')</label>
                    <textarea name="description_en" id="description_en" cols="30" rows="5" class="form-control">{{old('description_en')}}</textarea>
                </div>

                <div class="col-md-4">
                    <label for="description_ru">@lang('place.menu_description_ru')</label>
                    <textarea name="description_ru" id="description_ru" cols="30" rows="5" class="form-control">{{old('description_ru')}}</textarea>
                </div>
            </div>
        <div class="row mt-1">
            <div class="col-md-6">
                <label for="image" class="">@lang('place.image')</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/jpeg , image/png ,image/gif,image/jpg, image/svg">
                <b class="d-block"><small class="text-danger mt-2">الصور يجب انت تكون من نوع {{config('setting.image.allow_extensions')}}  </small></b>
                <b class="d-block"><small class="text-danger"> حجم الصورة الايزيد عن {{config('setting.image.size')}} كيلو بايت</small></b>
            </div>

            <div class="col-md-6">
                <label for="category_menu" class="">@lang('place.category_menu')</label>
                <select name="category_menu" id="category_menu" class="form-control">
                    <option disabled selected>@lang('global.choose') .... </option>
                    @foreach($place->menuCategories  as $mc)
                        <option value="{{$mc->id}}">{{$mc->name}}</option>
                    @endforeach
                </select>
            </div>

        </div>
            <h4 class="form-section"><i class="la la-globe"></i> @lang('place.sizes_prices')</h4>
            <!-- Start Row -->
            <div class="repeater-default">
                <div data-repeater-list="sizes">
                    <div data-repeater-item="">
                        <div class="row mb-1">
                            <div class="col-md-5">
                                <label for="size" class="">@lang('place.size')</label>
                                <select name="size" id="size" class="form-control">
                                    <option disabled selected>@lang('global.choose') .... </option>
                                    @foreach($sizes  as $size)
                                        <option value="{{$size->id}}">{{$size->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="am">@lang('place.price')</label>
                                <input type="number" min="1"  name="price" class="form-control" placeholder="@lang('place.price')">
                            </div>

                            <div class="col-md-1">
                                <label for="">@lang('global.delete')</label>
                                <button type="button" class="btn btn-danger" data-repeater-delete=""> <i class="ft-x"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group overflow-hidden mt-1">
                    <div class="col-12">
                        <button type="button" data-repeater-create class="btn btn-primary">
                            <i class="ft-plus"></i>
                            @lang('place.new_size')
                        </button>
                    </div>
                </div>
            </div>
            <!-- End Row -->

            <h4 class="form-section"><i class="la la-globe"></i> @lang('place.add_ons')</h4>


            <!-- Start Row -->
            <div class="repeater-default">
                <div data-repeater-list="addons">
                    <div data-repeater-item="" class="mb-3">
                        <div class="row mb-1">
                            <div class="col-md-4">
                                <label for="">@lang('place.add_ons_name_ar')</label>
                                <input type="text" name="addons_name_ar" class="form-control" placeholder="@lang('place.add_ons_name_ar')">
                            </div>
                            <div class="col-md-4">
                                <label for="">@lang('place.add_ons_name_en')</label>
                                <input type="text"  name="addons_name_en" class="form-control" placeholder="@lang('place.add_ons_name_en')">
                            </div>
                            <div class="col-md-4">
                                <label for="">@lang('place.add_ons_name_ru')</label>
                                <input type="text"  name="addons_name_ru" class="form-control" placeholder="@lang('place.add_ons_name_ru')">
                            </div>
                            <div class="col-md-6">
                                <label for="">@lang('place.add_ones_price')</label>
                                <input type="number"  name="addons_price" class="form-control" placeholder="@lang('place.add_ones_price')">
                            </div>


                            <div class="col-md-1">
                                <label for="">@lang('global.delete')</label>
                                <button type="button" class="btn btn-danger" data-repeater-delete=""> <i class="ft-x"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group overflow-hidden mt-2">
                    <div class="col-12">
                        <button type="button" data-repeater-create class="btn btn-primary">
                            <i class="ft-plus"></i>
                            @lang('place.add_addons')
                        </button>
                    </div>
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
            </div>
    </form>
@endsection


@section('script')
    <script src="{{URL::asset("assets/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js")}}"></script>
    <script src="{{URL::asset("assets/app-assets/js/scripts/forms/form-repeater.js")}}"></script>
@endsection
