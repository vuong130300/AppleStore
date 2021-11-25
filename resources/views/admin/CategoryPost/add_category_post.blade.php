@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm danh mục bài viết
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/save-category-post')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group" style="text-align:center;">
                            <?php
                                $message=Session::get('message');
                                if($message){
                                    echo '<div class="alert alert-success">' .$message. '</div>';
                                Session::put('message',null);
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục bài viết</label>
                            <input type="text" name="category_post_name" class="form-control" id="slug"
                                placeholder="Enter email" onkeyup="ChangeToSlug();">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug danh mục bài viết</label>
                            <input type="text" name="category_post_slug" class="form-control" id="convert_slug" 
                                placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục bài viết</label>
                            <textarea name="category_post_desc" style="resize:none" rows=8 class="form-control"
                                id="exampleInputPassword1" placeholder="Mô tả danh mục">
                                        </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="category_post_status" class="form-control m-bot15">
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>

                        <button type="submit" name="add_category_post" class="btn btn-info">Thêm danh mục bài viết</button>
                    </form>

                </div>
            </div>
        </section>

    </div>
</div>
@endsection