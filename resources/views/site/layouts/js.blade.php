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
 {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}

 {{-- <script>
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
 </script> --}}
 <script type="text/javascript">
     //  this header js for all ajaxS codeS
     $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     })
     /// Start product view with Modal
 </script>
 <script>
     /// Start Add To Cart Prodcut
     function addToCart() {
         var product_name = $('#pname').text();
         var id = $('#product_id').val();
         var color = $('#color option:selected').text();
         var size = $('#size option:selected').text();
         var quantity = $('#qty').val();
         var vendor = $('#pvendor_id').text();
         $.ajax({
             type: "GET",
             dataType: 'json',
             data: {
                 color: color,
                 size: size,
                 quantity: quantity,
                 product_name: product_name,
                 vendor: vendor

             },
             url: "/cart/data/store/" + id,
             success: function(data) {
                 miniCart();
                 $('#closeModal').click();
                 console.log(data)
                 //  // Start Message
                 const Toast = Swal.mixin({
                     toast: true,
                     position: 'top-end',
                     icon: 'success',
                     showConfirmButton: false,
                     timer: 3000
                 })
                 if ($.isEmptyObject(data.error)) {

                     Toast.fire({
                         type: 'success',
                         title: data.success,
                     })
                 } else {

                     Toast.fire({
                         type: 'error',
                         title: data.error,
                     })
                 }
                 // End Message
             }
         })
     }

     /// End Add To Cart Prodcut
 </script>

 <script type="text/javascript">
     function miniCart() {
         $.ajax({
             type: 'GET',
             url: '/product/mini/cart',
             dataType: 'json',
             success: function(response) {
                 $('span[id="cartSubTotal"]').text(response.cartTotal);
                 $('#cartQty').text(response.cartQty);
                 var miniCart = ""
                 $.each(response.carts, function(key, value) {
                     miniCart += ` <ul>
              <li>
                  <div class="shopping-cart-img">
                      <a href="shop-product-right.html"><img alt="Nest" src="/${value.options.image} " style="width:50px;height:50px;" /></a>
                  </div>
                  <div class="shopping-cart-title" style="margin: -73px 74px 14px; width" 146px;>
                      <h4><a href="shop-product-right.html"> ${value.name} </a></h4>
                      <h4><span>${value.qty} × </span>${value.price}</h4>
                  </div>
                  <div class="shopping-cart-delete" style="margin: -85px 1px 0px;">
                   <a type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)"  ><i class="fi-rs-cross-small"></i></a>
                  </div>
              </li>
          </ul>
          <hr><br>
                 `
                 });
                 $('#miniCart').html(miniCart);
             }
         })
     }
     miniCart();
 </script>
 <script>
     function miniCartRemove(rowId) {
         $.ajax({
             type: 'GET',
             url: '/minicart/product/remove/' + rowId,
             dataType: 'json',
             success: function(data) {
                 miniCart();
                 // Start Message
                 const Toast = Swal.mixin({
                     toast: true,
                     position: 'top-end',
                     icon: 'success',
                     showConfirmButton: false,
                     timer: 3000
                 })
                 if ($.isEmptyObject(data.error)) {

                     Toast.fire({
                         type: 'success',
                         title: data.success,
                     })
                 } else {

                     Toast.fire({
                         type: 'error',
                         title: data.error,
                     })
                 }
                 // End Message
             }
         })
     }
     /// Mini Cart Remove End
 </script>

 @yield('js')
