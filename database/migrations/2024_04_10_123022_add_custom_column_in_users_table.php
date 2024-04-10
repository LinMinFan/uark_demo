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
            $table->unsignedBigInteger('org_id')->after('id')->comment('單位id');
            $table->string('account')->unique()->after('name')->comment('帳號');
            $table->integer('status')->default(0)->after('password')->comment('帳號狀態 0:代審核 1:審核通過');
            $table->date('birthday')->nullable()->after('password')->comment('生日');

            $table->foreign('org_id')->references('id')->on('orgs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['org_id']);

            $table->dropColumn('org_id');
            $table->dropColumn('account');
            $table->dropColumn('status');
            $table->dropColumn('birthday');
        });
    }
};
