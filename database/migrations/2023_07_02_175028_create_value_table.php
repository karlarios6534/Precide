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
        Schema::create('values', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('record_id');
            $table->string('diagnosis');
            $radius_mean = $table->string('radius_mean');
            $radius_se = $table->string('radius_se');
            $radius_worst = $table->string('radius_worst');
            $texture_mean = $table->string('texture_mean');
            $texture_se = $table->string('texture_se');
            $texture_worst = $table->string('texture_worst');
            $perimeter_mean = $table->string('perimeter_mean');
            $perimeter_se = $table->string('perimeter_se');
            $perimeter_worst = $table->string('perimeter_worst');
            $area_mean = $table->string('area_mean');
            $area_se = $table->string('area_se');
            $area_worst = $table->string('area_worst');
            $smoothness_mean = $table->string('smoothness_mean');
            $smoothness_se = $table->string('smoothness_se');
            $smoothness_worst = $table->string('smoothness_worst');
            $compactness_mean = $table->string('compactness_mean');
            $compactness_se = $table->string('compactness_se');
            $compactness_worst = $table->string('compactness_worst');
            $concavity_mean = $table->string('concavity_mean');
            $concavity_se = $table->string('concavity_se');
            $concavity_worst = $table->string('concavity_worst');
            $concave_points_mean = $table->string('concave points_mean');
            $concave_points_se = $table->string('concave points_se');
            $concave_points_worst = $table->string('concave points_worst');
            $symmetry_mean = $table->string('symmetry_mean');
            $symmetry_se = $table->string('symmetry_se');
            $symmetry_worst = $table->string('symmetry_worst');
            $fractal_dimension_mean = $table->string('fractal_dimension_mean');
            $fractal_dimension_se = $table->string('fractal_dimension_se');
            $fractal_dimension_worst = $table->string('fractal_dimension_worst');            
            
            $table->foreign('record_id')
            ->references('id')
            ->on('records')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('values');
    }
};
