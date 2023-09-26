<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private $name = "Logger";
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared(
            "CREATE PROCEDURE $this->name (
            Action ENUM('INSERT','UPDATE','DELETE'),
            NewValue BIGINT UNSIGNED
            )
            MODIFIES SQL DATA
            BEGIN
                INSERT INTO log_activities VALUES (NULL,Action,NewValue,CURRENT_TIMESTAMP());
            END;"
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS $this->name");
    }
};