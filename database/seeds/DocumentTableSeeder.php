<?php

use Illuminate\Database\Seeder;

class DocumentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('documents')->insert(
            [
                'name' => 'AMS_HP_EliteBook_840_G1_Notebook_PC_Data_Sheet.pdf',
                'task_id' => 1,
            ]
        );

        DB::table('documents')->insert(
            [
                'name' => 'AMS_HP_EliteBook_840_G1_Notebook_PC_Data_Sheet.pdf',
                'task_id' => 2,
            ]
        );
        DB::table('documents')->insert(
            [
                'name' => 'AMS_HP_EliteBook_840_G1_Notebook_PC_Data_Sheet.pdf',
                'task_id' => 3,
            ]
        );
        DB::table('documents')->insert(
            [
                'name' => 'AMS_HP_EliteBook_840_G1_Notebook_PC_Data_Sheet.pdf',
                'task_id' => 4,
            ]
        );
    }
}
