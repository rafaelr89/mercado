<?php

$custom_scripts = [
  "product-script.js",
];

$external_scripts = [
  "https://code.jquery.com/jquery-3.6.0.min.js",
  "https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js",
];

?>

<?php include __DIR__ . '/../../templates/header.php'; ?>

<main class="container my-4">
  <h2 class="mb-4">Cadastrar Produto</h2>

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/mercado/products">Produtos</a></li>
      <li class="breadcrumb-item active" aria-current="page">Cadastrar Produto</li>
    </ol>
  </nav>

  <div class="row justify-content-start">
    <div class="col-md-12">
      <form action="/mercado/products/add" method="post">
        <div class="row">
          <div class="form-group col-6">
            <label for="name">Nome</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="form-group col-6">
            <label for="id_type">Tipo de Produto</label>
            <select class="form-control" id="id_type" name="id_type" required>
              <option value="">Selecione</option>

              <?php foreach ($product_types as $product_type) { ?>
                <option value="<?= $product_type->id ?>"><?= $product_type->name ?></option>
              <?php } ?>

            </select>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-6">
            <label for="price">Preço</label>
            <input type="text" class="form-control" id="price" name="price" required>
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Cadastrar</button>
      </form>
    </div>
  </div>
</main>

<?php include __DIR__ . '/../../templates/footer.php'; ?>