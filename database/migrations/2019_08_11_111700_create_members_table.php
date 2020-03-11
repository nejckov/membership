<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('custom_number')->unsigned();
            $table->string('fname');
            $table->string('lname');
            $table->string('address');
            $table->string('email');
            $table->string('mobile');
            $table->date('birthdate');
            $table->integer('post_id');
            $table->text('description')->nullable();
            $table->integer('active')->default(1);
            $table->string('gender', 1);
            $table->softDeletes();
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
        Schema::dropIfExists('members');
    }
}
