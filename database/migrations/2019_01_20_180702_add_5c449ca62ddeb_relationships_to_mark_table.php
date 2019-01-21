<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c449ca62ddebRelationshipsToMarkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('marks', function(Blueprint $table) {
            if (!Schema::hasColumn('marks', 'user_id')) {
                $table->integer('user_id')->unsigned()->nullable();
                $table->foreign('user_id', '255437_5c449080e7643')->references('id')->on('users')->onDelete('cascade');
                }
                if (!Schema::hasColumn('marks', 'semester_id')) {
                $table->integer('semester_id')->unsigned()->nullable();
                $table->foreign('semester_id', '255437_5c4475c57c14c')->references('id')->on('semesters')->onDelete('cascade');
                }
                if (!Schema::hasColumn('marks', 'subject_id')) {
                $table->integer('subject_id')->unsigned()->nullable();
                $table->foreign('subject_id', '255437_5c4475c590fb3')->references('id')->on('subjects')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('marks', function(Blueprint $table) {
            
        });
    }
}
