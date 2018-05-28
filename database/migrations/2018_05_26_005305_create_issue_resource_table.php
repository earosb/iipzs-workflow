<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssueResourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_resource', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('issue_id')->unsigned();
            $table->integer('resource_id')->unsigned();
            
            $table->foreign('issue_id')->references('id')->on('issues');
            $table->foreign('resource_id')->references('id')->on('resources');
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
        Schema::dropIfExists('issue_resource');
    }
}
