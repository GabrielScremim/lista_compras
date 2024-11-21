<?php
require_once 'lista-dao.php';

class Lista
{
    private $pdo;
    private $listaModel;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->listaModel = new ListModel($pdo);
    }

    public function AdicionarProduto($item)
    {
        $this->listaModel->AdicionarProduto($item);
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    }

    public function ListarProduto()
    {
        return $this->listaModel->ListarProdutor();
    }
    public function ComprarProduto($id)
    {
        // Marcar o produto como comprado
        $this->listaModel->ComprarProduto($id);
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    }

    public function SalvarPreco($id, $preco)
    {
        // Atualizar o preço do produto no banco de dados
        $this->listaModel->SalvarPreco($id, $preco);
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    }
    public function excluirProduto($id)
    {
        $this->listaModel->excluirProduto($id);
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    }

    public function ListarProdComprado()
    {
        return $this->listaModel->ListarProdComprado();
    }

    public function valorTotal()
    {
        return $this->listaModel->valorTotal();
    }

    public function ListarProdutoPorId($id)
    {
        return $this->listaModel->ListarProdutoPorId($id);
    }
    public function EditarProduto($id,  $item)
    {
        $this->listaModel->EditarProduto($id,  $item);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['editar'])) {
        $id = $_GET['editar'];
        // Busca o produto pelo ID
        $lista = new Lista($pdo);
        $produto = $lista->ListarProdutoPorId($id);
    }

    // Verifica se foi solicitado para excluir
    if (isset($_GET['excluir'])) {
        $lista = new Lista($pdo);
        $id = $_GET['excluir'];
        $lista->excluirProduto($id); // Excluir produto pelo ID
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o formulário de edição foi enviado
    if (isset($_POST['id']) && isset($_POST['item'])) {
        $id = $_POST['id'];
        $item = $_POST['item'];

        // Atualiza o produto no banco
        $lista = new Lista($pdo);
        $lista->EditarProduto($id, $item);

        // Redireciona de volta para a página principal
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    }

    // Verifica se o formulário para adicionar um novo item foi enviado
    if (isset($_POST['item']) && !isset($_POST['id'])) {
        $item = trim($_POST['item']);
        if (!empty($item)) {
            $lista = new Lista($pdo);
            $lista->AdicionarProduto($item);
        }
    }

    // Verifica se foi clicado para marcar um produto como comprado
    if (isset($_POST['comprar'])) {
        $lista = new Lista($pdo);
        $id = $_POST['comprar'];
        $lista->ComprarProduto($id);
    }

    // Verifica se é para salvar o preço do produto
    if (isset($_POST['salvar_preco']) && isset($_POST['preco'])) {
        $lista = new Lista($pdo);
        $id = $_POST['salvar_preco'];
        $preco = $_POST['preco'];
        $lista->SalvarPreco($id, $preco);
    }
}
