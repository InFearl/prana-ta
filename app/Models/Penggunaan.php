<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penggunaan extends Model
{
    use HasFactory;
    protected $table = 'penggunaan';

    protected $guarded = [
        'id'
    ];

    protected $primaryKey = 'id';

    public function detailpenggunaan()
    {
        return $this->hasMany(DetailPenggunaan::class, 'id');
    }

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }
}
