<?php include __DIR__ . '/../../templates/header.php'; ?>

<main class="container my-4">
    <h2 class="mb-4">Tipos de Produto</h2>

    <div class="d-flex justify-content-start mb-3">
        <div>
            <a href="/mercado/product_types/add" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Cadastrar Tipo de Produto</a>
        </div>
    </div>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Imposto</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($product_types as $product_type) : ?>
            <tr>
                <td><?= $product_type->id ?></td>
                <td><?= $product_type->name ?></td>
                <td><?= number_format($product_type->tax, 2, ',', '.') ?>%</td>
                <td>
                    <a href="/mercado/product_types/edit/<?= $product_type->id ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a>
                    <a href="/mercado/product_types/delete/<?= $product_type->id ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i> Excluir</a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</main>

<?php include __DIR__ . '/../../templates/footer.php'; ?>