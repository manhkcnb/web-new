@extends("admin.layout")
@section("do-du-lieu-tu-view")

@php
//lấy thông tin đơn hàng
function getOrder($order_id){
$order = DB::table("orders")->where("id","=",$order_id)->first();
return $order;
}
//lấy thông tin customer
function getCustomer($customer_id){
$customer = DB::table("customers")->where("id","=",$customer_id)->first();
return $customer;
}
//lấy thông tin sản phẩm thuộc đơn hàng
function getProducts($order_id){
    $products = DB::table("order_details")
        ->where('order_id', "=", $order_id)
        ->join("products", "products.id", "=", "order_details.product_id")
        ->select("products.quantity as product_quantity", "products.name", "products.photo", "products.discount", "order_details.quantity", "order_details.price")
        ->get();
return $products;
}
@endphp

@php
$order = getOrder($order_id);
$customer = getCustomer($order->customer_id)
@endphp
<div class="col-md-12">
    <div style="margin-bottom:5px;">
        <a href="#" onclick="history.go(-1);" class="btn btn-primary">Quay lại</a>
        @if($order->status != 3)
        <a href="{{ url('backend/orders/update/'.$order->id) }}" class="btn btn-danger execute-btn">Thực hiện giao hàng</a>
        @endif
        <a href="{{ url('backend/orders/delete/'.$order->id) }}" class="btn btn-danger">Xóa</a>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">Thông tin đơn hàng</div>
        <div class="panel-body">
            <table class="table">
                <tr>
                    <td style="width:200px;">Tên khách hàng</td>
                    <td>{{ isset($customer->name) ? $customer->name : "" }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ isset($customer->email) ? $customer->email : "" }}</td>
                </tr>
                <tr>
                    <td>ngày mua</td>
                    <td>{{ isset($order->date) ? date("d/m/Y", strtotime($order->date)) : "" }}</td>
                </tr>
                <tr>
                    <td>Tổng giá</td>
                    <td>{{ isset($order->price) ? $order->price : "" }}</td>
                </tr>
                <tr>
                    <td>Trạng thái giao hàng</td>
                    @if ($order->status==3)
                    <td>Đã giao hàng</td>
                    @elseif($order->status==2)
                    <td>Đã thanh toán</td>
                    @else
                    <td>Đã đặt hàng</td>
                    @endif

                </tr>
            </table>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">Chi tiết đơn hàng</div>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <tr>
                    <th style="width:100px;">Photo</th>
                    <th>Name</th>
                    <th style="width:100px;">Price</th>
                    <th style="width:80px;">Discount</th>
                    <th style="width:80px;">Quantity</th>

                    <th style="width:150px;">Remaining product</th>


                </tr>
                @php
                $products = getProducts($order_id);
                @endphp
                @foreach($products as $row)
                <tr>
                    <td>
                        @if($row->photo != "" && file_exists('upload/products/'.$row->photo))
                        <img src="{{ asset('upload/products/'.$row->photo) }}" style="width:100px;">
                        @endif
                    </td>
                    <td>{{ $row->name }}</td>
                    <td>{{ number_format($row->price) }}</td>
                    <td style="text-align:center;">{{ $row->discount }}%</td>
                    <td style="text-align:center;">{{ $row->quantity }}</td>

                    <td style="width:150px;">
                        @if($row->product_quantity < $row->quantity)
                           <p style="color: red"> Kho còn {{ $row->product_quantity }} sản phẩm không đủ hàng.Vui lòng xóa đơn hàng</p>
                        @else
                            Kho còn {{ $row->product_quantity  }} sản phẩm
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var executeBtn = document.querySelector('.execute-btn');

        // Lặp qua mảng products để kiểm tra điều kiện và ẩn nút nếu cần
        @foreach($products as $row)
            @if($row->product_quantity < $row->quantity)
                executeBtn.style.display = 'none';
            @endif
        @endforeach
    });
</script>
@endsection