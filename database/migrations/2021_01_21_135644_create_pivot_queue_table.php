<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotQueueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pivot_queue', function (Blueprint $table) {
            $table->increments('id'); 
            $table->foreign('queue_id')->references('id')->on('queue')->onDelete('cascade');;
            $table->integer('queue_id')->unsigned();
            $table->string('sheet',255)->nullable(false);
            $table->string('sheet_code',255)->nullable(false);
            $table->text('response')->nullable(false);
            $table->string('response_code',255)->nullable(true);
            $table->string('response_data',255)->nullable(true);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pivot_queue');
    }
}
