<?php
// views/list.php
require_once __DIR__ . '/../src/repository.php';

// Captura o status vindo da URL (ex: ?acao=list&status=pendente)
$status_filtro = $_GET['status'] ?? null;

// Passa o status capturado para a função listar_tarefas que atualizamos
$tarefas = listar_tarefas($status_filtro);
?>
<div class="row" style="margin-bottom: 20px; display: flex; gap: 10px; flex-wrap: wrap;">
    <a class="btn" href="?acao=create">+ Nova tarefa</a>
    
    <!-- Botões para controlar o filtro por status -->
    <a class="btn" href="?acao=list" style="background-color: #6c757d; color: white; text-decoration: none;">Todas</a>
    <a class="btn" href="?acao=list&status=pendente" style="background-color: #f0ad4e; color: white; text-decoration: none;">Pendentes</a>
    <a class="btn" href="?acao=list&status=feito" style="background-color: #5cb85c; color: white; text-decoration: none;">Feitas</a>
</div>

<table>
<thead>
<tr>
<th>ID</th>
<th>Título</th>
<th>Status</th>
<th>Criado em</th>
<th>Ações</th>
</tr>
</thead>
<tbody>
<?php foreach ($tarefas as $t): ?>
<tr>
<td><?= (int)$t['id'] ?></td>
<td><?= htmlspecialchars($t['titulo']) ?></td>
<td><span class="badge"><?= htmlspecialchars($t['status']) ?></span></td>
<td><?= htmlspecialchars($t['criado_em']) ?></td>
<td class="row">
<a class="btn" href="?acao=edit&id=<?= (int)$t['id'] ?>">Editar</a>
<form method="post" action="?acao=delete" onsubmit="return confirm('Excluir esta tarefa?');">
<input type="hidden" name="id" value="<?= (int)$t['id'] ?>">
<button class="btn btn-danger" type="submit">Excluir</button>
</form>
</td>
</tr>
<?php endforeach; ?>
<?php if (count($tarefas) === 0): ?>
<tr><td colspan="5">Nenhuma tarefa cadastrada.</td></tr>
<?php endif; ?>
</tbody>
</table>
