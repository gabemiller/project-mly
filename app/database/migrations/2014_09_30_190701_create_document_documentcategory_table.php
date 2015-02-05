<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocumentDocumentcategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('document_documentcategory', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('document_id')->unsigned()->index();
			$table->foreign('document_id')->references('id')->on('document')->onDelete('cascade');
			$table->integer('documentcategory_id')->unsigned()->index();
			$table->foreign('documentcategory_id')->references('id')->on('documentcategory')->onDelete('cascade');
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
		Schema::drop('document_documentcategory');
	}

}
