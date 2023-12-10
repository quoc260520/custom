<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChucVu extends Model
{
    protected $table = "chucvu";
    protected $primaryKey = 'idCV';
    public $timestamps = false;
    protected $fillable = [
        'idCV',
        'TenChucVu',
    ];
}
