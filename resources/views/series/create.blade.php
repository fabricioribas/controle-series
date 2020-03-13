@extends('layout')

@section('cabecalho')
    Adicionar Série
@endsection

@section('conteudo')

@include('erros', ['errors' => $errors])

<form method="post">
    <!-- Sempre que recebermos um post com dados de um formulário, o Laravel verificará se, junto com qualquer dado, foi enviado um token de verificação -->
    <!-- Dessa forma, ele garantirá que o Laravel gerou esse token, nós o entregamos a ele, e em seguida o Laravel devolveu. -->
    <!-- Previne um tipo de ataque chamado de "Cross Site Request Forgery", que é basicamente forjar um request -->
    <!-- Esse token pode ser enviado adicionando a linha @csrf ao nosso formulário. -->
    @csrf
    <div class="row">
        <div class="col col-8">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" name="nome" id="nome">
        </div>

        <div class="col col-2">
            <label for="qtd_temporadas">Nº temporadas</label>
            <input type="number" class="form-control" name="qtd_temporadas" id="qtd_temporadas">
        </div>

        <div class="col col-2">
            <label for="ep_por_temporada">Ep. por temporada</label>
            <input type="number" class="form-control" name="ep_por_temporada" id="ep_por_temporada">
        </div>
    </div>

    <button class="btn btn-primary mt-2">Adicionar</button>
</form>
@endsection