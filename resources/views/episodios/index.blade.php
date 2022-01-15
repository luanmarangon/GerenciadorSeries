@extends('layout')

@section('titulo')
    Episodios
@endsection

@section('conteudo')

    @include('mensagem', ['mensagem' => $mensagem])

    <a href="/temporadas/{{ $temporadaId }}/episodios/new" class="btn btn-dark mb-2 mt-2">+ Episódio</a>
    <form action="/temporadas/{{ $temporadaId }}/episodios/assistir" method="post" class="mt-2">
        @csrf
        <ul class="list-group">
        @foreach( $episodios as $episodio )
            <!-- Button trigger modal -->

                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Episódio {{ $episodio->numero }}

                    <span class="d-flex">
                        <form action="/episodios/{{ $episodio->id }}/destroy" method="post">
                            @csrf
                        <button type="button" class="btn btn-danger btn-sm me-1 " data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                        <i class="bi bi-recycle"></i>
                    </button>
                        </form>
                    <input type="checkbox" name="episodios[]" value="{{ $episodio->id }}"
                            {{ $episodio->assistido ? 'checked' : '' }}>
                    </span>

                </li>
            @endforeach
        </ul>
        <button class="btn btn-primary mt-2 me-2">Salvar</button>
    </form>



    {{--            Inicio do Modal--}}
{{--    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--        <div class="modal-dialog">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>--}}
{{--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                </div>--}}
{{--                <form action="/episodios/{{ $episodio->id }}/destroy" method="post">--}}
{{--                    @csrf--}}
{{--                    <div class="modal-body">--}}
{{--                        <?php--}}
{{--                        var_dump($episodio->numero);--}}
{{--                        ?>--}}

{{--                        Episódio {{ $episodio}}--}}
{{--                    </div>--}}
{{--                    <div class="modal-footer">--}}
{{--                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"--}}
{{--                                onclick="goBack()">Cancelar--}}
{{--                        </button>--}}
{{--                        <button type="submit" class="btn btn-danger">Excluir</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    {{--            Final do Modal--}}
@endsection
