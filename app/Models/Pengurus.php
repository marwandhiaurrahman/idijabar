<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function jabatan()
    {
        return $this->hasOne(Struktur::class,'id','struktur_id');
    }

}
