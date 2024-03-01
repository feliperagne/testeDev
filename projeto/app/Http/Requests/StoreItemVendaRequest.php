<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemVendaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'venda_id' => 'required|exists:vendas,id',
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
            'preco_unitario' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'venda_id.required' => 'O campo venda é obrigatório.',
            'venda_id.exists' => 'A venda selecionada não existe.',
            'produto_id.required' => 'O campo produto é obrigatório.',
            'produto_id.exists' => 'O produto selecionado não existe.',
            'quantidade.required' => 'O campo quantidade é obrigatório.',
            'quantidade.integer' => 'A quantidade deve ser um número inteiro.',
            'quantidade.min' => 'A quantidade deve ser pelo menos 1.',
            'preco_unitario.required' => 'O campo preço unitário é obrigatório.',
            'preco_unitario.numeric' => 'O preço unitário deve ser um valor numérico.',
            'preco_unitario.min' => 'O preço unitário deve ser pelo menos 0.',
        ];
    }
}
