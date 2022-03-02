@extends('dashboard.layouts.master')

@section('title')
    @lang('menu_category.menu_categories') . {{$place->name}}
@endsection

@section('active')
    places
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>@lang('menu_category.menu_categories') . {{$place->name}}</h1>
        </div>
    </div>
@endsection

@section('without-card')

    @foreach($menuCategories as $i =>  $category)
        <!-- Start Col-->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header text-center">
                    <h2 class="card-title font-large-2" >{{$category->name}}</h2>
                </div>
                <div class="card-content">
                    <img class="img-fluid" src="{{URL::to('public/files/categoryMenu/'. $category->image)}}" alt="{{$category->name}}">
                </div>
                <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                    <b class="badge badge{{$category->status == 1 ? '-success' : '-danger'}}">@lang('global.status_' .$category->status )</b>
                    <span class="float-right">

                         <div class="dropdown d-inline-block mx-2">
                           <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#editMenuCategory_{{$category->id}}">
                               <i class="la la-edit"></i>
                                @lang('global.edit')
                           </button>
                        <!-- Start Form-->
                         <form class="form form-horizontal" action="{{route('dashboard.place.category.update', [$place->id, $category->id])}}" method="post" enctype="multipart/form-data">
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
                             @csrf
                             {{method_field('put')}}
                             <!-- Modal -->
                             <div class="modal fade" id="editMenuCategory_{{$category->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h1 class="modal-title" id="exampleModalLabel">@lang('global.edit') {{$category->name}}</h1>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                     <div class="form-body">
                                            <h4 class="form-section"><i class="la la-folder-open"></i> @lang('global.name')</h4>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="name_ar">@lang('category.name_ar')</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="text" id="name_ar" class="form-control" placeholder="@lang('category.name_ar')" name="name_ar" value="{{$category->getTranslation('name', 'ar')}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="name_en">@lang('category.name_en')</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="text" id="name_en" class="form-control" placeholder="@lang('category.name_en')" name="name_en" value="{{$category->getTranslation('name', 'en')}}">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="name_en">@lang('category.name_ru')</label>
                                                <div class="col-md-9 mx-auto">
                                                    <input type="text" id="name_ru" class="form-control" placeholder="@lang('category.name_ru')" name="name_ru" value="{{$category->getTranslation('name', 'ru')}}">
                                                </div>

                                            </div>

                                        <h4 class="form-section"><i class="la la-file-image-o" style="font-size: 20px"></i> @lang('global.images')</h4>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="icon_category">@lang('category.icon_category')</label>
                                            <div class="col-md-8 mx-auto">
                                                <input type="file" id="icon_category" class="form-control" placeholder="@lang('category.icon_category')"  accept="image/jpeg , image/png ,image/gif,image/jpg, image/svg" name="icon_category" value="{{old('icon_category')}}">
                                            </div>
                                         <div class="col-md-1">
                                                    <img src="{{URL::to('public/files/categoryMenu/'. $category->image)}}" alt="{{$category->name}}" class="img-thumbnail shadow-1" style="border-radius: 50%; width: 75px; height: 75px" alt="">
                                                </div>
                                        </div>
                                        <h4 class="form-section"><i class="la la-cog" style="font-size: 20px"></i> @lang('global.setting')</h4>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="sorting">@lang('category.sorting')</label>
                                            <div class="col-md-9 mx-auto">
                                                <input type="number" min="0" id="sorting" class="form-control" placeholder="@lang('category.sorting')" name="sorting" value="{{$category->sort}}">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="status">@lang('global.status')</label>
                                            <div class="col-md-9 mx-auto">
                                                <select id="status" name="status" class="form-control">
                                                    <option disabled selected>@lang('global.choose') ... </option>
                                                    <option value="1"  {{$category->status === 1 ? 'selected' :''}}>@lang('global.active')</option>
                                                    <option value="0" {{$category->status === 0 ? 'selected' :''}}>@lang('global.deactivated')</option>
                                                </select>
                                            </div>
                                        </div>

                                        </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('global.close')</button>
                                    <button type="submit" class="btn btn-primary">@lang('global.edit')</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                         </form>
                     <!-- End Form-->
                       </div>


                      <div class="dropdown d-inline-block">
                           <button class="btn btn-outline-success btn-sm" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               <i class="la la-plus-circle"></i>
                                @lang('global.add')
                           </button>

                           <div class="dropdown-menu p-0" aria-labelledby="dropdownMenu3">
                               <a href="{{route("dashboard.place.menu.create", $place->id)}}" class="dropdown-item">@lang('place.add_menu')</a>
                           </div>
                       </div>
                    </span>
                </div>
            </div>
        </div>
        <!-- End Col-->
    @endforeach

        <div class="col-md-12 text-center">
            {{$menuCategories->links()}}
        </div>

@endsection


@section('script')
@endsection
