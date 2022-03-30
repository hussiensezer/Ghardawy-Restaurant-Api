@extends('dashboard.layouts.master')

@section('title')
    @lang('sidebar.permissions')
@endsection

@section('active')
    all_permissions
@endsection
@section('card_title')
    @lang('sidebar.permissions')
@endsection

@section('content')
    <div class="create-owner">
        <button class="btn btn-success btn-sm mb-2" data-toggle="modal" data-target="#createowner">
            <i class="la la-plus"></i>
            @lang('global.add')
        </button>
        <!-- Modal -->
        <form action="{{route('dashboard.permissions.store')}}" method="post">
            @csrf
            {{method_field('post')}}
            <div class="modal fade bd-example-modal-lg" id="createowner" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-top modal-lg " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">@lang('global.add')</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="model-body">
                          <div class="row">
                              <div class=" col-md-12 row text-center mt-2">
                                  <label class="col-md-9 my-auto label-control" for="name_ar">اسم الصلاحية</label>
                                  <div class="col-md-12 my-auto">
                                      <input type="text" id="name" class="form-control" placeholder="اسم الصلاحية" name="name" value="{{old('name')}}">
                                  </div>
                              </div>
                              <div class=" col-md-12 row text-center mt-2">
                                  @foreach($permissions as $permission)
                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <input type="checkbox" name="permissions[]" id="{{$permission->name}}" value="{{$permission->id}}">
                                              <label for="{{$permission->name}}"  class="">{{$permission->name}}</label>
                                          </div>
                                      </div>
                                  @endforeach
                              </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('global.close')</button>
                            <button type="submit" class="btn btn-primary">@lang('global.add')</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm mb-0 caption-top">
            <thead>
            <tr>
                <th colspan="col">#</th>
                <th colspan="col">@lang("global.name")</th>
                <th colspan="col">@lang('global.edit')</th>
                <th colspan="col">@lang('global.delete')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($roles as $i =>  $role)
                <tr>
                    <td>{{$i + 1}}</td>
                    <td>{{$role->name}}</td>
                    @if($role->name !== 'Super Admin')
                        <td>
                            @can('permission_edit')
                                <a href="{{route("dashboard.permissions.edit", $role->id)}}" class="btn btn-outline-primary btn-sm">
                                    <i class="la la-edit"></i>
                                </a>
                            @endcan
                        </td>

                        <td>

                            <!-- Button trigger modal -->
                                <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#role_{{$role->id}}">
                                    <i class="la la-trash"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="role_{{$role->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form action="{{route("dashboard.permissions.destroy", $role->id)}}" method="post">
                                            {{method_field('delete')}}
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">@lang('global.delete')</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="text" disabled value="{{$role->name}}" class="form-control">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">@lang('global.close')</button>
                                                    <button type="submit" class="btn btn-outline-danger">
                                                        @lang('global.delete')
                                                        <i class="la la-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>

                        </td>
                    @else
                        <td></td>
                        <td></td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$roles->links()}}
    </div>
@endsection


@section('script')
@endsection
