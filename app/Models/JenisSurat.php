<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    use HasFactory;
    protected $table = 'jenis_surat';
    /**
     * The attributes that are not assignable.
     * @var array<int, string>
     */
    protected $guarded = ['id'];
    /**
     * Timestamps column on db
     * @var boolean */
    public $timestamps = false;
    /* -------------------------------- RELATION -------------------------------- */
    public function surat()
    {
        return $this->hasMany(Surat::class,'id_jenis_surat');
    }
}