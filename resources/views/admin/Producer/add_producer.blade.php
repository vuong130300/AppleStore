@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm nhà cung cấp
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/save-producer')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <?php
                                $message=Session::get('message');
                                if($message){
                                    echo '<div class="alert alert-success">' .$message. '</div>';
                                Session::put('message',null);
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên nhà cung cấp</label>
                            <input type="text" name="producer_name" class="form-control"
                                placeholder="Enter email">
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="producer_status" class="form-control m-bot15">
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>

                        <button type="submit" name="add_producer" class="btn btn-info">Thêm nhà cung cấp</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection