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
        Schema::table('students', function (Blueprint $table) {
            //
            $table->string('aid')->nullable();
            $table->float('height')->nullable();
            $table->float('weight')->nullable();
            $table->date('birthday')->nullable();
            $table->enum('gender',['m','f'])->default('m');
        });
    }

    /**
     * Reverse the migrations.
     * 當執行 php artisan migrate:rollback --step=1 會執行 1 次的反遷移
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            //
            $table->dropColumn('aid');
            $table->dropColumn('height');
            $table->dropColumn('weight');
            $table->dropColumn('birthday');
            $table->dropColumn('gender');
        });
    }
};
