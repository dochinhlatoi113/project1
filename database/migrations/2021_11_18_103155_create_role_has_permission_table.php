<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleHasPermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_has_permission', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')
                ->references('id')
                ->on('role')
                ->onUpdate('cascade')
                ->onDelete('cascade');
                
            $table->unsignedBigInteger('permission_id');
            $table->foreign('permission_id')
                    ->references('id')
                    ->on('permission')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
                       
                
           
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
        Schema::dropIfExists('role_has_permission');
    }
}
