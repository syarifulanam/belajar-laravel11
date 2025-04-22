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
        if (Schema::hasColumn('blogs', 'whatever')) {
            Schema::table('blogs', function (Blueprint $table) {
                $table->dropColumn('whatever');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasColumn('blogs', 'whatever')) {
            Schema::table('blogs', function (Blueprint $table) {
                $table->string('whatever', 100)->nullable()->after('description');
            });
        }
    }
};
