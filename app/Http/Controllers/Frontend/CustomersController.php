<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Hash;
use DB;
use App\Models;
use App\Models\Customer;
use App\Models\Users;

class CustomersController extends Controller
{
    public function login(){
        return view("frontend.form_customers_login");
    }
    public function loginPost(){
        $email = request()->get("email");
        $password = request()->get("password");
        $record = Customer::where("email","=",$email)->first();
        $record1 = Users::where("email","=",$email)->first();
        if(isset($record->email)){
            if(Hash::check($password,$record->password)){
                session()->put("customer_email",$record->email);
                session()->put("customer_id",$record->id);
                return redirect(url(''));
            }
        }
        if(isset($record1->email)){
            if(Hash::check($password,$record1->password)){
                session()->put("customer_email",$record1->email);
                return redirect(url(''));
            }
        }
        return redirect(url('customers/login?notify=invalid'));
    }
    public function register(){
        return view("frontend.form_customers_register");
    }
    public function registerPost(){
        $email = request()->get("email");
        $password = request()->get("password");
        $password = Hash::make($password);
        $name = request()->get("name");
        $phone = request()->get("phone");
        $address = request()->get("address");
        //kiểm tra xem email đã tồn tại chưa, nếu chưa thì mới cho insert
        $check = Customer::where("email","=",$email)->first();
        $check1 = Users::where("email","=",$email)->first();
        if(!isset($check->email)&&!isset($check1->email)){
            Customer::insert(["email"=>$email,"name"=>$name,'password'=>$password,'phone'=>$phone,'address'=>$address]);
            Users::insert(["email"=>$email,"name"=>$name,'password'=>$password,"role"=>"3"]);
        }
        else
            return redirect(url('customers/register?notify=invalid'));
        return redirect(url('customers/login'));
    }
    public function logout(){
        session()->remove("customer_email");
        session()->remove("customer_id");
        session()->remove("cart");
        return redirect(url(''));
    }
}
