@extends('layout_not_category')
@section('content')

<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Đăng ký</h4>
                    <div class="breadcrumb__links">
                        <a href="{{URL::to('/trang-chu')}}">Trang chủ</a>
                        <span>Đăng ký</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <form action="{{URL::to('/add-customer')}}" method="POST">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <h6 class="coupon__code"><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click
                                here</a> to enter your code</h6>
                        <h6 class="checkout__title">Đăng ký</h6>
                        <div class="checkout__input">
                            <p>Họ và tên<span>*</span></p>
                            <input type="text" name="customer_name" placeholder="Họ và tên" />
                        </div>
                        <div class="checkout__input">
                            <p>Địa chỉ email<span>*</span></p>
                            <input type="email" name="customer_email" placeholder="Địa chỉ email" />
                        </div>
                        <div class="checkout__input">
                            <p>Số điện thoại<span>*</span></p>
                            <input type="text" name="customer_phone" placeholder="Số điện thoại" />
                        </div>
                        <div class="checkout__input">
                            <p>Mật khẩu<span>*</span></p>
                            <input type="password" name="customer_password" placeholder="Mật khẩu" />
                        </div>
                        <div class="checkout__input">
                            <button type="submit" class="site-btn">Đăng ký</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection