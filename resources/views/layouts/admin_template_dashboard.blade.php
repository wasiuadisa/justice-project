<?php /*

gd-bag 
gd-check-box
gd-hand-open
gd-printer
gd-search
gd-timer
gd-folder
gd-view-list
gd-email gd-folder

gd-save, gd-trash,

gd-facebook, gd-twitter, gd-instagram,
*/ ?><!DOCTYPE html>
<html lang="en">
<head>
    <!-- Title -->
    <title><?php if(isset($pageTitle)){echo $pageTitle;} ?> | Administrative area | {{ config('app.name') }}</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('storage/public_template/images/' . $siteSettingsMiddlewareData->favicon_logo) }}">

    <!-- Template -->
    <link rel="stylesheet" href="{{ asset('storage/admin_template/assets/css/graindashboard.css') }}">
</head>

<body class="has-sidebar has-fixed-sidebar-and-header">

    <!-- Header -->
    <header class="header bg-body border-bottom border-dark">
        <nav class="navbar flex-nowrap p-0">
            <div class="navbar-brand-wrapper d-flex align-items-center col-auto border-right border-dark">
                <!-- Logo For Mobile View -->
                <a class="navbar-brand navbar-brand-mobile" href="{{ route('index') }}">
                    <img class="img-fluid w-100" src="{{ asset('storage/public_template/images/' . strtolower($siteSettingsMiddlewareData->header_logo_filename)) }}" alt="{{ config('app.name') }}">
                </a>
                <!-- End Logo For Mobile View -->

                <!-- Logo For Desktop View -->
                <a class="navbar-brand navbar-brand-desktop text-inline" href="{{ route('index') }}">
                    <img class="side-nav-show-on-closed" src="{{ asset('storage/public_template/images/' . strtolower($siteSettingsMiddlewareData->header_logo_filename)) }}" alt="{{ ucwords($siteSettingsMiddlewareData->header_logo_alt_text) }}" style="width: auto; height: 33px;">
                    <img class="side-nav-hide-on-closed" src="{{ asset('storage/public_template/images/' . strtolower($siteSettingsMiddlewareData->header_logo_filename)) }}" alt="{{ ucwords($siteSettingsMiddlewareData->header_logo_alt_text) }}" style="width: auto; height: 33px;">
                </a>
                <!-- End Logo For Desktop View -->
            </div>

            <div class="header-content col px-md-3">
                <div class="d-flex align-items-center">
                    <!-- Side Nav Toggle -->
                    <a  class="js-side-nav header-invoker d-flex mr-md-2" href="#"
                        data-close-invoker="#sidebarClose"
                        data-target="#sidebar"
                        data-target-wrapper="body">
                        <i class="gd-align-left"></i>
                    </a>
                    <!-- End Side Nav Toggle -->
    <?php /*
                    <!-- User Notifications -->
                    <div class="dropdown ml-auto">
                        <a id="notificationsInvoker" class="header-invoker" href="#" aria-controls="notifications" aria-haspopup="true" aria-expanded="false" data-unfold-event="click" data-unfold-target="#notifications" data-unfold-type="css-animation" data-unfold-duration="300" data-unfold-animation-in="fadeIn" data-unfold-animation-out="fadeOut">
                            <span class="indicator indicator-bordered indicator-top-right indicator-primary rounded-circle"></span>
                            <i class="gd-bell"></i>
                        </a>

                        <div id="notifications" class="dropdown-menu dropdown-menu-center py-0 mt-4 w-18_75rem w-md-22_5rem unfold-css-animation unfold-hidden" aria-labelledby="notificationsInvoker" style="animation-duration: 300ms;">
                            <div class="card">
                                <div class="card-header d-flex align-items-center border-bottom py-3">
                                    <h5 class="mb-0">Notifications</h5>
                                    <a class="link small ml-auto" href="#">Clear All</a>
                                </div>

                                <div class="card-body p-0">
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item list-group-item-action">
                                            <div class="d-flex align-items-center text-nowrap mb-2">
                                                <i class="gd-info-alt icon-text text-primary mr-2"></i>
                                                <h6 class="font-weight-semi-bold mb-0">New Update</h6>
                                                <span class="list-group-item-date text-muted ml-auto">Just now</span>
                                            </div>
                                            <p class="mb-0">
                                                Order <strong>#10000</strong> has been updated.
                                            </p>
                                            <a class="list-group-item-closer text-muted" href="#"><i class="gd-close"></i></a>
                                        </div>
                                        <div class="list-group-item list-group-item-action">
                                            <div class="d-flex align-items-center text-nowrap mb-2">
                                                <i class="gd-info-alt icon-text text-primary mr-2"></i>
                                                <h6 class="font-weight-semi-bold mb-0">New Update</h6>
                                                <span class="list-group-item-date text-muted ml-auto">Just now</span>
                                            </div>
                                            <p class="mb-0">
                                                Order <strong>#10001</strong> has been updated.
                                            </p>
                                            <a class="list-group-item-closer text-muted" href="#"><i class="gd-close"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End User Notifications -->
    */ ?>
                    <!-- User Avatar -->
    <!--                <div class="dropdown mx-3 dropdown ml-2"> -->
                    <div class="dropdown mx-3 dropdown ml-auto">
                        <a id="profileMenuInvoker" class="header-complex-invoker" href="#" aria-controls="profileMenu" aria-haspopup="true" aria-expanded="false" data-unfold-event="click" data-unfold-target="#profileMenu" data-unfold-type="css-animation" data-unfold-duration="300" data-unfold-animation-in="fadeIn" data-unfold-animation-out="fadeOut">
                            <!--img class="avatar rounded-circle mr-md-2" src="#" alt="John Doe"-->
                            <span class="mr-md-2 avatar-placeholder">W</span>
                            <span class="d-none d-md-block">
                                {{ ucwords(Auth::user()->name) }}
                            </span>
                            <i class="gd-angle-down d-none d-md-block ml-2"></i>
                        </a>

                        <ul id="profileMenu" class="unfold unfold-user unfold-light unfold-top unfold-centered position-absolute pt-2 pb-1 mt-4 unfold-css-animation unfold-hidden fadeOut" aria-labelledby="profileMenuInvoker" style="animation-duration: 300ms;">
                            <li class="unfold-item">
                                <a class="unfold-link d-flex align-items-center text-nowrap" href="{{ route('profile.edit') }}">
                                    <span class="unfold-item-icon mr-3">
                                      <i class="gd-user"></i>
                                    </span> My Profile 
                                </a>
                            </li>
                            <li class="unfold-item unfold-item-has-divider">
                                <!-- Authentication -->
                                <form method="post" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="unfold-link d-flex align-items-center text-nowrap" href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                                        <span class="unfold-item-icon mr-3">
                                          <i class="gd-power-off"></i>
                                        </span> Sign Out 
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <!-- End User Avatar -->
                </div>
            </div>
        </nav>
    </header>
    <!-- End Header -->

    <main class="main">

        <!-- Sidebar Nav -->
        <aside id="sidebar" class="js-custom-scroll side-nav border-right border-dark border-top">
            <ul id="sideNav" class="side-nav-menu side-nav-menu-top-level mb-0">
                <!-- Title -->
                <li class="sidebar-heading h6 border-bottom border-light" style="color: black; text-size: 25px;">
                    Role: Administrator
                </li>
                <!-- End Title -->

                <!-- Getting Started -->
                <li class="side-nav-menu-item border-bottom border-light">
                    <a class="side-nav-menu-link media align-items-center" href="{{ route('dashboard') }}">
                  <span class="side-nav-menu-icon d-flex mr-3">
                    <i class="gd-bookmark-alt"></i>
                  </span>
                        <span class="side-nav-fadeout-on-closed media-body">
                            Dashboard
                        </span>
                    </a>
                </li>
                <!-- End Getting Started -->
