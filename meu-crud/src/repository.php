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










?>