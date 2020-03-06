<?php

namespace App\Http\Controllers;
// -----------------------------------------------------------------------------

use App\Serie;
use Illuminate\Http\Request;
// -----------------------------------------------------------------------------

class SeriesController extends Controller
{
    public function index(Request $request) {
        // Função ANTIGA que busca as Séries (Criando o Array na "mão")
        // $series = [
        //     'The Flash',
        //     '13 Reasons Why',
        //     'Lucifer'
        // ];
        
        // Busca no DB todas as Séries
        //$series = Serie::all();
     
        //Faz a busca em ordem alfabetica
        //query faz a consulta
        //Ela vai ser ordernada oderBy
        //retorna os dados com GET
        $series = Serie::query()->orderBy('nome')->get();
        $mensagem = $request-session()->get('mensagem')

        return view('series.index', compact('series','mensagem'));
    }

    public function create ()
    {
        return view('series.create');
    }

    //Estamos pegando DA requisição o nome que foi enviado no campo nome do nosso create.blade.php
    public function store(Request $request)
    {
        //Create recebe por parametro um array associativo tendo os valores que quero passar para a nossa Model
        // Serie::create([
        //     'nome' => $nome
        // ]);
        
        /*
        *---------------------------------
        * Definindo atributo por atributo
        *---------------------------------
        *    $nome = $request->nome;
        *    $serie = Serie::create([
        *        'nome' => $nome
        *    ]);
        */
        
        // Aqui estamos pegando todo o Requeste com o métido All.
        // Então, todos os dados que vierem do formulário no Request ele vai pegar e mandar para Série(Serie).
            $series = Serie::create($request->all());
            $request->session()
            ->flash(
                'mensagem',
                "Série {$serie->id} criada com sucesso {$serie->nome}"
            );
        /*
        *----------------------------------------------------------
        * Podemos inclusive pegar a "Serie" e exibir uma Mensagem
        *----------------------------------------------------------
        *
        *    echo "Série com id {$serie->id} criada: {(}$serie->nome}";
        */
            return redirect('/series');
        /*
        * $nome = $request->nome;
        * $serie = new Serie(); --> Cria uma estância de SÉRIE
        * $serie->nome = $nome;
        * var_dump($serie->save()); --> Depois SALVA
        */

    }
}