@extends('layout_not_category')
@section('content')

<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Đăng nhập</h4>
                    <div class="breadcrumb__links">
                        <a href="{{URL::to('/trang-chu')}}">Trang chủ</a>
                        <span>Đăng nhập</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <form action="{{URL::to('/login-customer')}}" method="POST">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        @if(session()->has('error'))
                        <div class="alert alert-danger">
                            {!! session()->get('error') !!}
                        </div>
                        @endif
                        <h6 class="coupon__code"><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click
                                here</a> to enter your code</h6>
                        <h6 class="checkout__title">Đăng nhập</h6>
                        <div class="checkout__input">
                            <p>Tên đăng nhập hoặc email<span>*</span></p>
                            <input type="text" name="email_account" placeholder="Điền tên tài khoản hoặc Email" />
                        </div>
                        <div class="checkout__input">
                            <p>Mật khẩu<span>*</span></p>
                            <input type="password" name="password_account" placeholder="Điền mật khẩu" />

                        </div>
                        <div class="checkout__input">
                            <button type="submit" class="site-btn"><i class="fas fa-sign-in-alt"></i> Đăng nhập</button>
                        </div>
                        <div class="checkout__input">
                            <p><a href="{{URL::to('/create-customer')}}"><i class="fas fa-user-plus"></i> Tạo tài khoản mới</a> </p>

                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection