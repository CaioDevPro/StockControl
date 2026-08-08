<?php
class ProductModel {

    // CREATE - Cadastra um novo produto
    public function criar(array $dados): bool {
        $sql = "INSERT INTO produtos (descricao, qtd, estoque_minimo, preco, id_categoria, id_fornecedor)
                VALUES (:descricao, :qtd, :estoque_minimo, :preco, :id_categoria, :id_fornecedor)";

        $stmt = Database::getConexao()->prepare($sql);

        return $stmt->execute([
            ':descricao'      => $dados['descricao'],
            ':qtd'            => $dados['qtd'],
            ':estoque_minimo' => $dados['estoque_minimo'],
            ':preco'          => $dados['preco'],
            ':id_categoria'   => $dados['id_categoria'] ?: null,
            ':id_fornecedor'  => $dados['id_fornecedor'] ?: null,
        ]);
    }

    // READ - Lista todos os produtos
    public function listarTodos(): array {
        $sql = "SELECT * FROM produtos ORDER BY id DESC";
        $stmt = Database::getConexao()->query($sql);
        return $stmt->fetchAll();
    }
}