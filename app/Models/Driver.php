<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $table = 'driver';

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function auto()
    {
        return $this->hasOne(Relation::class, 'driver_id', 'id')->with('auto');
    }
}
