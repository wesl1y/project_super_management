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
        Schema::create('produto_detalhes', function (Blueprint $table) {
            //Colunas
            $table->id();
            $table->unsignedBigInteger("produto_id");
            $table->float("comprimento", 8, 2);
            $table->float("largura", 8, 2);
            $table->float("altura", 8, 2);
            $table->timestamps();

            //constrait referencial
            $table->foreign("produto_id")->references("id")->on("produtos");
            //produtos_id passa a ser referencia da coluna ID da tabela produtos

            $table->unique("produto_id");
            // para que os Detalhes dos Produtos sejam unicos
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produto_detalhes');
    }
};
