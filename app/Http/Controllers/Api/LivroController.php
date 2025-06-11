<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLivroRequest;
use App\Http\Requests\UpdateLivroRequest;
use App\Models\Livro;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class LivroController extends Controller
{
    /**
     * Retorna uma lista de livros
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $livros = Livro::orderBy('LIV_ID', 'ASC')->get();

        return response()->json([
            'status' => true,
            'livros' => $livros,
        ], 200);
    }

    /**
     * Cadastra um novo livro
     *
     * @param StoreLivroRequest $request
     * @return JsonResponse
     */
    public function store(StoreLivroRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            $livro = Livro::create([
                'LIV_TITULO' => $request->LIV_TITULO,
                'LIV_AUTOR' => $request->LIV_AUTOR,
                'LIV_ANO_PUBLICACAO' => $request->LIV_ANO_PUBLICACAO,
                'LIV_GENERO' => $request->LIV_GENERO,
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'livro' => $livro->refresh(),
                'message' => 'Livro cadastrado com sucesso!',
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Livro não cadastrado! Erro: ' . $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Retorna os detalhes de um livro específico
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $livro = Livro::findOrFail($id);

            return response()->json([
                'status' => true,
                'livro' => $livro,
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Livro não encontrado!',
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao buscar o livro!',
            ], 500);
        }
    }

    /**
     * Atualiza os dados de um livro
     * 
     * @param \App\Http\Requests\UpdateLivroRequest $request
     * @param mixed $id
     * @return JsonResponse|mixed
     */
    public function update(UpdateLivroRequest $request, $id): JsonResponse
    {
        try {
            // Buscar o livro pelo ID
            $livro = Livro::find($id);

            if (!$livro) {
                return response()->json([
                    'status' => false,
                    'message' => 'Livro não encontrado!',
                ], 404);
            }

            // Atualiza apenas os campos permitidos
            $updateData = $request->only([
                'LIV_TITULO',
                'LIV_AUTOR',
                'LIV_ANO_PUBLICACAO',
                'LIV_GENERO'
            ]);

            // Atualiza o livro
            $livro->update($updateData);

            return response()->json([
                'status' => true,
                'message' => 'Livro atualizado com sucesso!',
                'livro' => $livro->refresh(),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Ocorreu um erro ao atualizar o livro!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove um livro
     * @param int $id
     * @return JsonResponse|mixed
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $livro = Livro::findOrFail($id);
            $livro->delete();

            return response()->json([
                'status' => true,
                'message' => 'Livro removido com sucesso!',
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Livro não encontrado!',
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao remover o livro!',
            ], 500);
        }
    }
}
