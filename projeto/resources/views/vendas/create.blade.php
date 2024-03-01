<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Venda</title>
    <!-- Adicione os links para os arquivos de estilo e script do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

    <div class="container mt-5">
        <h2>Criar Venda</h2>

        <form action="{{ route('vendas.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="vendedor_id" class="form-label">Vendedor responsável:</label>
                <input type="text" class="form-control" id="vendedor_id" name="vendedor_id" value="{{ auth()->user()->name }}" readonly>
            </div>


            <div class="mb-3">
                <label for="cliente_id" class="form-label">Cliente:</label>
                <select class="form-select" id="cliente_id" name="cliente_id">
                    <option value="" selected>Selecione um cliente</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                    @endforeach
                </select>
                @error('cliente_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="forma_pagamento" class="form-label">Forma de Pagamento:</label>
                <select class="form-select" id="forma_pagamento" name="forma_pagamento">
                    <option value="" selected>Selecione uma forma de pagamento</option>
                    <option value="dinheiro">Dinheiro</option>
                    <option value="credito">Crédito</option>
                    <option value="debito">Débito</option>
                </select>
                @error('forma_pagamento')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="container-produtos">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <label for="itens[produto_id][]" class="form-label">Produto:</label>
                        <select class="form-select" name="itens[produto_id][]">
                            <option value="" selected>Selecione um produto</option>
                            @foreach($produtos as $produto)
                                <option value="{{ $produto->id }}" data-preco="{{ $produto->preco }}">{{ $produto->nome }}</option>
                            @endforeach
                            @error('produto_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label for="itens[quantidade][]" class="form-label">Quantidade:</label>
                        <input type="number" class="form-control" name="itens[quantidade][]" >
                        @error('quantidade')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                    </div>
                    <div class="col-md-2">
                        <label for="itens[preco_unitario][]" class="form-label">Preço:</label>
                        <input type="number" class="form-control" name="itens[preco_unitario][]" readonly>
                        @error('preco_unitario')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                    </div>
                    <div class="col-md-2">
                        <label for="itens[subtotal][]" class="form-label">Subtotal:</label>
                        <input type="number" class="form-control" name="itens[subtotal][]" readonly>
                        @error('subtotal')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-primary btn-adicionar-produto">Adicionar Produto</button>
            <button type="submit" class="btn btn-success">Salvar Venda</button>

            <div class="mt-3">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </form>
    </div>

    <script>
       document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('.btn-adicionar-produto').addEventListener('click', adicionarProduto);
    document.querySelector('.container-produtos').addEventListener('change', function (event) {
        if (event.target.name && event.target.name.startsWith('itens[produto_id][]')) {
            atualizarPrecoESubtotal(event);
        }
    });
    document.querySelector('.container-produtos').addEventListener('input', function (event) {
        if (event.target.name && event.target.name.startsWith('itens[quantidade][]')) {
            atualizarPrecoESubtotal(event);
        }
    }); 
});

function adicionarProduto() {
    const containerProdutos = document.querySelector('.container-produtos');
    const novoProduto = containerProdutos.firstElementChild.cloneNode(true);

    novoProduto.querySelectorAll('[name^="itens"]').forEach(function (element) {
        element.value = '';
    });
    containerProdutos.appendChild(novoProduto);
    novoProduto.querySelector('[name^="itens[produto_id][]"]').addEventListener('change', atualizarPrecoESubtotal);
    novoProduto.querySelector('[name^="itens[quantidade][]"]').addEventListener('input', atualizarPrecoESubtotal);
}

function atualizarPrecoESubtotal(event) {
    const produtoSelect = event.target.closest('.row').querySelector('[name^="itens[produto_id][]"]');
    const precoInput = produtoSelect.closest('.row').querySelector('[name^="itens[preco_unitario][]"]');
    const subtotalInput = produtoSelect.closest('.row').querySelector('[name^="itens[subtotal][]"]');
    const precoProduto = parseFloat(produtoSelect.options[produtoSelect.selectedIndex].getAttribute('data-preco')) || 0;
    precoInput.value = precoProduto.toFixed(2);
    const quantidade = parseFloat(event.target.value) || 0;
    subtotalInput.value = (quantidade * precoProduto).toFixed(2);
}

    </script>



</body>
</html>
