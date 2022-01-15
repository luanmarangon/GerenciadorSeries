@extends('layout')

@section('titulo')
    Criar Séries
@endsection

@section('conteudo')

    @include('errors', ['errors' => $errors])

    <form method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-8">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" name="nome" id="nome"></input>
            </div>

            <div class="col-2">
                <label for="qtd_temporadas">N° temporadas</label>
                <input type="number" class="form-control" name="qtd_temporadas" id="qtd_temporadas"></input>
            </div>

            <div class="col-2">
                <label for="ep_por_temporada">Ep. por temporadas</label>
                <input type="number" class="form-control" name="ep_por_temporada" id="ep_por_temporada"></input>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <input type="file" name="anexo" id="anexo" class="form-control">
            </div>
        </div>



        <button class="btn btn-outline-primary mt-2">Adicionar</button>
    </form>
@endsection
