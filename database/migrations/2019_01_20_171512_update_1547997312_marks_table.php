<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1547997312MarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('marks', function (Blueprint $table) {
            if(Schema::hasColumn('marks', 'name')) {
                $table->dropColumn('name');
            }
            
        });
Schema::table('marks', function (Blueprint $table) {
            
if (!Schema::hasColumn('marks', 'mark')) {
                $table->integer('mark')->nullable()->unsigned();
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
        Schema::table('marks', function (Blueprint $table) {
            $table->dropColumn('mark');
            
        });
Schema::table('marks', function (Blueprint $table) {
                        $table->string('name');
                
        });

    }
}
