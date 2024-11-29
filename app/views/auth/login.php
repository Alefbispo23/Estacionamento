<?php
// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber e limpar os dados do formulário
    $modelo = htmlspecialchars($_POST['modelo']);
    $placa = htmlspecialchars($_POST['placa']);
    
    // Validar se os campos foram preenchidos
    if (empty($modelo) || empty($placa)) {
        $erro = "Por favor, preencha todos os campos.";
    } else {
        // Se não houver erro, pode-se realizar algum processamento, como salvar em banco de dados ou log
        $sucesso = "Veículo $modelo com placa $placa registrado para entrada no estacionamento!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrada no Estacionamento</title>
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
            width: 300px;
            text-align: center;
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
    </style>
</head>
<body>

<div class="container">
    <h2>Entrada no Estacionamento</h2>
    
    <!-- Exibir mensagens de erro ou sucesso -->
    <?php if (isset($erro)): ?>
        <p class="erro"><?php echo $erro; ?></p>
    <?php elseif (isset($sucesso)): ?>
        <p class="sucesso"><?php echo $sucesso; ?></p>
    <?php endif; ?>

    <!-- Formulário -->
    <form method="post" action="">
        <label for="modelo">Modelo do veículo:</label>
        <input type="text" id="modelo" name="modelo" placeholder="Digite o modelo do veículo" value="<?php echo isset($modelo) ? $modelo : ''; ?>" required>
        
        <label for="placa">Placa do veículo:</label>
        <input type="text" id="placa" name="placa" placeholder="Digite a placa do veículo" value="<?php echo isset($placa) ? $placa : ''; ?>" required>
        
        <input type="submit" value="Registrar Entrada">
    </form>
</div>

</body>
</html>
