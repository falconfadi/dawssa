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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('applicant_first_name')->nullable();;
            $table->string('applicant_father_name')->nullable();;
            $table->string('applicant_last_name')->nullable();;
            $table->string('applicant_national_id')->nullable();;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('applicant_first_name');
            $table->dropColumn('applicant_father_name');
            $table->dropColumn('applicant_last_name');
            $table->dropColumn('applicant_national_id');
        });
    }
};
