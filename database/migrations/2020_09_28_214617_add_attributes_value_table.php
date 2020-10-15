<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttributesValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributesvalue', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('attributeGroup_id');
            $table->foreign('attributeGroup_id')->references('id')->on('attributesGroup')->onDelete('cascade');
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
        Schema::dropIfExists('attributesValue');
    }
}
