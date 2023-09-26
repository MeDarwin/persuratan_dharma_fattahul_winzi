<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    use HasFactory;
    /**
     * The attributes that are not assignable.
     * @var array<int, string>
     */
    protected $guarded = ['id'];
    public $timestamps = false;

}
