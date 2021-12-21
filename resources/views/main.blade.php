<!DOCTYPE html>
<html lang="vn">

    <head>
        
        @include('layouts.head')

    </head>

    <body class="hold-transition sidebar-mini layout-fixed">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="/public/template/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <div class="wrapper pb-3">

            @include('layouts.navbar')

            @include('layouts.sidebar')

            <div class="content-wrapper">

                @include('layouts.header')

                @include('layouts.alert')

                @yield('content')

            </div>
            
        </div>

        @include('layouts.footer')

    </body>

</html>