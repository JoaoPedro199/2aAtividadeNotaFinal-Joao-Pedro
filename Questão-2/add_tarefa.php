<?php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $descricao = $_POST['descricao'];
    $data = $_POST['data_vencimento'];

    if (!empty($descricao)) {
        // Usa prepare/bindValue para evitar erros de segurança
        $stmt = $db->prepare("INSERT INTO tarefas (descricao, data_vencimento) VALUES (:desc, :data)");
        $stmt->bindValue(':desc', $descricao);
        $stmt->bindValue(':data', $data);
        
        $stmt->execute();
    }
}

header('Location: index.php');
exit();
?>