<?php
// Conecte-se ao banco de dados (ajuste as configurações conforme necessário)
$mysqli = new mysqli("127.0.0.1", "root", "", "one_piece");

// Verifique a conexão
if ($mysqli->connect_error) {
    die("Erro na conexão com o banco de dados: " . $mysqli->connect_error);
}

// Obtenha os dados do formulário
$resposta = $_POST['resposta'];

// Insira os dados no banco de dados
$sql = "INSERT INTO episodios (resposta) VALUES (?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $resposta);

ini_set('SMTP', 'localhost');
ini_set('smtp_port', '25');

// Valide os dados (exemplo simples)
if (empty($resposta)) {
    echo "Por favor, preencha a resposta.";
} else {
    $email = 'gabriel.cipriano@unesp.br';
    // Crie uma mensagem de e-mail
    $to = $email; // Substitua com o e-mail do destinatário
    $subject = 'Resposta Recebida!!';
    $message = "Você respondeu: $resposta" . "\r\n" . "Lembre-se deste episódio e revisite o site quando alcançar novos episódios para conhecer novas aventuras!";
    $headers = 'From: gabriel.cipriano@unesp.br' . "\r\n" .
        'Reply-To: mg.celestino@unesp.br';

    if (mail($to, $subject, $message, $headers)) {
        echo "Sua resposta foi enviada com sucesso.";
    } else {
        echo "Houve um problema ao enviar o e-mail. Por favor, tente novamente mais tarde.";
    }
}
if ($stmt->execute()) {
    header("Location: ../Projeto_configs/configuracoes.html");
} else {
    echo "Erro ao realizar o cadastro: " . $stmt->error;
}
 Feche a conexão
$stmt->close();
$mysqli->close();
?>