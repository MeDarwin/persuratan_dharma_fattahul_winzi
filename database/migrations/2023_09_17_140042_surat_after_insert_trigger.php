<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private $name = 't_after_insert_surat';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared(
            "CREATE TRIGGER $this->name 
            AFTER INSERT ON surat FOR EACH ROW
            BEGIN
                SET @NewVal = new.id;
                CALL Logger('INSERT',@NewVal);
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