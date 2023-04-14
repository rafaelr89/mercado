<?php include __DIR__ . '/../../templates/header.php'; ?>

<main class="container my-4">
    <h2 class="mb-4">Produtos</h2>

    <div class="d-flex justify-content-start mb-3">
        <div>
            <a href="/mercado/products/add" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Cadastrar Produto</a>
        </div>
        <div>
            <a href="/mercado/product_types" class="btn btn-primary btn-sm"><i class="fa fa-tags" aria-hidden="true"></i> Tipos de Produto</a>
        </div>
    </div>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product) : ?>
            <tr>
                <td><?= $product->id ?></td>
                <td><?= $product->name ?></td>
                <td><?= $product->type ?></td>
                <td>R$ <?= number_format($product->price, 2, ',', '.') ?></td>
                <td>
                    <a href="/mercado/products/edit/<?= $product->id ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a>
                    <a href="/mercado/products/delete/<?= $product->id ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i> Excluir</a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</main>

<?php include __DIR__ . '/../../templates/footer.php'; ?>