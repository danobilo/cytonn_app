<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->integer('created_by');
            $table->integer('assigned_to');
            $table->integer('category_id')->unsigned();
//            $table->foreign('category_id')->references('id')->on('categories');
            $table->date('start_date');
            $table->date('due_date');
            $table->string('priority');
            $table->boolean('open');
            $table->boolean('private');
            $table->integer('progress');
            $table->boolean('reccurring');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
