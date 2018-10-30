<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDelegatesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('delegates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('country_id');
            $table->unsignedInteger('user_id');
            $table->enum('type', ['public', 'private', 'hybrid'])->default('public');
            $table->string('username')->unique();
            $table->char('address', 34)->unique();
            $table->char('public_key', 66)->unique();
            $table->unsignedInteger('rank');
            $table->bigInteger('votes')->default(0);
            $table->uuid('verification_token')->nullable();
            $table->timestamp('claimed_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamp('banned_at')->nullable();
            $table->schemalessAttributes('extra_attributes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('delegates');
    }
}
