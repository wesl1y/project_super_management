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
        //Criando a tabela filiais
        Schema::create("filiais", function (Blueprint $table) {
            $table->id();
            $table->string("filial", 30);
            $table->timestamps();
        });

        //Criando Tabela Produto_filiais
        Schema::create('produto_filiais', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("filial_id");
            $table->unsignedBigInteger("produto_id");
            $table->decimal("preco_vendas", 8, 2);
            $table->integer("estoque_min");
            $table->integer("estoque_max");
            $table->timestamps();

            //foreign key (constraints)
            $table->foreign("filial_id")->references("id")->on("filiais");
            $table->foreign("produto_id")->references("id")->on("produtos");
        });

        //removendo colunas da tabela produtos
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropColumn([
                'preco_vendas', 
                "estoque_min", 
                "estoque_max"
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Adicionando colunas da tabela produtos
        Schema::table('produtos', function (Blueprint $table) {
            $table->decimal("preco_vendas", 8, 2);
            $table->integer("estoque_min");
            $table->integer("estoque_max");
        });


        Schema::dropIfExists('produto_filiais');

        Schema::dropIfExists('filiais');
    }
};
