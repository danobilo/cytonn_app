<?php

use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('comments')->insert(
            [
                'user_id' => 3,
                'task_id' => 1,
                'comment' => 'task 1 comment',
            ]
        );

        DB::table('comments')->insert(
            [
                'user_id' => 2,
                'task_id' => 2,
                'comment' => 'task 2 comment',
            ]
        );
        DB::table('comments')->insert(
            [
                'user_id' => 3,
                'task_id' => 3,
                'comment' => 'task 3 comment',
            ]
        );

    }
}
