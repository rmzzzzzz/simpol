<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class setoranModel extends Model
{
    use HasFactory;
    protected $table = 'setoran';
    protected $primaryKey = 'id_setoran';
    protected $guarded = [];

public function pesanan()
{
    return $this->belongsTo(pesananModel::class,'pesanan_id', 'id_pesanan'); // sesuaikan FK-nya
}

}
