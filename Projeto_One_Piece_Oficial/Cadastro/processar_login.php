<?php
// Conecte-se ao banco de dados (ajuste as configurações conforme necessário)
$mysqli = new mysqli("127.0.0.1", "root", "", "one_piece");

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

// Gere um salt seguro (pode usar a função random_bytes ou openssl_random_pseudo_bytes)
$salt = bin2hex(random_bytes(16));

// Combine a senha com o salt e crie um hash Bcrypt
$senhaCriptografada = password_hash($password . $salt, PASSWORD_BCRYPT);

// Insira os dados no banco de dados
$sql = "INSERT INTO usuarios (username, email, birthdate, senha_cripto, salt) VALUES (?, ?, ?, ?, ?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("sssss", $username, $email, $birthdate, $senhaCriptografada, $salt);

if ($stmt->execute()) {
    header("Location: ../Login_One_Piece/Login_One_Piece.html");
} else {
    echo "Erro ao realizar o cadastro: " . $stmt->error;
}

// Feche a conexão
$stmt->close();
$mysqli->close();
?>