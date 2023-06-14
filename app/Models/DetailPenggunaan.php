<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenggunaan extends Model
{
    use HasFactory;
    protected $table = 'detail_penggunaan';

    protected $guarded = [
        'id'
    ];

    protected $primaryKey = 'id';

    public function persediaan()
    {
        return $this->belongsTo(Persediaan::class, 'id_persediaan');
    }

    public function penggunaan()
    {
        return $this->belongsTo(Penggunaan::class, 'id_penggunaan');
    }
}
