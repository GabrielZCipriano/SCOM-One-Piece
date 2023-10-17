<?php
if (!isset($_SESSION)) {
    session_start();
}

// Inicialize as variáveis $showDiv1 e $showDiv2 com valores padrão (false)
$showDiv1 = false;
$showDiv2 = false;

// Verifique se o usuário está autenticado (usando o exemplo de nome de usuário)
if (isset($_SESSION['usuario']) && isset($_SESSION['senha'])) {
    if ($_SESSION['usuario'] === "Kaido" && $_SESSION['senha'] === "4.611.100.000") { 
        // Se o usuário é Kaido, adicione um card adicional
        $showDiv1 = true;
        $showDiv2 = false;
        
    } elseif ($_SESSION['usuario'] === "Big Mom" && $_SESSION['senha'] === "4.388.000.000") {
        // Se o usuário é Big Mom, adicione um card adicional
        $showDiv2 = true;
        $showDiv1 = false;
    } else {
        $showDiv2 = false;
        $showDiv1 = false;
    }
}
// Apagando todos os dados de uma sessão:
session_unset();
// Destruição da sessão:
session_destroy();
// Mostrando os dados da sessão destruída:
print_r($_SESSION);
?>