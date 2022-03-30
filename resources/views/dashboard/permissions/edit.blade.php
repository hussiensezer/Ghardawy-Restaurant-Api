@extends('dashboard.layouts.master')

@section('title')
    @lang('permission.edit_permission')
@endsection
@section('active')
    permissions
@endsection
@section('card_title')
    @lang('permission.edit_permission')
@endsection

@section('content')
    <form class="form form-horizontal" action="{{route('dashboard.permissions.update', $role->id)}}" method="post">
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
        <div class="form-body">
            <h4 class="form-section"><i class="la la-globe"></i> @lang('permission.setting')</h4>
            <div class="form-group row">
                <label class="col-md-3 label-control" for="name_ar">@lang('permission.name')</label>
                <div class="col-md-9 mx-auto">
                    <input type="text" id="name" class="form-control" placeholder="@lang('permission.name')" name="name" value="{{$role->name}}">
                </div>
            </div>
            <div class="form-group row">
                @foreach($permissions as $permission)
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="checkbox" name="permissions[]" id="{{$permission->name}}" value="{{$permission->id}}" {{in_array($permission->id, $rolePermissions) ? 'checked' : ''}}>
                            <label for="{{$permission->name}}"  class="">{{$permission->name}}</label>
                        </div>
                    </div>
                @endforeach
            </div>


        </div>

        <div class="form-actions row">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">
                    <i class="la la-edit"></i>
                    @lang('global.edit')
                </button>
            </div>
        </div>
    </form>
@endsection


@section('script')
@endsection
