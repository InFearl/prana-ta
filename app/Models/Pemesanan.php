<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;
    protected $table = 'pemesanan';

    protected $fillable = [
        'id_persediaan','biaya_total','tanggal_pemesanan','jumlah_pemesanan','status_pemesanan'
    ];

    protected $primaryKey = 'id';

    public function persediaan(){
        return $this->belongsTo(Persediaan::class,'id_persediaan');
    }

    public function detailpemesanan()
    {
        return $this->hasMany(DetailPemesanan::class, 'id');
    }

}
