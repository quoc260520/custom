<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DienVien extends Model
{
    use HasFactory;
    protected $table = "dienvien";
    protected $primaryKey = 'MADV';
    public $timestamps = false;
    protected $fillable = [
        'MADV',
        'TENDV',
        'MOTA',
        'idPhim'
    ];
}
