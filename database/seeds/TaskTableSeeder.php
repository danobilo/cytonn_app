<?php

use Illuminate\Database\Seeder;

class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tasks')->insert(
            [
                'title' => 'task 1',
                'description' => 'task 1 description',
                'created_by' => '1',
                'assigned_to' => '2',
                'category_id' => 1,
                'start_date' => '2018-05-16',
                'due_date' => '2018-05-17',
                'priority' => 'Urgent',
                'open' => '1',
                'private' => '0',
                'progress' => 50,
                'reccurring' => '0',
            ]
        );

        DB::table('tasks')->insert(
            [
                'title' => 'task 2',
                'description' => 'task 2 description',
                'created_by' => '3',
                'assigned_to' => '1',
                'category_id' => 1,
                'start_date' => '2018-05-18',
                'due_date' => '2018-05-19',
                'priority' => 'Urgent',
                'open' => '0',
                'private' => '0',
                'progress' => 100,
                'reccurring' => '0',
            ]
        );
        DB::table('tasks')->insert(
            [
                'title' => 'task 3',
                'description' => 'task 3 description',
                'created_by' => '1',
                'assigned_to' => '2',
                'category_id' => 2,
                'start_date' => '2018-05-18',
                'due_date' => '2018-05-19',
                'priority' => 'Urgent',
                'open' => '1',
                'private' => '0',
                'progress' => 50,
                'reccurring' => '0',
            ]
        );
        DB::table('tasks')->insert(
            [
                'title' => 'task 4',
                'description' => 'task 4 description',
                'created_by' => '2',
                'assigned_to' => '1',
                'category_id' => 1,
                'start_date' => '2018-05-23',
                'due_date' => '2018-05-24',
                'priority' => 'Urgent',
                'open' => '1',
                'private' => '1',
                'progress' => 50,
                'reccurring' => '0',
            ]
        );
    }
}
