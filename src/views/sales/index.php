<?php include __DIR__ . '/../../templates/header.php'; ?>

<main class="container my-4">
    
    <h2 class="mb-4">Vendas</h2>

    <div class="d-flex justify-content-start mb-3">
        <div>
            <a href="/mercado/sales/add" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Cadastrar Venda</a>
        </div>
    </div>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Criado em</th>
                <th>Valor Total</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sales as $sale) : ?>
            <tr>
                <td><?= $sale->id ?></td>
                <td><?= $sale->customer ?></td>
                <td><?= date('d/m/Y à\s H:i', strtotime($sale->created_at)) ?></td>
                <td>R$ <?= number_format($sale->total, 2, ',', '.') ?></td>
                <td>
                    <a href="/mercado/sales/edit/<?= $sale->id ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a>
                    <a href="/mercado/sales/delete/<?= $sale->id ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i> Excluir</a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</main>

<?php include __DIR__ . '/../../templates/footer.php'; ?>