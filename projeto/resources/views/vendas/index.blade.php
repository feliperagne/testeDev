<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Vendas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Listagem de Vendas</h2>

    <a href="{{ route('vendas.create') }}" class="btn btn-primary mb-2">Nova Venda</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Vendedor</th>
                <th>Forma de Pagamento</th>
                <th>Produtos vendidos</th>
                <th>Data da Venda</th>

                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vendas as $venda)
                <tr>
                    <td>{{ $venda->id }}</td>
                    <td>{{ $venda->cliente ? $venda->cliente->nome : 'N/A' }}</td>
                    <td>{{ $venda->vendedor->nome }}</td>
                    <td>{{ $venda->forma_pagamento }}</td>
                    <td>
                        @foreach ($venda->itens as $item)
                            {{ $item->produto->nome }} (Quantidade: {{ $item->quantidade }})
                            @if (!$loop->last)
                                <br>
                            @endif
                        @endforeach
                    </td>
                    <td>{{ $venda->created_at->format('d/m/Y H:i:s') }}</td>
                    <td>
                        <a href="{{ route('vendas.edit', $venda->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('vendas.destroy', $venda->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
