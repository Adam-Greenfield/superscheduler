<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Game;
use App\Location;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 10) as $i) {
            DB::table('users')->insert([
                'username' => Str::random(10),
                'first_name' => Str::random(10),
                'last_name' => Str::random(10),
                'email' => Str::random(10).'@gmail.com',
                'password' => bcrypt('password'),
            ]);
        }

        DB::table('users')->insert([
            'username' => 'admin',
            'first_name' => 'Adam',
            'last_name' => 'Greenfield',
            'email' => 'ajamesgreenfield@gmail.com',
            'password' => bcrypt('password'),
            'admin' => 1
        ]);

        DB::table('locations')->insert([
            'name' => 'big house',
            'adress_ln_1' => '3 Berlap Lane',
            'adress_ln_2' => 'Toddenham',
            'town' => 'London',
            'postcode' => 'LN5 TR9',
            'notes' => 'Can only do sundays',
            'user_id' => DB::table('users')->first()->id
        ]);

        DB::table('locations')->insert([
            'name' => 'Bill and Steve\'s',
            'adress_ln_1' => '4 Mary\'s passage',
            'adress_ln_2' => '',
            'town' => 'Brighton',
            'postcode' => 'BN1 29J',
            'notes' => '',
            'user_id' => DB::table('users')->skip(1)->first()->id
        ]);

        DB::table('locations')->insert([
            'name' => '',
            'adress_ln_1' => '5 Tonsil lane',
            'adress_ln_2' => 'Rebarton',
            'town' => 'London',
            'postcode' => 'LNJ B8Y',
            'notes' => '',
            'user_id' => DB::table('users')->skip(2)->first()->id
        ]);

        DB::table('games')->insert([
            'date' => Carbon::now()->addDays(7),
            'time' => '17:00',
            'finalised' => 1
        ]);

        DB::table('games')->insert([
            'date' => Carbon::now()->addDays(14),
            'time' => '11:00',
            'finalised' => 0
        ]);

        DB::table('games')->insert([
            'date' => Carbon::now()->addDays(25),
            'time' => '13:00',
            'finalised' => 0
        ]);

        $game1 = Game::first();
        $game2 = Game::skip(1)->first();
        $game3 = Game::skip(2)->first();

        $location1 = Location::first();
        $location2 = Location::skip(1)->first();
        $location3 = Location::skip(2)->first();

        $game1->location()->associate($location1);
        $game1->save();
        $game2->locations()->attach([$location1->id, $location2->id]);
        $game3->locations()->attach([$location1->id, $location3->id, $location2->id]);
    }
}
