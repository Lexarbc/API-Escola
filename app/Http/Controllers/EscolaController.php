<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Escola;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class professorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dadosProfessor = Professor::All();

        return 'Professores: '.$dadosProfessor;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dadosProfessor = $request->All();
        $valida = Validator::make($dadosProfessor,[
            'titulo' => 'required',
            'conteudo' => 'required'
        ]);

        if($valida->fails()){
            return 'Dados incompletos '.$valida->errors(true). 500;
        }

        $RegistrosProfessor = Professor::create($dadosProfessor);
        if($RegistrosProfessor){
            return 'Dados cadastros com sucesso.';
        }else{  
            return 'Dados não cadastrados no banco de dados';
        }
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dadosProfessor = Professor::find($id);
        $contador = $dadosProfessor->count();

        if($dadosProfessor){
            return 'Professores encontradas: '.$contador.' - '.$dadosProfessor.response()->json([],Response::HTTP_NO_CONTENT); 
        }else{
            return 'Professores Não localizadas.'.response()->json([],Response::HTTP_NO_CONTENT); 
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dadosProfessor =  $request->all();

        $valida = validator::make($dadosProfessor,[
            'titulo' => 'required',
            'conteudo' => 'required'
        ]);

        if($valida->fails()){
            return "Erro validação!!".$valida->$errors();
        }
        $dadosProfessorBanco = Professor::find($id);
        $dadosProfessorBanco->titulo = $dadosProfessor['titulo'];
        $dadosProfessorBanco->conteudo = $dadosProfessor['conteudo'];

        $enviarProfessor = $dadosProfessorBanco->save();

        if($enviarProfessor){
            return 'A Noticia foi alterada com sucesso.'.response()->json([],Response::HTTP_NO_CONTENT); 
        }else{
            return 'A Noticia Não foi alterada.'.response()->json([],Response::HTTP_NO_CONTENT); 
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $dadosNoticias = Professor::find($id);
        if($dadosProfessor){
            $dadosProfessor->delete();
            return 'O Professor foi deletada com sucesso.'.response()->json([],Response::HTTP_NO_CONTENT); 
        }else{
            return 'O Professor Não foi deletada com sucesso.'.response()->json([],Response::HTTP_NO_CONTENT); 
        }
    
    }
}