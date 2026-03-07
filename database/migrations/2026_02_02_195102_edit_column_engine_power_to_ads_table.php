<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /*Schema::table('ads', function (Blueprint $table) {
            $table->string('engine_power')->change();
            $table->renameColumn('engine_power', 'power');
        });*/
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /*Schema::table('ads', function (Blueprint $table) {
            $table->renameColumn('power', 'engine_power');
            $table->integer('engine_power')->change();
        });*/
    }
};

