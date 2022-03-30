@extends('dashboard.layouts.master')

@section('title')
    @lang('sidebar.customers')
@endsection

@section('active')
    all_customers
@endsection
@section('card_title')
    @lang('sidebar.customers')
@endsection

@section('content')

    <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm mb-0 caption-top">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">@lang('customer.name')</th>
                <th scope="col">@lang('customer.email')</th>
                <th scope="col">@lang('customer.phone')</th>

            </tr>
            </thead>
           <tbody>
           @foreach($customers as $i =>  $customer)
               <tr class="p-0">
                   <td>{{$i + 1}}</td>
                   <td>{{$customer->name}}</td>
                   <td>{{$customer->email}}</td>
                   <td>{{$customer->phone}}</td>
               </tr>
           @endforeach
           </tbody>
        </table>
        {{$customers->links()}}
    </div>
@endsection


@section('script')
@endsection
