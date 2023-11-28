
<?php
    error_reporting(E_ALL);
    ini_set('display_errors',1);
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "financas";
    
    $conn = new mysqli($servername, $username, $password, $dbname);

    
    if ($conn->connect_error) {
    die("Erro de conexao: " . $conn->connect_error);
    }
    echo "";

    function autenticar_usuario($conn,$email,$senha){
        $sql = "SELECT id_usuario from usuarios where email = '$email' and senha = '$senha' ;";

        $resultado = $conn->query($sql);
        
        if ($resultado->num_rows > 0) {
            header("Location: index.php");
            die();
        } else {
            echo ("<script>alert('Usuário não cadastrado!')</script>");
        }
        $conn->close();
    }
    

?> 

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <title>Cadastre</title>
    <style>
        body{
            background-color:#fff;
        }
        #formulario,#formulario2,#formulario3{
            text-align: Center;  
            
        }
        #botaoCadastrar{
            background-color: green ;
            color: white;
            

        }
        h3{
            font-size:50px;
            color: black;
            background-color:#fff;
            text-align: Center;
            border-top: 30px solid #fff
            

        }

        #botaoAtualizar{
            background-color: BlueViolet ;
            color: white; 
            margin-left: auto;
            margin-right: auto;
            display: block;

           
        }

        #botaoExcluirLancamento{
            background-color: red ;
            color: white; 
            margin-left: auto;
            margin-right: auto;
            display: block;
           
        }

        a{
            text-decoration: none;

        }
    </style>


</head>
<body>
    <h3>Login</h3><br><br>
    <form action="" method="post" name="formulario" id="formulario" >

      
        <label for="email">E-mail:</label>
        <input id="email" name="email" type="email"><br><br>

        <label for="senha">Senha:</label>
        <input id="senha" name="senha" type="password"><br><br>

        <button type="submit" class="btn btn-success">Cadastrar</button>

        
    </form>
    
        
    

</body>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $email = vazio_input($_POST["email"]);
        $senha = vazio_input($_POST["senha"]);

        autenticar_usuario($conn,$email,$senha);
    
    }

    function vazio_input($data) {
            
        if(empty($data)){
            echo("<script>alert('É necessário preencher todos os campos!')</script>");
        }
        return $data;
    }
    
?>
</html>