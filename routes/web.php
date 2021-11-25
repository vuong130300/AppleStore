<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//-------------------------------------------- Frontend --------------------------------------------
Route::get('/','HomeController@index');
Route::get('/trang-chu','HomeController@index');
Route::get('/san-pham','HomeController@product');
Route::post('/tim-kiem','HomeController@search');

//Danh muc san pham trang chu
Route::get('/danh-muc-san-pham/{category_product_slug}','CategoryProductController@show_category_home');
Route::get('/chi-tiet-san-pham/{product_slug}','ProductController@details_product');

//Danh muc bai viet
Route::get('/danh-muc-bai-viet/{post_slug}','PostController@show_category_post_home');
Route::get('/bai-viet/{post_slug}','PostController@show_post_home');


//-------------------------------------------- Backend --------------------------------------------
Route::get('/admin','AdminController@index');
Route::get('/dashboard','AdminController@show_dashboard');
Route::get('/logout','AdminController@logout');
Route::post('/admin-dashboard','AdminController@dashboard');

//Customer
Route::get('/add-customer','CustomerController@add_customer');
Route::get('/list-customer','CustomerController@list_customer');
Route::get('/edit-customer/{customer_id}','CustomerController@edit_customer');
Route::get('/delete-customer/{customer_id}','CustomerController@delete_customer');

Route::post('/save-customer','CustomerController@save_customer');
Route::post('/update-customer/{customer_id}','CustomerController@update_customer');

// Producer
Route::get('/add-producer','ProducerController@add_producer');
Route::get('/list-producer','ProducerController@list_producer');
Route::get('/edit-producer/{producer_id}','ProducerController@edit_producer');
Route::get('/delete-producer/{producer_id}','ProducerController@delete_producer');

Route::get('/active-producer/{producer_id}','ProducerController@active_producer');
Route::get('/unactive-producer/{producer_id}','ProducerController@unactive_producer');

Route::post('/save-producer','ProducerController@save_producer');
Route::post('/update-producer/{producer_id}','ProducerController@update_producer');


// Category Product
Route::get('/add-category-product','CategoryProductController@add_category_product');
Route::get('/all-category-product','CategoryProductController@all_category_product');
Route::get('/edit-category-product/{category_product_id}','CategoryProductController@edit_category_product');
Route::get('/delete-category-product/{category_product_id}','CategoryProductController@delete_category_product');

Route::get('/active-category-product/{category_product_id}','CategoryProductController@active_category_product');
Route::get('/unactive-category-product/{category_product_id}','CategoryProductController@unactive_category_product');

Route::post('/save-category-product','CategoryProductController@save_category_product');
Route::post('/update-category-product/{category_product_id}','CategoryProductController@update_category_product');

// Product
Route::get('/add-product','ProductController@add_product');
Route::get('/all-product','ProductController@all_product');
Route::get('/edit-product/{product_id}','ProductController@edit_product');
Route::get('/delete-product/{product_id}','ProductController@delete_product');

Route::get('/active-product/{product_id}','ProductController@active_product');
Route::get('/unactive-product/{product_id}','ProductController@unactive_product');

Route::post('/save-product','ProductController@save_product');
Route::post('/update-product/{product_id}','ProductController@update_product');

//Cart
Route::post('/update-cart','CartController@update_cart');
Route::post('/save-cart','CartController@save_cart');

Route::get('/gio-hang','CartController@gio_hang');

Route::post('/add-cart-ajax','CartController@add_cart_ajax');
Route::get('/del-product/{session_id}','CartController@delete_product');


//Coupon
Route::post('/check-coupon','CartController@check_coupon');

Route::get('/unset-coupon','CouponController@unset_coupon');
Route::get('/insert-coupon','CouponController@insert_coupon');
Route::get('/delete-coupon/{coupon_id}','CouponController@delete_coupon');
Route::get('/list-coupon','CouponController@list_coupon');
Route::post('/insert-coupon-code','CouponController@insert_coupon_code');


//Category Post

Route::get('/add-category-post','CategoryPostController@add_category_post');
Route::get('/list-category-post','CategoryPostController@list_category_post');
Route::get('/edit-category-post/{category_post_id}','CategoryPostController@edit_category_post');
Route::get('/delete-category-post/{category_post_id}','CategoryPostController@delete_category_post');

Route::get('/danh-muc-bai-viet/{category_post_slug}','CategoryPostController@danh_muc_bai_viet');
Route::get('/active-category-post/{category_post_id}','CategoryPostController@active_category_post');
Route::get('/unactive-category-post/{category_post_id}','CategoryPostController@unactive_category_post');

Route::post('/save-category-post','CategoryPostController@save_category_post');
Route::post('/update-category-post/{category_post_id}','CategoryPostController@update_category_post');


//Post

Route::get('/add-post','PostController@add_post');
Route::get('/list-post','PostController@list_post');
Route::get('/edit-post/{post_id}','PostController@edit_post');
Route::get('/delete-post/{post_id}','PostController@delete_post');

Route::post('/save-post','PostController@save_post');
Route::post('/update-post/{post_id}','PostController@update_post');

Route::get('/active-post/{post_id}','PostController@active_post');
Route::get('/unactive-post/{post_id}','PostController@unactive_post');


//Checkout
Route::get('/login-checkout','CheckoutController@login_checkout');
Route::get('/create-customer','CheckoutController@create_customer');
Route::get('/logout-checkout','CheckoutController@logout_checkout');
Route::post('/login-customer','CheckoutController@login_customer');
Route::post('/add-customer','CheckoutController@add_customer');
Route::post('/order-place','CheckoutController@order_place');

Route::get('/checkout','CheckoutController@checkout');
Route::get('/payment','CheckoutController@payment');
Route::post('/save-checkout-customer','CheckoutController@save_checkout_customer');

Route::post('/select-delivery-home','CheckoutController@select_delivery_home');
Route::post('/confirm-order','CheckoutController@confirm_order');

//Order
Route::get('/manage-order','OrderController@manage_order');
Route::get('/view-order/{order_code}','OrderController@view_order');
Route::get('/print-order/{checkout_code}','OrderController@print_order');
Route::get('/delete-order/{order_code}','OrderController@order_code');
Route::post('/update-order-qty','OrderController@update_order_qty');
Route::post('/update-qty','OrderController@update_qty');

//Delivery
Route::get('/delivery','DeliveryController@delivery');
Route::post('/select-delivery','DeliveryController@select_delivery');
Route::post('/insert-delivery','DeliveryController@insert_delivery');
Route::post('/select-feeship','DeliveryController@select_feeship');
Route::post('/update-delivery','DeliveryController@update_delivery');

//Banner
Route::get('/manage-slider','SliderController@manage_slider');
Route::get('/add-slider','SliderController@add_slider');
Route::get('/delete-slide/{slide_id}','SliderController@delete_slide');
Route::post('/insert-slider','SliderController@insert_slider');
Route::get('/unactive-slide/{slide_id}','SliderController@unactive_slide');
Route::get('/active-slide/{slide_id}','SliderController@active_slide');



