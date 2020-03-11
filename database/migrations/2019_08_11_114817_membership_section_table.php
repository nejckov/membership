<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MembershipSectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership_section', function(Blueprint $table) {
          $table->bigInteger('section_id')->unsigned();
          $table->bigInteger('membership_id')->unsigned();
          $table->softDeletes();
          $table->timestamps();

          $table->foreign('section_id')->references('id')->on('sections');
          $table->foreign('membership_id')->references('id')->on('memberships');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('membership_section');
    }
}
