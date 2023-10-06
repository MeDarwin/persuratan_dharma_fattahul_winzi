<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private $sf_name = "log_concat";
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared(
            "CREATE OR REPLACE FUNCTION $this->sf_name(
                id_surat BIGINT UNSIGNED,
                id_jenis_surat BIGINT UNSIGNED,
                id_user BIGINT UNSIGNED,
                ringkasan TEXT,
                file VARCHAR(255))RETURNS TEXT
            BEGIN
                    DECLARE JenisSurat VARCHAR(100);
                    DECLARE User VARCHAR(255); 
                    
                    SELECT jenis_surat INTO JenisSurat FROM jenis_surat WHERE id=id_jenis_surat LIMIT 1;
                    SELECT username INTO User FROM user WHERE id=id_user LIMIT 1;
                    
                    RETURN CONCAT(
                    'Surat affected: ', id_surat ,
                    ' - jenis surat: ', JenisSurat,
                    ' - affected by: ', User,
                    ' - file: ', file,
                    ' - Ringkasan: ', ringkasan);
            END;"
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP FUNCTION IF EXISTS $this->sf_name;");
    }
};