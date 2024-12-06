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
    $id_materia = $_POST['id_materia'];
    $id_professor = $_POST['id_professor'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fim = $_POST['hora_fim'];

    // Inserir os dados no banco
    $sql = "INSERT INTO tb_horarios (id_materia, id_professor, hora_inicio, hora_fim) 
            VALUES ('$id_materia', '$id_professor', '$hora_inicio', '$hora_fim')";

    if ($conn->query($sql) === TRUE) {
        echo "Novo horário cadastrado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

// Buscar matérias e professores para exibir no formulário
$materias_result = $conn->query("SELECT id_materia, nome_materia FROM tb_materias");
$professores_result = $conn->query("SELECT id_professores, nome_professores FROM tb_professores");

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Horários</title>
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

        input[type="time"], select {
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
        <h2>Cadastro de Horários</h2>
        <form method="post">
            <label for="id_materia">Matéria</label>
            <select id="id_materia" name="id_materia" required>
                <option value="">Selecione uma matéria</option>
                <?php while ($materia = $materias_result->fetch_assoc()): ?>
                    <option value="<?= $materia['id_materia'] ?>"><?= $materia['nome_materia'] ?></option>
                <?php endwhile; ?>
            </select>

            <label for="id_professor">Professor</label>
            <select id="id_professor" name="id_professor" required>
                <option value="">Selecione um professor</option>
                <?php while ($professor = $professores_result->fetch_assoc()): ?>
                    <option value="<?= $professor['id_professores'] ?>"><?= $professor['nome_professores'] ?></option>
                <?php endwhile; ?>
            </select>

            <label for="hora_inicio">Hora de Início</label>
            <input type="time" id="hora_inicio" name="hora_inicio" required>

            <label for="hora_fim">Hora de Fim</label>
            <input type="time" id="hora_fim" name="hora_fim" required>

            <button type="submit">Cadastrar</button>
        </form>
    </div>

</body>
</html>
