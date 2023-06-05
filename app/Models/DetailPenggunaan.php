<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenggunaan extends Model
{
    use HasFactory;
    protected $table = 'detail_penggunaan';

    protected $fillable = [
        'jumlah_penggunaan'
    ];

    protected $primaryKey = 'id';
}
