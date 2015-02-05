<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('users', function($table) {
            $table->string('phone');
            $table->boolean('deletable')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('users', function($table) {

            if (Schema::hasColumn('phone', 'deletable')) {
                $table->dropColumn(['phone', 'deletable']);
            }
        });
    }

}
