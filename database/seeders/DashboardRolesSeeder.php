<?php

namespace Database\Seeders;

use App\Enums\Core\RolesEnum;
use App\Models\Employee;
use Auth;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Artisan::call('permission:cache-reset');
        $this->setupPermissions();
        //
        $this->setupRoles();
        $this->setupUsers();
    }

    private function setupUsers()
    {
        Auth::shouldUse('employee');
        tap(Employee::updateOrCreate(['email' => 'admin@admin.com'], [
            'first_name'     => 'Super Admin',
            'last_name'     => 'Super Admin',
            'email'    => 'admin@admin.com',
            'phone'    => '96651010101010',
            'active'   => true,
            'password' => Hash::make('123456'),
        ]))->assignRole([
            RolesEnum::admin()->value,
        ]);
        echo 'Employees Created Successfully'.PHP_EOL;
    }

    private function setupRoles()
    {
        Role::query()->delete();
        $roles = collect(RolesEnum::toArray())
            ->transform(fn ($i) => ['name' => $i, 'guard_name' => 'employee'])
            ->toArray();

        Role::insert($roles);

        Role::findByName('admin', 'employee')
            ->permissions()->sync(Permission::where('guard_name', 'employee')->pluck('id'));

        echo 'Roles Created Successfully'.PHP_EOL;
    }

    private function setupPermissions()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permissions')->truncate();
        DB::table('role_has_permissions')->truncate();
        DB::table('roles')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('model_has_permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $permissions = collect([
            ['name'=>'tasks'],
            ['name'=>'create_tasks'],
            ['name'=>'edit_tasks'],
            ['name'=>'show_tasks'],
            ['name'=>'delete_tasks'],
        ]);
        Permission::insert($permissions->transform(fn ($i) => ['name' => $i['name'], 'guard_name' => 'employee'])
                                       ->toArray());
        echo 'Permissions Created Successfully'.PHP_EOL;

        return $permissions;
    }
}
