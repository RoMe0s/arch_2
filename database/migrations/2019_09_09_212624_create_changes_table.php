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
            $table->uuid('id');

            $table->uuid('action_id');
            $table->foreign('action_id')
                ->references('actions')
                ->on('id')
                ->onDelete('cascade');

            $table->uuid('shape_id');
            $table->foreign('shape_id')
                ->references('shapes')
                ->on('id')
                ->onDelete('cascade');

            $table->uuid('state_id')->nullable();
            $table->foreign('state_id')
                ->references('states')
                ->on('id')
                ->onDelete('cascade');

            $table->uuid('previous_state_id')->nullable();
            $table->foreign('previous_state_id')
                ->references('states')
                ->on('id')
                ->onDelete('cascade');

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
