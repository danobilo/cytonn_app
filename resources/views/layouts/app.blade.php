<!DOCTYPE html>
<html>

    @include('head')


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            @include('topbar')
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
            @include('sidebar')
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">

                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div> <!-- container -->

                </div>
            </div> <!-- content -->

            @include('footer')

        </div>

        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->


    @include('includes-js')

</body>

</html>

