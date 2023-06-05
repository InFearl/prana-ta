<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'pesanan';

    protected $fillable = [
        'nama_perusahaan', 'c20ft', 'c40ft', 'tanggal_masuk', 'tanggal_akhir', 'status_pesanan'
    ];

    protected $primaryKey = 'id';
}
