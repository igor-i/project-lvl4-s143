<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Carbon\Carbon;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('color')->default('grey');
            $table->timestamps();
        });

        DB::table('tags')->insert([
            ['name' => 'bug', 'color' => 'red', 'created_at' => Carbon::now()],
            ['name' => 'feature', 'color' => 'green', 'created_at' => Carbon::now()],
            ['name' => 'something', 'color' => 'azure', 'created_at' => Carbon::now()]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
    }
}
