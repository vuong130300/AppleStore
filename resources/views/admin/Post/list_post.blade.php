@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê bài viết
        </div>
        <div class="row w3-res-tb">
            <div class="col-sm-5 m-b-xs">
                <select class="input-sm form-control w-sm inline v-middle">
                    <option value="0">Bulk action</option>
                    <option value="1">Delete selected</option>
                    <option value="2">Bulk edit</option>
                    <option value="3">Export</option>
                </select>
                <button class="btn btn-sm btn-default">Apply</button>
            </div>
            <div class="col-sm-4">
            </div>
            <div class="col-sm-3">
                <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="Search">
                    <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group" style="text-align:center;">
            @php
                $message=Session::get('message');
                if($message){
                    echo '<div class="alert alert-success">' .$message. '</div>';
                Session::put('message',null);
                }
            @endphp
        </div>
        <div class="table-responsive">

            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Tên bài viết</th>
                        <th>Slug bài viết</th>
                        <th>Hình sản phẩm</th>
                        <th>Danh mục bài viết</th>
                        <!-- <th style="table-layout: fixed;">Tóm tắt bài viết</th>
                        <th style="table-layout: fixed;">Nội dung bài viết</th> -->
                        <th>Hiển thị</th>
                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_post as $key =>$post)
                    <tr>
                        <td>{{ $post -> post_title }}</td>
                        <td>{{ $post -> post_slug }}</td>
                        <td><img class="img-fluid" src="{{asset('public/uploads/post/'.$post -> post_image)}}" alt="">
                        </td>
                        <td>{{ $post -> category_post -> category_post_name}}</td>

                        <!-- <td>
                            <textarea rows="4" cols="10">
                                {{ $post -> post_desc }}
                            </textarea>
                        </td>
                        <td>
                            <textarea rows="4" cols="10">
                                {{ $post -> post_content }}
                            </textarea>
                        </td> -->
                        <td>
                            <span class="text-ellipsis">
                                @if($post -> post_status==1)
                                <a href="{{URL::to('/active-post/'.$post -> post_id)}}"><span
                                        class="fa-styling fa fa-eye"></span></a>
                                @else
                                
                                <a href="{{URL::to('/unactive-post/'.$post -> post_id)}}"><span
                                        class="fa-styling fa fa-eye-slash"></span></a>
                                @endif
                            </span>
                        </td>
                        <td>
                            <a href="{{URL::to('edit-post/'.$post -> post_id)}}" class="active style-edit"
                                ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i>
                            </a>
                            <a onclick="return confirm('Bạn có chắc muốn xóa bài viết?')"
                                href="{{URL::to('delete-post/'.$post -> post_id)}}" class="active style-edit"
                                ui-toggle-class="">
                                <i class="fa fa-times text-danger text"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <footer class="panel-footer">
            <div class="row">

                <div class="col-sm-5 text-center">
                    <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                </div>
                <div class="col-sm-7 text-right text-center-xs">
                    <ul class="pagination pagination-sm m-t-none m-b-none">
                        {!!$all_post->links()!!}
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection