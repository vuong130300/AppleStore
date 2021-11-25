@extends('layout_not_category')
@section('content')
<section class="breadcrumb-blog set-bg" data-setbg="{{asset('public/frontend/img/breadcrumb-bg.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Danh Mục</h2>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Blog Section Begin -->
<section class="blog spad">
    <div class="container">
        <div class="row">
            @foreach($post as $key => $pst)
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <a href="{{URL::to('/bai-viet/'.$pst->post_slug)}}">
                        <div class="blog__item__pic set-bg"
                            data-setbg="{{asset('public/uploads/post/'.$pst->post_image)}}"></div>
                        <div class="blog__item__text">
                            <span><img src="img/icon/calendar.png" alt=""> 16 February 2020</span>
                            <h5>{{$pst->post_title}}</h5>
                            <a href="#">Read More</a>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Blog Section End -->


@endsection