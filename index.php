
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

    function Atualizar_lancamentos($conn,$id_lancamento, $descricao, $valor, $data, $tipoLancamento) {

        $sql = "UPDATE lancamentos SET descricao='$descricao', valor=$valor, data_venc='$data', id_tipo=$tipoLancamento WHERE id_lancamento =$id_lancamento;";
        $resultado = $conn->query($sql);
    
        if ($resultado) {
            echo ("<script>alert('Registro Atualizado com sucesso!')</script>");
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

        #botaoAtualizar{
            background-color: BlueViolet ;
            color: white; 
           
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
        #lista{

            text-align: Center; 
        }

    </style>


</head>
<body>
    <h3> Atualizar Lançamento </h3><br><br>
    <h2>LANÇAMENTOS CADASTRADOS</h2><br>
    <div id="lista">
        <?php
            listar_lancamentos($conn);
        ?>
    </div><br><br>
    <form action="" method="post" name="formulario" id="formulario" >

        <label for="idlancamento">Código do lancamento:</label>
        <input id="idlancamento" name="idlancamento" type="text"><br><br>

        <label for="Descricao">Descricao Atualizada:</label>
        <input id="descricao" name="descricao" type="text"><br><br>

        <label for="valor">Valor R$:</label>
        <input id="valor" name="valor" type="number" min="0.00" step="0.01"><br><br>

        <label for="Data">Data:</label>
        <input id="data" name="data" type="date"><br><br>

        <label for="tipoLancamento">Tipo de Lançamento:</label>
        <select id="tipoLancamento" name="tipoLancamento">
            <option value="1">Receitas</option>
            <option value="2">Despesas</option>
       
        </select><br><br> 

        <button id="botaoAtualizar" type="submit">Atualizar</button>

        
    </form><br> 
</body>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_lancamento = vazio_input($_POST["idlancamento"]);
        $descricao = vazio_input($_POST["descricao"]);
        $valor = vazio_input($_POST["valor"]);
        $data = vazio_input($_POST["data"]);
        $tipoLancamento = vazio_input($_POST["tipoLancamento"]);

        
        Atualizar_lancamentos($conn,$id_lancamento, $descricao, $valor, $data, $tipoLancamento);
     
    }

    function vazio_input($data) {
            
        if(empty($data)){
            echo("<script>alert('É necessário preencher todos os campos!')</script>");
        }
        return $data;
    }
  
?>
</html>