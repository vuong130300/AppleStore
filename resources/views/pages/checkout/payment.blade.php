@extends('layout_not_category')
@section('content')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
                <li class="active">Thanh toán giỏ hàng</li>
            </ol>
        </div>


        <div class="review-payment">
            <h2>Xem lại giỏ hàng</h2>
        </div>
        <div class="table-responsive cart_info">
            <?php
				$content = Cart::content();
				?>
            <table class="table table-condensed ">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Sản phẩm</td>
                        <td class="description"></td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($content as $v_content)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{URL::to('public/uploads/product/'.$v_content->options->image)}}"
                                    width="90" alt="" /></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$v_content->name}}</a></h4>
                            <p>Web ID: 1089772</p>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($v_content->price).'₫'}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <form action="{{URL::to('/update-cart-quantity')}}" method="POST">
                                    {{ csrf_field() }}
                                    <input class="cart_quantity_input" type="number" min="1" name="cart_quantity"
                                        value="{{$v_content->qty}}">
                                    <input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart"
                                        class="form-control">
                                    <input type="submit" value="Cập nhật" name="update_qty"
                                        class="btn-style btn btn-default btn-sm">
                                </form>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                                <?php
									$subtotal = $v_content->price * $v_content->qty;
									echo number_format($subtotal).'₫';
									?>
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm?')" class="cart_quantity_delete"
                                href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <h4 style="margin:40px 0;font-size: 20px;">Chọn hình thức thanh toán</h4>
        <form method="POST" action="{{URL::to('/order-place')}}">
            {{ csrf_field() }}
            <div class="payment-options">
                <span>
                    <label><input name="payment_option" value="1" type="checkbox"> Trả bằng thẻ ATM</label>
                </span>
                <span>
                    <label><input name="payment_option" value="2" type="checkbox"> Đặt hàng thanh toán sau</label>
                </span>
                <div class="checkout-style">
                    <button name="send_order_place" type="submit" class="btn btn-fefault cart">
                        <!-- <img src="{{asset('public/frontend/images/paper-plane-regular.svg')}}" alt="" /> -->
                        Thanh toán
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>
<!--/#cart_items-->

@endsection