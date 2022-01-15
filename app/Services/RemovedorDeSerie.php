<?php

namespace App\Services;


use Illuminate\Support\Facades\DB;
use App\{Events\SerieApagada, Jobs\ExcluirCapaSerie, Serie, Temporada, Episodio};
use Storage;

class RemovedorDeSerie
{
    public function removerSerie(int $serieId): string
    {
        $nomeSerie = '';
        DB::transaction(function () use ($serieId, &$nomeSerie) {
            $serie = Serie::find($serieId);
            $serieObj = (object)$serie->toArray();
            $nomeSerie = $serie->nome;

            $this->removerTemporada($serie);
            $serie->delete();

            $evento = new SerieApagada($serieObj);
            event($evento);
            ExcluirCapaSerie::dispatch($serieObj);
        });
        return $nomeSerie;
    }

    /**
     * @param $serie
     * @return void
     * @throws \Exception
     */
    public function removerTemporada(Serie $serie): void
    {
        $serie->temporadas->each(function (Temporada $temporada) {
            $this->removerEpisodios($temporada);
            $temporada->delete();
        });

    }

    /**
     * @param Temporada $temporada
     * @return void
     * @throws \Exception
     */
    public function removerEpisodios(Temporada $temporada): void
    {
        $temporada->episodios()->each(function (Episodio $episodio) {
            $episodio->delete();
        });

    }
}
