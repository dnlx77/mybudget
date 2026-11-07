<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

// Stesso nome e stessa struttura della migration delle versioni nuove di mybudget,
// cosi' i dump del db si possono importare senza modifiche.
return new class extends Migration
{
    private array $tables = ['conti', 'tags', 'operazioni'];

    public function up()
    {
        foreach ($this->tables as $name) {
            Schema::table($name, function (Blueprint $table) {
                $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            });
        }

        // I dati preesistenti vengono assegnati al primo utente, se esiste
        $firstUser = DB::table('users')->orderBy('id')->first();
        if ($firstUser) {
            foreach ($this->tables as $name) {
                DB::table($name)->whereNull('user_id')->update(['user_id' => $firstUser->id]);
            }
        }
    }

    public function down()
    {
        foreach ($this->tables as $name) {
            Schema::table($name, function (Blueprint $table) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            });
        }
    }
};
