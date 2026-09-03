<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('people', function (Blueprint $table) {
            $table->dropColumn('is_adopted');
            $table->boolean('is_father_adopted')->default(false)->after('biological_father_id');
            $table->boolean('is_mother_adopted')->default(false)->after('biological_mother_id');
        });
    }

    public function down(): void
    {
        Schema::table('people', function (Blueprint $table) {
            $table->dropColumn(['is_father_adopted', 'is_mother_adopted']);
            $table->boolean('is_adopted')->default(false);
        });
    }
};
