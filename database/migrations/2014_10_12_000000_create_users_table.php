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
            $table->string('name');
            $table->string('user_name')->unique();
            $table->string('password');
            $table->string('role_name',64);
            $table->integer('role_id')->unsigned();
            $table->string('countryName' )->nullable();
            $table->string('countryCode' ,50)->nullable();
            $table->string('region' , 100)->nullable();
            $table->string('currency' ,15)->nullable();
            $table->string('symbol' ,100)->nullable();
            $table->string('currency_code' )->nullable();
            $table->string('denomination' )->nullable();
            $table->string('decimals' )->nullable();
            $table->text('address1' )->nullable();
            $table->text('address2' )->nullable();
            $table->text('address3' )->nullable();
            $table->string('mobile_dail_code' )->nullable();
            $table->string('mobile' )->nullable();
            $table->string('city' )->nullable();
            $table->string('email' )->nullable();
            $table->time('opening_time')->nullable();
            $table->time('closing_time')->nullable();
            $table->integer('reg_tax_status')->default(0);
            $table->date('tax_reg_date')->nullable();
            $table->integer('tax_type')->default(0);
            $table->double('tax_rate', 16, 2)->nullable();
            $table->string('vat_no', 150)->nullable();
            $table->string('group_vat_no', 255)->nullable();
            $table->string('vat_tin_no', 255)->nullable();
            $table->string('state', 50)->nullable();
            $table->string('code', 50)->nullable();
            $table->string('pin', 50)->nullable();
            $table->string('location', 255)->nullable();
            $table->unsignedBigInteger('fax_dail_code')->default(0);
            $table->string('fax', 15)->nullable();
            $table->unsignedBigInteger('phone_dail_code')->default(0);
            $table->string('phone', 15)->nullable();
            $table->string('logo_image', 255)->nullable();
            $table->longText('signature')->nullable();
            $table->longText('seal')->nullable();
            $table->date('financial_year')->nullable();
            $table->date('book_begining')->nullable();
            $table->enum('status' , ['active' , 'inactive'])->default('active');
            $table->tinyInteger('common')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('my_name')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->unsignedBigInteger('countryid')->default(0);
            $table->integer('domain_code')->default(0);
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
