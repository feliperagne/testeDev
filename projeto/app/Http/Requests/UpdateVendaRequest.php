<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVendaRequest extends FormRequest
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
        $opcoesFormaPagamento = ['dinheiro', 'credito', 'debito'];

        return [
        'cliente_id' => 'nullable|exists:clientes,id',
        'vendedor_id' => 'required',
        'forma_pagamento' => 'required|string|in:' . implode(',', $opcoesFormaPagamento),
        ];
    }

    public function messages(): array{
        return [
            'cliente_id.exists' => 'O cliente selecionado não existe.',
            'vendedor_id.required' => 'O campo vendedor é obrigatório.',
            //'vendedor_id.exists' => 'O vendedor selecionado não existe.',
            'forma_pagamento.required' => 'O campo forma de pagamento é obrigatório.',
            'forma_pagamento.in' => 'A forma de pagamento selecionada não é válida.',
        ];
    }
}
