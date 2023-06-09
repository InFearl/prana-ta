<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    use HasFactory;
    protected $table = 'pemasukan';

    protected $fillable = [
        'id_persediaan','biaya_total','tanggal_pemasukan','jumlah_pemasukan'
    ];

    protected $primaryKey = 'id';

    public function persediaan(){
        return $this->belongsTo(Persediaan::class,'id_persediaan');
    }
}
