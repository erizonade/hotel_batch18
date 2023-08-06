<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layouts.header')
    </head>
    <body>

        {{-- Ini Letak Navbar --}}
        @include('layouts.navbar')


        <div id="layoutSidenav">
            {{-- Ini Letak Sidebar --}}
            @include('layouts.sidebar')


            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        {{-- ini title / judul --}}
                        <h1 class="mt-4">@yield('title')</h1>

                        {{-- Ini Letak Isi --}}
                        @yield('content')

                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        @include('layouts.scripts')

    </body>
</html>
