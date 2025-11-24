<?php
try {
   
    $db = new SQLite3('tarefas.db');

    $query = "CREATE TABLE IF NOT EXISTS tarefas (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        descricao TEXT NOT NULL,
        data_vencimento DATE,
        concluida INTEGER DEFAULT 0
    )";

    $db->exec($query);

} catch (Exception $e) {
    echo "Erro ao conectar: " . $e->getMessage();
    exit();
}
?>