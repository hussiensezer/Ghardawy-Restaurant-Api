@extends('dashboard.layouts.master')

@section('title')
    @lang('sidebar.categories')
@endsection

@section('active')
    all_categories
@endsection
@section('card_title')
    @lang('sidebar.categories')
@endsection

@section('content')

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm mb-0 caption-top">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">@lang('global.name')</th>
                <th scope="col">@lang('category.sorting')</th>
                <th scope="col">@lang('category.image')</th>
                <th scope="col">@lang('global.created_by')</th>
                <th scope="col">@lang('global.status')</th>
                <th scope="col">@lang('global.edit')</th>
            </tr>
            </thead>
           <tbody>
           @foreach($categories as $i =>  $category)
               <tr class="p-0">
                   <td>{{$i + 1}}</td>
                   <td>{{str_limit($category->name,10)}}</td>
                   <td>{{$category->sorting}}</td>
                   <td>
                       <img src="{{URL::to('public/files/category/'. $category->category_image)}}" class="img-thumbnail shadow-1" style="border-radius: 50%; width: 50px; height: 50px" alt="">
                   </td>
                   <td>{{$category->adminId->name}}</td>
                   <td>
                       <b class="badge badge{{$category->status == 1 ? '-success' : '-danger'}} badge-sm">@lang('global.status_' .$category->status )</b>
                   </td>
                   <td>
                       <a href="{{route("dashboard.categories.edit", $category->id)}}" class="btn btn-outline-primary btn-sm">
                           <i class="la la-edit"></i>
                       </a>
                   </td>
               </tr>
           @endforeach
           </tbody>
        </table>
        {{$categories->links()}}
    </div>
@endsection


@section('script')
@endsection
