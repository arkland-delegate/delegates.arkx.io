<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('delegate_id');
            $table->unsignedInteger('country_id');
            $table->enum('type', ['relay', 'forger'])->default('relay');
            $table->enum('network', ['production', 'development'])->default('production');
            $table->string('cpu');
            $table->string('ram');
            $table->string('disk');
            $table->string('connection');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('servers');
    }
}
