<?php

namespace App\Services;

use App\Serie;
use Illuminate\Support\Facades\DB;

class CriadorDeSerie
{
    public function criarSerie(string $nomeSerie, int $qtdTemporadas, int $epPorTemporada): Serie
    {
        /*
        * Create recebe por parametro um array associativo tendo os valores que quero passar para a nossa Model
        * Serie::create([
        *     'nome' => $nome
        * ]);
        *
        *
        *---------------------------------
        * Definindo atributo por atributo
        *---------------------------------
        *    $nome = $request->nome;
        *    $serie = Serie::create([
        *        'nome' => $nome
        *    ]);
        *
        *
        * Aqui estamos pegando todo o Requeste com o métido All.
        * Então, todos os dados que vierem do formulário no Request ele vai pegar e mandar para Série(Serie).
        */ 
        DB::beginTransaction();
        $serie = Serie::create(['nome' => $nomeSerie]);
        $this->criaTemporadas($qtdTemporadas, $epPorTemporada, $serie);
        DB::commit();


        return $serie;

    }

    private function criaTemporadas(int $qtdTemporadas, int $epPorTemporada, Serie $serie)
    {
        for ($i = 0; $i <= $qtdTemporadas; $i++) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);

            $this->criaEpisodios($epPorTemporada, $temporada);
        }
    }
    
    private function criaEpisodios(int $epPorTemporada, \Illuminate\Database\Eloquent\Model $temporada): void
    {

        for ($j = 1; $j <= $epPorTemporada; $j++) {
            $temporada->episodios()->create(['numero' => $j]);
        }
    }
}