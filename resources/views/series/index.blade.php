@extends('layout')

@section('cabecalho')
    Séries
@endsection

@section('conteudo')
    <a href="/series/criar" class="btn btn-dark mb-2">Adicionar</a>

    <ul class="list-group">
        @foreach($series as $serie)
         
        <!-- Assim manda no formato JSON -->
        <!-- <li class="list-group-item"><?= $serie; ?></li>  -->
        

        <!-- Assim exibe somente o NOME da Série -->
        <!-- <li class="list-group-item"><?= $serie->nome; ?></li>  -->

        <!-- Mostra váriaveis e seus valores com o Blade -->
        <li class="list-group-item">{{ $serie->nome }}</li> 

        @endforeach
    </ul>
@endsection