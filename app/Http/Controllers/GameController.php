<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    
    public function store(Request $request)
    {
        Game::create($request->all())
    }


}