<?php /*
                <!-- UI Components -->
                <li class="side-nav-menu-item side-nav-has-menu border-bottom border-light">
                    <a class="side-nav-menu-link media align-items-center" href="#" data-target="#subComponents">
                        <span class="side-nav-menu-icon d-flex mr-3">
                            <i class="gd-view-list"></i>
                        </span>
                        <span class="side-nav-fadeout-on-closed media-body">    Public template
                        </span>
                        <span class="side-nav-control-icon d-flex">
                            <i class="gd-angle-right side-nav-fadeout-on-closed"></i>
                        </span>
                        <span class="side-nav__indicator side-nav-fadeout-on-closed"></span>
                    </a>
                    <!-- UI Components: subComponents -->
                    <ul id="subComponents" class="side-nav-menu side-nav-menu-second-level mb-0" style="display:block;">
                        <li class="side-nav-menu-item">
                            <a class="side-nav-menu-link" href="">
                                Header
                            </a>
                        </li>
                        <li class="side-nav-menu-item">
                            <a class="side-nav-menu-link" href="">
                                Footer
                            </a>
                        </li>
                    </ul>
                    <!-- End UI Components: subComponents -->
                </li>
                <!-- End UI Components -->
*/ ?>
                <!-- Home page -->
                <li class="side-nav-menu-item border-bottom border-light">
                    <a class="side-nav-menu-link media align-items-center" href="{{ route('admin.index') }}">
                        <span class="side-nav-menu-icon d-flex mr-3">
                            <i class="gd-home"></i>
                        </span>
                        <span class="side-nav-fadeout-on-closed media-body">
                            Home section
                        </span>
                    </a>
                </li>
                <!-- End Home page -->

                <!-- About page -->
                <li class="side-nav-menu-item border-bottom border-light">
                    <a class="side-nav-menu-link media align-items-center" href="{{ route('admin.about') }}">
                        <span class="side-nav-menu-icon d-flex mr-3">
                            <i class="gd-book"></i>
                        </span>
                        <span class="side-nav-fadeout-on-closed media-body">
                            About section
                        </span>
                    </a>
                </li>
                <!-- End About page -->

                <!-- Services page -->
                <!-- UI Components -->
                <li class="side-nav-menu-item side-nav-has-menu border-bottom border-light">
                    <a class="side-nav-menu-link media align-items-center" href="#"
                       data-target="#serviceComponents">
                        <span class="side-nav-menu-icon d-flex mr-3">
                            <i class="gd-harddrives"></i>
                        </span>
                        <span class="side-nav-fadeout-on-closed media-body">
                            Services & Service section
                        </span>
                        <span class="side-nav-control-icon d-flex">
                            <i class="gd-angle-right side-nav-fadeout-on-closed"></i>
                        </span>
                        <span class="side-nav__indicator side-nav-fadeout-on-closed"></span>
                    </a>
                    <!-- UI Components: subComponents -->
                    <ul id="serviceComponents" class="side-nav-menu side-nav-menu-second-level mb-0 border-bottom border-light" style="display:block;">
                        <li class="side-nav-menu-item">
                            <a class="side-nav-menu-link" href="{{ route('admin.new-service') }}">
                                Create New Service
                            </a>
                        </li>
                        <li class="side-nav-menu-item">
                            <a class="side-nav-menu-link" href="{{ route('admin.services') }}">
                                Services
                            </a>
                        </li>
                        <li class="side-nav-menu-item">
                            <a class="side-nav-menu-link" href="{{ route('admin.service-page') }}">
                                Service section
                            </a>
                        </li>
                    </ul>
                    <!-- End UI Components: subComponents -->
                </li>
                <!-- End UI Components -->
                <!-- End Services -->

                <!-- Team -->
                <!-- UI Components -->
                <li class="side-nav-menu-item side-nav-has-menu border-bottom border-light">
                    <a class="side-nav-menu-link media align-items-center" href="#" data-target="#teamComponents">
                        <span class="side-nav-menu-icon d-flex mr-3">
                            <i class="gd-briefcase"></i>
                        </span>
                        <span class="side-nav-fadeout-on-closed media-body">
                            Team & Team section
                        </span>
                        <span class="side-nav-control-icon d-flex">
                            <i class="gd-angle-right side-nav-fadeout-on-closed"></i>
                        </span>
                        <span class="side-nav__indicator side-nav-fadeout-on-closed"></span>
                    </a>
                    <!-- UI Components: subComponents -->
                    <ul id="teamComponents" class="side-nav-menu side-nav-menu-second-level mb-0" style="display:block;">
                        <li class="side-nav-menu-item">
                            <a class="side-nav-menu-link" href="{{ route('admin.new-team-member') }}">
                                Create New Member
                            </a>
                        </li>
                        <li class="side-nav-menu-item">
                            <a class="side-nav-menu-link" href="{{ route('admin.teams') }}">
                                Team Members
                            </a>
                        </li>
                        <li class="side-nav-menu-item">
                            <a class="side-nav-menu-link" href="{{ route('admin.team-page') }}">
                                Team section
                            </a>
                        </li>
                    </ul>
                    <!-- End UI Components: subComponents -->
                </li>
                <!-- End UI Components -->
                <!-- End Team -->

                <!-- Settings -->
                <li class="side-nav-menu-item border-bottom border-light">
                    <a class="side-nav-menu-link media align-items-center" href="{{ route('admin.settings') }}">
                        <span class="side-nav-menu-icon d-flex mr-3">
                            <i class="gd-settings"></i>
                        </span>
                        <span class="side-nav-fadeout-on-closed media-body">
                            Site Settings
                        </span>
                    </a>
                </li>
                <!-- End Settings -->
