<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dashboard_files/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i>Online</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i><span>@lang('site.dashboard')</span></a></li>

            @if (auth()->user()->hasRole('super_admin'))
                <li><a href="{{ route('languages.index') }}"><i class="fa fa-users"></i><span>@lang('site.languages')</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('users-read'))
                <li><a href="{{ route('admins.index') }}"><i class="fa fa-users"></i><span>@lang('site.admins')</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('users-read'))
                <li><a href="{{ route('users.index') }}"><i class="fa fa-users"></i><span>@lang('site.users')</span></a></li>
            @endif

            @if (auth()->user()->hasPermission('products-read'))
                <li><a href="{{ route('products.index') }}"><i class="fa fa-th"></i><span>@lang('site.products')</span></a></li>
            @endif

        </ul>

    </section>

</aside>

