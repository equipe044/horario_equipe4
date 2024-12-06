<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "escola_horarios";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber os dados do formulário
    $nome_materia = $_POST['nome_materia'];
    $id_professor = $_POST['id_professor'];

    // Inserir os dados no banco
    $sql = "INSERT INTO tb_materias (nome_materia, id_professor) 
            VALUES ('$nome_materia', '$id_professor')";

    if ($conn->query($sql) === TRUE) {
        echo "Nova matéria cadastrada com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

$professores_result = $conn->query("SELECT id_professores, nome_professores FROM tb_professores");

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Matérias</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }

        .container {
            width: 400px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            color: #555;
        }

        input[type="text"], select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        .message {
            color: green;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Cadastro de Matérias</h2>
        <form method="post">
            <label for="nome_materia">Nome da Matéria</label>
            <input type="text" id="nome_materia" name="nome_materia" required>

            <label for="id_professor">Professor</label>
            <select id="id_professor" name="id_professor" required>
                <option value="">Selecione um professor</option>
                <?php while ($professor = $professores_result->fetch_assoc()): ?>
                    <option value="<?= $professor['id_professores'] ?>"><?= $professor['nome_professores'] ?></option>
                <?php endwhile; ?>
            </select>

            <button type="submit">Cadastrar</button>
        </form>
    </div>

</body>
</html>
