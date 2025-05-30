<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailAnggotaModel extends Model
{
   use HasFactory;
    protected $table = 'detail_anggota';
    protected $primaryKey = 'id_anggota';
    protected $guarded = [];

  
public function pesanan()
{
    return $this->hasMany(pesananModel::class, 'detail_anggota_id', 'id_anggota');
}
public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
}
