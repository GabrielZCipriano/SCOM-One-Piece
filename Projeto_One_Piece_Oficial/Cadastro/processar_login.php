<?php
// Conecte-se ao banco de dados (ajuste as configurações conforme necessário)
$mysqli = new mysqli("127.0.0.1", "root", "", "cadastro_login_op");

// Verifique a conexão
if ($mysqli->connect_error) {
    die("Erro na conexão com o banco de dados: " . $mysqli->connect_error);
}


// Obtenha os dados do formulário
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$birthdate = $_POST['birthdate'];

// Insira os dados no banco de dados
$sql = "INSERT INTO cadastro (username, email, password, confirm_password, birthdate) VALUES (?, ?, ?, ?, ?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("sssss", $username, $email, $password, $confirm_password, $birthdate);

if ($stmt->execute()) {
    header("Location: ../Login_One_Piece/Login_One_Piece.html");
} else {
    echo "Erro ao realizar o cadastro: " . $stmt->error;
}

// Feche a conexão
$stmt->close();
$mysqli->close();
?>