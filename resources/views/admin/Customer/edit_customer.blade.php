@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật thông tin khách hàng
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/update-customer/'.$all_customer->customer_id)}}" method="post">
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
                            <label for="exampleInputEmail1">Họ tên khách hàng</label>
                            <input type="text" name="customer_name" class="form-control" placeholder="Enter email" value="{{$all_customer->customer_name}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Địa chỉ email</label>
                            <input type="email" name="customer_email" class="form-control" placeholder="Địa chỉ email" value="{{$all_customer->customer_email}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Số điện thoại</label>
                            <input type="text" name="customer_phone" class="form-control" placeholder="Số điện thoại" value="{{$all_customer->customer_phone}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mật khẩu</label>
                            <input type="password" name="customer_password" class="form-control" placeholder="Mật khẩu" value="{{$all_customer->customer_password}}">
                        </div>

                        <button type="submit" name="edit_customer" class="btn btn-info">Cập nhật thông tin khách hàng</button>
                    </form>

                </div>
            </div>
        </section>

    </div>
</div>
@endsection