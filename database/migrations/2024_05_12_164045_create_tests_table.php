<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('classroom_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });

        Schema::create('question_test', function (Blueprint $table) {
            $table->foreignId('test_id')->constrained()->onDelete('cascade');
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            $table->primary(['test_id', 'question_id']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('question_test');
        Schema::dropIfExists('tests');
    }
}
