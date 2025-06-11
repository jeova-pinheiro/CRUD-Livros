<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateLivroRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta requisição.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Manipula falha de validação e retorna uma resposta JSON com os erros.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'erros' => $validator->errors(),
        ], 422));
    }

    /**
     * Regras de validação para atualização parcial de livros.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'LIV_TITULO'          => 'sometimes|required|string|max:255',
            'LIV_AUTOR'           => 'sometimes|required|string|max:255',
            'LIV_ANO_PUBLICACAO'  => 'sometimes|required|integer|min:1|max:' . date('Y'),
            'LIV_GENERO'          => 'sometimes|nullable|string|max:255',
        ];
    }

    /**
     * Mensagens personalizadas para as validações.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'LIV_TITULO.required' => 'O campo LIV_TITULO é obrigatório!',
            'LIV_TITULO.max'      => 'O LIV_TITULO não pode ter mais que 255 caracteres!',

            'LIV_AUTOR.required' => 'O campo LIV_AUTOR é obrigatório!',
            'LIV_AUTOR.max'      => 'O LIV_AUTOR não pode ter mais que 255 caracteres!',

            'LIV_ANO_PUBLICACAO.required' => 'O campo LIV_ANO_PUBLICACAO é obrigatório!',
            'LIV_ANO_PUBLICACAO.integer'  => 'O LIV_ANO_PUBLICACAO deve ser um número inteiro!',
            'LIV_ANO_PUBLICACAO.min'      => 'O LIV_ANO_PUBLICACAO deve ser maior ou igual a 1!',
            'LIV_ANO_PUBLICACAO.max'      => 'O LIV_ANO_PUBLICACAO não pode ser maior que o ano atual!',

            'LIV_GENERO.max' => 'O LIV_GENERO não pode ter mais que 255 caracteres!',
        ];
    }
}
