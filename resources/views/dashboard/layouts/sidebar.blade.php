<!-- BEGIN: Main Menu-->

<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <!-- Start Li-->
            <li class="nav-item {{ trim($__env->yieldContent('active')) &&  trim($__env->yieldContent('active'))== 'home' ? 'active' : ''}}"><a href="{{route('dashboard.home')}}"><i class="la la-home"></i><span class="menu-title" data-i18n="Dashboard">@lang('sidebar.home')</span></a></li>
            <!-- End Li-->
            @can('categories_access')
            <!-- Start Li-->
            <li class=" nav-item {{ trim($__env->yieldContent('active')) &&  trim($__env->yieldContent('active'))== 'categories' ? 'active' : ''}}"><a href="#"><i class="la la-television"></i><span class="menu-title" data-i18n="categories">@lang('sidebar.categories')</span></a>
                <ul class="menu-content">
                    <li class="{{ trim($__env->yieldContent('active')) &&  trim($__env->yieldContent('active'))== 'all_categories' ? 'active' : ''}}"><a class="menu-item" href="{{route('dashboard.categories.index')}}"><i></i><span data-i18n="all_categories">@lang('sidebar.all_categories')</span></a></li>
                    @can('categories_create')
                    <li class="{{ trim($__env->yieldContent('active')) &&  trim($__env->yieldContent('active'))== 'create_category' ? 'active' : ''}}"><a class="menu-item" href="{{route('dashboard.categories.create')}}"><i></i><span data-i18n="create_category">@lang('sidebar.create_category')</span></a></li>
                     @endcan
                </ul>
            </li>
            @endcan
            <!-- End Li-->
            @can('place_access')
            <!-- Start Li-->
            <li class=" nav-item {{ trim($__env->yieldContent('active')) &&  trim($__env->yieldContent('active'))== 'places' ? 'active' : ''}}"><a href="#"><i class="la la-television"></i><span class="menu-title" data-i18n="places">@lang('sidebar.places')</span></a>
                <ul class="menu-content">
                    <li class="{{ trim($__env->yieldContent('active')) &&  trim($__env->yieldContent('active'))== 'all_places' ? 'active' : ''}}"><a class="menu-item" href="{{route('dashboard.places.index')}}"><i></i><span data-i18n="all_places">@lang('sidebar.all_places')</span></a></li>
                  @can('place_create')
                    <li class="{{ trim($__env->yieldContent('active')) &&  trim($__env->yieldContent('active'))== 'create_place' ? 'active' : ''}}"><a class="menu-item" href="{{route('dashboard.places.create')}}"><i></i><span data-i18n="create_place">@lang('sidebar.create_place')</span></a></li>
                  @endcan
                </ul>
            </li>
            @endcan
            <!-- End Li-->
            @can('sizes_access')
            <!-- Start Li-->
            <li class=" nav-item {{ trim($__env->yieldContent('active')) &&  trim($__env->yieldContent('active'))== 'sizes' ? 'active' : ''}}"><a href="#"><i class="la la-television"></i><span class="menu-title" data-i18n="sizes">@lang('sidebar.sizes')</span></a>
                <ul class="menu-content">
                    <li class="{{ trim($__env->yieldContent('active')) &&  trim($__env->yieldContent('active'))== 'all_sizes' ? 'active' : ''}}"><a class="menu-item" href="{{route('dashboard.sizes.index')}}"><i></i><span data-i18n="all_sizes">@lang('sidebar.all_sizes')</span></a></li>
                   @can('sizes_create')
                    <li class="{{ trim($__env->yieldContent('active')) &&  trim($__env->yieldContent('active'))== 'create_size' ? 'active' : ''}}"><a class="menu-item" href="{{route('dashboard.sizes.create')}}"><i></i><span data-i18n="create_size">@lang('sidebar.create_size')</span></a></li>
                    @endcan
                </ul>
            </li>
            <!-- End Li-->
            @endcan

            @can('customer_access')
            <!-- Start Li-->
            <li class=" nav-item {{ trim($__env->yieldContent('active')) &&  trim($__env->yieldContent('active'))== 'customers' ? 'active' : ''}}"><a href="#"><i class="la la-television"></i><span class="menu-title" data-i18n="sizes">@lang('sidebar.customers')</span></a>
                <ul class="menu-content">
                    <li class="{{ trim($__env->yieldContent('active')) &&  trim($__env->yieldContent('active'))== 'all_customers' ? 'active' : ''}}"><a class="menu-item" href="{{route('dashboard.customers.index')}}"><i></i><span data-i18n="all_sizes">@lang('sidebar.all_customers')</span></a></li>
                </ul>
            </li>
            <!-- End Li-->
            @endcan

            @can('caption_access')
            <!-- Start Li-->
            <li class=" nav-item {{ trim($__env->yieldContent('active')) &&  trim($__env->yieldContent('active'))== 'captions' ? 'active' : ''}}"><a href="#"><i class="la la-television"></i><span class="menu-title" data-i18n="sizes">@lang('sidebar.captions')</span></a>
                <ul class="menu-content">
                    <li class="{{ trim($__env->yieldContent('active')) &&  trim($__env->yieldContent('active'))== 'all_captions' ? 'active' : ''}}"><a class="menu-item" href="{{route('dashboard.captions.index')}}"><i></i><span data-i18n="all_sizes">@lang('sidebar.captions')</span></a></li>
                </ul>
            </li>
            <!-- End Li-->
           @endcan
            @can('order_access')
            <!-- Start Li-->
            <li class=" nav-item {{ trim($__env->yieldContent('active')) &&  trim($__env->yieldContent('active'))== 'orders' ? 'active' : ''}}"><a href="#"><i class="la la-television"></i><span class="menu-title" data-i18n="sizes">@lang('sidebar.orders')</span></a>
                <ul class="menu-content">
                    <li class="{{ trim($__env->yieldContent('active')) &&  trim($__env->yieldContent('active'))== 'all_order' ? 'active' : ''}}"><a class="menu-item" href="{{route('dashboard.orders.index')}}"><i></i><span data-i18n="all_sizes">@lang('sidebar.all_orders')</span></a></li>
                </ul>
            </li>
            <!-- End Li-->
            @endcan

            @can('permission_access')
            <!-- Start Li-->
            <li class=" nav-item {{ trim($__env->yieldContent('active')) &&  trim($__env->yieldContent('active'))== 'permissions' ? 'active' : ''}}"><a href="#"><i class="la la-television"></i><span class="menu-title" data-i18n="sizes">@lang('sidebar.permissions')</span></a>
                <ul class="menu-content">
                    <li class="{{ trim($__env->yieldContent('active')) &&  trim($__env->yieldContent('active'))== 'all_permissions' ? 'active' : ''}}"><a class="menu-item" href="{{route('dashboard.permissions.index')}}"><i></i><span data-i18n="all_sizes">@lang('sidebar.all_permissions')</span></a></li>
                </ul>
            </li>
            <!-- End Li-->
            @endcan

