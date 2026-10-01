<?php
$nome = $_POST['nome'];
$total = (float) $_POST['total'];
$idade = (int) $_POST['idade'];
$fidelidade = isset($_POST['fidelidade']);

if ($idade >= 70) {
    $descontoIdade = 7;
} elseif ($idade >= 51) {
    $descontoIdade = 5;
} else {
    $descontoIdade = 0;
}

$descontoFidelidade = $fidelidade ? 5 : 0;
$descontoTotal = $descontoIdade + $descontoFidelidade;

$valorDesconto = $total * ($descontoTotal / 100);
$valorFinal = $total - $valorDesconto;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado do Pedido</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="container">
        <h1>Resultado do Pedido</h1>
        <div class="resultado">
            <p>Cliente: <?= htmlspecialchars($nome) ?></p>
            <p>Idade: <?= $idade ?> anos</p>
            <p>Total do pedido: R$ <?= number_format($total, 2, ',', '.') ?></p>
            <p>Desconto por idade: <?= $descontoIdade ?>%</p>
            <p>Desconto cartão fidelidade: <?= $descontoFidelidade ?>%</p>
            <p>Desconto total: <?= $descontoTotal ?>% (R$ <?= number_format($valorDesconto, 2, ',', '.') ?>)</p>
            <p class="destaque">Valor a pagar: R$ <?= number_format($valorFinal, 2, ',', '.') ?></p>
        </div>

        <h2>Parcelamento (com for)</h2>
        <ul class="lista">
            <?php for ($i = 1; $i <= 6; $i++) { ?>
                <li><?= $i ?>x de R$ <?= number_format($valorFinal / $i, 2, ',', '.') ?></li>
            <?php } ?>
        </ul>

        <h2>Parcelamento (com while)</h2>
        <ul class="lista">
            <?php
            $parcela = 1;
            while ($parcela <= 6) {
            ?>
                <li><?= $parcela ?>x de R$ <?= number_format($valorFinal / $parcela, 2, ',', '.') ?></li>
            <?php
                $parcela++;
            }
            ?>
        </ul>

        <a class="voltar" href="index.html">Fazer novo cálculo</a>
    </div>
</body>
</html>