<?php /*
                <!-- Contact page -->
                <li class="side-nav-menu-item border-bottom border-light">
                    <a class="side-nav-menu-link media align-items-center" href="{{-- route('') --}}">
                        <span class="side-nav-menu-icon d-flex mr-3">
                            <i class="gd-gallery"></i>
                        </span>
                        <span class="side-nav-fadeout-on-closed media-body">
                            Contact page
                        </span>
                    </a>
                </li>
                <!-- End Contact -->
*/ ?>
                </li>
                <!-- End Utils -->

            </ul>
        </aside>
        <!-- End Sidebar Nav -->

        @yield('main_content')

        <!-- Footer -->
        <footer class="small p-3 px-md-4 mt-auto">
            <div class="row justify-content-between">
                <div class="col-lg text-center text-lg-left mb-3 mb-lg-0">
                    &copy; 2023 | {{ config('app.name') }} is developed by <a href="">Wasiu Adisa</a>. | Template is edited by <a href="">Wasiu Adisa</a>
                </div>
                <div class="col-lg text-center text-lg-right">
                    &copy; 2019 Template created by <a href="https://graindashboard.com" target="_blank">Graindashboard</a>. All Rights Reserved.
                </div>
            </div>
        </footer>
        <!-- End Footer -->
    </div>

    </main>

    <!-- Bootstrap 5 -->
    <div class="floating-button-div">
        <a id="button" class="btn btn-dark" style="top:40%;right:0;position:fixed;z-index: 9999" href="../../../">Developer Website</a>
    </div>

<script src="{{ asset('storage/admin_template/assets/js/graindashboard.js') }}"></script>
<script src="{{ asset('storage/admin_template/assets/js/graindashboard.vendor.js') }}"></script>

</body>
</html>