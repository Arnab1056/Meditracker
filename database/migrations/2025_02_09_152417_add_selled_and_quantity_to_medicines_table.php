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
    Schema::table('medicines', function (Blueprint $table) {
        if (!Schema::hasColumn('medicines', 'selled')) {
            $table->integer('selled')->default(0);
        }

        if (!Schema::hasColumn('medicines', 'quantity')) {
            $table->integer('quantity')->default(0);
        }
    });
}

public function down()
{
    Schema::table('medicines', function (Blueprint $table) {
        $table->dropColumn('selled');
        $table->dropColumn('quantity');
    });
}

};
