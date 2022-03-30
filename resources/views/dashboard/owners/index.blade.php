@extends('dashboard.layouts.master')

@section('title')
    @lang('sidebar.owners')
@endsection

@section('active')
    all_owners
@endsection
@section('card_title')
    @lang('sidebar.owners')
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
    <div class="create-owner">
        <button class="btn btn-success btn-sm mb-2" data-toggle="modal" data-target="#createowner">
            <i class="la la-plus"></i>
            @lang('global.add')
        </button>
        <!-- Modal -->
        <form action="{{route('dashboard.owners.store')}}" method="post">
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
                        <div class="modal-body">
                            <!-- Start Row-->
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">@lang('owner.name')</label>
                                    <input type="text" name="name" value="{{old('name')}}" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="phone">@lang('owner.phone')</label>
                                    <input type="text" name="phone" value="{{old('phone')}}" class="form-control">
                                </div>
                            </div>
                            <!-- End Row-->
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="email">@lang('owner.email')</label>
                                    <input type="email" name="email" value="{{old('email')}}" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="password">@lang('owner.password')</label>
                                    <input type="password" name="password"   class="form-control">

                                </div>

                                <div class="form-group col-md-4">
                                    <label for="password">@lang('owner.password_confirm')</label>
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
        <table class="table table-bordered table-hover table-sm mb-0 owner-top">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">@lang('owner.name')</th>
                <th scope="col">@lang('owner.email')</th>
                <th scope="col">@lang('owner.phone')</th>
                <th scope="col">@lang('owner.place')</th>
                <th scope="col">@lang('global.status')</th>
                <th scope="col">@lang('owner.id')</th>
                <th scope="col">@lang('global.edit')</th>

            </tr>
            </thead>
           <tbody>
           @foreach($owners as $i =>  $owner)
               <tr class="p-0">
                   <td>{{$i + 1}}</td>
                   <td>{{$owner->name}}</td>
                   <td>{{$owner->email}}</td>
                   <td>{{$owner->phone}}</td>
                   <td>{{!empty($owner->place) ? $owner->place->name : 'لا يوجد'}}</td>
                   <td>
                       <b class="badge badge{{$owner->status == 1 ? '-success' : '-danger'}}">@lang('global.status_' .$owner->status )</b>
                   </td>
                   <td>{{$owner->id}}</td>
                   <td>
                        <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#editowner_{{$owner->id}}">
                            <i class="la la-edit"></i>
                        </button>
                        <!-- Modal -->
                        <form action="{{route('dashboard.owners.update', $owner->id)}}" method="post">
                            @csrf
                            {{method_field('put')}}
                            <div class="modal fade bd-example-modal-lg" id="editowner_{{$owner->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-top modal-lg " role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">@lang('global.edit')</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Start Row-->
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="name">@lang('owner.name')</label>
                                                    <input type="text" name="name" value="{{$owner->name}}" class="form-control">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="email">@lang('owner.email')</label>
                                                    <input type="email" name="email" value="{{$owner->email}}" class="form-control">
                                                </div>
                                            </div>
                                            <!-- End Row-->
                                            <div class="row">

                                                <div class="form-group col-md-6">
                                                    <label for="password">@lang('owner.password')</label>
                                                    <input type="password" name="password"  class="form-control">
                                                    <small class="text-danger"> <strong>* ان لم تكن تريد تغير كلمة المرور اتركة فرغة</strong></small>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="status">@lang('global.status')</label>
                                                    <select id="status" name="status" class="form-control">
                                                        <option disabled selected>@lang('global.choose') ... </option>
                                                        <option value="1"  {{$owner->status === 1 ? 'selected' :''}}>@lang('global.active')</option>
                                                        <option value="0" {{$owner->status === 0 ? 'selected' :''}}>@lang('global.deactivated')</option>
                                                    </select>
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
                    </td>
               </tr>
           @endforeach
           </tbody>
        </table>
        {{$owners->links()}}
    </div>
@endsection


@section('script')
@endsection
