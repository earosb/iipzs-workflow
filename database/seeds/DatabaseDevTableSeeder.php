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
        $user = factory(App\User::class)->create(['name' => 'User Developer', 'email' => 'dev@local', 'password' => bcrypt('secret')]);
        $user->assignRole(['admin', 'supervisor', 'worker', ]);

        factory(App\User::class, 25)->create();

        factory(App\Issue::class, 50)->create()->each(function ($i) {
            $i->comments()->save(factory(App\Comment::class, null, ['issue_id' => $i->id])->make());
        });
    }
}
