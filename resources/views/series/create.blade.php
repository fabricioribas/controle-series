@extends('layout')

@section('cabecalho')
    Adicionar Série
@endsection

@section('conteudo')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="post">
    <!-- Sempre que recebermos um post com dados de um formulário, o Laravel verificará se, junto com qualquer dado, foi enviado um token de verificação -->
    <!-- Dessa forma, ele garantirá que o Laravel gerou esse token, nós o entregamos a ele, e em seguida o Laravel devolveu. -->
    <!-- Previne um tipo de ataque chamado de "Cross Site Request Forgery", que é basicamente forjar um request -->
    <!-- Esse token pode ser enviado adicionando a linha @csrf ao nosso formulário. -->
    @csrf
    <div class="form-group">
    <label for="nome">Nome</label>
        <input type="text" class="form-control" name="nome" id="nome">

    </div>
    <button class="btn btn-primary">Adicionar</button>
</form>
@endsection