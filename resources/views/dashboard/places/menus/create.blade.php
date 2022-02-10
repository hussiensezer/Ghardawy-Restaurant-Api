@extends('dashboard.layouts.master')

@section('title')
    @lang('place.add_menu')
@endsection
@section('active')
    places
@endsection
@section('card_title')
    @lang('place.add_menu')
@endsection

@section('content')
    <form action="{{route('dashboard.menus.store', $place->id)}}" method="post" class="form-group"  enctype="multipart/form-data">
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
            <div class="col-md-6">
                <label for="name_ar">@lang('place.menu_name_ar')</label>
                <input type="text" class="form-control" id="name_ar" name="name_ar" placeholder="@lang('place.menu_name_ar')" value="{{old('name_ar')}}">
            </div>
            <div class="col-md-6">
                <label for="name_en">@lang('place.menu_name_en')</label>
                <input type="text" class="form-control" id="name_en" name="name_en" placeholder="@lang('place.menu_name_en')" value="{{old('name_en')}}">
            </div>
        </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="description_ar">@lang('place.menu_description_ar')</label>
                    <textarea name="description_ar" id="description_ar" cols="30" rows="5" class="form-control">{{old('description_ar')}}</textarea>
                </div>
                <div class="col-md-6">
                    <label for="description_en">@lang('place.menu_description_en')</label>
                    <textarea name="description_en" id="description_en" cols="30" rows="5" class="form-control">{{old('description_en')}}</textarea>
                </div>
            </div>
        <div class="row">
            <div class="col-md-6">
                <label for="image" class="">@lang('place.image')</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/jpeg , image/png ,image/gif,image/jpg, image/svg">
                <b class="d-block"><small class="text-danger mt-2">الصور يجب انت تكون من نوع {{config('setting.image.allow_extensions')}}  </small></b>
                <b class="d-block"><small class="text-danger"> حجم الصورة الايزيد عن {{config('setting.image.size')}} كيلو بايت</small></b>
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
    </form>
@endsection


@section('script')
@endsection
