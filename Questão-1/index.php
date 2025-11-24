<?php
require 'database.php';

$stmt = $pdo->query("SELECT * FROM livros ORDER BY id DESC");
$livros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livraria Simples</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 20px auto; background-color: #f4f4f4; padding: 20px; }
        h1, h2 { color: #333; text-align: center; }
        
        .form-container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); margin-bottom: 30px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="number"] { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ddd; border-radius: 4px; }
        button { background-color: #28a745; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; width: 100%; font-size: 16px; }
        button:hover { background-color: #218838; }

        table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #007bff; color: white; }
        tr:hover { background-color: #f1f1f1; }
        
        .btn-delete { background-color: #dc3545; color: white; text-decoration: none; padding: 5px 10px; border-radius: 3px; font-size: 14px; }
        .btn-delete:hover { background-color: #c82333; }
        
        .empty-msg { text-align: center; padding: 20px; color: #666; font-style: italic; }
    </style>
</head>
<body>

    <h1>Gerenciamento de Livraria</h1>

    <div class="form-container">
        <h2>Adicionar Novo Livro</h2>
        <form action="add_book.php" method="POST">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" required placeholder="Ex: Dom Casmurro">
            </div>
            <div class="form-group">
                <label for="autor">Autor:</label>
                <input type="text" id="autor" name="autor" required placeholder="Ex: Machado de Assis">
            </div>
            <div class="form-group">
                <label for="ano">Ano de Publicação:</label>
                <input type="number" id="ano" name="ano" required placeholder="Ex: 1899">
            </div>
            <button type="submit">Salvar Livro</button>
        </form>
    </div>

    <h2>Livros Cadastrados</h2>
    
    <?php if (count($livros) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Ano</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($livros as $livro): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($livro['id']); ?></td>
                        <td><?php echo htmlspecialchars($livro['titulo']); ?></td>
                        <td><?php echo htmlspecialchars($livro['autor']); ?></td>
                        <td><?php echo htmlspecialchars($livro['ano']); ?></td>
                        <td>
                            <a href="delete_book.php?id=<?php echo $livro['id']; ?>" 
                               class="btn-delete"
                               onclick="return confirm('Tem certeza que deseja excluir este livro?');">
                               Excluir
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="empty-msg">Nenhum livro cadastrado ainda.</div>
    <?php endif; ?>

</body>
</html>