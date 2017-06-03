<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBestResults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('best_results', function (Blueprint $table) {
            $table->increments('id');

            $table->string('login');
            $table->string('repository');
            $table->string('avatar_url')->nullable();
            $table->integer('rating');

            $table->unique(['login', 'repository']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('best_results');
    }
}
