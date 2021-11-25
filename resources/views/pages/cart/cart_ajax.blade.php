@extends('layout_not_category')
@section('content')

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Giỏ hàng của bạn</h4>
                    <div class="breadcrumb__links">
                        <a href="{{URL::to('/trang-chu')}}">Trang chủ</a>
                        <span>Giỏ hàng của bạn</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
@if(Session::get('cart')==true)
@php
$total = 0;
@endphp

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        @if(session()->has('message'))
       
            {!! session()->get('message') !!}
        
        @elseif(session()->has('error'))
      
            {!! session()->get('error') !!}
      
        @endif
        <form action="{{url('/update-cart')}}" method="POST">
        {{csrf_field()}}
        <div class="row">
            <div class="col-lg-8">
                <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Tạm tính</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(Session::get('cart') as $key => $cart)
                                @php
                                $subtotal = $cart['product_price']*$cart['product_qty'];
                                $total+=$subtotal;
                                @endphp
                                <tr>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
                                            <img src="{{asset('public/uploads/product/'.$cart['product_image'])}}"
                                                width="90" alt="{{$cart['product_name']}}">
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h6>{{$cart['product_name']}}</h6>
                                            <h5>{{number_format($cart['product_price'],0,',','.').'₫'}}</h5>
                                        </div>
                                    </td>
                                    <td class="quantity__item">
                                        <div class="quantity">
                                            <div class="pro-qty-2">
                                                <input class="cart_quantity_input" type="number" min="1"
                                                    name="cart_qty[{{$cart['session_id']}}]"
                                                    value="{{$cart['product_qty']}}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__price">{{number_format($subtotal,0,',','.')}}₫</td>
                                    <td class="cart__close"><a
                                            onclick="return confirm('Bạn có chắc muốn xóa sản phẩm?')"
                                            class="cart_quantity_delete"
                                            href="{{url('/del-product/'.$cart['session_id'])}}"><i class="far fa-window-close"></i></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn">
                            <a href="{{URL::to('/trang-chu')}}"><i class="fas fa-cart-plus"></i> Tiếp tục mua sản phẩm</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn update__btn">
                            <button type="submit" name="update_qty"><i class="fa fa-spinner"></i> Cập nhật giỏ hàng</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            <div class="col-lg-4">
                <div class="cart__discount">
                    <h6>Mã khuyến mãi</h6>
                    <form method="POST" action="{{url('/check-coupon')}}" class="couponform">
                        {{csrf_field()}}
                        <input type="text" class="coupon-input" name="coupon" placeholder="Nhập mã khuyến mãi">
                        <button type="submit" class="btn btn-default"><i class="fas fa-ticket-alt    "></i> Áp dụng </button>
                    </form>
                </div>
                <div class="cart__total">
                    <h6>Cart total</h6>
                    <ul>
                        <li>Tạm tính: <span>{{number_format($total,0,',','.')}}₫</span></li>
                        @if(Session::get('coupon'))

                        <li>
                            @foreach(Session::get('coupon') as $key => $cou)
                            @if($cou['coupon_condition']==1)
                            Loại mã giảm giá:<span>{{$cou['coupon_number']}}%</span>

                            @php
                            $total_coupon = ($total*$cou['coupon_number'])/100;
                            @endphp

                        <li>Tổng tiền:<span>{{number_format($total-$total_coupon,0,',','.')}}₫</span></li>

                        @elseif($cou['coupon_condition']==2)
                        Loại mã giảm giá :<span>{{number_format($cou['coupon_number'],0,',','.')}}₫</span>

                        @php
                        $total_coupon = $total - $cou['coupon_number'];
                        @endphp

                        <li>Tổng tiền :<span>{{number_format($total_coupon,0,',','.')}}₫</span></li>


                        @endif
                        @endforeach
                        </li>
                        @else
                        <li>Giảm Giá :<span>0 ₫</span></li>
                        <li>Tổng tiền :<span>{{number_format($total,0,',','.')}}₫</span></li>
                        @endif
                    </ul>
                    @if(Session::get('coupon'))
                    <a class="primary-btn update" href="{{url('/unset-coupon')}}"><i class="fas fa-times-circle"></i> Xóa mã khuyến mãi</a>
                    @endif

                    @if(Session::get('customer_id'))
                    <a class="primary-btn check_out" href="{{URL::to('/checkout')}}"><i class="fab fa-amazon-pay"></i> Thanh toán</a>
                    @else
                    <a class="primary-btn check_out" href="{{URL::to('/login-checkout')}}"><i class="fab fa-amazon-pay"></i> Thanh toán</a>
                    @endif

                </div>
            </div>
        </div>
    </div>
</section>
@else

<div class="container text-center">
    <div class="cart-empty">
        <i class="fas fa-cart-plus"></i>
        <p>Không có sản phẩm nào trong giỏ hàng</p>
        <h4><a href="{{URL::to('/trang-chu')}}"><i class="fas fa-arrow-circle-left"></i> VỀ TRANG CHỦ</a></h4>
        <h5>Khi cần trợ giúp vui lòng gọi <span>0917889558</span> hoặc <span>0943705326</span> (7h30 - 22h)</h5>
    </div>
</div>

@endif
<!-- Shopping Cart Section End -->
@endsection