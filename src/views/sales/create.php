<?php

$custom_scripts = [
  "sale-script.js",
];

?>

<?php include __DIR__ . '/../../templates/header.php'; ?>

<main class="container my-4">
  <h2 class="mb-4">Cadastrar Venda</h2>

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/mercado/sales">Vendas</a></li>
      <li class="breadcrumb-item active" aria-current="page">Cadastrar Venda</li>
    </ol>
  </nav>

  <div class="row justify-content-start">
    <div class="col-md-12">
      <form action="/mercado/sales/add" method="post" onsubmit="return validaForm()">
        <div class="row">
          <div class="form-group col-6">
            <label for="customer">Cliente</label>
            <input type="text" class="form-control" id="customer" name="customer" required>
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

              <?php foreach ($products as $product) { ?>
                <option value="<?= $product->id ?>" data-price="<?= $product->price ?>" data-type="<?= $product->type ?>" data-tax="<?= $product->type_tax ?>"><?= $product->name ?></option>
              <?php } ?>

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
              <tr data-empty="true">
                <td colspan="8" class="text-center">Nenhum produto adicionado</td>
              </tr>
            </tbody>
          </table>
          <input type="hidden" id="all-products" name="all-products" value="">
        </div>
        <div class="row">
          <div class="form-group col-4">
            <label for="products-total">Total dos Produtos</label>
            <input type="text" class="form-control" id="products-total" value="R$ 0,00" disabled>
          </div>
          <div class="form-group col-4">
            <label for="tax-total">Total dos Impostos</label>
            <input type="text" class="form-control" id="tax-total" value="R$ 0,00" disabled>
          </div>
          <div class="form-group col-4">
            <label for="total">Total Geral</label>
            <input type="text" class="form-control" id="total" value="R$ 0,00" disabled>
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