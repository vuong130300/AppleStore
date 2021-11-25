@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">

    <div class="panel panel-default">
        <div class="panel-heading">
            Thông tin đăng nhập
        </div>

        <div class="table-responsive">
            <?php
                $message = Session::get('message');
                if($message){
                    echo '<span class="text-alert">'.$message.'</span>';
                    Session::put('message',null);
                }
            ?>
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$customer->customer_name}}</td>
                        <td>{{$customer->customer_phone}}</td>
                        <td>{{$customer->customer_email}}</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
<br>
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Thông tin vận chuyển
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Tên người vận chuyển</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Ghi chú</th>
                        <th>Hình thức thanh toán</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$shipping->shipping_name}}</td>
                        <td>{{$shipping->shipping_address}},
                            {{$wards->name_xaphuong}},
                            {{$province->name_quanhuyen}},
                            {{$city->name_thanhpho}}
                        </td>
                        <td>{{$shipping->shipping_phone}}</td>
                        <td>{{$shipping->shipping_email}}</td>
                        <td>{{$shipping->shipping_notes}}</td>
                        <td>@if($shipping->shipping_method==0) Chuyển khoản @else Tiền mặt @endif</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<br><br>
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê chi tiết đơn hàng
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

        <div class="table-responsive">
            <?php
                $message = Session::get('message');
                if($message){
                    echo '<span class="text-alert">'.$message.'</span>';
                    Session::put('message',null);
                }
            ?>
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Thứ tự</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng kho còn</th>
                        <th>Số lượng</th>
                        <th>Giá sản phẩm</th>
                        <th>Tổng tiền</th>
                        <th>Mã khuyến mãi</th>
                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 0;
                    $fee_ship=0;
                    $total = 0;
                    @endphp
                    @foreach($order_details as $key => $details)

                    @php
                    $i++;
                    $subtotal = $details->product_price*$details->product_sales_quantity;
                    $total+=$subtotal;
                    @endphp
                    <tr class="color_qty_{{$details->product_id}}">
                        <td><i>{{$i}}</i></td>
                        <td>{{$details->product_name}}</td>
                        <td>{{$details->product->product_quantity}}</td>
                        <td> 
                            <input type="number" min="1" class="style order_qty_{{$details->product_id}}"
                                value="{{$details->product_sales_quantity}}" name="product_sales_quantity" {{$order_status != 1 ? 'disabled' : ''}}>

                            <input type="hidden" name="order_qty_storage"
                                class="order_qty_storage_{{$details->product_id}}"
                                value="{{$details->product->product_quantity}}">

                            <input type="hidden" name="order_code" class="order_code" value="{{$details->order_code}}">

                            <input type="hidden" name="order_product_id" class="order_product_id"
                                value="{{$details->product_id}}">
                        @if($order_status==1) 
                            <button class="btn btn-info update_quantity_order"
                                data-product_id="{{$details->product_id}}" name="update_quantity_order">Cập
                                nhật</button>
                        @endif
                        </td>
                        <td>{{number_format($details->product_price,0,',','.')}}₫</td>
                        <td>{{number_format( $subtotal,0,',','.')}}₫</td>
                        <td>@if($details->product_coupon!='no')
                            {{$details->product_coupon}}
                            @else
                            Không dùng mã
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="6">
                            Tạm tính: {{number_format($total,0,',','.')}}₫
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            @php
                            $total_coupon = 0;
                            @endphp
                            @if($coupon_condition==1)
                            @php
                            $total_after_coupon = ($total*$coupon_number)/100;
                            echo 'Giảm giá: '.number_format($total_after_coupon,0,',','.').'₫';
                            $total_coupon = $total + $fee_ship - $total_after_coupon ;
                            @endphp
                            @else
                            @php
                            echo 'Giảm giá: '.number_format($coupon_number,0,',','.').'₫';
                            $total_coupon = $total + $fee_ship - $coupon_number ;
                            @endphp
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            @php
                            if($total>=15000000){
                            echo'Phí vận chuyển: 0₫';
                            }
                            else{
                            $fee_ship=30000;
                            echo'Phí vận chuyển: '.number_format($fee_ship,0,',','.').'₫';
                            }
                            @endphp
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            Tổng tiền: {{number_format($total_coupon + $fee_ship,0,',','.')}}₫
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            @foreach($order as $key => $or)
                            @if($or->order_status==1)
                            <form>
                                {{csrf_field()}}
                                <select class="form-control order_details">
                                    <option value="">----Chọn hình thức đơn hàng-----</option>
                                    <option id="{{$or->order_id}}" selected value="1">Chưa xử lý</option>
                                    <option id="{{$or->order_id}}" value="2">Đã xử lý-Đã giao hàng</option>
                                    <option id="{{$or->order_id}}" value="3">Hủy đơn hàng</option>
                                </select>
                            </form>
                            @elseif($or->order_status==2)
                            <form>
                            {{csrf_field()}}
                                <select class="form-control order_details">
                                    <!-- <option value="">----Chọn hình thức đơn hàng-----</option> -->
                                    <!-- <option id="{{$or->order_id}}" value="1">Chưa xử lý</option> -->
                                    <option id="{{$or->order_id}}" selected value="2">Đã xử lý-Đã giao hàng</option>
                                    <!-- <option id="{{$or->order_id}}" value="3">Hủy đơn hàng</option> -->
                                </select>
                            </form>

                            @else
                            <form>
                            {{csrf_field()}}
                                <select class="form-control order_details">
                                    <!-- <option value="">----Chọn hình thức đơn hàng-----</option> -->
                                    <!-- <option id="{{$or->order_id}}" value="1">Chưa xử lý</option>
                                    <option id="{{$or->order_id}}" value="2">Đã xử lý-Đã giao hàng</option> -->
                                    <option id="{{$or->order_id}}" selected value="3">Hủy đơn hàng</option>
                                </select>
                            </form>

                            @endif
                            @endforeach


                        </td>
                    </tr>
                </tbody>
            </table>

            <a target="_blank" href="{{url('/print-order/'.$details->order_code)}}" class="btn btn-info">In đơn hàng
            </a>
        </div>
    </div>
</div>
@endsection