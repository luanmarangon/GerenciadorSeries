@extends('layout')

@section('titulo')
    Episodios da {{$temporadaNome}}ª Temporada da {{$serieNome}}
@endsection

@section('conteudo')

    @include('mensagem', ['mensagem' => $mensagem])

    <div class="d-flex justify-content-between">
        <a href="/temporadas/{{ $temporadaId }}/episodios/new" class="btn btn-dark mb-2 mt-2">+ Episódio</a>
        <a href="/series/{{$serieId}}/temporadas" class=" mb-2 mt-2">Voltar</a>
    </div>

    <table id="tabela" class="table table-hover">
        <thead>
        <th>#</th>
        <th>Episodios</th>
        <th>Assistidos</th>

        </thead>

        <tbody>
        <form action="/temporadas/{{ $temporadaId }}/episodios/assistir" method="post" class="mt-2">
            @csrf
            <ul class="list-group">

                @foreach( $episodios as $episodio )
                    <tr>
                        <td><a href="/episodios/destroy/{{$episodio->id}}" class="btn btn-danger btn-sm me-2"><i
                                    class="bi bi-recycle"></i></a></td>
                        <td>Episódio {{ $episodio->numero }}</td>
                        <td><input type="checkbox" name="episodios[]" value="{{ $episodio->id }}"
                                {{ $episodio->assistido ? 'checked' : '' }}></td>
                    </tr>

                @endforeach
            </ul>
        </tbody>
    </table>
    <button class="btn btn-primary mt-2 me-2">Salvar</button>
    {{--        <a href="/episodios/destroy/{{$episodio->id}}" class="btn btn-danger btn-sm me-2"><i class="bi bi-recycle"></i></a>--}}

    </form>

{{--    @extends('layout')--}}

{{--@section('titulo')--}}
{{--    Episodios da {{$temporadaNome}}ª Temporada da {{$serieNome}}--}}
{{--@endsection--}}

{{--@section('conteudo')--}}

{{--    @include('mensagem', ['mensagem' => $mensagem])--}}

{{--    <div class="d-flex justify-content-between">--}}
{{--        <a href="/temporadas/{{ $temporadaId }}/episodios/new" class="btn btn-dark mb-2 mt-2">+ Episódio</a>--}}
{{--        <a href="/series/{{$serieId}}/temporadas" class=" mb-2 mt-2">Voltar</a>--}}
{{--    </div>--}}
{{--    <form action="/temporadas/{{ $temporadaId }}/episodios/assistir" method="post" class="mt-2">--}}
{{--        @csrf--}}
{{--        <ul class="list-group">--}}

{{--            @foreach( $episodios as $episodio )--}}
{{--                <li class="list-group-item d-flex justify-content-between align-items-center">--}}
{{--                    <div class="d-flex">--}}
{{--                        <a href="/episodios/destroy/{{$episodio->id}}" class="btn btn-danger btn-sm me-2"><i--}}
{{--                                class="bi bi-recycle"></i></a>--}}
{{--                        Episódio {{ $episodio->numero }}--}}

{{--                    </div>--}}

{{--                    <span class="d-flex">--}}
{{--                    <input type="checkbox" name="episodios[]" value="{{ $episodio->id }}"--}}
{{--                            {{ $episodio->assistido ? 'checked' : '' }}>--}}
{{--                    </span>--}}
{{--                </li>--}}

{{--            @endforeach--}}
{{--        </ul>--}}
{{--        <button class="btn btn-primary mt-2 me-2">Salvar</button>--}}
{{--        --}}{{--        <a href="/episodios/destroy/{{$episodio->id}}" class="btn btn-danger btn-sm me-2"><i class="bi bi-recycle"></i></a>--}}

{{--    </form>--}}


{{--@endsection--}}





@endsection
