<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persediaan extends Model
{
    use HasFactory;
    protected $table = 'persediaan';

    protected $fillable = [
        'nama_persediaan', 'jumlah_persediaan'
    ];

    protected $primaryKey = 'id';
    public function penggunaan(){
        return $this->hasMany(penggunaan::class,'id');
    }}
