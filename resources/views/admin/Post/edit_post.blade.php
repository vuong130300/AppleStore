@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật bài viết
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/update-post/'.$post->post_id)}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên bài viết</label>
                            <input type="text" name="post_title" class="form-control" placeholder="Enter email"
                                id="slug" onkeyup="ChangeToSlug();" value="{{$post->post_title}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" name="post_slug" class="form-control" placeholder="Tên danh mục"
                                id="convert_slug" value="{{$post->post_slug}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh bài viết</label>
                            <input type="file" name="post_image" class="form-control">
                            <img class="img-fluid" src="{{asset('public/uploads/post/'.$post->post_image)}}"
                                alt="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tóm tắt bài viết</label>
                            <textarea name="post_desc" class="form-control" id="ckeditor1" placeholder="Mô tả sản phẩm"
                                style="resize:none">{{$post->post_desc}}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung bài viết</label>
                            <textarea name="post_content" style="resize:none" rows=8 class="form-control" id="ckeditor2"
                                placeholder="Mô tả nội dung sản phẩm">{{$post->post_content}}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Meta từ khóa</label>
                            <textarea name="post_meta_keywords" style="resize:none" rows=3 class="form-control"
                                placeholder="Mô tả nội dung sản phẩm">{{$post->post_meta_keywords}}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Meta nội dung</label>
                            <textarea name="post_meta_desc" style="resize:none" rows=3 class="form-control"
                                placeholder="Mô tả nội dung sản phẩm">{{$post->post_meta_desc}}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh mục bài viết</label>
                            <select name="category_post_id" class="form-control m-bot15">
                                @foreach($cate_post as $key =>$cate)
                                <option {{$post->category_post_id == $cate->category_post_id ? 'selected' : ''}} value="{{$cate->category_post_id}}">{{$cate->category_post_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="post_status" class="form-control m-bot15">
                                @if($post->post_status==1)
                                    <option selected value="1">Hiển thị</option>
                                    <option value="0">Ẩn</option>
                                @else
                                    <option value="1">Hiển thị</option>
                                    <option selected value="0">Ẩn</option>
                                @endif
                            </select>
                        </div>

                        <button type="submit" name="update_post" class="btn btn-info">Cập nhật bài viết</button>
                    </form>
                </div>
            </div>
        </section>

    </div>
</div>
@endsection