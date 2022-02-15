@extends('dashboard.layouts.master')

@section('title')
    @lang('sidebar.sizes')
@endsection

@section('active')
    all_sizes
@endsection
@section('card_title')
    @lang('sidebar.sizes')
@endsection

@section('content')

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm mb-0 caption-top">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">@lang('global.name')</th>
                <th scope="col">@lang('global.created_by')</th>
                <th scope="col">@lang('global.status')</th>
                <th scope="col">@lang('global.edit')</th>
            </tr>
            </thead>
           <tbody>
           @foreach($sizes as $i =>  $size)
               <tr class="p-0">
                   <td>{{$i + 1}}</td>
                   <td>{{$size->name}}</td>
                   <td>{{$size->adminId->name}}</td>
                   <td>
                       <b class="badge badge{{$size->status == 1 ? '-success' : '-danger'}} badge-sm">@lang('global.status_' .$size->status )</b>
                   </td>
                   <td>
                       <a href="{{route("dashboard.sizes.edit", $size->id)}}" class="btn btn-outline-primary btn-sm">
                           <i class="la la-edit"></i>
                       </a>
                   </td>
               </tr>
           @endforeach
           </tbody>
        </table>
        {{$sizes->links()}}
    </div>
@endsection


@section('script')
@endsection
