<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//sử dụng query builder
use DB;
//đối tượng mã hóa password
use Hash;
use Auth;
use Illuminate\Support\Arr;
use App\Models\Users;



class UsersController extends Controller
{
    public function read(Request $request){
        //lấy các bản ghi, phân 4 bản ghi trên 1 trang
        $data = Users::orderBy("id","desc")->paginate(10);
        $user = Auth::user();
        return view("admin.users.read",compact('data','user'));
    }
    public function update(Request $request,$id){
        //lấy 1 bản ghi
        $record = Users::where("id","=",$id)->first();
        //tạo biến $action để đưa vào thuộc tính action của form
        $action = url('backend/users/update-post/'.$id);
        return view("admin.users.create_update",["record"=>$record,"action"=>$action]);
    }
    public function updatePost(Request $request,$id){
        $name = $request->get("name");
        //có thể dùng cách khác để lấy giá trị
        $email = request("email");
        $password = $request->get("password");
        $role=request("role");
        //update name
        Users::where("id","=",$id)->update(["name"=>$name,"role"=>$role]);
        //nếu password không rỗng thì update password
        if($password != ""){
            //mã hóa password
            $password = Hash::make($password);
            Users::where("id","=",$id)->update(["password"=>$password]);
        }
        return redirect(url('backend/users'));
    }
    public function create(Request $request){
        //tạo biến $action để đưa vào thuộc tính action của form
        $action = url('backend/users/create-post');
        return view("admin.users.create_update",["action"=>$action]);
    }
    public function createPost(Request $request){
        $name = $request->get("name");
        //có thể dùng cách khác để lấy giá trị
        $email = request("email");
        $role=request("role");
        $password = $request->get("password");
        $password = Hash::make($password);
        //update name
        Users::insert(["name"=>$name,"email"=>$email,"password"=>$password,"role"=>$role]);
        return redirect(url('backend/users'));
    }
    public function delete(Request $request,$id){
        //xóa bản ghi
        $record = Users::where("id","=",$id)->delete();
        return redirect(url('backend/users'));
    }
}
