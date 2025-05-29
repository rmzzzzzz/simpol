<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userModel extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $guarded = [];

      public function detail_anggota()
{
    return $this->hasOne(detailAnggotaModel::class, 'anggota_id', 'id');
}
}
