<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreProjetoRequest;
use App\Models\Projeto;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Cloudinary\Cloudinary;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;


class ApiProjetoController extends Controller
{
    public function index()
    {
        $redis = Redis::connection('default');
        $cachePorjetos = $redis->get('projetos:all');
        if($cachePorjetos){
            Log::info('Usando cache');
            $dadosJson = json_decode($cachePorjetos);
        }else {
            $projetos = Projeto::all();
            $dadosJson = [
                'status' => true,
                'projetos' => $projetos
            ];

            $redis->set('projetos:all',json_encode($dadosJson));
            Log::info('consultando o banco');
        }
        return response()->json($dadosJson);
    }

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

    public function show($id)
    {
        try {
            $projeto = Projeto::findOrFail($id);
            return response()->json([
                'status' => true,
                'projeto' => $projeto
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Projeto não encontrado.',
                'erro' => $e

            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'CaminhoImagem' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $projeto = Projeto::findOrFail($id);
            $requestData = $request->all();

            if ($request->hasFile('CaminhoImagem')) {
                $cloudinary = new Cloudinary();
                $uploadedFileUrl = $cloudinary->uploadApi()->upload($request->file('CaminhoImagem')->getRealPath());
                $requestData['CaminhoImagem'] = $uploadedFileUrl['secure_url'];
            }

            $projeto->update($requestData);

            return response()->json([
                'status' => true,
                'message' => "Projeto Atualizado com Sucesso!",
                'projeto' => $projeto
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Projeto não encontrado.'
            ], 404);
        }
    }
    public function destroy($id)
    {
        try {
            $projeto = Projeto::findOrFail($id);
            $projeto->delete();

            return response()->json([
                'status' => true,
                'message' => "Projeto Deletado com Sucesso!"
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Projeto não encontrado.'
            ], 404);
        }
    }
}
