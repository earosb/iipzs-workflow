<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Type::class)->create(['name' => 'Observación']);
        factory(App\Type::class)->create(['name' => 'Prevensión']);

        factory(App\Status::class)->create(['name' => 'new', 'class' => 'primary']);
        factory(App\Status::class)->create(['name' => 'open', 'class' => 'default']);

        if (app()->environment() !== 'production') $this->call(DatabaseDevTableSeeder::class);
    }
}
