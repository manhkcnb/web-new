@extends("frontend.layout_home")
@section("do-du-lieu-vao-layout")
@php
//để sử dụng các hàm bên trong trait Cart thì phải khai báo ở đây
use \App\Http\ShoppingCart\Cart;
use \App\Models\Product;
@endphp
@if(isset($cart))
<div class="template-cart">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

  <form action="{{ url('cart/update') }}" method="post">
    <!-- phải đặt csrf vào bên trong thẻ form thì mới bắt được dữ liệu theo kiểu POST -->
    @csrf
    <div class="table-responsive">
      <table class="table table-cart">
        <thead>
          <tr>
            <th class="image">Ảnh sản phẩm</th>
            <th class="name">Tên sản phẩm</th>

            <th class="price">Giá bán lẻ</th>
            <th class="quantity">Số lượng</th>
            <th class="price">Thành tiền</th>
            <th>Xóa</th>
          </tr>
        </thead>
        <tbody>
          @foreach($cart as $product)
          @php
          $quantity = Product::where("id","=",$product['id'])->first();
          
          @endphp
          
          <tr>
            <td><img src="{{ asset('upload/products/'.$product['photo']) }}" class="img-responsive" /></td>
            <td><a href="{{ url('products/detail/'.$product['id']) }}">{{ $product['name'] }}</a></td>
            <td> {{ number_format($product['price']) }}₫ </td>
            <td><input type="number" id="qty" min="0"  max="{{ $quantity->quantity }}" class="input-control" value="{{ $product['quantity'] }}"
                name="product_{{ $product['id'] }}" required="Không thể để trống"></td>
            <td>
              <p><b>{{ number_format($product['quantity'] * ($product['price'] - ($product['price'] *
                  $product['discount'])/100)) }}₫</b></p>
            </td>
            <td><a href="{{ url('cart/remove/'.$product['id']) }}" data-id="2479395"><i class="fa fa-trash"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
        @if(Cart::cartNumber() > 0)
        <tfoot>
          <tr>
            <td colspan="6"><a href="{{ url('cart/destroy') }}" class="button pull-left">Xóa toàn bộ</a> <a
                href="{{ url('') }}" class="button pull-right black">Tiếp tục mua hàng</a>
              <input type="submit" class="button pull-right" value="Cập nhật">
            </td>
          </tr>
        </tfoot>
        @endif
      </table>
    </div>
  </form>
  @if(Cart::cartNumber() > 0)
  <div class="total-cart"> Tổng tiền thanh toán:
    {{ number_format(Cart::cartTotal()) }}₫ <br>
    <div style="display: flex; justify-content:right">
      <a href="{{ url('cart/order') }}" class="button black">Thanh toán khi nhận hàng</a>
      <form method="post" action="{{ route('vnpay') }}">
        @csrf
        <input type="hidden" value="{{ number_format(Cart::cartTotal()) }}" name="price" />
        <button type="submit" name="redirect" class="button black">Thanh toán bằng VNPAY</button>
      </form>
    </div>
  </div>

  @endif
</div>
@else
<div class="template-cart">
  <div class="table-responsive">
      <div style="text-align: center">
          <img src="{{ asset('upload/empty-cart.webp') }}">
      </div>
  </div>

</div>

@endif
@endsection