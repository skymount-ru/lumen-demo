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
            $table->id();
            $table->string('url')->comment('The hypermedia URL of this resource');
            $table->string('name')->comment('The name of this book');
            $table->string('isbn')->comment('The International Standard Book Number (ISBN-13)');
            $table->json('authors')->comment('An array of names of the authors that wrote this book');
            $table->integer('numberOfPages')->comment('The number of pages in this book');
            $table->string('publisher')->comment('The company that published this book');
            $table->string('country')->comment('The country that this book was published in');
            $table->string('mediaType')->comment('The type of media this book was released in');
            $table->date('released')->comment('The date (ISO 8601) when this book was released');
            $table->json('characters')->comment('An array of Character resource URLs that has been in this book');
            $table->json('povCharacters')->comment('An array of Character resource URLs that has had a POV-chapter in this book');
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
