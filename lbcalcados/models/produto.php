<?php
require_once '../config/connection.php'; 


class Produto {

    private $nome;
    private $descricao;
    private $preco;
    private $cor;
    private $tamanho;
    private $marca;
    private $url_img;
    private $categoria;
    private $estoque_qtd;
    private $conn;


    public function setNome($nome) {$this->nome = $nome;}

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
    
    public function setPreco($preco) {
        $this->preco = $preco;
    }
    
    public function setCor($cor) {
        $this->cor = $cor;
    }
    
    public function setTamanho($tamanho) {
        $this->tamanho = $tamanho;
    }
    
    public function setMarca($marca) {
        $this->marca = $marca;
    }
    
    public function setUrlImg($url_img) {
        $this->url_img = $url_img;
    }
    
    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }
    
    public function setEstoqueQtd($estoque_qtd) {
        $this->estoque_qtd = $estoque_qtd;
    }
    

    public function __construct(){
        $db = new Connection;
        $this->conn = $db-> conectar(); 
    }

    public function cadastrarProduto($nome, $descricao, $preco, $cor, $tamanho, $marca, $url_img, $categoria, $estoque_qtd) {
        // Verifica se a categoria foi fornecida. Se não, atribui 'diversos'
        if (empty($categoria)) {
            $categoria = 'diversos'; 
        }
    
        $query = "INSERT INTO produtos (nome, descricao, preco, cor, tamanho, marca, url_img, categoria, estoque_qtd) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($query);
        
        if ($stmt === false) {
            die('Erro na preparação da consulta: ' . $this->conn->error);
        }
    
        $stmt->bind_param("ssdsssdsi", $nome, $descricao, $preco, $cor, $tamanho, $marca, $url_img, $categoria, $estoque_qtd);
        
        if (!$stmt->execute()) {
            
            return true;

        } else {
            
            die('Erro ao executar a consulta: ' . $stmt->error);
        }
    
        return true;
    }
}

// Exemplo de uso (supondo que você tenha uma conexão com o banco $db_connection):
// $produto = new Produto($db_connection);
// $produto->cadastrarProduto($nome, $descricao, $preco, $cor, $tamanho, $marca, $url_img, $categoria, $estoque_qtd);

?>
