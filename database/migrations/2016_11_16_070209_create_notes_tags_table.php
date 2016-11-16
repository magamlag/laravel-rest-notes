<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes_tags', function (Blueprint $table) {
            $table->integer('note_id')->unsigned()->index()->default(0);
            $table->integer('tag_id')->unsigned()->index()->default(0);
            $table->timestamps();

            $table->foreign('note_id')->references('id')
                ->on('notes')->onDelete('cascade');

            $table->foreign('tag_id')->references('id')
                ->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes_tags');
    }
}
