<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->insert(
            [
                'name' => 'Accounting',
                'department_id' => 1,
            ]
        );

        DB::table('rooms')->insert(
            [
                'name' => 'Hiring',
                'department_id' => 1,
            ]
        );
        DB::table('categories')->insert(
            [
                'name' => 'Development',
                'department_id' => 2,
            ]
        );
        DB::table('categories')->insert(
            [
                'name' => 'Testing',
                'department_id' => 2,
            ]
        );
    }
}
