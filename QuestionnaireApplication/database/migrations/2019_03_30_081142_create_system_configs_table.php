<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_configs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('attributename');
            $table->string('attributevalue');
            $table->timestamps();
        });

        DB::table('system_configs')->insert(
            array(
                array (
                    'attributename' => 'languageapikey',
                    'attributevalue' => 'na',
                    'created_at' => date('Y-m-d H:i:s'), 
                    'updated_at' => date('Y-m-d H:i:s') 
                ),
                array (
                    'attributename' => 'locationapikey',
                    'attributevalue' => 'na',
                    'created_at' => date('Y-m-d H:i:s'), 
                    'updated_at' => date('Y-m-d H:i:s') 
                ),
                array (
                    'attributename' => 'applicationname',
                    'attributevalue' => 'How are you feeling?',
                    'created_at' => date('Y-m-d H:i:s'), 
                    'updated_at' => date('Y-m-d H:i:s') 
                ),
                array (
                    'attributename' => 'applicationlogo',
                    'attributevalue' => 'na',
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
        Schema::dropIfExists('system_configs');
    }
}
