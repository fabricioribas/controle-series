<?php

namespace App\Services;

use App\{Serie, Temporada, Episodio};
use Illuminate\Support\Facades\DB;

// -----------------------------------------------------------------------------
class RemovedorDeSerie
{
    public function removerSerie(int $serieId): string
    {
        $nomeSerie = '';
        DB::transaction(function () use ($serieId, &$nomeSerie) {
            // Antes de remover a Série, precisamos buscar esta sério. Pois vamos trabalhar com ela.
            $serie = Serie::find($serieId);
            $nomeSerie = $serie->nome;
            
            $this->removerTemporadas($serie);
             // Para cada uma dessas Séries chamamos o método Delete.
        $serie->delete();
        });

        return $nomeSerie;
    }
    
    private function removerTemporadas(Serie $serie): void
    {
        // Desta Série, nós vamos trabalhar com as temporadas. Método EACH faz que para cada uma dessas Temporadas ele vai exexutar uma função passando como parâmetro a temporada.
        $serie->temporadas->each(function (Temporada $temporada) {
            $this->removerEpidosios($temporada);
            // Para cada uma dessas temporadadas chamamos o método Delete.
            $temporada->delete();
        });
    }

    private function removerEpidosios(Temporada $temporada): void
    {
        // Desta Série, nós vamos trabalhar com os episodios. Método EACH faz que para cada um desses Episodios ele vai exexutar uma função passando como parâmetro o episodio.
        $temporada->episodios()->each(function (Episodio $episodio) {
            $episodio->delete();
        });
    }
}