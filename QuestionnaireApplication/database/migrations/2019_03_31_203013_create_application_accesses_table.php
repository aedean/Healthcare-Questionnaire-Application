<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_accesses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pageurl');
            $table->timestamps();
        });

        DB::table('application_accesses')->insert(
            array(
                array (
                    'pageurl' => '/systemconfiguration',
                    'created_at' => date('Y-m-d H:i:s'), 
                    'updated_at' => date('Y-m-d H:i:s') 
                ),
                array (
                    'pageurl' => '/systemconfiguration/languages',
                    'created_at' => date('Y-m-d H:i:s'), 
                    'updated_at' => date('Y-m-d H:i:s') 
                ),
                array (
                    'pageurl' => '/systemconfiguration/tags',
                    'created_at' => date('Y-m-d H:i:s'), 
                    'updated_at' => date('Y-m-d H:i:s') 
                )
            )
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('application_accesses');
    }
}
