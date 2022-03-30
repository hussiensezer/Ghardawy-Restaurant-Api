@extends('dashboard.layouts.master')

@section('title')
    @lang('sidebar.home')
@endsection
@section('active')
    home
@endsection
@section('card_title')
    @lang('sidebar.home')
@endsection

@section('without-card')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <!--Start -->

            <div class="col-xl-3 col-md-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="p-2 text-center bg-info bg-darken-2 rounded-left">
                                <i class="icon-camera font-large-2 text-white"></i>
                            </div>
                            <div class="p-2 bg-info text-white media-body rounded-right">
                                <h5 class="text-white"> المنتجات اليوم</h5>
                                <h5 class="text-white text-bold-400 mb-0">{{$todayMenus}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="p-2 text-center bg-danger bg-darken-2 rounded-left">
                                <i class="icon-user font-large-2 text-white"></i>
                            </div>
                            <div class="p-2 bg-danger text-white media-body rounded-right">
                                <h5 class="text-white">العملاء</h5>
                                <h5 class="text-white text-bold-400 mb-0">{{$customers}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="p-2 text-center bg-success bg-darken-2 rounded-left">
                                <i class="icon-basket-loaded font-large-2 text-white"></i>
                            </div>
                            <div class="p-2 bg-success text-white media-body rounded-right">
                                <h5 class="text-white">عدد الطلبات اليوم</h5>
                                <h5 class="text-white text-bold-400 mb-0">{{$ordersToday}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="p-2 text-center bg-warning bg-darken-2 rounded-left">
                                <i class="icon-wallet font-large-2 text-white"></i>
                            </div>
                            <div class="p-2 bg-warning text-white media-body rounded-right">
                                <h5 class="text-white"> معاملات اليوم</h5>
                                <h5 class="text-white text-bold-400 mb-0">{{$totalOrdersToday}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3 col-md-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="p-2 bg-warning text-white media-body text-left rounded-left">
                                <h5 class="text-white">عدد الامكان</h5>
                                <h5 class="text-white text-bold-400 mb-0">{{$places}}</h5>
                            </div>
                            <div class="p-2 text-center bg-warning bg-darken-2 rounded-right">
                                <i class="icon-camera font-large-2 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="p-2 bg-success text-white media-body text-left rounded-left">
                                <h5 class="text-white">ملاك الاماكن</h5>
                                <h5 class="text-white text-bold-400 mb-0">{{$owners}}</h5>
                            </div>
                            <div class="p-2 text-center bg-success bg-darken-2 rounded-right">
                                <i class="icon-user font-large-2 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="p-2 bg-danger text-white media-body text-left rounded-left">
                                <h5 class="text-white">كل الطلبات </h5>
                                <h5 class="text-white text-bold-400 mb-0">{{$allOrders}}</h5>
                            </div>
                            <div class="p-2 text-center bg-danger bg-darken-2 rounded-right">
                                <i class="icon-basket-loaded font-large-2 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="p-2 bg-info text-white media-body text-left rounded-left">
                                <h5 class="text-white">اجمالى التعاملات</h5>
                                <h5 class="text-white text-bold-400 mb-0">{{$totalOrders}}</h5>
                            </div>
                            <div class="p-2 text-center bg-info bg-darken-2 rounded-right">
                                <i class="icon-wallet font-large-2 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection


@section('script')
@endsection
