<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="{{ asset('css/lineicons.css') }}" />
    @vite('resources/sass/app.scss')

    {{-- Fonts --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap">
    
</head>

<body>
    <!-- ======== sidebar-nav start =========== -->
    <aside class="sidebar-nav-wrapper" style="background: linear-gradient(180deg, #620707 0%, #C80E0E 100%); overflow-y: auto;">
        <div class="navbar-logo" style="width: 140px;height: 59px;top: 28px;left: 24px;gap: 0px;opacity: 0px;">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logo/logo.png') }}" alt="logo" style="width: 140px;height: 59px;top: 28px;left: 24px;gap: 0px;opacity: 0px;" />
            </a>
        </div>
        <nav class="sidebar-nav">
            @include('layouts.navigation')
        </nav>
    </aside>
    <div class="overlay"></div>
    <!-- ======== sidebar-nav end =========== -->

    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper" style="background-color: #F4F7FE;">
        <!-- ========== header start ========== -->
        <header class="header" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('images/beranda.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-6">
                        <div class="header-left d-flex align-items-center">
                            <div class="menu-toggle-btn mr-20">
                                <button id="menu-toggle" class="main-btn btn-hover" style="background: linear-gradient(180deg, #620707 0%, #C80E0E 100%); color: white;">
                                    <i class="lni lni-chevron-left me-2"></i> {{ __('Menu') }}
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-6">
                        <div class="header-right">
                            <!-- profile start -->
                            <div class="profile-box ml-15">
                                <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="profile-info">
                                        <div class="info">
                                            <h6 class="mr-5" style="//styleName: Body Text/Small/Body Medium (Bold);font-family: DM Sans;font-size: 16px;font-weight: 700;line-height: 24px;letter-spacing: -0.02em;text-align: left;color:white; letter-spacing: 1px;">
                                                {{ __('Hi  ') }}{{ Auth::user()->name }},</h6>
                                        </div>
                                        <div>
                                            <h6 class="mr-5" style="//styleName: Display Text/Small/Display Small (Bold);font-family: DM Sans;font-size: 27px;font-weight: 700;line-height: 42px;letter-spacing: -0.02em;text-align: left; color: #DE0F0F;">
                                            Welcome Back!
                                            </h6>
                                        </div>
                                    </div>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile.show') }}"> <i
                                                class="lni lni-user"></i>
                                            {{ __('My profile') }}</a>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); this.closest('form').submit();"> <i
                                                    class="lni lni-exit"></i> {{ __('Logout') }}</a>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            <!-- profile end -->
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- ========== header end ========== -->

        <!-- ========== section start ========== -->
        <section class="section" style="background-color: #F4F7FE;">
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- end container -->
        </section>
        <!-- ========== section end ========== -->

        <!-- ========== footer start =========== -->
        <footer class="footer" style="background-color: #F4F7FE;">
            <div class="container-fluid" >
                <div class="row">
                    <div class="col-md-6 order-last order-md-first">
                        <div class="copyright text-md-start">
                            <p class="text-sm">
                                PUI-PT Sensing-Iot by Tino n David
                            </p>
                        </div>
                    </div>
                    <!-- end col-->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </footer>
        <!-- ========== footer end =========== -->
    </main>
    <!-- ======== main-wrapper end =========== -->

    <!-- ========= All Javascript files linkup ======== -->
    @vite('resources/js/app.js')
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>

