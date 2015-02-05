<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('pages', function(Blueprint $table) {
            $table->increments('id');
            $table->string('menu');
            $table->integer('parent');
            $table->string('title');
            $table->text('content');
            $table->boolean('shows');
            $table->integer('gallery_id');
			$table->boolean('is_competition');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('pages');
    }

}
