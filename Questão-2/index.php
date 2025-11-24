<?php include 'database.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciador de Tarefas</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        .form-group { margin-bottom: 15px; padding: 15px; background-color: #f4f4f4; border-radius: 5px;}
        input { padding: 8px; margin-right: 10px; }
        button { padding: 8px 15px; cursor: pointer; background-color: #28a745; color: white; border: none; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #eee; }
        .btn-concluir { color: green; text-decoration: none; font-weight: bold; }
        .btn-excluir { color: red; text-decoration: none; font-weight: bold; margin-left: 10px;}
        .tarefa-concluida { text-decoration: line-through; color: gray; }
    </style>
</head>
<body>

    <h1>Lista de Tarefas</h1>

    <div class="form-group">
        <form action="add_tarefa.php" method="POST">
            <label>Descrição:</label>
            <input type="text" name="descricao" required placeholder="Ex: Estudar PHP">
            <label>Vencimento:</label>
            <input type="date" name="data_vencimento">
            <button type="submit">Adicionar</button>
        </form>
    </div>

    <hr>

    <h2>A Fazer</h2>
    <table>
        <tr>
            <th>Descrição</th>
            <th>Data</th>
            <th>Ações</th>
        </tr>
        <?php
        // Busca apenas tarefas pendentes
        $resultados = $db->query("SELECT * FROM tarefas WHERE concluida = 0 ORDER BY data_vencimento ASC");
        
        while ($row = $resultados->fetchArray()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['descricao']) . "</td>";
            echo "<td>" . $row['data_vencimento'] . "</td>";
            echo "<td>
                    <a href='update_tarefa.php?id=" . $row['id'] . "' class='btn-concluir'>Concluir</a>
                    <a href='delete_tarefa.php?id=" . $row['id'] . "' class='btn-excluir' onclick='return confirmarExclusao()'>Excluir</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>

    <h2>Concluídas</h2>
    <table>
        <tr>
            <th>Descrição</th>
            <th>Data</th>
            <th>Ações</th>
        </tr>
        <?php
        // Busca apenas tarefas concluídas
        $resultados = $db->query("SELECT * FROM tarefas WHERE concluida = 1 ORDER BY id DESC");
        
        while ($row = $resultados->fetchArray()) {
            echo "<tr>";
            echo "<td class='tarefa-concluida'>" . htmlspecialchars($row['descricao']) . "</td>";
            echo "<td>" . $row['data_vencimento'] . "</td>";
            echo "<td>
                    <a href='delete_tarefa.php?id=" . $row['id'] . "' class='btn-excluir' onclick='return confirmarExclusao()'>Excluir</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>

    <script>
        function confirmarExclusao() {
            return confirm("Tem certeza que deseja excluir?");
        }
    </script>

</body>
</html>