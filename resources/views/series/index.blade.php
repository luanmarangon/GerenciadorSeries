@extends('layout')

@section('titulo')
    Series

    <img src="{{URL::asset('/img/series2.png')}}" alt="" width="20%" class="d-flex rounded float-end">

@endsection

@section('conteudo')

    @include('mensagem', ['mensagem' => $mensagem])


    <a href="{{route('criar_serie')}}" class="btn btn-dark mb-2 mt-2">+ Séries</a>
    <ul class="list-group">
        @foreach($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <a href="/series/{{ $serie->id }}/temporadas">
                        <img src="{{$serie->anexo_url}}" alt="{{ $serie->nome }}"
                             class="img-thumbnail" height="100px" width="100px">
                    </a>
                    <span id="nome-serie-{{ $serie->id }}">{{ $serie->nome }}</span>
                </div>

                <div class="input-group w-50" hidden id="input-nome-serie-{{ $serie->id }}">
                    <input type="text" class="form-control me-1" value="{{ $serie->nome }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" onclick="editarSerie({{ $serie->id }})">
                            <i class="bi bi-file-earmark-check"></i>
                        </button>
                        @csrf
                    </div>
                </div>

                <span class="d-flex">
                    <button class="btn btn-info btn-sm me-1" onclick="toggleInput({{ $serie->id }})">
                        <i class="bi bi-pen"></i>
                    </button>
                    <a href="/series/{{ $serie->id }}/temporadas" class="btn btn-info btn-sm me-1">
                        <i class="bi bi-box-arrow-up-right"></i>
                     </a>
                    <form method="post" action="/series/remover/{{ $serie->id }}"
                            onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($serie->nome) }}?')">
                        @csrf
                        <button class="btn btn-danger btn-sm">
                            <i class="bi bi-recycle"></i>
                        </button>
                    </form>
                </span>
            </li>
        @endforeach
    </ul>
    <script>
        function toggleInput(serieId) {
            const NOMESERIEEL = document.getElementById(`nome-serie-${serieId}`);
            const INPUTSERIEEL = document.getElementById(`input-nome-serie-${serieId}`)
            if (NOMESERIEEL.hasAttribute('hidden')) {
                NOMESERIEEL.removeAttribute('hidden');
                INPUTSERIEEL.hidden = true;
            } else {
                INPUTSERIEEL.removeAttribute('hidden');
                NOMESERIEEL.hidden = true;
            }

        }

        function editarSerie(serieId) {
            let formData = new FormData();
            const NOME = document
                .querySelector(`#input-nome-serie-${serieId} > input`)
                .value;
            const TOKEN = document.querySelector('input[name="_token"]').value;
            formData.append('nome', NOME);
            formData.append('_token', TOKEN);

            const URL = `/series/${serieId}/editaNome`;
            fetch(URL, {
                body: formData,
                method: 'POST'
            }).then(() => {
                toggleInput(serieId);
                document.getElementById(`nome-serie-${serieId}`).textContent = NOME;

            });
        }
    </script>
@endsection
