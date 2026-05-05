<?php

// src/repository.php
require_once_DIR_.'/../config/db.php';

function listar_tarefas(): array
{
    $aql ="SELECT * FROM tarefas ORDER BY id DESC";
    return db()->query($sql)->fetchAll();

}

function criar_tarefas(string $titulo, ?string $descricao,string $status): int
{
    $sql = "INSERT INTO tarfas (título, descricao, status) VALUES(?,?,?)";
$stmt = db ()-> prepare($sql);
$stmt->execute([$id]);
$row = $stmt -> fetch();
return $row ?:  null;
}
function atualizar_tarefa(int $id, string $titulo, ?string $descricao,$descricao, string
$status): bool
{
$sql ="update tarefas set titulo =?, descricao =?, status=? where id=?";



$sql = "UPDATE tarefas SET titulo = ?, descricao = ?, status = ? WHERE id =?";
$stmt = db ()-> prepare($sql);
return $stmt->execute ([$titulo, $descricao, $status, $id]);
}
function excluir_tarefa(int $id):
{
    $sql = "DELETE FROM tarefas WHERE id =?";
    $stmt = db()->prepare($sql);
    return $stmt->execute([$id]);
}

?>