<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//sử dụng model

use DB;




class SlideController extends Controller
{
    public function read(Request $request){
        //lấy các bản ghi, phân 4 bản ghi trên 1 trang
        $data = DB::table("slide")->orderBy("id","desc")->paginate(6);
        return view("admin.slide.read",["data"=>$data]);
    }
    public function update(Request $request,$id){
        //lấy 1 bản ghi
        $record =DB::table("slide")->where("id","=",$id)->first();
        //tạo biến $action để đưa vào thuộc tính action của form
        $action = url('backend/slide/update-post/'.$id);
        return view("admin.slide.create_update",["record"=>$record,"action"=>$action]);
    }
    public function updatePost(Request $request,$id){
        $name = $request->get("name");
        $display = $request->get("display") != "" ? 1 : 0;
        $photo = "";
        $record=DB::table("slide")->where("id","=",$id)->first();
        $oldPhoto = $record->photo;
        if ($request->hasFile("photo")) {
            $file = $request->file("photo");
            $file_name = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path("upload/slide"), $file_name);
            $photo = $file_name;
            if (!empty($oldPhoto)) {
                $oldPhotoPath = public_path("upload/slide") . "/" . $oldPhoto;
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }
        }
        

        // Tạo bản ghi
        DB::table("slide")->where("id","=",$id)->update(["name" => $name, "display" => $display, "photo" => $photo]);

        return redirect(url('backend/slide'));
    }
    public function create(Request $request){
        //tạo biến $action để đưa vào thuộc tính action của form
        $action = url('backend/slide/create-post');
        return view("admin.slide.create_update",["action"=>$action]);
    }
    public function createPost(Request $request)
    {
        $name = $request->get("name");
        $display = $request->get("display") != "" ? 1 : 0;
        $photo = "";

        if ($request->hasFile("photo")) {
            $file = $request->file("photo");
            $file_name = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path("upload/slide"), $file_name);
            $photo = $file_name;
        }

        // Tạo bản ghi
        DB::table("slide")->insert(["name" => $name, "display" => $display, "photo" => $photo]);

        return redirect(url('backend/slide'));
    }

    public function delete(Request $request,$id){
        //xóa bản ghi
        $record = DB::table("slide")->where("id","=",$id)->delete();
        return redirect(url('backend/slide'));
    }
}
