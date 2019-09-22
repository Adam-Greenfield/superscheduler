<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'games';

    protected $fillable = ['date', 'time', 'finalised'];

    public function locations()
    {
        return $this->belongsToMany(Location::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
