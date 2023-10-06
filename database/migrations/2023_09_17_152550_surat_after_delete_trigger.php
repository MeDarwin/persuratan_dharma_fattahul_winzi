<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private $name = 't_after_delete_surat';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared(
            "CREATE TRIGGER $this->name 
            AFTER DELETE ON surat FOR EACH ROW
            BEGIN
                DECLARE Activity TEXT;
                SET @File = IFNULL(OLD.file, 'NULL');
                SELECT log_concat(
                    OLD.id,
                    OLD.id_jenis_surat,
                    OLD.id_user,
                    OLD.ringkasan,
                    @FIle) INTO Activity;
                CALL Logger('DELETE',Activity);
            END;"
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS $this->name;");
    }
};