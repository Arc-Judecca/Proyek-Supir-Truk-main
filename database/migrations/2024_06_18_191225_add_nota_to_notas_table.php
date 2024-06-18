<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNotaToNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('notas', function (Blueprint $table) {
        $table->string('nota')->after('tanggal');
    });
}

public function down()
{
    Schema::table('notas', function (Blueprint $table) {
        $table->dropColumn('nota');
    });
}

}
