<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Venda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <h2>Editar Venda</h2>

    <form action="{{ route('vendas.update', $vendas->id) }}" method="POST">
        @csrf
        @method('PUT')


        <div class="mb-3">
            <label for="cliente_id" class="form-label">Cliente:</label>
            <select class="form-select" id="cliente_id" name="cliente_id">
                <option value="" selected>Selecione um cliente</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ $cliente->id == $vendas->cliente_id ? 'selected' : '' }}>{{ $cliente->nome }}</option>
                @endforeach
            </select>
        </div>


        <div class="mb-3">
            <label for="vendedor_id" class="form-label">Vendedor:</label>
            <select class="form-select" id="vendedor_id" name="vendedor_id">
                <option value="" selected>Selecione um vendedor</option>
                @foreach($vendedores as $vendedor)
                    <option value="{{ $vendedor->id }}" {{ $vendedor->id == $vendas->vendedor_id ? 'selected' : '' }}>{{ $vendedor->nome }}</option>
                @endforeach
            </select>
        </div>


        <div class="mb-3">
            <label for="forma_pagamento" class="form-label">Forma de Pagamento:</label>
            <input type="text" class="form-control" id="forma_pagamento" name="forma_pagamento" value="{{ $vendas->forma_pagamento }}">
        </div>


        <div class="container-itens-venda">
            @foreach($vendas->itens as $item)
                <div class="row mb-2">
                    <div class="col-md-6">
                        <label for="itens[{{ $item->id }}][produto_id]" class="form-label">Produto:</label>
                        <select class="form-select" name="itens[{{ $item->id }}][produto_id]">
                            <option value="" selected>Selecione um produto</option>
                            @foreach($produtos as $produto)
                                <option value="{{ $produto->id }}" data-preco="{{ $produto->preco }}" {{ $produto->id == $item->produto_id ? 'selected' : '' }}>{{ $produto->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="itens[{{ $item->id }}][quantidade]" class="form-label">Quantidade:</label>
                        <input type="number" class="form-control" name="itens[{{ $item->id }}][quantidade]" value="{{ $item->quantidade }}" required>
                    </div>
                    <div class="col-md-2">
                        <label for="itens[{{ $item->id }}][preco_unitario]" class="form-label">Preço:</label>
                        <input type="number" class="form-control" name="itens[{{ $item->id }}][preco_unitario]" value="{{ $item->preco_unitario }}" readonly>
                    </div>
                    <div class="col-md-2">
                        <label for="itens[{{ $item->id }}][subtotal]" class="form-label">Subtotal:</label>
                        <input type="number" class="form-control" name="itens[{{ $item->id }}][subtotal]" value="{{ $item->subtotal }}" readonly>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="button" class="btn btn-primary btn-adicionar-item">Adicionar Item</button>
        <button type="submit" class="btn btn-success mt-2">Atualizar Venda</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelector('.btn-adicionar-item').addEventListener('click', adicionarItem);
        document.querySelectorAll('[name^="itens"]').forEach(function (element) {
            element.addEventListener('change', atualizarPrecoESubtotal);
        });
    });

    function adicionarItem() {
        const containerItensVenda = document.querySelector('.container-itens-venda');
        const novoItem = containerItensVenda.firstElementChild.cloneNode(true);

        novoItem.querySelectorAll('[name^="itens"]').forEach(function (element) {
            element.value = '';
        });
        containerItensVenda.appendChild(novoItem);
        novoItem.querySelector('[name^="itens[produto_id]"]').addEventListener('change', atualizarPrecoESubtotal);
    }

    function atualizarPrecoESubtotal(event) {
        const produtoSelect = event.target;
        const precoInput = produtoSelect.closest('.row').querySelector('[name^="itens[preco_unitario]"]');
        const subtotalInput = produtoSelect.closest('.row').querySelector('[name^="itens[subtotal]"]');
        const precoProduto = produtoSelect.options[produtoSelect.selectedIndex].getAttribute('data-preco');
        precoInput.value = precoProduto;
        const quantidade = parseFloat(produtoSelect.closest('.row').querySelector('[name^="itens[quantidade]"]').value) || 0;
        subtotalInput.value = (quantidade * precoProduto).toFixed(2);
    }
</script>

</body>
</html>
