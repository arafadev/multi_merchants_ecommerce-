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

 <script>
     /// Start Details Page Add To Cart Product
     function addToCartDetails() {
         var product_name = $('#dpname').text();
         var id = $('#dproduct_id').val();
         var color = $('#dcolor option:selected').text();
         var size = $('#dsize option:selected').text();
         var vendor = $('#vproduct_id').val();
         var quantity = $('#dqty').val();
         $.ajax({
             type: "POST",
             dataType: 'json',
             data: {
                 color: color,
                 size: size,
                 quantity: quantity,
                 color: color,
                 size: size,
                 quantity: quantity,
                 product_name: product_name,
                 vendor: vendor

             },
             url: "/dcart/data/store/" + id,
             success: function(data) {
                 miniCart();
                 //  console.log(data)
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
     /// Eend Details Page Add To Cart Product
 </script>
 <script>
     function addToWishList(product_id) {
         $.ajax({
             type: "POST",
             dataType: 'json',
             url: "/add-to-wishlist/" + product_id,
             success: function(data) {
                 wishlist();

                 const Toast = Swal.mixin({
                     toast: true,
                     position: 'top-end',

                     showConfirmButton: false,
                     timer: 3000
                 })
                 if ($.isEmptyObject(data.error)) {

                     Toast.fire({
                         type: 'success',
                         icon: 'success',
                         title: data.success,
                     })
                 } else {

                     Toast.fire({
                         type: 'error',
                         icon: 'error',
                         title: data.error,
                     })
                 }
                 // End Message
             }
         })
     }
     /// End Wishlist Add -->
 </script>
 <script type="text/javascript">
     function wishlist() {
         $.ajax({
             type: "GET",
             dataType: 'json',
             url: "/get-wishlist-product/",
             success: function(response) {
                 $('#wishQty').text(response.wishQty);
                 var rows = ""
                 $.each(response.wishlist, function(key, value) {
                     rows += `<tr class="pt-30">
                        <td class="custome-checkbox pl-30">

                        </td>
                        <td class="image product-thumbnail pt-40"><img src="/${value.product.product_thambnail}" alt="#" /></td>
                        <td class="product-des product-name">
                            <h6><a class="product-name mb-10" href="shop-product-right.html">${value.product.product_name} </a></h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                        </td>
                        <td class="price" data-title="Price">
                        ${value.product.discount_price == null
                        ? `<h3 class="text-brand">$${value.product.selling_price}</h3>`
                        :`<h3 class="text-brand">$${value.product.discount_price}</h3>`
                        }

                        </td>
                        <td class="text-center detail-info" data-title="Stock">
                            ${value.product.product_qty > 0
                                ? `<span class="stock-status in-stock mb-0"> In Stock </span>`
                                :`<span class="stock-status out-stock mb-0">Stock Out </span>`
                            }

                        </td>

                        <td class="action text-center" data-title="Remove">
                            <a type="submit" class="text-body" id="${value.id}" onclick="wishlistRemove(this.id)" ><i class="fi-rs-trash"></i></a>                        </td>
                    </tr> `
                 });
                 $('#wishlist').html(rows);
             }
         })
     }
     wishlist();
 </script>
 <script>
     function wishlistRemove(id) {
         $.ajax({
             type: "GET",
             dataType: 'json',
             url: "/wishlist-remove/" + id,
             success: function(data) {
                 wishlist();
                 const Toast = Swal.mixin({
                     toast: true,
                     position: 'top-end',

                     showConfirmButton: false,
                     timer: 3000
                 })
                 if ($.isEmptyObject(data.error)) {

                     Toast.fire({
                         type: 'success',
                         icon: 'success',
                         title: data.success,
                     })
                 } else {

                     Toast.fire({
                         type: 'error',
                         icon: 'error',
                         title: data.error,
                     })
                 }
                 // End Message
             }
         })
     }
 </script>
 @yield('js')
