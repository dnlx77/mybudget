<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelOperazioniTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rel_operazioni_tags', function (Blueprint $table) {
            $table->bigInteger('operazione_id')->unsigned();
            $table->bigInteger('tag_id')->unsigned();
            $table->timestamps();
            $table->primary(['operazione_id', 'tag_id']);
            $table->foreign('operazione_id')->references('id')->on('operazioni')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tag')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rel_operazioni_tags');
    }
}
