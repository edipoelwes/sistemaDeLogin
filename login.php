<?php 
session_start();

if(isset($_SESSION['email']) && !empty($_SESSION['email'])){
    $email = addslashes($_POST['email']);
    $senha = md5(addslashes($_POST['senha']));

    $dsn = "mysql:dbname=teste;host=localhost";
    $dbuser= "root";
    $dbpass = "";

    try{
        $db = new PDO( $dsn,  $dbuser, $dbpass);

        $sql = $db->query("SELECT * FROM usuarios WHERE email= '$email' AND senha= '$senha'");

        
        if($sql->rowCount() > 0){
            $dado = $sql->fetch();

            $_SESSION['id'] = $dado['id'];

            header("Location: index.php");
        }
    }catch(PDOException $e){
        echo "Falhou: ".$e->getMessage();
    }
}
?>

pagina de login
<br><br>
<form method="POST">
    E-mail: <br>
    <input type="email" name="email"/>
    <br><br>
    Senha: <br>
    <input type="password" name="senha"/>
    <br><br>
    <input type="submit" value="Entrar"/>
</form>
