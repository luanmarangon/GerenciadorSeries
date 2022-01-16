<?php

namespace App\Http\Controllers;

use App\Episodio;
use App\Serie;
use App\Services\RemovedorDeSerie;
use App\Temporada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EpisodiosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Serie $serie, Temporada $temporada, Request $request)
    {
        $episodios = $temporada->episodios;
        $temporadaId = $temporada->id;
        $temporadaNome = $temporada->numero;
        $serie = Serie::find($temporada->serie_id);

        $serieNome = $serie->nome;
        $serieId = $serie->id;
        $mensagem = $request->session()->get('mensagem');

        return view('episodios.index', compact('episodios', 'temporadaId', 'temporadaNome',
            'serieNome', 'serieId', 'mensagem'));
    }

    public function assistir(Temporada $temporada, Request $request)
    {
        $episodioAssistidos = $request->episodios;
        $temporada->episodios->each(function (Episodio $episodio) use ($episodioAssistidos) {
            $episodio->assistido = in_array($episodio->id, $episodioAssistidos);

        });
        $temporada->push();
        $request->session()->flash('mensagem', 'Episódios marcados como assistidos');

        return redirect()->back();

    }

    public function add(Temporada $temporada, Request $request)
    {
        $episodio = new Episodio();
        $temporada->episodios()->count();
        $epCount = DB::table('episodios')
            ->where('temporada_id', $temporada->id)
            ->count();
        $episodio->numero = $epCount + 1;
        $episodio->temporada_id = $temporada->id;
        $episodio->assistido = 0;

        $episodio->save();

        $temporada->push();
        $request->session()->flash('mensagem', 'Novo Episódio adicionado');

        return redirect()->back();

    }

    public function destroy(Episodio $episodio, Request $request)
    {
        $epNumero = $episodio->numero;

//        $episodios = $removedorDeSerie->removerEpisodios($episodio);
        Episodio::destroy($episodio->id);
        $request->session()->flash('mensagem', "O episódio $epNumero, excluído com sucesso!");

        return redirect()->back();

    }
}
