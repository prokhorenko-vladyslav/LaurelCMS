<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_sections', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->json('description');
            $table->string('slug')->unique();
            $table->string('icon_url');
            $table->timestamps();
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->json('description');
            $table->string('slug');
            $table->string('value')->nullable();
            $table->unsignedBigInteger('section_id');
            $table->string('type');
            $table->json('attributes')->nullable();
            $table->foreignId('setting_id')->nullable();
            $table->nullableMorphs('settingable');
            $table->timestamps();

            $table->foreign('section_id')->references('id')->on('setting_sections');
            $table->foreign('setting_id')->references('id')->on('settings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
