<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuratMasuk extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['id'];
    public function disposisis()
    {
        return $this->hasMany(Disposisi::class,  'id_surat', 'id');
    }
}
