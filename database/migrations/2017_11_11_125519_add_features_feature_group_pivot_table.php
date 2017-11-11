<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFeatureFeatureGroupPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('features_feature_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('feature_id')->nullable()->unsigned();
            $table->integer('feature_group_id')->nullable()->unsigned();
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
        Schema::drop('features_feature_groups');
    }
}
