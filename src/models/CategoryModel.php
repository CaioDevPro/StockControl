<?php
class CategoryModel {

    // CREATE - Cadastra uma nova categoria
    public function criar(array $dados): bool {
        $sql = "INSERT INTO categorias (nome) VALUES (:nome)";
        $stmt = Database::getConexao()->prepare($sql);
        return $stmt->execute([':nome' => $dados['nome']]);
    }

    // READ - Lista todas as categorias
    public function listarTodos(): array {
        $sql = "SELECT * FROM categorias ORDER BY nome ASC";
        $stmt = Database::getConexao()->query($sql);
        return $stmt->fetchAll();
    }

    // READ - Busca uma categoria pelo ID
    public function buscarPorId(int $id): array|false {
        $sql = "SELECT * FROM categorias WHERE id = :id";
        $stmt = Database::getConexao()->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // UPDATE - Atualiza uma categoria existente
    public function atualizar(int $id, array $dados): bool {
        $sql = "UPDATE categorias SET nome = :nome WHERE id = :id";
        $stmt = Database::getConexao()->prepare($sql);
        return $stmt->execute([
            ':id'   => $id,
            ':nome' => $dados['nome'],
        ]);
    }

    // DELETE - Remove uma categoria pelo ID
    public function deletar(int $id): bool {
        $sql = "DELETE FROM categorias WHERE id = :id";
        $stmt = Database::getConexao()->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}