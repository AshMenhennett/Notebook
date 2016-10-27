<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameNotebooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notebooks', function (Blueprint $table) {
            Schema::rename('notebooks', 'note_books');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('note_books', function (Blueprint $table) {
            Schema::rename('note_books', 'notebooks');
        });
    }
}
