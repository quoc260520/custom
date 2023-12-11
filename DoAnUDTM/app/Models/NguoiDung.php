<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class NguoiDung extends Authenticatable
{
    use HasFactory;
    protected $table='taikhoan';
    protected $username = 'TenDangNhap'; 
    protected $password = 'MatKhau';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'TenDangNhap',
        'MatKhau',
        'TinhTrang'
    ];
}
