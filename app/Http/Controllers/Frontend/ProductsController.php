<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class ProductsController extends Controller
{
    //
    public function category($category_id){
        // có thể dùng query  builder < eloquent,MPV ddeer truy vaans
        $order = request('order');
        $data = Product::where("category_id","=",$category_id)->orderBy("id","desc")->paginate(12);
        $order = request('order');
        switch ($order){
            case 'nameAsc':
                $data =Product::where("category_id","=",$category_id)->orderBy("name","asc")->paginate(4);
            break;
             case 'nameDesc':
                $data = Product::where("category_id","=",$category_id)->orderBy("name","desc")->paginate(4);
            break;
             case 'priceAsc':
                $data = Product::where("category_id","=",$category_id)->orderBy("price","desc")->paginate(4);
            break;
             case 'priceDesc':
                $data = Product::where("category_id","=",$category_id)->orderBy("price","desc")->paginate(4);
            break;
        }
        return view("frontend.product_category",["category_id"=>$category_id,"data"=>$data,"order"=>$order]);

    }
    public function detail($id){
        $record=Product::where("id","=",$id)->first();
          return view("frontend.product_detail",['record'=>$record]);

    }
    

    public function comment($id)
    {
        $username = session()->get('customer_email');
        $name="";
        if($username) {
            // Người dùng đã đăng nhập
            $namek=Users::where("email","=",$username)->select("name")->first(); 
            $name=$namek->name;
            
            
        }
        else{
          
            $name = "Ẩn Danh";
        }
        $content = request('comment'); // Lấy nội dung bình luận từ trường 'comment' trong form

        $data = DB::table("comment")->insert([
            "product_id" => $id,
            "user_name" => $name,
            "content" => $content
        ]);
        
        $record = Product::where("id", $id)->first();
        
        return view("frontend.product_detail", ['record' => $record]);
    }

    public function search(Request $request){
        // lấy biến key truyền từ ủl
        $key=request('key');// hoặc thông tin $key=$request->get('key');
        $data =DB::table("products")->where("name","like",'%'.$key.'%')->orWhere("description","like",'%'.$key.'%')->paginate(40);
        
        return view("frontend.product_search",["key"=>$key,"data"=>$data]);
       
    }
    public function ajax(){
        //lấy biến key truyền từ url
        $key = request('key');//hoặc $key = $request->get('key');
        $data = DB::table("products")->where("name","like",'%'.$key.'%')->orWhere("description","like",'%'.$key.'%')->orWhere("content","like",'%'.$key.'%')->select('name','id','photo')->get();
        $str = "";
        foreach($data as $row){
            $str =  $str."<li><img src='".asset('upload/products/'.$row->photo)."'> <a href='".url('products/detail/'.$row->id)."'>".$row->name."</a></li>";
        }
        echo $str;
    }
    public function rating($id){
        $start = request('star');
        DB::table("rating")->insert(["product_id"=>$id,'star'=>$star]);
        return redirect(url('products/detail/'.$id));
    }
     public function searchPrice(Request $request){
        // lấy biến key truyền từ ủl
        $fromPrice=request('fromPrice');// hoặc thông tin $key=$request->get('key');
        $toPrice=request('toPrice');
        $data =DB::table("products")->where("price",">=",$fromPrice)->where("price","<=",$toPrice)->paginate(40);
        
        return view("frontend.product_search_price",["fromPrice"=>$fromPrice,"data"=>$data,"toPrice"=>$toPrice]);
       
    }
}
