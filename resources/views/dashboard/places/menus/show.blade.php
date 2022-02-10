@extends('dashboard.layouts.master')

@section('title')
    @lang('place.menu')
@endsection
@section('active')
    places
@endsection
@section('card_title')
    @lang('place.menu')
@endsection

@section('without-card')
    @foreach($menus as $menu)
        <div class="col-md-3">
            <div class="card p-0">
                <div class="card-content">
                    <img class="card-img-top img-fluid" src="{{URL::to('public/files/places/menu/'. $menu->path_image)}}" alt="{{$menu->name}}">
                    <div class="card-body">
                        <h4 class="card-title">{{$menu->name}}</h4>
                        <p class="card-text">{{$menu->description}}</p>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <button class="float-left btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#menu_{{$menu->id}}" data-whatever="@ {{$menu->name}}">
                        <i class="la la-edit"></i>
                        @lang('global.edit')
                    </button>
                    <span class="float-right">
                        <button class="float-left btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete_{{$menu->id}}">
                        <i class="la la-trash"></i>
                        @lang('global.delete')
                    </button>
                    </span>
                </div>
            </div>
        </div>
        <!-- Start Edit Model-->
        <div class="modal fade" id="menu_{{$menu->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{$menu->name}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form  action="{{route("dashboard.menus.update", $menu->id)}}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        {{method_field('put')}}
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name_ar">@lang('place.menu_name_ar')</label>
                                <input type="text" class="form-control" id="name_ar" name="name_ar" placeholder="@lang('place.menu_name_ar')" value="{{$menu->getTranslation('name', 'ar')}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name_en">@lang('place.menu_name_en')</label>
                                <input type="text" class="form-control" id="name_en" name="name_en" placeholder="@lang('place.menu_name_en')" value="{{$menu->getTranslation('name', 'en')}}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="description_ar">@lang('place.menu_description_ar')</label>
                                <textarea name="description_ar" id="description_ar" cols="30" rows="3" class="form-control">{{$menu->getTranslation('description', 'ar')}}</textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="description_en">@lang('place.menu_description_en')</label>
                                <textarea name="description_en" id="description_en" cols="30" rows="3" class="form-control">{{$menu->getTranslation('description', 'en')}}</textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="image" class="">@lang('place.image')</label>
                                <input type="file" name="image" id="image" class="form-control" accept="image/jpeg , image/png ,image/gif,image/jpg, image/svg">
                                <b class="d-block"><small class="text-danger mt-2">الصور يجب انت تكون من نوع {{config('setting.image.allow_extensions')}}  </small></b>
                                <b class="d-block"><small class="text-danger"> حجم الصورة الايزيد عن {{config('setting.image.size')}} كيلو بايت</small></b>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">@lang('global.edit')</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Edit Model-->

        <!-- Start Destroy Model-->
        <!-- Modal -->
        <div class="modal fade" id="delete_{{$menu->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">@lang('global.delete')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('dashboard.menus.destroy', $menu->id)}}" method="post">
                        @csrf
                        {{method_field('delete')}}
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" value="{{$menu->name}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">@lang('global.close')</button>
                            <button type="submit" class="btn btn-outline-danger">@lang('global.delete')</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- End Destroy Model-->
    @endforeach
    <div class="col-md-12 text-center">
        {{$menus->links()}}
    </div>
@endsection


@section('script')
@endsection
