<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietVe extends Model
{
    use HasFactory;
    protected $table = "chitietve";
    protected $primaryKey = 'MACT';
    public $timestamps = false;
    protected $fillable = [
        'MACT',
        'idVe',
        'MAHOADON',
        'GiaVe'
    ];
}
