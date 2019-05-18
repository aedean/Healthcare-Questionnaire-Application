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
                    'attributename' => 'Language API Key',
                    'attributevalue' => 'na',
                    'created_at' => date('Y-m-d H:i:s'), 
                    'updated_at' => date('Y-m-d H:i:s') 
                ),
                array (
                    'attributename' => 'Application Name',
                    'attributevalue' => 'How are you feeling?',
                    'created_at' => date('Y-m-d H:i:s'), 
                    'updated_at' => date('Y-m-d H:i:s') 
                ),
                array (
                    'attributename' => 'Application Logo',
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
