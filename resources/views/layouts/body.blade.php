@include('layouts.header')

<body class="main">
    <!-- BEGIN: Mobile Menu -->
    <div class="mobile-menu md:hidden">
        <div class="mobile-menu-bar">
            <a href="" class="flex mr-auto">
                <img alt="Midone - HTML Admin Template" class="w-6" src="{{ url('assets/images/app/logo.svg') }}">
            </a>
            <a href="javascript:;" class="mobile-menu-toggler"> <i data-lucide="bar-chart-2"
                    class="w-8 h-8 text-white transform -rotate-90"></i> </a>
        </div>
        <div class="scrollable">
            <a href="javascript:;" class="mobile-menu-toggler"> <i data-lucide="x-circle"
                    class="w-8 h-8 text-white transform -rotate-90"></i> </a>
            <ul class="scrollable__content py-2">
                <li>
                    <a href="javascript:;.html" class="menu">
                        <div class="menu__icon"> <i data-lucide="home"></i> </div>
                        <div class="menu__title">
                            Master
                            <div class="menu__sub-icon transform rotate-180"> <i data-lucide="chevron-down"></i> </div>
                        </div>
                    </a>
                    <ul class="menu__sub">
                        @if (auth()->user()->role->master_category)
                            <li>
                                <a href="{{ url('/category') }}" class="menu">
                                    <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                                    <div class="menu__title"> Kategori </div>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->role->master_unit)
                            <li>
                                <a href="{{ url('/unit') }}" class="menu">
                                    <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                                    <div class="menu__title"> Unit </div>
                                </a>
                            </li>
                        @endif

                        @if (auth()->user()->role->master_role)
                            <li>
                                <a href="{{ url('/roles') }}" class="menu">
                                    <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                                    <div class="menu__title"> Role </div>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->role->master_user)
                            <li>
                                <a href="{{ url('/user') }}" class="menu">
                                    <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                                    <div class="menu__title"> User </div>
                                </a>
                            </li>
                        @endif
                        @if (auth()->user()->role->master_product)
                            <li>
                                <a href="{{ url('/products') }}" class="menu">
                                    <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                                    <div class="menu__title"> Products </div>
                                </a>
                            </li>
                        @endif

                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="menu menu">
                        <div class="menu__icon"> <i data-lucide="inbox"></i> </div>
                        <div class="menu__title">
                            Transaction
                            <div class="menu__sub-icon transform rotate-180"> <i data-lucide="chevron-down"></i> </div>
                        </div>
                    </a>
                    <ul class="menu__sub">
                        @if (auth()->user()->role->purchase_order)
                            <li>
                                <a href="{{ url('/purchase-order') }}" class="menu">
                                    <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                                    <div class="menu__title"> Purchase Order </div>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                @if (auth()->user()->role->view_product)
                    <li>
                        <a href="{{url('/view-product')}}" class="menu">
                            <div class="menu__icon"> <i data-lucide="inbox"></i> </div>
                            <div class="menu__title"> Explore Product </div>
                        </a>
                    </li>
                    
                @endif

                <li class="menu__devider my-6"></li>

            </ul>
        </div>
    </div>
    <!-- END: Mobile Menu -->
    <!-- BEGIN: Top Bar -->
    @include('layouts.topbar')
    <!-- END: Top Bar -->
    <div class="wrapper">
        <div class="wrapper-box">
            <!-- BEGIN: Side Menu -->
            <nav class="side-nav">
                <ul>

                    <li>
                        <a href="javascript:;.html" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="home"></i> </div>
                            <div class="side-menu__title">
                                Master
                                <div class="side-menu__sub-icon transform rotate-180"> <i
                                        data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                        <ul class="side-menu__sub">
                            @if (auth()->user()->role->master_category)
                                <li>
                                    <a href="{{ url('/category') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                        <div class="side-menu__title"> Kategori </div>
                                    </a>
                                </li>
                            @endif
                            @if (auth()->user()->role->master_unit)
                                <li>
                                    <a href="{{ url('/unit') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                        <div class="side-menu__title"> Unit </div>
                                    </a>
                                </li>
                            @endif

                            @if (auth()->user()->role->master_role)
                                <li>
                                    <a href="{{ url('/roles') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                        <div class="side-menu__title"> Role </div>
                                    </a>
                                </li>
                            @endif
                            @if (auth()->user()->role->master_user)
                                <li>
                                    <a href="{{ url('/user') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                        <div class="side-menu__title"> User </div>
                                    </a>
                                </li>
                            @endif
                            @if (auth()->user()->role->master_product)
                                <li>
                                    <a href="{{ url('/products') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                        <div class="side-menu__title"> Products </div>
                                    </a>
                                </li>
                            @endif

                        </ul>
                    </li>

                    <li>
                        <a href="javascript:;" class="side-menu side-menu">
                            <div class="side-menu__icon"> <i data-lucide="inbox"></i> </div>
                            <div class="side-menu__title">
                                Transaction
                                <div class="side-menu__sub-icon transform rotate-180"> <i
                                        data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                        <ul class="side-menu__sub">
                            @if (auth()->user()->role->purchase_order)
                                <li>
                                    <a href="{{ url('/purchase-order') }}" class="side-menu">
                                        <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                        <div class="side-menu__title"> Purchase Order </div>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                    @if (auth()->user()->role->view_product)
                    <li>
                        <a href="{{url('/view-product')}}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="inbox"></i> </div>
                            <div class="side-menu__title"> Explore Product </div>
                        </a>
                    </li>
                    @endif
                </ul>
            </nav>
            <!-- END: Side Menu -->
            <!-- BEGIN: Content -->
            <div class="content">
                <!-- wrapper -->
                <div class="p-2 mt-4">
                    @yield('content')
                </div>

            </div>
            <!-- END: Content -->
        </div>
    </div>
    @include('layouts.footer')
