<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>@yield('title')</title>
        <link href="{{asset('admin_assets/css/styles.css')}}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        @include('layouts.admin.header')
        <div id="layoutSidenav">
            @include('layouts.admin.sidebar')
            <div id="layoutSidenav_content">
                <main>
                    @yield('content')
                </main>
                @include('layouts.admin.footer')
            </div>
        </div>
        <script src="{{asset('admin_assets/js/bootstrap.bundle.min.js')}}" ></script>
        <script src="{{asset('admin_assets/js/scripts.js')}}"></script>
    </body>
</html>
