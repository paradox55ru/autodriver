<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auto extends Model
{
    protected $table = 'auto';

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function driver()
    {
        return $this->hasOne(Relation::class,'auto_id', 'id')->with('driver');
    }
}
