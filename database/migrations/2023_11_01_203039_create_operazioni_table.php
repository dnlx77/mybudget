<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperazioniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operazioni', function (Blueprint $table) {
            $table->id();
            $table->date('data_operazione');
            $table->decimal('importo', 10, 2);
            $table->string('descrizione', 511)->nullable();
            $table->bigInteger('conto_id')->unsigned();
            $table->timestamps();
            $table->foreign('conto_id')->references('id')->on('conti');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operazioni');
    }
}
