<?php
require 'database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM livros WHERE id = :id");
        $stmt->execute([':id' => $id]);
    } catch (PDOException $e) {
        echo "Erro ao excluir: " . $e->getMessage();
        exit;
    }
}

header('Location: index.php');
exit;
?>