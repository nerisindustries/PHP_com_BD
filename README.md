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


7.2-

a-Devemos usálo em variaveis vindo do banco de dads, pois ele funciona da seguinte forma, após receber os dados vindo dos bancos ,ele "cifra" os dados vindos do bancos, assim se um usário com más intenções digitando por exemplo um comando que eu pesquisei pra entender,<script>alert('hackeado')</script>, este comando faz com que quando um usuário comum abra a página um pop-up com uma mensagem "hackeado" , ele cifra isso e impede que o sistema reconheça isso como comando e o execute.


b-Para que cliques indesejados  no botão, possam ocasionar a exclusão do banco todo sem querer,que alterções no servidor por exemplo devm ser post segundo a semantica do HTTP e é mais seguro, contra por exemplo:proteção contra CSRF que de forma resumida é um meio de um hacker enviar um botão de exclusão para os usuários.

8.2
A-Basicamente um null é algo que nem se quer foi criado ou um formulario onde o usuário não preencheu um campo e o sistema não sabe ao certo se ele existe ou não, já a string é aapenas uma "pasta existente, porém sem arquivos",ou seja o usuário interagiu com o campo, mas não digitou nada ou apagou!

Explicações SQL

1-A primary key é uma chave primária responsáve por ser identidade unica de cada registro na tabela.
2-Auto_Incrment é basicamente um automatizador de contagem, basicamente ele sozinho numera um id sempre que uma tarefa é criada.
3-Enum é uma lista fecha de oções, então ela não permite qualquer texto,mas só as opções que ela determinou.