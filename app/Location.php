<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';

    protected $fillable = ['date', 'time', 'finalised'];

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
