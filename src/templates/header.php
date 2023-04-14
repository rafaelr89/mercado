<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mercado</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="/mercado/public/assets/css/styles.css">

    <?php

    if (!empty($external_scripts)) {
        foreach ($external_scripts as $external_script) {
            ?>
            <script src="<?= $external_script ?>"></script>
            <?php
        }
    }

    if (!empty($custom_scripts)) {
        foreach ($custom_scripts as $custom_script) {
            ?>
            <script src="/mercado/public/assets/js/<?= $custom_script ?>"></script>
            <?php
        }
    }

    ?>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="/mercado">Mercado</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="/mercado/products">Produtos</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="/mercado/sales">Vendas</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>