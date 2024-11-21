<?php
require_once 'conexao.php';
class ListModel
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function AdicionarProduto($item)
    {
        $comando = $this->pdo->prepare("INSERT INTO itens (nome) values(:nome)");
        $comando->bindValue(':nome', $item);
        $comando->execute();
    }

    public function ListarProdutor()
    {
        $resultado = array();
        $comando = $this->pdo->prepare("SELECT * FROM itens WHERE mostrar = 1 AND comprado <> 2");
        $comando->execute();
        $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function excluirProduto($id)
    {
        $comando = $this->pdo->prepare("UPDATE itens SET mostrar = '0' WHERE id = :id");
        $comando->bindValue(':id', $id);
        $comando->execute();
    }

    public function ComprarProduto($id)
    {
        // Marcar produto como comprado
        $comando = $this->pdo->prepare("UPDATE itens SET comprado = 1 WHERE id = :id");
        $comando->bindValue(':id', $id);
        $comando->execute();
    }

    public function SalvarPreco($id, $preco)
    {
        // Atualizar o preço do produto
        $comando = $this->pdo->prepare("UPDATE itens SET comprado = 2, valor = :valor WHERE id = :id");
        $comando->bindValue(':valor', $preco);
        $comando->bindValue(':id', $id);
        $comando->execute();
    }

    public function ListarProdComprado()
    {
        $resultado = array();
        $comando = $this->pdo->prepare("SELECT * FROM itens WHERE comprado = 2");
        $comando->execute();
        $resultado = $comando->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    public function valorTotal()
    {
        $resultado = array();
        $comando = $this->pdo->prepare("SELECT SUM(valor) as total_valor FROM itens WHERE comprado = 2;");
        $comando->execute();
        $resultado = $comando->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    // Método na classe Lista para buscar um produto por ID
    public function ListarProdutoPorId($id)
    {
        $sql = "SELECT * FROM itens WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function EditarProduto($id,  $item)
    {
        $sql = "UPDATE itens SET nome = :nome WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nome', $item);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }
}
