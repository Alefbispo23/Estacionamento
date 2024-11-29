<h1>Estacionamento</h1>
<?php
session_start(); // Inicia a sessão para manter os dados entre as requisições

// Inicializar a lista de veículos, caso ainda não exista
if (!isset($_SESSION['veiculos'])) {
    $_SESSION['veiculos'] = [];
}

// Adicionar alguns veículos de exemplo na sessão para simular dados
if (empty($_SESSION['veiculos'])) {
   
}

// Variáveis para mensagens
$erro = '';
$sucesso_saida = '';

// Verificar se o formulário de saída foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['placa_saida'])) {
    $placa_saida = htmlspecialchars($_POST['placa_saida']);
    
    // Validar se a placa foi preenchida
    if (empty($placa_saida)) {
        $erro = "Por favor, informe a placa do veículo para saída.";
    } else {
        // Buscar o veículo pela placa e registrar a saída
        $veiculo_encontrado = false;
        foreach ($_SESSION['veiculos'] as &$veiculo) {
            if ($veiculo['placa'] == $placa_saida && $veiculo['hora_saida'] === null) {
                $veiculo['hora_saida'] = date("H:i:s"); // Registra a hora de saída
                $sucesso_saida = "Veículo $placa_saida saiu do estacionamento às " . $veiculo['hora_saida'];
                $veiculo_encontrado = true;
                break;
            }
        }

        if (!$veiculo_encontrado) {
            $erro = "Veículo com a placa $placa_saida não encontrado ou já registrou saída.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Saída de Veículos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 450px;
        }
        h2 {
            margin-bottom: 20px;
        }
        input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        .erro {
            color: red;
            font-size: 14px;
        }
        .sucesso {
            color: green;
            font-size: 14px;
        }
        .veiculos-lista {
            margin-top: 20px;
            text-align: left;
        }
        .veiculos-lista table {
            width: 100%;
            border-collapse: collapse;
        }
        .veiculos-lista th, .veiculos-lista td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .veiculos-lista th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Registrar Saída de Veículo</h2>

    <!-- Exibir mensagens de erro ou sucesso -->
    <?php if (isset($erro)): ?>
        <p class="erro"><?php echo $erro; ?></p>
    <?php elseif (isset($sucesso_saida)): ?>
        <p class="sucesso"><?php echo $sucesso_saida; ?></p>
    <?php endif; ?>

    <!-- Formulário de saída -->
    <form method="POST">
        <label for="placa_saida">Placa do veículo para saída:</label>
        <input type="text" id="placa_saida" name="placa_saida" placeholder="Digite a placa do veículo" required>
        
        <input type="submit" value="Registrar Saída">
    </form>

    <!-- Exibir a lista de veículos com as horas de saída -->
    <div class="veiculos-lista">
        <h3>Veículos com Hora de Saída</h3>
        <?php if (isset($_SESSION['veiculos']) && count($_SESSION['veiculos']) > 0): ?>
            <table>
                <tr>
                    <th>Modelo</th>
                    <th>Hora de Saída</th>
                </tr>
                <?php foreach ($_SESSION['veiculos'] as $veiculo): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($veiculo['modelo']); ?></td>
                        <td><?php echo $veiculo['hora_saida'] ? $veiculo['hora_saida'] : 'Ainda no estacionamento'; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>Não há veículos registrados no estacionamento.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
