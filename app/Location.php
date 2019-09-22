<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';

    protected $fillable = ['date', 'time', 'finalised'];

    public function games()
    {
        return $this->hasMany(Game::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
