<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobpostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobposts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jobcategory_id');
            $table->string('title');
            $table->string('slug');
            $table->string('employement_status')->nullable();
            $table->string('vacancy')->nullable();
            $table->date('application_deadline')->nullable();
            $table->text('body')->nullable();
            $table->string('exp_in_year')->nullable();
            $table->string('email')->nullable();
            $table->string('read_before')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_desc')->nullable();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('jobposts');
    }
}
