<?php

use Illuminate\Database\Migrations\Migration;

class ImageManagerFilesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('image_manager_files', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('originalName');
            $table->string('type');
            $table->string('path');
            $table->bigInteger('size');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('image_manager_files');
    }

}
