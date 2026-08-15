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

    // READ - Busca um único produto pelo ID (usado pra preencher o form de edição)
    public function buscarPorId(int $id): array|false {
        $sql = "SELECT * FROM produtos WHERE id = :id";
        $stmt = Database::getConexao()->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // UPDATE - Atualiza um produto existente
    public function atualizar(int $id, array $dados): bool {
        $sql = "UPDATE produtos
                SET descricao = :descricao,
                    qtd = :qtd,
                    estoque_minimo = :estoque_minimo,
                    preco = :preco,
                    id_categoria = :id_categoria,
                    id_fornecedor = :id_fornecedor
                WHERE id = :id";

        $stmt = Database::getConexao()->prepare($sql);

        return $stmt->execute([
            ':id'             => $id,
            ':descricao'      => $dados['descricao'],
            ':qtd'            => $dados['qtd'],
            ':estoque_minimo' => $dados['estoque_minimo'],
            ':preco'          => $dados['preco'],
            ':id_categoria'   => $dados['id_categoria'] ?: null,
            ':id_fornecedor'  => $dados['id_fornecedor'] ?: null,
        ]);
    }

    // DELETE - Remove um produto pelo ID
    public function deletar(int $id): bool {
        $sql = "DELETE FROM produtos WHERE id = :id";
        $stmt = Database::getConexao()->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}