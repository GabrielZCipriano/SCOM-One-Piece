<?php
session_start();
// Verifique se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conecte-se ao banco de dados (ajuste as configurações conforme necessário)
    $mysqli = new mysqli("127.0.0.1", "root", "", "one_piece");

    // Verifique a conexão
    if ($mysqli->connect_error) {
        die("Erro na conexão com o banco de dados: " . $mysqli->connect_error);
    }

    // Obtenha os dados do formulário
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta SQL para verificar as credenciais
    $sql = "SELECT senha_cripto, salt FROM usuarios WHERE username = '$username'";
    $result = $mysqli->query($sql);


    // Verificação bem-sucedida, configure uma variável de sessão se o usuário for "admin" e a senha for "1080"
    if ($username === "Kaido" && $password === "4.611.100.000") {
        $_SESSION['senha'] = $password;
        $_SESSION['usuario'] = $username;
        header("Location: ../Selecao_Navios/Selecao_Navio.php");
    } elseif ($username === "Big Mom" && $password === "4.388.000.000") {
        $_SESSION['senha'] = $password;
        $_SESSION['usuario'] = $username;
        header("Location: ../Selecao_Navios/Selecao_Navios.php");
    }

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashArmazenado = $row['senha_cripto'];
        $salt = $row['salt'];

         // Verifique se a correspondência foi encontrada
        if (password_verify($password . $salt, $hashArmazenado)) {

            // Redirecione para o site desejado
            header("Location: ../Selecao_Navios/Selecao_Navios.php");
            exit;

        } else {
            // Senha incorreta
            echo "Senha incorreta. Tente novamente.";
        }
    } else {
        // Usuário não encontrado
        echo "Usuário incorreto. Tente novamente.";
    }

    // Feche a conexão
    $mysqli->close();
}
?>