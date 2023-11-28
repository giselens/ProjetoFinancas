
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
    echo "Conectado com sucesso!!";


    function listar_lancamentos($conn) {
        $sql = "select * from lancamentos;";
       
        $resultado = $conn->query($sql);
    
        if ($resultado->num_rows > 0) {
          
            while($row = $resultado->fetch_assoc()) {
                echo "<br>Código de Lançamento:   " . $row["id_lancamento"]. " -   Descricao: " . $row["descricao"]. " -   Valor: " . $row["valor"]." -   Data de Venc.: " . $row["data_venc"]." -   Tipo: " . $row["id_tipo"]."<br>";
            
            }
        } else {
            $error = $conn->error;
            echo $error;
        }
    
        
    }  
   
    function Excluir_lancamento($conn,$id_lancamento) {

        $sql = "DELETE FROM lancamentos  WHERE id_lancamento = $id_lancamento;";
        $resultado = $conn->query($sql);
    
        if ($resultado) {
            echo ("<script>alert('Registro excluído!')</script>");
        } else {
            $error = $conn->error;
            echo $error;
        }
    
        $conn->close();
    }
?> 

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Lançamentos</title>
    <style>
        body{
            background-color:Cornsilk;
        }
        #formulario{
            text-align: Center;  
            
        }


        h3{
            font-size:40px;
            color: white;
            background-color:#FF8C00;
            text-align: Center;
            border-top: 30px solid #FF8C00
            

        }
        h2{
            color: black;
            text-align: Center;
         
        }

        #botaoExcluirLancamento{

            background-color: Red;
            color: white; 
        }

        #lista{

            text-align: Center; 
        }
    </style>


</head>
<body>
    <h3> Excluir Lançamento </h3><br>
    <h2>LANÇAMENTOS CADASTRADOS</h2><br>
    <div id="lista">
        <?php

            listar_lancamentos($conn);

        ?>
    </div>

    <br><br><br><br>
    <form action="" method="post" name="formulario" id="formulario" >

        <label for="idlancamento">Código do lancamento a excluir:</label>
        <input id="idlancamento" name="idlancamento" type="text"><br><br>

        <button id="botaoExcluirLancamento" type="submit">Excluir</button>

        
    </form><br> 
</body>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_lancamento = vazio_input($_POST["idlancamento"]);
     
        Excluir_lancamento($conn,$id_lancamento);
    }

    function vazio_input($data) {
            
        if(empty($data)){
            echo("<script>alert('É necessário preencher todos os campos!')</script>");
        }
        return $data;
    }
  
?>
</html>