<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//khai báo class Products
use App\MyCustomClass\Products;

class ProductsController extends Controller{
	//tạo biến $model (là một biến của class ProductsController)
	public $model;
	//hàm tạo
	public function __construct(){
		//khởi tạo object của class Products, sau đó gán vào biến $model (để từ biến $model có thể gọi đến bất cứ hàm nào của class Products)
		$this->model = new Products();
	}
	public function read(){
		$data = $this->model->modelRead();
		return view("admin.products.read",["data"=>$data]);
	}
	public function update($id){
		$record = $this->model->modelGetRow($id);
		//tạo biến $action để đưa vào thuộc tính action của thẻ form
		$action = url("backend/products/update-post/$id");
		return view("admin.products.create_update",["record"=>$record,"action"=>$action]);
	}
	public function updatePost($id){
		$this->model->modelUpdate($id);
		return redirect(url("backend/products"));
	}
	public function create(){
		//tạo biến $action để đưa vào thuộc tính action của thẻ form
		$action = url("backend/products/create-post/");
		return view("admin.products.create_update",["action"=>$action]);
	}
	public function createPost(){
		$this->model->modelCreate();
		return redirect(url("backend/products"));
	}
	public function delete($id){
		$this->model->modelDelete($id);
		return redirect(url("backend/products"));
	}
}