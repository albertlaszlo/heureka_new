<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CascadeOnDelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tables', function (Blueprint $table) {
            $table->dropForeign(['host_id']);
            $table->foreign('host_id')->references('id')->on('hosts')->onDelete('cascade');
        });
        Schema::table('images', function (Blueprint $table) {
            $table->dropForeign(['host_id']);
            $table->foreign('host_id')->references('id')->on('hosts')->onDelete('cascade');
        });
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['host_id']);
            $table->foreign('host_id')->references('id')->on('hosts')->onDelete('cascade');
            $table->dropForeign(['table_id']);
            $table->foreign('table_id')->references('id')->on('tables')->onDelete('cascade');
        });
       
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tables', function (Blueprint $table) {
            $table->dropForeign(['host_id']);
            $table->foreign('host_id')->references('id')->on('hosts');
        });
        Schema::table('images', function (Blueprint $table) {
            $table->dropForeign(['host_id']);
            $table->foreign('host_id')->references('id')->on('hosts');
        });
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['host_id']);
            $table->foreign('host_id')->references('id')->on('hosts');
            $table->dropForeign(['table_id']);
            $table->foreign('table_id')->references('id')->on('tables');
        });
    }
}
