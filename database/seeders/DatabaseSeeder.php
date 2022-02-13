<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->create();
        Schedule::factory(2)->create();
        Employee::factory(20)->create()->each(function (Employee $employee) {
            $employee->schedules()->sync(Schedule::inRandomOrder()->first());
        });
        $this->call([
                        RoleTableSeeder::class,
                        RoleUserTableSeeder::class
                    ]);
    }
}
