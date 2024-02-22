<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;

use DB;

class OrdersController extends Controller
{
    //danh sách đơn hàng
    public function read(){
        $data = Order::orderBy("id","desc")->paginate(10);
        return view("admin.orders.read",["data"=>$data]);
    }
    //chi tiết đơn hàng
    public function detail($id){
        //lấy đơn hàng
        $order =Order::where("id","=",$id)->first();
        //lấy thông tin khách hàng
        $customer = Customer::where("id","=",$order->customer_id)->first();
        //lấy danh sách các sản phẩm thuộc đơn hàng
        $products = OrderDetail::where("order_id","=",$id)->get();
        return view("admin.orders.detail",["order_id"=>$id]);
    }
    public function delete($id){
        //lấy đơn hàng
        Order::where("id","=",$id)->delete();
        OrderDetail::where("order_id","=",$id)->delete();
        return redirect(url('backend/orders'));
    //cập nhật tình trạng đơn hàng từ chưa giao hàng thành đã giao hàng
    }
    public function update($id){
        Order::where("id","=",$id)->update(["status"=>3]);
        $datas=OrderDetail::where("order_id","=",$id)->get();
        foreach($datas as $data){
            $product=Product::where("id",'=',$data->product_id)->first();
            $product->decrement('quantity', $data->quantity);
            $product->save();

        }
        return redirect(url('backend/orders/detail/'.$id));
    }
}
