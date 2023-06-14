<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;
    protected $table = 'pemesanan';

    protected $guarded = [
        'id'
    ];

    protected $primaryKey = 'id';

    public function detailpemesanan()
    {
        return $this->hasMany(DetailPemesanan::class, 'id');
    }
}
