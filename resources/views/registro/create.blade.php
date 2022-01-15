@extends('layout')

@section('titulo')
    Registrar-se
@endsection

@section('conteudo')
    <form method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" name="name" id="name" required class="form-control">
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" required class="form-control">
        </div>

        <div class="form-group">
            <label for="password">Senha</label>
            <input type="password" name="password" id="password" required min="1" class="form-control">
        </div>

        <div class="form-group">
            <label for="anexo">Profile</label>
            <input type="file" name="anexo" id="anexo" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary mt-3">
            Registar
        </button>
        <a href="/entrar" class="btn btn-danger mt-3">Retornar</a>
    </form>
@endsection
