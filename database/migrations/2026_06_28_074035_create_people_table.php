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
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();

            $table->string('last_name', 50);
            $table->string('first_name', 50);
            $table->string('maiden_name', 50)->nullable();
            $table->enum('biological_sex', ['male', 'female', 'unknown']);

            $table->date('birth_date')->nullable();
            $table->boolean('is_deceased')->default(false);
            $table->date('death_date')->nullable();
            $table->string('birthplace', 100)->nullable();

            $table->foreignId('biological_father_id')->nullable()->constrained('people')->nullOnDelete();
            $table->foreignId('biological_mother_id')->nullable()->constrained('people')->nullOnDelete();
            $table->boolean('is_adopted')->default(false);

            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
