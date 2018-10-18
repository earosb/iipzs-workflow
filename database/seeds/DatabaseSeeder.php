<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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

        factory(App\Status::class)->create(['name' => 'open', 'class' => 'info']);
        factory(App\Status::class)->create(['name' => 'resolved', 'class' => 'warning']);
        factory(App\Status::class)->create(['name' => 'closed', 'class' => 'success']);

        // Access Control List
        $acl = [
            'admin'      => ['manage users', 'manage resources', 'manage issue types', ],
            'supervisor' => ['view all issues', 'edit issues', 'delete issues', 'close issues'],
            'inspector'  => ['view all issues', 'resolve issues', 'assigned to'],
            'worker'     => ['create issues']
        ];

        foreach ($acl as $role => $permissions) {
            $role = Role::create(['name' => $role]);
            foreach ($permissions as $permission) {
                Permission::create(['name' => $permission]);
            }
            $role->syncPermissions($permissions);
        }

        if (app()->environment() !== 'production') {
            $this->call(DatabaseDevTableSeeder::class);
        }
    }
}
