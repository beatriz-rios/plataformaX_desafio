<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exclusão</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <h1>Exclusão</h1>
     <nav>
    <ul>
        <li><a href="http://localhost/aula_PHP/desafioRaynner/menu.php">Menu</a></li>
        <li><a href="http://localhost/aula_PHP/desafioRaynner/inclusao.php">Inclusão</a></li>
        <li><a href="http://localhost/aula_PHP/desafioRaynner/login.php">Login</a></li>
        <li><a href="http://localhost/aula_PHP/desafioRaynner/alteracao.php">Alteração</a></li>
        <li><a href="http://localhost/aula_PHP/desafioRaynner/consulta.php">Consulta</a></li>

    </ul>
</nav>

  <form method="post" enctype="multipart/form-data">
    Digite o número do ID da movimentação que deseja excluir:
    <br><br>
    <input type="number" name="idcli" placeholder="ID da movimentação" required>
    <br><br>
    <input type="submit" value="Excluir">
  </form>

  <?php 
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $idcli= $_POST["idcli"];

      $servername = "localhost";
      $database = "bancox";
      $username = "root";
      $password = "";

      $conn = mysqli_connect($servername, $username, $password, $database);

      if (!$conn) {
          echo "<div class='message error'>Falha na conexão: " . mysqli_connect_error() . "</div>";
          exit;
      }

      echo "<div class='message'>Conectado com sucesso.</div>";

$sql_select_user = "SELECT nomeparaUsuario FROM usuario WHERE idusuario = '$idcli'";
$resultado = mysqli_query($conn, $sql_select_user);
$linha = mysqli_fetch_assoc($resultado);

if ($linha) {
    $nome_banco_excluir = $linha['nomeparaUsuario'];
    
    // 2. Excluir o usuário do banco de dados (DROP USER)
    $sql_drop = "DROP USER IF EXISTS '{$nome_banco_excluir}'@'localhost'";
    
    if (mysqli_query($conn, $sql_drop)) {
        echo "<div class='message success'>Usuário do banco **'{$nome_banco_excluir}'** excluído com sucesso.</div>";
    } else {
        echo "<div class='message error'>Erro ao excluir usuário do banco: " . mysqli_error($conn) . "</div>";
    }

} else {
    echo "<div class='message error'>Usuário não encontrado na aplicação.</div>";
}


      $sql = "DELETE FROM usuario WHERE idusuario = '$idcli'";

      if (mysqli_query($conn, $sql)) {
          echo "<div class='message success'>Comando executado com sucesso.</div>";
      } else {
          echo "<div class='message error'>Erro: " . mysqli_error($conn) . "</div>";
      }

      mysqli_close($conn);
  }
  ?>
</body>
</html>

</body>
</html>