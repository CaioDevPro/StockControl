<?php
class SupplierModel {

    // CREATE - Cadastra um novo fornecedor
    public function criar(array $dados): bool {
        $sql = "INSERT INTO fornecedores (cnpj, empresa, email, telefone, endereco)
                VALUES (:cnpj, :empresa, :email, :telefone, :endereco)";

        $stmt = Database::getConexao()->prepare($sql);

        return $stmt->execute([
            ':cnpj'     => $dados['cnpj'],
            ':empresa'  => $dados['empresa'],
            ':email'    => $dados['email'],
            ':telefone' => $dados['telefone'],
            ':endereco' => $dados['endereco'],
        ]);
    }

    // READ - Lista todos os fornecedores
    public function listarTodos(): array {
        $sql = "SELECT * FROM fornecedores ORDER BY empresa ASC";
        $stmt = Database::getConexao()->query($sql);
        return $stmt->fetchAll();
    }

    // READ - Busca um fornecedor pelo ID
    public function buscarPorId(int $id): array|false {
        $sql = "SELECT * FROM fornecedores WHERE id = :id";
        $stmt = Database::getConexao()->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // UPDATE - Atualiza um fornecedor existente
    public function atualizar(int $id, array $dados): bool {
        $sql = "UPDATE fornecedores
                SET cnpj = :cnpj,
                    empresa = :empresa,
                    email = :email,
                    telefone = :telefone,
                    endereco = :endereco
                WHERE id = :id";

        $stmt = Database::getConexao()->prepare($sql);

        return $stmt->execute([
            ':id'       => $id,
            ':cnpj'     => $dados['cnpj'],
            ':empresa'  => $dados['empresa'],
            ':email'    => $dados['email'],
            ':telefone' => $dados['telefone'],
            ':endereco' => $dados['endereco'],
        ]);
    }

    // DELETE - Remove um fornecedor pelo ID
    public function deletar(int $id): bool {
        $sql = "DELETE FROM fornecedores WHERE id = :id";
        $stmt = Database::getConexao()->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}