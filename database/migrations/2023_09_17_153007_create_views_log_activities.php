<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private $name = "logger_view";
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared(
            "CREATE VIEW $this->name AS
            SELECT
                log_activities.id, 
                log_activities.action, 
                log_activities.time, 
                surat.id_jenis_surat, 
                surat.tanggal_surat, 
                surat.ringkasan, 
                surat.file, 
                surat.id_user
            FROM
                log_activities
            JOIN
                surat
            ON 
                log_activities.on_key = surat.id;"
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP VIEW IF EXISTS $this->name");
    }
};