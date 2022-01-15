<?php

namespace App\Services;

use App\Mail\NovaSerie;
use App\Serie;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CriadorDeSeries
{
    public function criarSerie(string $nomeSerie, int $qtdTemporadas, int $epPorTemporada, string $anexo=null): Serie
    {

        DB::beginTransaction();
        $serie = Serie::create([
            'nome' => $nomeSerie,
            'anexo' => $anexo
        ]);

        $this->criaTemporadas($qtdTemporadas, $epPorTemporada, $serie);

        $eventNewSerie = new \App\Events\NovaSerie(
            $serie->nome,
            $qtdTemporadas,
            $epPorTemporada
        );
        event($eventNewSerie);
//        $user = Auth::user();
        DB::commit();
        return $serie;
    }

    /**
     * @param int $qtdTemporadas
     * @param $serie
     * @param int $epPorTemporada
     * @return void
     */
    private function criaTemporadas(int $qtdTemporadas, int $epPorTemporada, Serie $serie): void
    {
        for ( $i = 1; $i <= $qtdTemporadas; $i++ ) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);

            $this->criaEpisodios($epPorTemporada, $temporada);
        }
    }

    /**
     * @param int $epPorTemporada
     * @param $temporada
     * @return void
     */
    private function criaEpisodios(int $epPorTemporada, $temporada): void
    {
        for ( $j = 1; $j <= $epPorTemporada; $j++ ) {
            $temporada->episodios()->create(['numero' => $j]);
        }
    }
}
