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
        Schema::create('relation', function (Blueprint $table) {
            $table->unsignedInteger('driver_id')->unique();
            $table->unsignedInteger('auto_id')->unique();
            $table->foreign('driver_id')
                ->references('id')
                ->on('driver')
                ->cascadeOnDelete()
                ->restrictOnUpdate();
            $table->foreign('auto_id')
                ->references('id')
                ->on('auto')
                ->cascadeOnDelete()
                ->restrictOnUpdate();
            $table->comment('Связь водитель-автомобиль');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relation');
    }
};
