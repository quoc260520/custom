<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietThucAn extends Model
{
    use HasFactory;
    protected $table = "chitietthucan";
    protected $primaryKey = 'MACT';
    public $timestamps = false;
    protected $fillable = [
        'MACT',
        'MATHUCAN',
        'MAHOADON',
        'SOLUONG'
    ];
    public function thucAn()
    {
        return $this->belongsTo(ThucAn::class, 'MATHUCAN', 'MATHUCAN');
    }
}
