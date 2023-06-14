<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persediaan extends Model
{
    use HasFactory;
    protected $table = 'persediaan';

    protected $guarded = [
        'id'
    ];

    protected $primaryKey = 'id';

    public function detailpenggunaan()
    {
        return $this->hasMany(DetailPenggunaan::class, 'id');
    }

    public function detailpemasukan()
    {
        return $this->hasMany(DetailPemasukan::class, 'id');
    }

    public function detailpemesenan()
    {
        return $this->hasMany(DetailPemesanan::class, 'id');
    }

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'id');
    }
}
