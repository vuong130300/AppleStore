@extends('layout')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <ul class="filter__controls">
            <li class="active" data-filter="*">Sản phẩm mới</li>
        </ul>
    </div>
</div>
<div class="row product__filter">
    @foreach($all_product as $key => $product)
    <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
        <div class="product__item">
            <div class="product__item__pic set-bg"
                data-setbg="{{URL::to('public/uploads/product/'.$product->product_image)}}">
                <span class="label">New</span>
                <ul class="product__hover">
                    <li><a href="#"><img src="{{asset('public/frontend/img/icon/heart.png')}}" alt=""></a></li>
                    <li><a href="#"><img src="{{asset('public/frontend/img/icon/compare.png')}}" alt="">
                            <span>Compare</span></a></li>
                    <li><a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_slug)}}"><img src="{{asset('public/frontend/img/icon/search.png')}}" alt=""></a></li>
                </ul>
            </div>
            <form>
                {{ csrf_field() }}
                <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">

                <input type="hidden" value="{{$product->product_name}}"
                    class="cart_product_name_{{$product->product_id}}">

                <input type="hidden" value="{{$product->product_quantity}}"
                    class="cart_product_quantity_{{$product->product_id}}">

                <input type="hidden" value="{{$product->product_image}}"
                    class="cart_product_image_{{$product->product_id}}">

                <input type="hidden" value="{{$product->product_price}}"
                    class="cart_product_price_{{$product->product_id}}">

                <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">

                <div class="product__item__text">
                    <h6>{{$product->product_name}}</h6>
                    <a type="button"  data-id_product="{{$product->product_id}}" name="add-to-cart" class="add-cart add-to-cart">+ Add To Cart</a>
                   
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h5> {{number_format($product->product_price).'₫'}}</h5>
                    <div class="product__color__select">
                        <label for="pc-1">
                            <input type="radio" id="pc-1">
                        </label>
                        <label class="active black" for="pc-2">
                            <input type="radio" id="pc-2">
                        </label>
                        <label class="grey" for="pc-3">
                            <input type="radio" id="pc-3">
                        </label>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endforeach
</div>

@endsection