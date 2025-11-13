<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<h1>Cadastro</h1>
<nav>
    <ul>
        
        <li><a href="http://localhost/aula_PHP/desafioRaynner/menu.php">Menu</a></li>
        <li><a href="http://localhost/aula_PHP/desafioRaynner/login.php">Login</a></li>
        <li><a href="http://localhost/aula_PHP/desafioRaynner/alteracao.php">Alteração</a></li>
        <li><a href="http://localhost/aula_PHP/desafioRaynner/exlcusao.php">Exclusão</a></li>
        <li><a href="http://localhost/aula_PHP/desafioRaynner/consulta.php">Consulta</a></li>

    </ul>
</nav>
    
    <form method="post" enctype="multipart/form-data">
    <div>
    <div>
        <label for="nome">Nome:</label><br>
        <input type="text" name="nome" placeholder="Digite seu nome completo">
    </div>
    <div>

    <label for="cpf">CPF:</label><br>
    <input type="number" name="cpf" placeholder="Digite seu CPF">
    </div>

    <div>
        <label for="email">E-mail:</label><br>
        <input type="email" name="email" placeholder="Digite seu E-mail">
    </div>

    <div>
        <label for="telefone">Telefone:</label>
        <input type="number" name="phone" placeholder="Digite seu telefone">
    </div> 

    <div>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" placeholder="Digite sua senha">
    </div>

    <input type="submit" VALUE="Cadastrar">

    </div>
    </form>

     <?php 

    if($_SERVER["REQUEST_METHOD"] == "POST"){
       
       $nome = $_POST["nome"];
       $cpf = $_POST["cpf"];
       $email = $_POST["email"];
       $phone = $_POST["phone"];
       $senha = $_POST["senha"];
  
        


        $servername = "localhost";
        $database = "bancox";
        $username = "root";
        $password = "";


 //Remove espaços em branco do nome para embaralhar apenas os caracteres
        $nomeSemEspacos = str_replace('', '', $nome);

       // 2. Embaralha a string para 'nomeBanco_usu'
        $nomeBanco_usu = str_shuffle($nomeSemEspacos);

       // 3. Embaralha novamente para 'senhaBanco_usu'
        $senhaBanco_usu = str_shuffle($nomeSemEspacos);


        $conn = mysqli_connect($servername, $username,$password,$database);

        if(!$conn){
            echo "<div class='mensagem erro'>Falha na conexão: " . mysqli_connect_error() . "</div>";
            die();
        }
        
        $sql = " INSERT INTO usuario (
            nome,
            cpf,
            email,
            telefone,
            nomeparaUsuario,
            senhaparaUsuario,
            senha
            )VALUE(
            '$nome',
            '$cpf',
            '$email',
            '$phone',
            '$nomeBanco_usu',
            '$senhaBanco_usu',
            '$senha'
            
            
        )";


// Comando SQL para CRIAR o usuário no servidor MySQL (usuário do banco)
$sql_create_user = "CREATE USER '{$nomeBanco_usu}'@'localhost' IDENTIFIED BY '{$senhaBanco_usu}'";

//  Comando SQL para CONCEDER privilégios ao novo usuário do banco
// SELECT para que ele consiga consultar os dados
$sql_grant = "GRANT SELECT, INSERT, UPDATE, DELETE ON bancox.usuario TO '{$nomeBanco_usu}'@'localhost'";


$sucesso = true;

//  Executa o INSERT na tabela da aplicação 
if (mysqli_query($conn, $sql)) {
    echo"<br>Usuário da aplicação cadastrado com sucesso.";
} else {
    echo"<br>Error ao cadastrar usuário da aplicação: " . mysqli_error($conn);
    $sucesso = false;
}

// Executa CREATE USER se o INSERT foi bem-sucedido
if ($sucesso && mysqli_query($conn, $sql_create_user)) {
    echo"<br>Usuário do banco de dados **'{$nomeBanco_usu}'** criado com sucesso.";
} else if ($sucesso) {
    echo"<br>Error ao criar usuário do banco (pode já existir): " . mysqli_error($conn);
    $sucesso = false;
}

// Executa GRANT se o CREATE USER foi bem-sucedido
if ($sucesso && mysqli_query($conn, $sql_grant)) {
    echo"<br>Privilégios concedidos ao usuário do banco **'{$nomeBanco_usu}'**.";
} else if ($sucesso) {
    echo"<br>Error ao conceder privilégios: " . mysqli_error($conn);
}

mysqli_close($conn); 

 } 
    ?>
</body>
</html>