
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

    function cadastrar_lancamentos($conn, $descricao, $valor, $data, $tipoLancamento) {
        $sql = "INSERT INTO lancamentos (descricao, valor, data_venc, id_tipo) VALUES ('$descricao', '$valor', '$data', $tipoLancamento);";
       
        $resultado = $conn->query($sql);
    
        if ($resultado) {
            echo ("<script>alert('Novo registro cadastrado!')</script>");
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

        .rodape {
            color: white;
            background-color: #33ff33;
            text-align: center;
            font-size: 20px;
            padding: 20pt;
            width: 100%;
            position: fixed;
            bottom: 0;
        }
    </style>


</head>
<body>
    <h3>Cadastre seus lançamentos</h3><br><br>
    <form action="" method="post" name="formulario" id="formulario" >

        <label for="Descricao">Descricao:</label>
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

        <button type="button" class="btn btn-success">Cadastrar</button>

        
    </form>
    
        
    <footer class="rodape">
            <p>&copy; 2023 Financas. Todos os direitos
                reservados.</p>
            <p>Contato: financas@suporte.com.br</p>

    </footer>

</body>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $descricao = vazio_input($_POST["descricao"]);
        $valor = vazio_input($_POST["valor"]);
        $data = vazio_input($_POST["data"]);
        $tipoLancamento = vazio_input($_POST["tipoLancamento"]);

        cadastrar_lancamentos($conn,$descricao,$valor,$data,$tipoLancamento);
        
    }

    function vazio_input($data) {
            
        if(empty($data)){
            echo("<script>alert('É necessário preencher todos os campos!')</script>");
        }
        return $data;
    }
  
?>
</html>