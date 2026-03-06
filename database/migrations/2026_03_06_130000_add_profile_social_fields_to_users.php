<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar_path')->nullable()->after('github_username');
            $table->string('github_repository')->nullable()->after('avatar_path');
            $table->string('instagram')->nullable()->after('github_repository');
            $table->string('whatsapp')->nullable()->after('instagram');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['avatar_path','github_repository','instagram','whatsapp']);
        });
    }
};
