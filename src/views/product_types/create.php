<?php include __DIR__ . '/../../templates/header.php'; ?>

<main class="container my-4">
  <h2 class="mb-4">Cadastrar Tipo de Produto</h2>

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/mercado/product_types">Tipos de Produto</a></li>
      <li class="breadcrumb-item active" aria-current="page">Cadastrar Tipo de Produto</li>
    </ol>
  </nav>

  <div class="row justify-content-start">
    <div class="col-md-12">
      <form action="/mercado/product_types/add" method="post">
        <div class="row">
          <div class="form-group col-6">
            <label for="name">Nome</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="form-group col-2">
            <label for="tax">Imposto</label>
            <div class="input-group mb-2">
              <input type="number" class="form-control" id="tax" name="tax" min="0" required>
              <div class="input-group-append">
                <div class="input-group-text">%</div>
              </div>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Cadastrar</button>
      </form>
    </div>
  </div>
</main>

<?php include __DIR__ . '/../../templates/footer.php'; ?>