<?php
// src/repository.php
require_once __DIR__ . '/../config/db.php';

// Atualizado para aceitar o filtro de status opcional
function listar_tarefas(?string $status = null): array
{
    // Se o status for válido, usamos o prepare para filtrar com segurança
    if ($status === 'pendente' || $status === 'feito') {
        $sql = "SELECT * FROM tarefas WHERE status = ? ORDER BY id DESC";
        $stmt = db()->prepare($sql);
        $stmt->execute([$status]);
        return $stmt->fetchAll();
    }

    // Se não houver filtro, busca todas as tarefas
    $sql = "SELECT * FROM tarefas ORDER BY id DESC";
    return db()->query($sql)->fetchAll();
}

function criar_tarefa(string $titulo, ?string $descricao, string $status): int
{
    $sql = "INSERT INTO tarefas (titulo, descricao, status) VALUES (?, ?, ?)";
    $stmt = db()->prepare($sql);
    $stmt->execute([$titulo, $descricao, $status]);
    return (int) db()->lastInsertId();
}

function buscar_tarefa(int $id): ?array
{
    $sql = "SELECT * FROM tarefas WHERE id = ?";
    $stmt = db()->prepare($sql);
    $stmt->execute([$id]);
    $row = $stmt->fetch();
    return $row ?: null;
}

function atualizar_tarefa(int $id, string $titulo, ?string $descricao, string $status): bool
{
    $sql = "UPDATE tarefas SET titulo = ?, descricao = ?, status = ? WHERE id = ?";
    $stmt = db()->prepare($sql);
    return $stmt->execute([$titulo, $descricao, $status, $id]);
}

function excluir_tarefa(int $id): bool
{
    $sql = "DELETE FROM tarefas WHERE id = ?";
    $stmt = db()->prepare($sql);
    return $stmt->execute([$id]);
}
?>