<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias - Stock Control</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/base.css">
</head>
<body>
    <h1>Categorias cadastradas</h1>
    <p><a href="<?= BASE_URL ?>/?rota=painel">Voltar ao painel</a> | <a href="<?= BASE_URL ?>/?rota=logout">Sair</a></p>

    <?php
    $mensagens = [
        'criado'         => 'Categoria cadastrada com sucesso!',
        'atualizado'     => 'Categoria atualizada com sucesso!',
        'excluido'       => 'Categoria excluída com sucesso!',
        'nao_encontrado' => 'Categoria não encontrada.',
    ];
    $msg = $_GET['msg'] ?? null;
    ?>

    <?php if ($msg && isset($mensagens[$msg])): ?>
        <?php $cor = ($msg === 'nao_encontrado') ? 'red' : 'green'; ?>
        <p style="color: <?= $cor ?>;"><?= htmlspecialchars($mensagens[$msg]) ?></p>
    <?php endif; ?>

    <p><a href="<?= BASE_URL ?>/?rota=categorias/novo">+ Nova categoria</a></p>

    <?php if (empty($categorias)): ?>
        <p>Nenhuma categoria cadastrada ainda.</p>
    <?php else: ?>
        <table border="1" cellpadding="8">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($categorias as $categoria): ?>
                <tr>
                    <td><?= htmlspecialchars($categoria['id']) ?></td>
                    <td><?= htmlspecialchars($categoria['nome']) ?></td>
                    <td>
                        <a href="<?= BASE_URL ?>/?rota=categorias/editar&id=<?= $categoria['id'] ?>">Editar</a>
                        |
                        <a href="<?= BASE_URL ?>/?rota=categorias/deletar&id=<?= $categoria['id'] ?>"
                           onclick="return confirm('Tem certeza que deseja excluir esta categoria?');">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>