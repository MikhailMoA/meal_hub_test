<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Santa extends Authenticatable
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'santa_id',
    ];

    /**
     * @return HasOne
     */
    public function ward(): HasOne
    {
        return $this->hasOne(Santa::class, 'id', 'santa_id');
    }
}
