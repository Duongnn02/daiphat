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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('cccd_cmnd')->nullable();
            $table->string('before_cccd_cmnd')->nullable();
            $table->string('after_cccd_cmnd')->nullable();
            $table->string('face_cccd_cmnd')->nullable();
            $table->string('academic_level')->nullable();
            $table->string('loan_purpose')->nullable();
            $table->integer('house')->comment('0:không, 1: có')->nullable();
            $table->string('vehicle')->nullable();
            $table->string('salary')->nullable();
            $table->string('address')->nullable();
            $table->string('relationship_family')->comment('1:Bố mẹ, 2:vợ chồng, 3:anh chị, 4: đồng nghiệp, 5: bạn')->nullable();
            $table->string('full_name_family')->nullable();
            $table->string('phone_family')->nullable();
            $table->string('additional_information')->nullable();
            $table->string('account_name')->nullable();
            $table->string('bank')->nullable();
            $table->string('number_bank')->nullable();
            $table->string('signature')->nullable();
            $table->integer('status_cmnd')->nullable();
            $table->integer('status_infor')->nullable();
            $table->integer('status_bank')->nullable();
            $table->integer('status_signature')->nullable();
            $table->integer('status_additional')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
