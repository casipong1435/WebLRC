<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('accession_number')->startingValue(7734);
            $table->date('date_acquired');
            $table->string('author');
            $table->string('title');
            $table->string('edition')->nullable();
            $table->string('volume')->nullable();
            $table->string('extent')->nullable();
            $table->string('funding_source')->nullable();
            $table->string('purchase_price')->nullable();
            $table->string('publisher')->nullable();
            $table->string('publication_year')->nullable();
            $table->string('location')->nullable();
            $table->string('remarks')->nullable();
            $table->string('program')->nullable();
            $table->string('course_code')->nullable();
            $table->string('isbn');
            $table->string('course_title')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('books');
    }
}
