
@include('site.layouts.head')

<body>
    <!-- Modal -->

    <!-- Quick view -->
    @include('site.layouts.quickview')
    <!-- Header  -->

    @include('site.layouts.header')
    <!--End header-->



    <main class="main">
        @yield('main')

    </main>

    @include('site.layouts.footer')



    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center">
                    <img src="{{ asset('frontend/assets/imgs/theme/loading.gif') }}" alt="" />
                </div>
            </div>
        </div>
    </div>
   @include('site.layouts.js')
</body>

</html>
