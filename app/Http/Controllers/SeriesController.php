<?php

namespace App\Http\Controllers;
// -----------------------------------------------------------------------------

use App\Episodio;
use App\Http\Requests\SeriesFormRequest;
use App\Serie;
use App\Services\CriadorDeSerie;
use App\Services\RemovedorDeSerie;
use App\Temporada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// -----------------------------------------------------------------------------

class SeriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request) {
        /*
        * Função ANTIGA que busca as Séries (Criando o Array na "mão")
        * $series = [
        *     'The Flash',
        *     '13 Reasons Why',
        *     'Lucifer'
        * ];
        *
        * Busca no DB todas as Séries
        * $series = Serie::all();
        *
        * Faz a busca em ordem alfabetica
        * query faz a consulta
        * Ela vai ser ordernada oderBy
        * retorna os dados com GET
        */
        $series = Serie::query()->orderBy('nome')->get();
        $mensagem = $request->session()->get('mensagem');

        return view('series.index', compact('series', 'mensagem'));
    }

    public function create()
    {
        return view('series.create');
    }

    //Estamos pegando DA requisição o nome que foi enviado no campo nome do nosso create.blade.php
    public function store(SeriesFormRequest $request, CriadorDeSerie $criadorDeSerie)
    {
        $serie = $criadorDeSerie->criarSerie($request->nome, $request->qtd_temporadas, $request->ep_por_temporada);

        $request->session()
            ->flash(
                'mensagem',
                "Série {$serie->id} e suas temporadas e episódios criados com sucesso {$serie->nome}"
            );

        /*
        *----------------------------------------------------------
        * Podemos inclusive pegar a "Serie" e exibir uma Mensagem
        *----------------------------------------------------------
        *
        *    echo "Série com id {$serie->id} criada: {(}$serie->nome}";
        */
        return redirect()->route('listar_series');
        /*
        * $nome = $request->nome;
        * $serie = new Serie(); --> Cria uma estância de SÉRIE
        * $serie->nome = $nome;
        * var_dump($serie->save()); --> Depois SALVA
        */
    }

    public function destroy(Request $request, RemovedorDeSerie $removedorDeSerie)
    {
        $nomeSerie = $removedorDeSerie->removerSerie($request->id);
        // Serie::destroy($request->id);
        $request->session()
            ->flash(
                'mensagem',
                "Série $nomeSerie removida com sucesso"
            );
        return redirect()->route('listar_series');
    }

    public function editaNome(int $id, Request $request)
    {
        $serie = Serie::find($id);
        $novoNome = $request->nome;
        $serie->nome = $novoNome;
        $serie->save();
    }
}