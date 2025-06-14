<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produkModel extends Model
{
   use HasFactory;
    protected $table = 'produk';
     protected $primaryKey = 'id_barang';
    protected $guarded = [];

     public function kategori()
    {
        return $this->belongsTo(kategoriModel::class, 'kategori_id', 'id_kategori');
    }
             public function pesanan()
{
    return $this->hasMany(pesananModel::class, 'produk_id', 'id_barang');
}
}