{{--            <!-- Start Li-->--}}
{{--            <li class=" nav-item {{ trim($__env->yieldContent('active')) &&  trim($__env->yieldContent('active'))== 'sizes' ? 'active' : ''}}"><a href="#"><i class="la la-television"></i><span class="menu-title" data-i18n="sizes">الاعدادات</span></a>--}}
{{--                <ul class="menu-content">--}}
{{--                    <li class="{{ trim($__env->yieldContent('active')) &&  trim($__env->yieldContent('active'))== 'all_sizes' ? 'active' : ''}}"><a class="menu-item" href="{{route('dashboard.sizes.index')}}"><i></i><span data-i18n="all_sizes">@lang('sidebar.all_sizes')</span></a></li>--}}
{{--                    <li class="{{ trim($__env->yieldContent('active')) &&  trim($__env->yieldContent('active'))== 'create_size' ? 'active' : ''}}"><a class="menu-item" href="{{route('dashboard.sizes.create')}}"><i></i><span data-i18n="create_size">@lang('sidebar.create_size')</span></a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <!-- End Li-->--}}

            @can('employee_access')
            <!-- Start Li-->
            <li class=" nav-item {{ trim($__env->yieldContent('active')) &&  trim($__env->yieldContent('active'))== 'employees' ? 'active' : ''}}"><a href="#"><i class="la la-television"></i><span class="menu-title" data-i18n="sizes">الموظفين</span></a>
                <ul class="menu-content">
                    <li class="{{ trim($__env->yieldContent('active')) &&  trim($__env->yieldContent('active'))== 'all_employees' ? 'active' : ''}}"><a class="menu-item" href="{{route('dashboard.employees.index')}}"><i></i><span data-i18n="all_sizes">@lang('sidebar.all_employees')</span></a></li>
                </ul>
            </li>
            @endcan
            <!-- End Li-->
            @can('owners_access')
            <!-- Start Li-->
            <li class=" nav-item {{ trim($__env->yieldContent('active')) &&  trim($__env->yieldContent('active'))== 'owners' ? 'active' : ''}}"><a href="#"><i class="la la-television"></i><span class="menu-title" data-i18n="sizes">ملاك الاماكن</span></a>
                <ul class="menu-content">
                    <li class="{{ trim($__env->yieldContent('active')) &&  trim($__env->yieldContent('active'))== 'all_owners' ? 'active' : ''}}"><a class="menu-item" href="{{route('dashboard.owners.index')}}"><i></i><span data-i18n="all_sizes">@lang('sidebar.all_owners')</span></a></li>
                </ul>
            </li>
           @endcan
{{--            <!-- End Li-->--}}

        </ul>
    </div>
</div>

<!-- END: Main Menu-->
