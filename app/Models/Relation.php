<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    protected $table = 'relation';

    public $timestamps = false;

    protected $fillable = [
        'driver_id',
        'auto_id'
    ];

    public function auto()
    {
        return $this->hasOne(Auto::class,'id', 'auto_id');
    }

    public function driver()
    {
        return $this->hasOne(Driver::class,'id', 'driver_id');
    }
}
