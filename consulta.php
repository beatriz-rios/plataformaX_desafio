<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Financeiro</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <h1>Consulta</h1>
    <nav>
    <ul> 
        <li><a href="http://localhost/aula_PHP/desafioRaynner/menu.php">Menu</a></li>
        <li><a href="http://localhost/aula_PHP/desafioRaynner/inclusao.php">Inclusão</a></li>
        <li><a href="http://localhost/aula_PHP/desafioRaynner/alteracao.php">Alteração</a></li>
        <li><a href="http://localhost/aula_PHP/desafioRaynner/exlcusao.php">Exclusão</a></li>

    </ul>
</nav>


<?php

 $servername = "localhost";
 $database = "bancox";
 $username = "root";
$password = "";

$conn = mysqli_connect($servername, $username,$password,$database);

$sql = "SELECT * FROM usuario";
$resultado = mysqli_query($conn,$sql) or die("Erro ao retornar dados");



//$registros = mysqli_fetch_assoc($resultado);

echo'<style>
     #tabela{  
 border: 5px solid white;
 background-color: rgba(105, 231, 189, 1);
 color: rgba(85, 222, 199, 1);
 width: 100%;
 border-radius: 5px;

 }
 td, th{
 border: 2px solid rgba(51, 201, 156, 1);
 
 }
 </style>';


echo"<table border='3' cellpadding='8' cellspacing='0'>";
        echo'<tr>';
        echo'<th> idusuario</td>';
        echo'<th> Nome </td>';
        echo'<th> CPF </td>';
        echo'<th> E-mail </td>';
        echo'<th> Telefone </td>';
        echo'<th> Nome p/ Usuário </td>';
        echo'<th> Senha p/ Usuário</td>';
        echo'<th> Senha </td>';
        echo'</tr>';

while($linha = mysqli_fetch_assoc($resultado)){
   
    
    echo'<td>' . $linha['idusuario'] . '</td>';
    echo'<td>' . $linha['nome'] .'</td>';
    echo'<td>' . $linha['cpf'] .'</td>';
    echo'<td>' . $linha['email'] .'</td>';
    echo'<td>' . $linha['telefone'] .'</td>';
    echo'<td>' . $linha['nomeparaUsuario'] .'</td>';
    echo'<td>' . $linha['senhaparaUsuario'] .'</td>';
    echo'<td>' . $linha['senha'] .'</td></tr>';
    

}

  
if(mysqli_query($conn, $sql)){
    echo"<br>";
}else{
    echo"Error: " . $sql . "<br>" . mysqli_error($conn);


  echo'</table>';  

mysqli_close($conn);
}


?>
</body>
</html>
