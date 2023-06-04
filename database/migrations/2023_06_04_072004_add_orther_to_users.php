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
            $table->tinyInteger('relationship_other')->comment('1:Bố mẹ, 2:vợ chồng, 3:anh chị, 4: đồng nghiệp, 5: bạn')->nullable();
            $table->string('full_name_other')->nullable();
            $table->string('phone_other')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['relationship_other', 'full_name_other', 'phone_other']);
        });
    }
};
