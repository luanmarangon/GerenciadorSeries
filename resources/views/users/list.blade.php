@extends('layout')

@section('titulo')
    Usuários
@endsection

@section('conteudo')

    {{--    @include('mensagem', ['mensagem' => $mensagem])--}}

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <table id="tabela" class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Avatar</th>
                        <th scope="col">Nome</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Cadastro</th>
                    </tr>
                    </thead>
                    @foreach( $users as $item )
                    <tbody>
                    <tr>
                        <th scope="row"><img src="{{$item->anexo_url}}" alt=""
                                             class="img-thumbnail" height="50px" width="50px"></th>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->created_at}}</td>
                    </tr>
                    </tbody>
                    @endforeach
                </table>


                    </div>
                </ul>
            </div>
        </div>
    </div>






@endsection
