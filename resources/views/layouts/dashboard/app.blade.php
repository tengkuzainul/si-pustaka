<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.dashboard.head')

<body data-sidebar="dark" data-bs-theme="ligth" data-topbar="light">
    @include('sweetalert::alert')

    <!-- Begin page -->
    <div id="layout-wrapper">


        @include('layouts.dashboard.header')

        <!-- ========== Left Sidebar Start ========== -->
        @include('layouts.dashboard.sidebar')
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                @yield('content')
            </div>
            <!-- End Page-content -->

            @include('layouts.dashboard.footer')
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- JAVASCRIPT -->
    @include('layouts.dashboard.js')

</body>

</html>
