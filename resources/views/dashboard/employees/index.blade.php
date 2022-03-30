@extends('dashboard.layouts.master')

@section('title')
    @lang('sidebar.all_employees')
@endsection

@section('active')
    all_employees
@endsection
@section('card_title')
    @lang('sidebar.all_employees')
@endsection

@section('content')
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
    <div class="create-employee">
        <button class="btn btn-success btn-sm mb-2" data-toggle="modal" data-target="#createemployee">
            <i class="la la-plus"></i>
            @lang('global.add')
        </button>
        <!-- Modal -->
        <form action="{{route('dashboard.employees.store')}}" method="post">
            @csrf
            {{method_field('post')}}
            <div class="modal fade bd-example-modal-lg" id="createemployee" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-top modal-lg " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">@lang('global.add')</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Start Row-->
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">@lang('employee.name')</label>
                                    <input type="text" name="name" value="{{old('name')}}" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="phone">@lang('employee.phone')</label>
                                    <input type="text" name="phone" value="{{old('phone')}}" class="form-control">
                                </div>
                            </div>
                            <!-- End Row-->
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="email">@lang('employee.email')</label>
                                    <input type="email" name="email" value="{{old('email')}}" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="password">@lang('employee.password')</label>
                                    <input type="password" name="password"   class="form-control">

                                </div>

                                <div class="form-group col-md-4">
                                    <label for="password">@lang('employee.password_confirm')</label>
                                    <input type="password" name="password_confirmation"  value="" class="form-control">

                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="status">@lang('global.status')</label>
                                    <select id="status" name="status" class="form-control">
                                        <option disabled selected>@lang('global.choose') ... </option>
                                        <option value="1"  {{old('status') === 1 ? 'selected' :''}}>@lang('global.active')</option>
                                        <option value="0" {{old('status')  === 0 ? 'selected' :''}}>@lang('global.deactivated')</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>الصلاحيات</label>
                                    <select name="role" class="form-control js-example-basic-single p-0">
                                        <option disabled selected>اختار الصلاحية</option>
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}" {{old("role") ==  $role->id ? 'selected' : ''}}> {{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('global.close')</button>
                            <button type="submit" class="btn btn-primary">@lang('global.add')</button>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm mb-0 employee-top">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">@lang('employee.name')</th>
                <th scope="col">@lang('employee.email')</th>
                <th scope="col">@lang('employee.phone')</th>
                <th scope="col">@lang('global.status')</th>
                <th scope="col">@lang('global.edit')</th>

            </tr>
            </thead>
           <tbody>
           @foreach($employees as $i =>  $employee)
               <tr class="p-0">
                   <td>{{$i + 1}}</td>
                   <td>{{$employee->name}}</td>
                   <td>{{$employee->email}}</td>
                   <td>{{$employee->phone}}</td>

                   <td>
                       <b class="badge badge{{$employee->status == 1 ? '-success' : '-danger'}}">@lang('global.status_' .$employee->status )</b>
                   </td>
                    <td>
                        <a class="btn btn-outline-primary btn-sm" href="{{route('dashboard.employees.edit', $employee->id)}}">
                            <i class="la la-edit"></i>
                        </a>
                    </td>
               </tr>
           @endforeach
           </tbody>
        </table>
        {{$employees->links()}}
    </div>
@endsection


@section('script')
@endsection
