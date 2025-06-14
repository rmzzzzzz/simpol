<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategoriModel extends Model
{
    use HasFactory;
    protected $table = 'kategori';
     protected $primaryKey = 'id_kategori';
    protected $guarded = [];

          public function produk()
{
    return $this->hasMany(produkModel::class, 'kategori_id', 'id_kategori');
}
}
