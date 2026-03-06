<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('presences', function (Blueprint $table) {
            $table->string('material_file')->nullable()->after('material');
        });
    }

    public function down(): void
    {
        Schema::table('presences', function (Blueprint $table) {
            $table->dropColumn('material_file');
        });
    }
};
