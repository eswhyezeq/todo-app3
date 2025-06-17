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
        Schema::table('todos', function (Blueprint $table) {
            if (!Schema::hasColumn('todos', 'title')) {
                $table->string('title')->nullable();
            }
            if (!Schema::hasColumn('todos', 'description')) {
                $table->text('description')->nullable();
            }
            if (!Schema::hasColumn('todos', 'status')) {
                $table->string('status')->default('pending');
            }
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('todos', function (Blueprint $table) {
            //
        });
    }
};
