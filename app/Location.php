<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';

    protected $fillable = ['name', 'adress_ln_1', 'adress_ln_2', 'town', 'postcode', 'notes', 'user_id'];


    public function games()
    {
        return $this->belongsToMany(Game::class);
    }

    public function game()
    {
        return $this->hasOne(Game::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
