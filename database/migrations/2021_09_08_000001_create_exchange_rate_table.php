<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchange_rates', function (Blueprint $table) {
            $floatScale = config('currency.float_scale', 10);
            $table->id();
            $table->foreignId('base_id');
            $table->foreignId('counter_id');
            $table->integer('time')->unsigned();
            $table->unsignedDecimal('rate', 10 + $floatScale, $floatScale);

            $table->index(['base_id', 'counter_id', 'time']);
            $table->foreign('base_id')
                ->references('id')
                ->on('currencies')
                ->onDelete('cascade');
            $table->foreign('counter_id')
                ->references('id')
                ->on('currencies')
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
        Schema::dropIfExists('exchange_rates');
    }
};
