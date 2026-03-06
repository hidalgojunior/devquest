<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->boolean('is_draft')->default(true)->after('closed');
            $table->dateTime('visible_from')->nullable()->after('is_draft');
            $table->boolean('open_to_all')->default(false)->after('visible_from');
        });
    }

    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropColumn(['is_draft','visible_from','open_to_all']);
        });
    }
};
