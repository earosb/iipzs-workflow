<?php

use Illuminate\Database\Seeder;

class DatabaseDevTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create(['name' => 'User Developer', 'email' => 'dev@local.dev', 'password' => bcrypt('secret')]);
        factory(App\User::class, 25)->create();

        factory(App\Observation::class, 50)->create()->each(function ($o) {
            $o->comments()->save(factory(App\Comment::class)->make());
        });
    }
}
