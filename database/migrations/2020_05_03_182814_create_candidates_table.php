<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->bigIncrements('candidate_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->string('name',30);
            $table->string('avatar')->nullable();
            $table->string('goal')->nullable(); //Descrição do perfil da empresa
            $table->longText('description')->nullable(); //Descrição do perfil da empresa
            $table->string('email')->unique();
            $table->string('tax_id',30); //CPF/CNPJ
            $table->unsignedBigInteger('building_id')->nullable();
            $table->foreign('building_id')->references('building_id')->on('building');
            $table->string('phone',10)->nullable();
            $table->string('mobile',11);
            $table->date('birthdate')->nullable();
            $table->string('cid')->nullable();
            $table->string('curriculum')->nullable();
            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('candidates');
    }
}
