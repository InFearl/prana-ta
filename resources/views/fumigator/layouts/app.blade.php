<!DOCTYPE html>
<html lang="en">

<head>
    <title>Prana - @yield('title')</title>

    @include('fumigator.includes.header')

</head>

<body id="page-top">

    <div id="wrapper">
        @include('fumigator.includes.Sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('fumigator.includes.navbar')
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            @include('fumigator.includes.footer')
        </div>
    </div>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include('fumigator.includes.logout')
    @include('fumigator.includes.script')
    @include('sweetalert::alert')
    @stack('after-script')

</body>

</html>
