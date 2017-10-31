<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class CreateTaskStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TaskStatus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        DB::table('TaskStatus')->insert([
            ['name' => 'ToDo', 'created_at' => Carbon::now()],
            ['name' => 'Doing', 'created_at' => Carbon::now()],
            ['name' => 'Testing', 'created_at' => Carbon::now()],
            ['name' => 'Done', 'created_at' => Carbon::now()]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TaskStatus');
    }
}
