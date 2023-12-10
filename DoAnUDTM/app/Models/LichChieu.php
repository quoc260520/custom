<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LichChieu extends Model
{
    use HasFactory;
    protected $table = "lichchieu";
    protected $primaryKey = 'idLichChieu';
    public $timestamps = false;
    protected $fillable = [
        'idLichChieu',
        'ThoiGianChieu',
        'idPhong',
        'idPhim',
        'GiaVe',
        'ThoiGianKetThuc'
    ];
    public function phong(): BelongsTo
    {
        return $this->belongsTo(PhongChieu::class, 'idPhong', 'idPhongChieu');
    }
    public function phim(): BelongsTo
    {
        return $this->belongsTo(Phim::class, 'idPhim', 'idPhim');
    }
}
