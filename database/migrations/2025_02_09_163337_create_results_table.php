<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id');
            $table->char('registration_no', 20);
            $table->decimal('sessional_marks', 4, 2)->default(00.00);
            $table->decimal('midterm_marks', 4, 2);
            $table->decimal('final_marks', 4, 2);
            $table->decimal('final_score', 4, 2);
            $table->decimal('normalized_score', 4, 2);
            $table->char('grade', 2);
            $table->decimal('gpa', 4, 2);
            $table->integer('added_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('results');
    }
}
