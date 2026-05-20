<?php
// views/create.php
require_once __DIR__ . '/../src/repository.php';
$erros = [];
$titulo = '';
$descricao = '';
$status = 'pendente';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $status = $_POST['status'] ?? 'pendente';
    
    // Validações do formulário (Exercício 8.2 corrigido aqui)
    if ($titulo === '') {
        $erros[] = "Título é obrigatório.";
    } elseif (strlen($titulo) < 3) {
        $erros[] = "O título deve ter pelo menos 3 caracteres.";
    }
    
    if (!in_array($status, ['pendente','feito'], true)) {
        $erros[] = "Status inválido.";
    }
    
    if (!$erros) {
        criar_tarefa($titulo, $descricao !== '' ? $descricao : null, $status);
        header("Location: ?acao=list");
        exit;
    }
}
?>
<a class="btn" href="?acao=list">• Voltar</a>
<h2>Nova tarefa</h2>

<?php if ($erros): ?>
<ul style="color:#a00;">
<?php foreach ($erros as $e): ?>
<li><?= htmlspecialchars($e) ?></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>

<form method="post">
<p>
<label>Título<br>
<!-- Adicionado minlength="3" para validação nativa no navegador -->
<input name="titulo" value="<?= htmlspecialchars($titulo) ?>"
minlength="3" maxlength="120" style="width:100%;" required>
</label>
</p>
<p>
<label>Descrição<br>
<textarea name="descricao" rows="4" style="width:100%;"><?= htmlspecialchars($descricao) ?></textarea>
</label>
</p>
<p>
<label>Status<br>
<select name="status">
<option value="pendente" <?= $status === 'pendente' ? 'selected' : '' ?>>pendente</option>
<option value="feito" <?= $status === 'feito' ? 'selected' : '' ?>>feito</option>
</select>
</label>
</p>
<button class="btn" type="submit">Salvar</button>
</form>
