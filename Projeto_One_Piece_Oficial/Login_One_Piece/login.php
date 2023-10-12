<?php
// Verifique se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conecte-se ao banco de dados (ajuste as configurações conforme necessário)
    $mysqli = new mysqli("127.0.0.1", "root", "", "cadastro_login_op");

    // Verifique a conexão
    if ($mysqli->connect_error) {
        die("Erro na conexão com o banco de dados: " . $mysqli->connect_error);
    }

    // Obtenha os dados do formulário
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta SQL para verificar as credenciais
    $sql = "SELECT * FROM login WHERE username = ? AND password = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifique se a correspondência foi encontrada
    if ($result->num_rows > 0) {
        // Redirecione para o site desejado
        header("Location: ../Selecao_Navios/Selecao_Navios.html");
        exit;
    } else {
        // Exiba uma mensagem de erro ou recarregue a mesma página
        echo "Credenciais incorretas. Tente novamente.";
    }

    // Feche a conexão
    $stmt->close();
    $mysqli->close();
}
?>