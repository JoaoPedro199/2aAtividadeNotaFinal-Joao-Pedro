<?php
include 'database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Define 'concluida' como 1
    $stmt = $db->prepare("UPDATE tarefas SET concluida = 1 WHERE id = :id");
    $stmt->bindValue(':id', $id);
    $stmt->execute();
}

header('Location: index.php');
exit();
?>