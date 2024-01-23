<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('unidades', function (Blueprint $table) {
            $table->id();
            $table->string("unidade", 5); //cm, mm, kg
            $table->string("descricao", 30);
            $table->timestamps();
        });

        //Adicionando relacionamento com a tabela produtos
        Schema::table('produtos', function (Blueprint $table) {
            $table->unsignedBigInteger("unidade_id");
            $table->foreign("unidade_id")->references("id")->on("unidades");
        });

        //Adicionando relacionamento com a tabela produtos_detalhes
        Schema::table('produto_detalhes', function (Blueprint $table) {
            $table->unsignedBigInteger("unidade_id");
            $table->foreign("unidade_id")->references("id")->on("unidades");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //remover relacionamento com a tabela produtos_detalhes
        Schema::table('produto_detalhes', function (Blueprint $table) {
            //remover foreign key
            $table->dropForeign('produto_detalhes_unidade_id_foreign'); //[tabela]_[coluna]_foreign
            $table->dropColumn('unidade_id');
        });


        //remover relacionamento com a tabela produtos
        Schema::table('produtos', function (Blueprint $table) {
            //remover foreign key
            $table->dropForeign('produtos_unidade_id_foreign'); //[tabela]_[coluna]_foreign
            $table->dropColumn('unidade_id');

        });


        Schema::dropIfExists('unidades');
    }
};
