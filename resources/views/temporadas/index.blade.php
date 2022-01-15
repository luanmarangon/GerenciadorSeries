@extends('layout')

@section('titulo')
    Temporadas de {{$serie->nome}}


@endsection

@section('conteudo')

    @if($serie->anexo)
    <div class="row mb-4">
        <div class="col-12 text-center">
            <a href="{{$serie->anexo_url}}" target="_blank">
                <img src="{{$serie->anexo_url}}" alt="{{ $serie->nome }}"
                        class="img-thumbnail" height="400px" width="400px">
            </a>
        </div>
    </div>
    @endif

    <ul class="list-group">
        @foreach( $temporadas as $temporada )
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="/temporadas/{{ $temporada->id }}/episodios">
                    Temporada {{$temporada->numero}}
                </a>
                <span class="bg-secondary">
                    {{ $temporada->getEpisodiosAssistidos()->count() }} / {{ $temporada->episodios->count() }}
                </span>
            </li>

        @endforeach
    </ul>
@endsection
