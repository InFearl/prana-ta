<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    use HasFactory;
    protected $table = 'pemasukan';

    protected $guarded = [
        'id'
    ];

    protected $primaryKey = 'id';

    public function detailpemasukan()
    {
        return $this->hasMany(DetailPemasukan::class, 'id');
    }

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan');
    }
}
