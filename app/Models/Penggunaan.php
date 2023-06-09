<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penggunaan extends Model
{
    use HasFactory;
    protected $table = 'penggunaan';

    protected $fillable = [
        'id_persediaan','tanggal_penggunaan','jumlah_penggunaan'
    ];

    protected $primaryKey = 'id';

    public function detailpenggunaan(){
        return $this->hasMany(DetailPenggunaan::class,'id');
    }}

