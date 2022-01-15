@extends('layout')

@section('titulo')
    Dados do Usuário

    {{--    <img src="{{URL::asset('/img/series2.png')}}" alt="" width="20%" class="d-flex rounded float-end">--}}

@endsection

@section('conteudo')
    @include('mensagem', ['mensagem' => $mensagem])

    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
                <img src="{{Auth::user()->anexo_url}}" alt=""
                     class="img-thumbnail" height="200px" width="200px">

                <div class="row">
                    <div class="col-3">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                            Avatar
                        </button>
                    </div>
                    <div class="col-3">
                        {{--Inicio do RemoverAvatar--}}
                        <form action="/users/profile/remove" method="post">
                            @csrf
                            <button class="btn btn-danger mt-2">Remover</button>
                        </form>
                        {{--Fim do RemoverAvatar--}}
                    </div>
                </div>

            {{--Inicio do Modal--}}
            <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Trocar de Avatar</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <form action="/users/profile" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">

                                    <input type="file" name="anexo" id="anexo" class="form-control">

                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{--Fim do Modal--}}


            </div>
            <div class="col-8">
                <h3 for="">Usuário Logado:</h3>
                <input type="text" value="{{ Auth::user()->name }}" readonly class="form-control">
                <h3 for="">E-Mail:</h3>
                <input type="text" value="{{ Auth::user()->email }}" readonly class="form-control">
                <hr>
                <!-- Button trigger modal -->
                <div class="d-grid gap-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                        Alterar os Dados
                    </button>
                </div>
                <!-- Modal -->
                <!-- Scrollable modal -->


                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                     tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="nome">Nome:</label>
                                            <input type="text" class="form-control" name="nome" id="nome"
                                                   value="{{ Auth::user()->name }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="email">E-mail:</label>
                                            <input type="text" class="form-control" name="email" id="email"
                                                   value="{{ Auth::user()->email }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="newpasswd">Informe sua senha:</label>
                                            <input type="password" name="newpasswd" id="newpasswd" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <label for="confpasswd">Confirme sua senha:</label>
                                            <input type="password" name="confpasswd" id="confpasswd"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                                onclick="{{route('profile')}}">Cancelar
                                        </button>

                                        <button type="submit" class="btn btn-primary">Alterar</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection
