<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <h1>Login</h1>
<nav>
    <ul>
        <li><a href="http://localhost/aula_PHP/desafioRaynner/menu.php">Menu</a></li>
        <li><a href="http://localhost/aula_PHP/desafioRaynner/inclusao.php">Inclusão</a></li>
        <li><a href="http://localhost/aula_PHP/desafioRaynner/alteracao.php">Alteração</a></li>
        <li><a href="http://localhost/aula_PHP/desafioRaynner/exlcusao.php">Exclusão</a></li>
        <li><a href="http://localhost/aula_PHP/desafioRaynner/consulta.php">Consulta</a></li>

    </ul>
</nav>
    
    <form method="post" enctype="multipart/form-data">
    <div>
    <div>

    <div>
        <label for="email">E-mail:</label>
        <input type="email" name="email" placeholder="Digite seu E-mail" required>
    </div>

    <div>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" placeholder="Digite sua senha" required>
    </div>

    <input type="submit" VALUE="Cadastrar">

    </div>
    </form>
<?php
// Inicia a sessão para armazenar as credenciais do banco
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha_app = $_POST["senha"]; 

    $servername = "localhost";
    $database = "bancox";
     

    
    // validar o login, use o usuário 'root' (administrador)
    // para buscar as credenciais do usuário na tabela 'usuario'.
    $username_admin = "root";
    $password_admin = "";

    $conn_admin = mysqli_connect($servername, $username_admin, $password_admin, $database);

    if (!$conn_admin) {
        die("Falha na conexão de administração: " . mysqli_connect_error());
    }

    // 1. Busca as credenciais do usuário E as credenciais do banco
    $sql_login = "SELECT nomeparaUsuario, senhaparaUsuario, senha FROM usuario WHERE email = '$email'";
    $resultado = mysqli_query($conn_admin, $sql_login);
    
    if ($linha = mysqli_fetch_assoc($resultado)) {
        
        // 2. Verifica a senha da aplicação (apenas se a linha foi encontrada)
        if ($linha['senha'] === $senha_app) { // Comparação simples, use password_verify em produção!
            
            // 3. Login bem-sucedido: Armazena as credenciais do banco na sessão
            $_SESSION['db_user'] = $linha['nomeparaUsuario'];
            $_SESSION['db_pass'] = $linha['senhaparaUsuario'];
            $_SESSION['logado'] = true;

            // Redireciona para o menu da aplicação
          
            header("Location: menu.php");
            echo(alert('foi logado com sucesso!'));
            exit();
        } else {
            echo "<p class='mensagem erro'>Senha da aplicação incorreta.</p>";
        }
    } else {
        echo "<p class='mensagem erro'>Usuário não encontrado.</p>";
    }
    
    mysqli_close($conn_admin);
}
?>
</body>
</html>