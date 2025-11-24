<?php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'] ?? '';
    $autor = $_POST['autor'] ?? '';
    $ano = $_POST['ano'] ?? '';

    if (!empty($titulo) && !empty($autor) && !empty($ano)) {
        try {
            // Previne SQL Injection
            $stmt = $pdo->prepare("INSERT INTO livros (titulo, autor, ano) VALUES (:titulo, :autor, :ano)");
            
            $stmt->execute([
                ':titulo' => $titulo,
                ':autor' => $autor,
                ':ano' => $ano
            ]);
        } catch (PDOException $e) {
            echo "Erro ao adicionar: " . $e->getMessage();
            exit;
        }
    }
}

header('Location: index.php');
exit;
?>