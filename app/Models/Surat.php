<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;
    protected $table = 'surat';
    /**
     * The attributes that are not assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];
    public $timestamps = false;
    public function jenis()
    {
        return $this->belongsTo(JenisSurat::class, 'id_jenis_surat');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}