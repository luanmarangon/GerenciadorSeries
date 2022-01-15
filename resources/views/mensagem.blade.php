@if(!empty($mensagem))
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading"><i class="bi bi-info-circle">Informação</i></h4>
        <p>{{ $mensagem }}</p>
    </div>
@endif
