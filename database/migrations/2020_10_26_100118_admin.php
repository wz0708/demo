<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Admin extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        //

        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('password');
            $table->string('auth');
            $table->tinyInteger('status')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
        Schema::dropIfExists('admins');
    }

}
