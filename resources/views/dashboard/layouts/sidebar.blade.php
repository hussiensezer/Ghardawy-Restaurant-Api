<!-- BEGIN: Main Menu-->

<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <!-- Start Li-->
            <li class="nav-item {{ trim($__env->yieldContent('active')) &&  trim($__env->yieldContent('active'))== 'home' ? 'active' : ''}}"><a href="{{route('dashboard.home')}}"><i class="la la-home"></i><span class="menu-title" data-i18n="Dashboard">@lang('sidebar.home')</span></a></li>
            <!-- End Li-->

            <!-- Start Li-->
            <li class=" nav-item {{ trim($__env->yieldContent('active')) &&  trim($__env->yieldContent('active'))== 'categories' ? 'active' : ''}}"><a href="#"><i class="la la-television"></i><span class="menu-title" data-i18n="categories">@lang('sidebar.categories')</span></a>
                <ul class="menu-content">
                    <li class="{{ trim($__env->yieldContent('active')) &&  trim($__env->yieldContent('active'))== 'all_categories' ? 'active' : ''}}"><a class="menu-item" href="{{route('dashboard.categories.index')}}"><i></i><span data-i18n="all_categories">@lang('sidebar.all_categories')</span></a></li>
                    <li class="{{ trim($__env->yieldContent('active')) &&  trim($__env->yieldContent('active'))== 'create_category' ? 'active' : ''}}"><a class="menu-item" href="{{route('dashboard.categories.create')}}"><i></i><span data-i18n="create_category">@lang('sidebar.create_category')</span></a></li>
                </ul>
            </li>

        </ul>
    </div>
</div>

<!-- END: Main Menu-->
