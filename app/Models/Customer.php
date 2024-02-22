<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    //khai báo table để model truy vấn
    public $table = "customers";
    //nếu trong table categories không có 2 trường create_at, update_at thì phải khai báo thêm dòng sau
    public $timestamps = false;
}
