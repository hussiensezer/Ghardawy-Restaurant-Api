@extends('dashboard.layouts.master')

@section('title')
    @lang('sidebar.orders')
@endsection

@section('active')
    all_orders
@endsection
@section('card_title')
    @lang('sidebar.orders')
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
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm mb-0 caption-top">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">@lang('order.id')</th>
                <th scope="col">@lang('order.place')</th>
                <th scope="col">@lang('order.customer')</th>
                <th scope="col">@lang('order.caption')</th>
                <th scope="col">@lang('order.total')</th>
                <th scope="col">@lang('order.status')</th>
                <th scope="col">@lang('order.show')</th>

            </tr>
            </thead>
           <tbody>
           @foreach($orders as $i =>  $order)
               <tr class="p-0">
                   <td>{{$i + 1}}</td>
                   <td>{{$order->id}}</td>
                   <td>{{$order->placeId->name}}</td>
                   <td>{{$order->customerId->name}}</td>
                   <td>{{!empty($order->captionId) ? $order->captionId->name : 'لا يوجد'}}</td>
                   <td>{{$order->total_price}}</td>
                   <td>{{$order->status}}</td>
                    <td>
                        <button class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#order_{{$order->id}}">
                            <i class="la la-eye"></i>
                        </button>
                        <!-- Modal -->
                            <div class="modal fade bd-example-modal-lg" id="order_{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-top modal-md " role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">@lang('order.order')</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-4 offset-4">
                                                        <img src="{{URL::asset('assets/app-assets/images/logo/logo.svg')}}" alt="logo" class="w-100">
                                                    </div>
                                                </div>
                                            <table class="table table-hover mt-2 ">
                                                <caption>

                                                </caption>
                                                <caption>
                                                   <span><strong>دليفرى : - </strong></span>
                                                    <span>{{$order->delivered_fees}}</span>
                                                    <span> جنية</span>
                                                </caption>
                                                <caption>
                                                    <span><strong>ضريبة القيمة المضافة : - </strong></span>
                                                    <span>{{$order->tax}}</span>
                                                    <span> %</span>
                                                </caption>
                                                <caption>
                                                    <span><strong> اجمالى الملبغ </strong></span>
                                                    <span class="totalOrderPrice">{{$order->tax}}</span>
                                                    <span> %</span>
                                                </caption>
                                                <thead>
                                                <tr>
                                                    <th scope="col">اسم</th>
                                                    <th scope="col">سعر</th>
                                                    <th scope="col">كمية</th>
                                                    <th scope="col">اجمالى</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($order->items as $item)
                                                    <tr class="table-active">
                                                        <th>{{$item->menuId->name}}</th>
                                                        <td>{{$item->price}}</td>
                                                        <td>{{$item->quantity}}</td>
                                                        <td class="item-total" data-item-price-total="{{($item->price * $item->quantity)}}">{{($item->price * $item->quantity)}}</td>
                                                    </tr>
                                                 @forelse($item->AddOns as $addOn)
                                                     <tr>
                                                         <td>{{$addOn->AddonId->name}}</td>
                                                         <td>{{$addOn->price}}</td>
                                                         <td>{{$addOn->quantity}}</td>
                                                         <td class="item-total" data-item-price-total="{{($addOn->price * $addOn->quantity)}}">{{($addOn->price * $addOn->quantity)}}</td>
                                                     </tr>
                                                 @empty
                                                 @endforelse
                                                @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('global.close')</button>
                                            <button type="submit" class="btn btn-primary">@lang('global.edit')</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </td>
               </tr>
           @endforeach
           </tbody>
        </table>
        {{$orders->links()}}
    </div>
@endsection


@section('script')
@endsection
