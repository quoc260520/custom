<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhanVien extends Model
{
    use HasFactory;
    protected $table = "nhanvien";
    protected $primaryKey = 'idNhanVien';
    public $timestamps = false;
    protected $fillable = [
        'idNhanVien',
        'HoTen',
        'NgaySinh',
        'SDT',
        'DiaChi',
        'Email',
        'NgayTao',
        'NgayThayDoi',
        'idChucVu',
        'GioiTinh',
        'idTK'
    ];
}
