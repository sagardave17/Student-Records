<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5c44a7ad33558RelationshipsToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            if (!Schema::hasColumn('users', 'role_id')) {
                $table->integer('role_id')->unsigned()->nullable();
                $table->foreign('role_id', '255408_5c44730fbdd51')->references('id')->on('roles')->onDelete('cascade');
                }
                if (!Schema::hasColumn('users', 'degree_id')) {
                $table->integer('degree_id')->unsigned()->nullable();
                $table->foreign('degree_id', '255408_5c44a79498d28')->references('id')->on('degrees')->onDelete('cascade');
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
        Schema::table('users', function(Blueprint $table) {
            
        });
    }
}
