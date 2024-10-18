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
    Schema::create('posts', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->text('description');
        $table->decimal('price');
        $table->string('image')->nullable(); // This will allow NULL values

        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // to track the post creator
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('posts');
}
};
