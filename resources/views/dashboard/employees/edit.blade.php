@extends('dashboard.layouts.master')

@section('title')
   تعديل موظف
@endsection
@section('active')
    all_employees
@endsection
@section('style')
@endsection
@section('card_title')
    تعديل موظف
@endsection

@section('content')
    <form class="form form-horizontal" action="{{route('dashboard.employees.update', $employee->id)}}" method="post" enctype="multipart/form-data">
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

                <!-- Start Row-->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="name">@lang('employee.name')</label>
                        <input type="text" name="name" value="{{$employee->name}}" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="password">@lang('employee.password')</label>
                        <input type="password" name="password"   class="form-control">
                        <small class="text-danger"> <strong>* ان لم تكن تريد تغير كلمة المرور اتركة فرغة</strong></small>

                    </div>
                </div>
                <!-- End Row-->

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="status">@lang('global.status')</label>
                        <select id="status" name="status" class="form-control">
                            <option disabled selected>@lang('global.choose') ... </option>
                            <option value="1"  {{$employee->status === 1 ? 'selected' :''}}>@lang('global.active')</option>
                            <option value="0" {{$employee->status  === 0 ? 'selected' :''}}>@lang('global.deactivated')</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>الصلاحيات</label>
                        <select name="role" class="form-control js-example-basic-single p-0">
                            <option disabled selected>اختار الصلاحية</option>
                            @foreach($rs as $role)
                                <option value="{{$role->id}}" {{!empty($userRole->id) && $userRole->id == $role->id ? 'selected' : ''}}> {{$role->name}}</option>
                            @endforeach
                        </select>
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

    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->
@endsection
