<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaktionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaktions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Book::class);
            $table->foreignIdFor(\App\Models\Student::class);
            $table->enum('status' , ['created' ,'deleted']);
            $table->integer('count');
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
        Schema::dropIfExists('transaktions');
    }
}
