<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pesananModel extends Model
{
    use HasFactory;
    protected $table = 'pesanan';
    protected $primaryKey = 'id_pesanan';
    protected $guarded = [];

     public function detail_anggota()
    {
        return $this->belongsTo(detailAnggotaModel::class, 'detail_anggota_id', 'id_anggota');
    }

     public function produk()
    {
        return $this->belongsTo(produkModel::class, 'produk_id', 'id_barang');
    }
    public function setoran()
{
    return $this->hasMany(setoranModel::class, 'pesanan_id', 'id_pesanan'); 
    // Sesuaikan nama primary key pesanan di model pesananModel
}
// Pesanan.php
public function setoran_berhasil()
{
    return $this->hasMany(setoranModel::class,'pesanan_id', 'id_pesanan')
                ->where('status', 'berhasil');
}

    public function distribusi()
{
    return $this->hasOne(distribusiModel::class, 'pesanan_id', 'id_pesanan'); 
    // Sesuaikan nama primary key pesanan di model pesananModel
}

}
