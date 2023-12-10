<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    public function chiTietVe(): HasMany
    {
        return $this->hasMany(ChiTietVe::class, 'MAHOADON', 'MAHOADON');
    }
    public function chiTietThucAn(): HasMany
    {
        return $this->hasMany(ChiTietThucAn::class, 'MAHOADON', 'MAHOADON');
    }
    public function nhanVien()
    {
        return $this->belongsTo(NhanVien::class, 'MANHANVIEN', 'idNhanVien');
    }
}
