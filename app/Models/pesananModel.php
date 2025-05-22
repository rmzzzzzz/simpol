<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pesananModel extends Model
{
    use HasFactory;
    protected $table = 'pesanan';
    protected $guarded = [];

     public function detail_anggota()
    {
        return $this->belongsTo(detailAnggotaModel::class, 'detail_anggota_id', 'id_anggota');
    }

     public function produk()
    {
        return $this->belongsTo(produkModel::class, 'produk_id', 'id_barang');
    }
}
