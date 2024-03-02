<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->enum('religion',[1 => 'Muslim', 2 => 'Christian']);
            $table->enum('experience', [1 => 'Has good experience', 2 => 'Has no experience']);
            $table->string('image');
            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('category_id');

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
        Schema::dropIfExists('workers');
    }
}
