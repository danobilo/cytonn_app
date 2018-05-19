<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert(
            [
                'name' => 'John Doe',
                'email' => 'john@email.com',
                'password' => bcrypt('123456789'),
                'job_level' => 1,
                'department_id' => 1,
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'Jane Doe',
                'email' => 'jane@email.com',
                'password' => bcrypt('123456789'),
                'job_level' => 1,
                'department_id' => 2,
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'Daniel Obilo',
                'email' => 'daniel@email.com',
                'password' => bcrypt('123456789'),
                'job_level' => 1,
                'department_id' => 2,
            ]
        );
    }
}
