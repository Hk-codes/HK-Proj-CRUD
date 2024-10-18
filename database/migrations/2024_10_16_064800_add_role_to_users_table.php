<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->integer('role')->default(0); // 0: Normal User, 1: Operator, 2: Admin
    });
}

    public function down()
{
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
}
};
