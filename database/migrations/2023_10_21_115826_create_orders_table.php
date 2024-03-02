<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('identity_id');
            $table->date('date_of_birth_hijri');
            $table->string('phone');
            $table->string('visa_number')->nullable();
            $table->date('visa_date_hijri')->nullable();
            $table->string('border_number')->nullable();
            $table->string('work_place');
            $table->string('work_city');
            $table->text('address');
            $table->string('relative_name');
            $table->string('relative_type');
            $table->string('relative_phone');
            $table->string('employer');
            $table->integer('num_floors')->default(1);
            $table->integer('num_rooms')->default(1);
            $table->integer('num_family_members')->default(1);
            $table->string('verification_code');
            $table->string('notes')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0=> Completed , 1=>InProgress, 2=> Canceled ');
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
        Schema::dropIfExists('orders');
    }
}
