<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    use HasFactory;
    protected $table = 'pemasukan';

    protected $fillable = [
        'tanggal_pemasukan'
    ];

    protected $primaryKey = 'id';

    public function persediaan(){
        return $this->belongsTo(Persediaan::class,'id_persediaan');
    }

    public function detailpemasukan()
    {
        return $this->hasMany(DetailPemasukan::class, 'id');
    }
}
