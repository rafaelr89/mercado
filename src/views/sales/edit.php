<?php

$custom_scripts = [
  "sale-script.js",
];

?>

<?php include __DIR__ . '/../../templates/header.php'; ?>

<main class="container my-4">
  <h2 class="mb-4">Editar Venda</h2>

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/mercado/sales">Vendas</a></li>
      <li class="breadcrumb-item active" aria-current="page">Editar Venda</li>
    </ol>
  </nav>

  <div class="row justify-content-start">
    <div class="col-md-12">
      <form action="/mercado/sales/update" method="post" onsubmit="return validaForm()">
        <input type="hidden" name="id" value="<?= $sale->id ?>">
        <div class="row">
          <div class="form-group col-6">
            <label for="customer">Cliente</label>
            <input type="text" class="form-control" id="customer" name="customer" value="<?= $sale->customer ?>" required>
          </div>
        </div>
        <div class="row mr-0 ml-0">
          <h3>Adicionar Produto</h3>
        </div>
        <div class="row">
          <div class="form-group col-4">
            <label for="products">Produto</label>
            <select class="form-control" id="products">
              <option value="">Selecione</option>

              <?php
                foreach ($products as $product) {
                  $disabled = in_array($product->id, array_column($sale_products, 'product_id')) ? 'disabled' : '';
                  ?>
                    <option value="<?= $product->id ?>" data-price="<?= $product->price ?>" data-type="<?= $product->type ?>" data-tax="<?= $product->type_tax ?>" <?= $disabled ?> ><?= $product->name ?></option>
                  <?php 
                } 
              ?>

            </select>
          </div>

          <div class="form-group col-2">
            <label for="quantity">Quantidade</label>
            <input type="number" class="form-control" id="quantity" min="0">
          </div>

          <div class="form-group col-2">
            <label for="add-product">&nbsp;</label>
            <button type="button" id="add-product" class="form-control btn btn-secondary btn-sm">Adicionar</button>
          </div>
        </div>
        <div class="row mr-0 ml-0">
          <h3>Produtos</h3>
          <table id="products-table" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Tipo</th>
                    <th>Imposto</th>
                    <th>Subtotal</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
              <?php
                $products_total = 0;
                $tax_total = 0;
                $total = 0;

                if (count($sale_products) === 0) {
                  ?>
                    <tr data-empty="true">
                      <td colspan="8" class="text-center">Nenhum produto adicionado</td>
                    </tr>
                  <?php
                } else {
                  foreach ($sale_products as $sale_product) {
                    $sub_total = $sale_product->price * $sale_product->quantity;
                    $tax_subtotal = ($sub_total / 100) * $sale_product->tax;
  
                    $products_total += $sub_total;
                    $tax_total += $tax_subtotal;
                    $total += ($sub_total + $tax_subtotal);
                    ?>
                    <tr data-id="<?= $sale_product->product_id ?>" data-quantity="<?= $sale_product->quantity ?>" data-price="<?= $sale_product->price ?>" data-tax="<?= $sale_product->tax ?>" data-subtotal="<?= $sub_total + $tax_subtotal ?>">
                      <td><?= $sale_product->product_id ?></td>
                      <td><?= $sale_product->name ?></td>
                      <td>R$ <?= number_format($sale_product->price, 2, ',', '.') ?></td>
                      <td><?= $sale_product->quantity ?></td>
                      <td><?= $sale_product->type ?></td>
                      <td><?= $sale_product->tax ?>%</td>
                      <td><?= 'R$ ' . number_format($sub_total + $tax_subtotal, 2, ',', '.') ?></td>
                      <td>
                        <button type="button" class="btn btn-danger btn-sm" onClick="deleteProduct(<?= $sale_product->product_id ?>);"><i class="fa fa-trash-o" aria-hidden="true"></i> Excluir</button>
                      </td>
                    </tr>
                    <?php
                  }
                }
              ?>
            </tbody>
          </table>
          <input type="hidden" id="all-products" name="all-products" value="">
        </div>
        <div class="row">
          <div class="form-group col-4">
            <label for="products-total">Total dos Produtos</label>
            <input type="text" class="form-control" id="products-total" value="R$ <?= number_format($products_total, 2, ',', '.') ?>" disabled>
          </div>
          <div class="form-group col-4">
            <label for="tax-total">Total dos Impostos</label>
            <input type="text" class="form-control" id="tax-total" value="R$ <?= number_format($tax_total, 2, ',', '.') ?>" disabled>
          </div>
          <div class="form-group col-4">
            <label for="total">Total Geral</label>
            <input type="text" class="form-control" id="total" value="R$ <?= number_format($total, 2, ',', '.') ?>" disabled>
          </div>
        </div>
        <div id="alert-products" class="alert alert-danger d-none" role="alert">
          Adicione pelo menos 1 produto!
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
      </form>
    </div>
  </div>
</main>

<?php include __DIR__ . '/../../templates/footer.php'; ?>