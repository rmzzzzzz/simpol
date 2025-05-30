<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class distribusiModel extends Model
{
    use HasFactory;
    protected $table = 'distribusi';
    protected $primaryKey = 'id_distribusi';
    protected $guarded = [];
}
