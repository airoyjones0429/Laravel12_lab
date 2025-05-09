<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 當執行 php artisan migrate  會執行 up() 
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * 當執行 php artisan migrate:rollback --step=1 會執行 1 次的反遷移
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
