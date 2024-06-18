<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSupirIdToNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('notas', function (Blueprint $table) {
        $table->unsignedBigInteger('supir_id')->after('id');
        $table->foreign('supir_id')->references('id')->on('supirs')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('notas', function (Blueprint $table) {
        $table->dropForeign(['supir_id']);
        $table->dropColumn('supir_id');
    });
}
}
