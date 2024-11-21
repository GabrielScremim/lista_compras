<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Compras</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<?php
require_once 'lista-cont.php';
?>

<body>

    <!-- Container principal -->
    <div class="container my-5">
        <h1 class="text-center mb-4">Lista de Compras</h1>

        <!-- Formulário para adicionar itens -->
        <form method="POST" class="mb-4">
            <div class="input-group">
                <?php
                if (isset($produto)) {
                    // Exibe o formulário de edição
                    echo '<input type="text" class="form-control" name="item" value="' . htmlspecialchars($produto['nome']) . '" required>';
                    echo '<input type="hidden" name="id" value="' . $produto['id'] . '">';
                    echo '<button class="btn btn-primary" type="submit">Salvar Alterações</button>';
                } else { ?>
                    <input type="text" class="form-control" name="item" placeholder="Adicionar item" required>
                    <button class="btn btn-primary" type="submit">Adicionar</button>
                <?php } ?>
            </div>
        </form>

        <!-- Tabela de Lista de Compras -->
        <table class="table table-striped table-bordered text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Item</th>
                    <th>Comprar</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $lista = new Lista($pdo);
                $lista_prod = $lista->ListarProduto();
                foreach ($lista_prod as $prod) { ?>
                    <tr>
                        <?php
                        foreach ($prod as $k => $v) {
                            if ($k != 'comprado' && $k != 'valor' && $k != 'mostrar') {
                        ?>
                                <td><?= $v ?></td>
                        <?php
                            }
                        }
                        ?>
                        <form method="POST">
                            <td>
                                <?php if ($prod['comprado'] == 0) { ?>
                                    <button class="btn btn-success btn-sm" type="submit" name="comprar" value="<?= $prod['id'] ?>">Comprar</button>
                                <?php } else { ?>
                                    <input type="text" class="form-control" name="preco" placeholder="Preço" required>
                                    <button class="btn btn-info btn-sm" type="submit" name="salvar_preco" value="<?= $prod['id'] ?>">Salvar Preço</button>
                                <?php } ?>
                            </td>
                        </form>
                        <form method="get">
                            <td>
                                <a href="?editar=<?= $prod['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm" type="submit" name="excluir" value="<?= $prod['id'] ?>">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </td>
                        </form>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <h1 class="text-center mb-4">Produtos Comprado</h1>
        <table class="table table-striped table-bordered text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Item</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <a href="/lista_compras/"></a>
            <tbody>
                <?php
                $lista = new Lista($pdo);
                $lista_comprado = $lista->ListarProdComprado();
                $valor = $lista->valorTotal();
                foreach ($lista_comprado as $prod) { ?>
                    <tr>
                        <?php
                        foreach ($prod as $k => $v) {
                            if ($k != 'comprado' && $k != 'mostrar') {
                        ?>
                                <td><?= $v ?></td>
                        <?php
                            }
                        }
                        ?>
                    </tr>
                <?php } ?>
                <tr>
                    <th colspan="2">Total</th>
                    <td><?= $valor['total_valor'] ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Script do Bootstrap e funcionalidades -->
    <script src="bootstrap.bundle.min.js"></script>
</body>

</html>