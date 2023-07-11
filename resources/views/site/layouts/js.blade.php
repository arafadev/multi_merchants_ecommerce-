 <!-- Vendor JS-->
 <script src="{{ asset('frontend/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
 <script src="{{ asset('frontend/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
 <script src="{{ asset('frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
 <script src="{{ asset('frontend/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
 <script src="{{ asset('frontend/assets/js/plugins/slick.js') }}"></script>
 <script src="{{ asset('frontend/assets/js/plugins/jquery.syotimer.min.js') }}"></script>
 <script src="{{ asset('frontend/assets/js/plugins/waypoints.js') }}"></script>
 <script src="{{ asset('frontend/assets/js/plugins/wow.js') }}"></script>
 <script src="{{ asset('frontend/assets/js/plugins/perfect-scrollbar.js') }}"></script>
 <script src="{{ asset('frontend/assets/js/plugins/magnific-popup.js') }}"></script>
 <script src="{{ asset('frontend/assets/js/plugins/select2.min.js') }}"></script>
 <script src="{{ asset('frontend/assets/js/plugins/counterup.js') }}"></script>
 <script src="{{ asset('frontend/assets/js/plugins/jquery.countdown.min.js') }}"></script>
 <script src="{{ asset('frontend/assets/js/plugins/images-loaded.js') }}"></script>
 <script src="{{ asset('frontend/assets/js/plugins/isotope.js') }}"></script>
 <script src="{{ asset('frontend/assets/js/plugins/scrollup.js') }}"></script>
 <script src="{{ asset('frontend/assets/js/plugins/jquery.vticker-min.js') }}"></script>
 <script src="{{ asset('frontend/assets/js/plugins/jquery.theia.sticky.js') }}"></script>
 <script src="{{ asset('frontend/assets/js/plugins/jquery.elevatezoom.js') }}"></script>
 <!-- Template  JS -->
 <script src="{{ asset('frontend/assets/js/main.js?v=5.3') }}"></script>
 <script src="{{ asset('frontend/assets/js/shop.js?v=5.3') }}"></script>
 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

 <script>
     @if (Session::has('message'))
         var type = "{{ Session::get('alert-type', 'info') }}"
         switch (type) {
             case 'info':
                 toastr.info(" {{ Session::get('message') }} ");
                 break;
             case 'success':
                 toastr.success(" {{ Session::get('message') }} ");
                 break;
             case 'warning':
                 toastr.warning(" {{ Session::get('message') }} ");
                 break;
             case 'error':
                 toastr.error(" {{ Session::get('message') }} ");
                 break;
         }
     @endif
 </script>
 @yield('js')

 @yield('js')
