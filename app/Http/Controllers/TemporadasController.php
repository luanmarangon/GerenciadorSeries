<?php

namespace App\Http\Controllers;


use App\Serie;
use App\Services\RemovedorDeSerie;
use App\Temporada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TemporadasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(int $serieId, Request $request)
    {
        $serie = Serie::find($serieId);
        $temporadas = $serie->temporadas;

        $mensagem = $request->session()->get('mensagem');
        return view(
            'temporadas.index',
            compact('serie', 'temporadas', 'mensagem')
        );
    }

    public function add(Serie $serie, Request $request)
    {

        $tempAtual = DB::table('temporadas')
            ->where('serie_id', $serie->id)
            ->count();
//        $tempAtual + 1;
        for ( $i = $tempAtual + 1; $i <= $request->ntemporada; $i++ ) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);

            for ( $j = 1; $j <= $request->nepisodios; $j++ ) {
                $temporada->episodios()->create(['numero' => $j]);
            }
        }
//        dd($tempAtual, $request, $serie);
        $request->session()->flash('mensagem', 'Nova Temporada e Episódios adicionados');
        return redirect()->back();
    }

    public function destroy(Temporada $temporada, RemovedorDeSerie $removedorDeSerie, Request $request)
    {
        $tempNumero = $temporada->numero;
        $episodios = $removedorDeSerie->removerEpisodios($temporada);
        Serie::destroy($temporada->id);
        $tempId = $temporada->id;

        Temporada::destroy($tempId);


        $request->session()->flash('mensagem', "A temporada $tempNumero, foi excluída com sucesso!");

        return redirect()->back();

    }

    public function destroyAll(Temporada $temporada, Serie $serie, RemovedorDeSerie $removedorDeSerie, Request $request)
    {
        $serie_id = $serie->id;
        $tempCount = DB::table('temporadas')
                    ->where('serie_id', $serie->id)->count();
        $temporada = DB::table('temporadas')->where('serie_id', $serie_id)->get('id');

        var_dump($serie);
        $temporada = $removedorDeSerie->removerTemporada($serie);
        $request->session()->flash('mensagem', "As temporadas e seus Episódios da $serie->nome, foi excluída com sucesso!");

        return redirect()->back();

//        dd($temporada, $serie, $tempCount);
//
//
////        dd($serie_id);
////        $temporada = DB::table('temporadas')->where('serie_id', $serie_id)->get('id');
////        dd($temporada);
////        $temporada = $removedorDeSerie->removerTemporada($temporada);
////        dd($serie_id);x
//        echo "teste {{$temporada}}";
//
//        while ($tempCount > 0){
//            echo "<br>";
//
//            echo "teste {{$tempCount}}";
////            Serie::destroy($serie->id);
//            $tempCount --;
//        }
//
//        dd($serie, $temporada, $request);

    }

}
