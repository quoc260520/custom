<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{
    protected $table = "hoadon";
    protected $primaryKey = 'MAHOADON';
    public $timestamps = false;
    protected $fillable = [
        'MAHOADON',
        'MAKHACHHANG',
        'MANHANVIEN',
        'TONGTIEN',
        'GHICHU',
        'TONGSL',
        'NGAYTAO',
        'TinhTrang',
        'TRANGTHAI'
    ];
}
