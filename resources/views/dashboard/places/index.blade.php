@extends('dashboard.layouts.master')

@section('title')
    @lang('sidebar.places')
@endsection

@section('active')
    all_places
@endsection
@section('card_title')
    @lang('sidebar.places')
@endsection

@section('content')

    <div class="py-5">
        <table class="table table-bordered table-hover table-sm mb-0 caption-top">
            <thead>
            <tr>
                <th colspan="col">#</th>
                <th colspan="col">@lang("place.name")</th>
                <th colspan="col">@lang('place.category')</th>
                <th colspan="col">@lang('place.owner')</th>
                <th colspan="col">@lang('global.status')</th>
                <th colspan="col">@lang('global.edit')</th>
                <th colspan="col">@lang('global.add')</th>
            </tr>
            </thead>
           <tbody>
           @foreach($places as $i =>  $place)
               <tr>
                    <td>{{$i + 1}}</td>
                    <td>{{$place->name}}</td>
                    <td>{{$place->categoryId->name}}</td>
                    <td>{{$place->ownerId->name}}</td>
                    <td>
                       <b class="badge badge{{$place->status == 1 ? '-success' : '-danger'}}">@lang('global.status_' .$place->status )</b>
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-outline-primary btn-sm" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-edit"></i>
                            </button>
                            <div class="dropdown-menu p-0" aria-labelledby="dropdownMenu2">
                                <a href="{{route("dashboard.places.edit", $place->id)}}" class="dropdown-item">@lang('place.edit_basic')</a>
                            </div>
                        </div>
                    </td>

                   <td>

                       <div class="dropdown">
                           <button class="btn btn-outline-success btn-sm" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               <i class="la la-plus-circle"></i>
                           </button>
                           <div class="dropdown-menu p-0" aria-labelledby="dropdownMenu3">

                           </div>
                       </div>
                   </td>
               </tr>
           @endforeach
           </tbody>
        </table>
        {{$places->links()}}
    </div>
@endsection


@section('script')
@endsection
