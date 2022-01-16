@extends('layout')

@section('titulo')
    Temporadas de {{$serie->nome}}


@endsection

@section('conteudo')


    <div class="container-fluid">
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
        @include('mensagem', ['mensagem' => $mensagem])

        <div class="row">
            <div class="col-12 d-flex justify-content-between mb-2">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-dark me-2" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                    + Temporada
                </button>

                <form action="/series/{{$serie->id}}/temporadas/destroyAll" method="post">
                    @csrf
                    <button class="btn btn-danger me-2">Excluir Tudo</button>
                </form>
                <div class="d-flex ">
                    {{--        <a href="/series/{{$serie->id}}/temporadas/new" class="btn btn-dark mb-2 mt-2">+ Temporada</a>--}}
                    <a href="{{route('listar_series')}}" class="mb-2 mt-2">Voltar</a>
                </div>
            </div>

        </div>

        {{--Inicio do Modal--}}
    <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Adicionar Temporadas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <form action="/series/{{$serie->id}}/temporadas/new" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-4">
                                    <label for="temporada">N° Temporada</label>
                                    <input type="number" class="form-control" name="ntemporada" id="ntemporada">
                                </div>
                                <div class="col-4">
                                    <label for="episodios">N° Episodios</label>
                                    <input type="number" class="form-control" name="nepisodios" id="nepisodios">
                                </div>


                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{--Fim do Modal--}}



        <ul class="list-group">
            @foreach( $temporadas as $temporada )
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="d-flex">
                        <a href="/temporadas/destroy/{{$temporada->id}}" class="btn btn-danger btn-sm me-2"><i
                                class="bi bi-recycle"></i></a>

                        <a href="/temporadas/{{ $temporada->id }}/episodios">
                            Temporada {{$temporada->numero}}
                        </a>
                    </div>
                    <span class="bg-secondary">
                    {{ $temporada->getEpisodiosAssistidos()->count() }} / {{ $temporada->episodios->count() }}
                </span>
                </li>
                <div>
                </div>
            @endforeach
        </ul>
    </div>
@endsection
