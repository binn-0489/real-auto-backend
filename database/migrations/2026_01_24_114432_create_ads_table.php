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
        Schema::create('ads', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');

        $table->foreignId('brand_id')
            ->nullable()
            ->constrained()
            ->onDelete('set null');

        $table->string('model')->nullable();
        $table->string('generation')->nullable();

        $table->integer('price')->nullable();
        $table->integer('mileage')->nullable();
        $table->year('year')->nullable();

        $table->string('transmission')->nullable();
        $table->string('drive')->nullable();

        $table->string('engine_type')->nullable();
        $table->decimal('engine_volume', 3, 1)->nullable();
        $table->integer('engine_power')->nullable();

        $table->string('wheel')->nullable();
        $table->string('condition')->nullable();
        $table->string('body_type')->nullable();

        $table->text('description')->nullable();
        $table->string('location')->nullable();

        $table->string('vin')->nullable();
        $table->string('number')->nullable();
        //$table->text(column: 'photo')->nullable();



        $table->timestamps();
        $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
