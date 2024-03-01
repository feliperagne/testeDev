<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreParcelaRequest extends FormRequest
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
            'valor' => 'required|numeric|min:0',
            'data_vencimento' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'venda_id.required' => 'O campo venda é obrigatório.',
            'venda_id.exists' => 'A venda selecionada não existe.',
            'valor.required' => 'O campo valor é obrigatório.',
            'valor.numeric' => 'O valor deve ser um número.',
            'valor.min' => 'O valor não pode ser negativo.',
            'data_vencimento.required' => 'O campo data de vencimento é obrigatório.',
            'data_vencimento.date' => 'A data de vencimento deve ser uma data válida.',
        ];
    }
}
