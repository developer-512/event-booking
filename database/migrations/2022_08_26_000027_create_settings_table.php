<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('setting_key')->unique();
            $table->string('setting_value');
            $table->string('details')->nullable();
            $table->string('setting_type')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}