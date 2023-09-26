<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_jenis_surat')->nullable(false);
            $table->dateTime('tanggal_surat')->nullable(false);
            $table->text('ringkasan')->nullable(false);
            $table->string('file')->nullable();
            $table->unsignedBigInteger('id_user')->nullable(false);

            $table->foreign('id_jenis_surat')->references('id')->on('jenis_surat')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('id_user')->references('id')->on('user')
                ->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat');
    }
};