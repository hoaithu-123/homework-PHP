<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveTeacherIdAndClassNameFromGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('grades', function (Blueprint $table) {
//            $table->dropColumn('teacher_id');
            $table->dropColumn('class_numeric');
            $table->dropColumn('class_description');
            $table->dropColumn('endtime_class');
            $table->dropColumn('starttime_class');
            $table->dropColumn('grade_class');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('grades', function (Blueprint $table) {
//            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('class_numeric');
            $table->string('class_description');
            $table->date('starttime_class');
            $table->date('endtime_class');
            $table->unsignedBigInteger('grade_class');
        });
    }
}
