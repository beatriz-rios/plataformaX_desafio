<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alteração</title>
   <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <h1>Alteração</h1>
        <nav>
    <ul>
        <li><a href="http://localhost/aula_PHP/desafioRaynner/menu.php">Menu</a></li>
        <li><a href="http://localhost/aula_PHP/desafioRaynner/inclusao.php">Inclusão</a></li>
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

    <div>
        <label for="id"></label>
        <input type="number" name="id" placeholder="Digite o ID">
    </div>

    <input type="submit" VALUE="Alterar">

    </div>

    </form>

     <?php 

    if($_SERVER["REQUEST_METHOD"] == "POST"){
       
       $nome = $_POST["nome"];
       $cpf = $_POST["cpf"];
       $email = $_POST["email"];
       $phone = $_POST["phone"];
       $senha = $_POST["senha"];
      $id = $_POST["id"];


        $servername = "localhost";
        $database = "bancox";
        $username = "root";
        $password = "";


 //Remove espaços em branco do nome para embaralhar apenas os caracteres
        $nomeSemEspacos = str_replace(' ', '', $nome);

       // 2. Embaralha a string para 'nomeBanco_usu'
        $nomeBanco_usu = str_shuffle($nomeSemEspacos);

       // 3. Embaralha novamente para 'senhaBanco_usu'
        $senhaBanco_usu = str_shuffle($nomeSemEspacos);


        $conn = mysqli_connect($servername, $username,$password,$database);

        if(!$conn){
            echo "<div class='mensagem erro'>Falha na conexão: " . mysqli_connect_error() . "</div>";
            die();
        }
        
        $sql = " UPDATE usuario 
        SET
            nome ='$nome',
            cpf ='$cpf',
            email = '$email',
            telefone = '$phone',
            nomeparaUsuario = '$nomeBanco_usu',
            senhaparaUsuario = '$senhaBanco_usu',
            senha ='$senha'

         WHERE idusuario = '$id'";


   if(mysqli_query($conn, $sql)){
    echo"<br>Comando executado com sucesso";
}else{
    echo"Error: " . $sql . "<br>" . mysqli_error($conn);
}


 mysqli_close($conn);
  }
    ?>

</body>
</html>