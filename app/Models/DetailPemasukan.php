<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPemasukan extends Model
{
    use HasFactory;
    protected $table = 'detail_pemasukan';

    protected $fillable = [
        'id_persediaan', 'id_pemasukan', 'jumlah_pemasukan'
    ];

    protected $primaryKey = 'id';

    public function persediaan()
    {
        return $this->belongsTo(Persediaan::class, 'id_persediaan');
    }

    public function pemasukan()
    {
        return $this->belongsTo(Pemasukan::class, 'id_pemasukan');
    }
}
