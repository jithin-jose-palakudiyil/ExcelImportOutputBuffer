<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQueueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queue', function (Blueprint $table) {
            $table->increments('id'); 
            $table->string('excel_path',255)->nullable(false);
            $table->foreign('front_user_id')->references('id')->on('front_users')->onDelete('cascade');
            $table->integer('front_user_id')->unsigned(); 
            $table->tinyInteger('is_completed')->default(0)->comment('0-created, 1-processing, 2-finished');
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
        Schema::dropIfExists('jobs');
    }
}
