<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "escola_horarios";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se houve erro de conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consultar os dados de tb_horarios, tb_materias e tb_professores
$sql = "SELECT h.id, m.nome_materia, p.nome_professores, h.hora_inicio, h.hora_fim
        FROM tb_horarios h
        JOIN tb_materias m ON h.id_materia = m.id_materia
        JOIN tb_professores p ON h.id_professor = p.id_professores
        ORDER BY h.id DESC";

$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela de Horários</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }

        .container {
            width: 80%;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        td {
            background-color: #fff;
        }

        .action-links {
            text-align: center;
        }

        .btn {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 0 5px;
        }

        .btn:hover {
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
        <h2>Tabela de Horários</h2>

        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Matéria</th>
                        <th>Professor</th>
                        <th>Hora Início</th>
                        <th>Hora Fim</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['nome_materia'] ?></td>
                            <td><?= $row['nome_professores'] ?></td>
                            <td><?= $row['hora_inicio'] ?></td>
                            <td><?= $row['hora_fim'] ?></td>
                            <td class="action-links">
                                <a href="editar_horario.php?id=<?= $row['id'] ?>" class="btn">Editar</a>
                                <a href="excluir_horario.php?id=<?= $row['id'] ?>" class="btn">Excluir</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="message">Não há horários cadastrados.</p>
        <?php endif; ?>
    </div>

</body>
</html>
