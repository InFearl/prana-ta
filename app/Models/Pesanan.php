<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'pesanan';

    protected $guarded = [
        'id'
    ];

    protected $primaryKey = 'id';

    public function penggunaan()
    {
        return $this->hasMany(Penggunaan::class, 'id');
    }
}
