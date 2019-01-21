<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c44753b2c304RelationshipsToSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subjects', function(Blueprint $table) {
            if (!Schema::hasColumn('subjects', 'semester_id')) {
                $table->integer('semester_id')->unsigned()->nullable();
                $table->foreign('semester_id', '255436_5c4475394af9b')->references('id')->on('semesters')->onDelete('cascade');
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
        Schema::table('subjects', function(Blueprint $table) {
            
        });
    }
}
