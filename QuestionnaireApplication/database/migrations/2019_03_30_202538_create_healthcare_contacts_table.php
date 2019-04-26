<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHealthcareContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('healthcare_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->bigInteger('mobile');
            $table->bigInteger('landline');
            $table->string('company');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE healthcare_contacts AUTO_INCREMENT = 100000;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('healthcare_contacts');
    }
}
