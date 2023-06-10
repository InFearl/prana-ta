<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPemesanan extends Model
{
    use HasFactory;

    protected $table = 'detail_pemesanan';
    protected $guarded = [
        'id'
    ];

    // protected $fillable = [
    //     'id_persediaan', 'id_pemesanan', 'jumlah_pemesanan','eoq'
    // ];   

    protected $primaryKey = 'id';

    public function persediaan()
    {
        return $this->belongsTo(Persediaan::class, 'id_persediaan');
    }

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan');
    }
}
