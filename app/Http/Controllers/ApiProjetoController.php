<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreProjetoRequest;
use App\Models\Projeto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;

class ApiProjetoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projetos = Projeto::all();
        return response()->json([
           'status'=>true,
           'projetos'=>$projetos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjetoRequest $request)
    {
        $request->validate([
            'CaminhoImagem' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $cloudinary = new Cloudinary();

        $uploadedFileUrl = $cloudinary->uploadApi()->upload($request->file('CaminhoImagem')->getRealPath());

        $requestData = $request->all();
        $requestData['CaminhoImagem'] = $uploadedFileUrl['secure_url'];

        // Criar o projeto com os dados do request
        $projeto = Projeto::create($requestData);

        return response()->json([
            'status' => true,
            'message' => "Projeto Criado com Sucesso!",
            'projeto' => $projeto
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Projeto $projeto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Projeto $projeto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Projeto $projeto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Projeto $projeto)
    {
        //
    }
}
