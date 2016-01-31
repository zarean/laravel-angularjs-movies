<?php

use Illuminate\Database\Seeder;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Movie::class, 50)->create()->each(function($m) {
            $m->casts()->save(factory(App\Cast::class)->make());
        });
    }
}
