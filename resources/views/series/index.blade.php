@extends('layout')

@section('cabecalho')
    Séries
@endsection

@section('conteudo')

    @if(!empty($mensagem))
        <div class="alert alert-success">
            {{ $mensagem }}
        </div>
    @endif

    <a href="{{ route('form_criar_serie') }}" class="btn btn-dark mb-2">Adicionar</a>

    <ul class="list-group">
        @foreach($series as $serie)
         
            <!-- Assim manda no formato JSON -->
            <!-- <li class="list-group-item"><?= $serie; ?></li>  -->


            <!-- Assim exibe somente o NOME da Série -->
            <!-- <li class="list-group-item"><?= $serie->nome; ?></li>  -->

            <!-- Mostra váriaveis e seus valores com o Blade -->
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $serie->nome }}
                <form method="post" action="/series/{{$serie->id}}"
                      onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes($serie->nome) }}?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </form> 
            </li>

        @endforeach
    </ul>
@endsection