<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('rm')->nullable()->unique()->after('email');
            $table->enum('role', ['student','teacher','admin'])->default('student')->after('rm');
            $table->string('cpf')->nullable()->after('role');
            $table->string('phone')->nullable()->after('cpf');
            $table->date('birthdate')->nullable()->after('phone');
            $table->string('github_username')->nullable()->unique()->after('birthdate');
            $table->foreignId('class_group_id')->nullable()->constrained('class_groups')->onDelete('set null')->after('github_username');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['class_group_id']);
            $table->dropColumn(['rm','role','cpf','phone','birthdate','github_username','class_group_id']);
        });
    }
};
