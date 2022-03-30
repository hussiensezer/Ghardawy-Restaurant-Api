@extends('dashboard.layouts.master')

@section('title')
    @lang('sidebar.captions')
@endsection

@section('active')
    all_captions
@endsection
@section('card_title')
    @lang('sidebar.captions')
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
    <div class="create-Caption">
        <button class="btn btn-success btn-sm mb-2" data-toggle="modal" data-target="#createCaption">
            <i class="la la-plus"></i>
            @lang('global.add')
        </button>
        <!-- Modal -->
        <form action="{{route('dashboard.captions.store')}}" method="post">
            @csrf
            {{method_field('post')}}
            <div class="modal fade bd-example-modal-lg" id="createCaption" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                    <label for="name">@lang('caption.name')</label>
                                    <input type="text" name="name" value="{{old('name')}}" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="phone">@lang('caption.phone')</label>
                                    <input type="text" name="phone" value="{{old('phone')}}" class="form-control">
                                </div>
                            </div>
                            <!-- End Row-->
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="email">@lang('caption.email')</label>
                                    <input type="email" name="email" value="{{old('email')}}" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="password">@lang('caption.password')</label>
                                    <input type="password" name="password"   class="form-control">

                                </div>

                                <div class="form-group col-md-4">
                                    <label for="password">@lang('caption.password_confirm')</label>
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

                                <div class="form-group col-md-6">
                                    <label for="status">@lang('caption.online')</label>
                                    <select id="status" name="online" class="form-control">
                                        <option disabled selected>@lang('global.choose') ... </option>
                                        <option value="1"  {{old('online')  === 1 ? 'selected' :''}}>@lang('global.online_1')</option>
                                        <option value="0" {{old('online')  === 0 ? 'selected' :''}}>@lang('global.online_0')</option>
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
        <table class="table table-bordered table-hover table-sm mb-0 caption-top">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">@lang('caption.name')</th>
                <th scope="col">@lang('caption.email')</th>
                <th scope="col">@lang('caption.phone')</th>
                <th scope="col">@lang('caption.online')</th>
                <th scope="col">@lang('global.status')</th>
                <th scope="col">@lang('global.edit')</th>

            </tr>
            </thead>
           <tbody>
           @foreach($captions as $i =>  $caption)
               <tr class="p-0">
                   <td>{{$i + 1}}</td>
                   <td>{{$caption->name}}</td>
                   <td>{{$caption->email}}</td>
                   <td>{{$caption->phone}}</td>
                   <td>
                       <b class="badge badge{{$caption->online == 1 ? '-success' : '-danger'}}">@lang('global.online_' .$caption->status )</b>
                   </td>

                   <td>
                       <b class="badge badge{{$caption->status == 1 ? '-success' : '-danger'}}">@lang('global.status_' .$caption->status )</b>
                   </td>
                    <td>
                        <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#editCaption_{{$caption->id}}">
                            <i class="la la-edit"></i>
                        </button>
                        <!-- Modal -->
                        <form action="{{route('dashboard.captions.update', $caption->id)}}" method="post">
                            @csrf
                            {{method_field('put')}}
                            <div class="modal fade bd-example-modal-lg" id="editCaption_{{$caption->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                    <label for="name">@lang('caption.name')</label>
                                                    <input type="text" name="name" value="{{$caption->name}}" class="form-control">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="email">@lang('caption.email')</label>
                                                    <input type="email" name="email" value="{{$caption->email}}" class="form-control">
                                                </div>
                                            </div>
                                            <!-- End Row-->
                                            <div class="row">

                                                <div class="form-group col-md-6">
                                                    <label for="password">@lang('caption.password')</label>
                                                    <input type="password" name="password"  class="form-control">
                                                    <small class="text-danger"> <strong>* ان لم تكن تريد تغير كلمة المرور اتركة فرغة</strong></small>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="status">@lang('global.status')</label>
                                                    <select id="status" name="status" class="form-control">
                                                        <option disabled selected>@lang('global.choose') ... </option>
                                                        <option value="1"  {{$caption->status === 1 ? 'selected' :''}}>@lang('global.active')</option>
                                                        <option value="0" {{$caption->status === 0 ? 'selected' :''}}>@lang('global.deactivated')</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">


                                                <div class="form-group col-md-6">
                                                    <label for="status">@lang('caption.online')</label>
                                                    <select id="status" name="online" class="form-control">
                                                        <option disabled selected>@lang('global.choose') ... </option>
                                                        <option value="1"  {{$caption->online === 1 ? 'selected' :''}}>@lang('global.online_1')</option>
                                                        <option value="0" {{$caption->online === 0 ? 'selected' :''}}>@lang('global.online_0')</option>
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
        {{$captions->links()}}
    </div>
@endsection


@section('script')
@endsection
