@extends('dashboard.layouts.master')

@section('title')
    @lang('place.add_media')
@endsection
@section('active')
    places
@endsection
@section('card_title')
    @lang('place.add_media')
@endsection

@section('content')
    <form action="{{route('dashboard.medias.store', $id)}}" method="post" class="form-group"  enctype="multipart/form-data">
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
        <h4 class="form-section"><i class="la la-globe"></i> @lang('place.image')</h4>
        <!-- Start Row -->
        <div class="row">
            <div class="col-md-6">
                <label for="images" class="">@lang('place.image')</label>
                <input type="file" name="images[]" id="images" class="form-control" accept="image/jpeg , image/png ,image/gif,image/jpg, image/svg" multiple>
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
