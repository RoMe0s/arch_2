<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('changes', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('action_id');
            $table->foreign('action_id')
                ->references('id')
                ->on('actions')
                ->onDelete('cascade');

            $table->uuid('shape_id')->nullable();

            $table->string('type');
            $table->string('color');

            $table->unique(['action_id', 'shape_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('changes');
    }
}
