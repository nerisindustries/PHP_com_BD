4.2 Pontos de estudo(
• O que charset=utf8mb4?
• O que muda com PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION?
1-Bom basicamente, ele serve para o SQL entender caracteres reecentes como por exemplo emojis e etc,
sem ele caso um usario comente um emoji em um site por exemplo que não contem o  charset=utf8mb4
mas sim a versão mais antiga, ele reportará um erro!

2-De froma simples ele serve para te alertar que ouve um erro no banco de dados, ja que sem ele, o php
percebe o erro mas "gaurda para ele", fica calado e por isso você teria que verificar manualmente
se houve um erro.

)

5.2 Exercícios de fixação (PDO)
• Identificar quais funções usam query() e quais usam prepare().
• Explicar por que prepare() é obrigatório quando há entrada do usuário.
1-

query:
_function listar_tarefas(): array_
{
$sql = "SELECT * FROM tarefas ORDER BY id DESC";
return db()->query($sql)->fetchAll();
}




prepare:
_function criar_tarefa(string $titulo, ?string $descricao, string $status): int_
{
$sql = "INSERT INTO tarefas (titulo, descricao, status) VALUES (?, ?, ?)";
$stmt = db()->prepare($sql);
$stmt->execute([$titulo, $descricao, $status]);
return (int) db()->lastInsertId();
}

_function buscar_tarefa(int $id): ?array_
{
$sql = "SELECT * FROM tarefas WHERE id = ?";
$stmt = db()->prepare($sql);
$stmt->execute([$id]);
$row = $stmt->fetch();
return $row ?: null;
}

_function atualizar_tarefa(int $id, string $titulo, ?string $descricao, string_
$status): bool
{
$sql = "UPDATE tarefas SET titulo = ?, descricao = ?, status = ? WHERE id
= ?";
$stmt = db()->prepare($sql);
return $stmt->execute([$titulo, $descricao, $status, $id]);
}

_function excluir_tarefa(int $id)_
{
$sql = "DELETE FROM tarefas WHERE id = ?";
$stmt = db()->prepare($sql);
return $stmt->execute([$id]);
}


2-O 'prepare' é obrigatório para evitar sql injection, pois, ele separa o código sql das informações
providas do usuário assim evitando a injeção de dados maliciosos
