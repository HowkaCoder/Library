<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newbooks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('count');           
            $table->foreignIdFor(\App\Models\Janre::class);
            $table->foreignIdFor(\App\Models\Author::class);
            $table->softDeletes();
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
        Schema::dropIfExists('newbooks');
    }
}
