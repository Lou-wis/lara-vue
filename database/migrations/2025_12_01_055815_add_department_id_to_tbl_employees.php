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
        Schema::table('tbl_employees', function (Blueprint $table) {
            $table->unsignedBigInteger('department_id')->nullable();
            $table->dropColumn('department');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_employees', function (Blueprint $table) {
            //
            $table->dropIfExists('department_id');
            $table->string('department')->nullable();
        });
    }
};
