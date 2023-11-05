<?php

use App\Models\User;
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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->text('content')->nullable();
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');;
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('post_post', function (Blueprint $table) {
            $table->unsignedBigInteger('post1_id');
            $table->unsignedBigInteger('post2_id');
            $table->foreign('post1_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('post2_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_post');
        Schema::dropIfExists('posts');
    }

};
