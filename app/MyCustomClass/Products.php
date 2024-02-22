<?php 
namespace App\MyCustomClass;

use App\Models\Categories;
use App\Models\Product;
use DB;
use Request;
class Products{
	public function modelRead(){
		$data =Product::orderBy("id","desc")->paginate(10);
		return $data;
	}
	//tạo hàm static để gọi trực tiếp bằng tên class mà không cần khởi tạo object
	public static function getCategoryName($category_id){
		$record = Categories::where("id","=",$category_id)->first();
		return isset($record->name) ? $record->name : "";
	}
	public function modelGetRow($id){
		$record =Product::where("id","=",$id)->first();
		return $record;
	}
	public function modelUpdate($id){
		$name = Request::get("name");//có thể sử dụng hàm request("name")
		$category_id = Request::get("category_id");
		$price = Request::get("price");
		$discount = Request::get("discount");
		$hot = Request::get("hot") != "" ? 1 : 0;
		$description = Request::get("description");
		$content = Request::get("content");
		$quantity = Request::get("quantity");
		//update bản ghi
		Product::where("id","=",$id)->update(["name"=>$name,"category_id"=>$category_id,"description"=>$description,"content"=>$content,"hot"=>$hot,"price"=>$price,"discount"=>$discount,"quantity"=>$quantity]);
		//nếu có upload ảnh thì update
		if(Request::hasFile("photo")){
			//---
			//lấy ảnh cũ để xóa
			$record = Product::where("id","=",$id)->first();
			if(file_exists('upload/products/'.$record->photo))
				unlink('upload/products/'.$record->photo);//xóa ảnh
			//---
			$file_name = Request::file("photo")->getClientOriginalName();
			$file_name = time()."_".$file_name;
			Request::file("photo")->move("upload/products",$file_name);
			Product::where("id","=",$id)->update(["photo"=>$file_name]);
		}
	}
	public function modelCreate(){
		$name = Request::get("name");//có thể sử dụng hàm request("name")
		$category_id = Request::get("category_id");
		$price = Request::get("price");
		$discount = Request::get("discount");
		$hot = Request::get("hot") != "" ? 1 : 0;
		$description = Request::get("description");
		$content = Request::get("content");
		$photo = "";
		$quantity = Request::get("quantity");
		//nếu có upload ảnh
		if(Request::hasFile("photo")){
			$file_name = Request::file("photo")->getClientOriginalName();
			$photo = time()."_".$file_name;
			Request::file("photo")->move("upload/products",$photo);
		}
		//create bản ghi
		Product::insert(["name"=>$name,"category_id"=>$category_id,"description"=>$description,"content"=>$content,"hot"=>$hot,"photo"=>$photo,"price"=>$price,"discount"=>$discount,"quantity"=>$quantity]);
		
	}
	public function modelDelete($id){
		//---
		//lấy ảnh cũ để xóa
		$record = Product::where("id","=",$id)->first();
		if(file_exists('upload/products/'.$record->photo))
			unlink('upload/products/'.$record->photo);//xóa ảnh
		//---
		//xóa bản ghi
		Product::where("id","=",$id)->delete();
	}
}