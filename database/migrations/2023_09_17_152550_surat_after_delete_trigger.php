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
                SET @OldVal = old.id;
                DELETE FROM log_activities 
                WHERE on_key = @OldVal
                AND NOT action = 'DELETE';
                CALL Logger('DELETE',@OldVal);
            END;"
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS $this->name");
    }
};