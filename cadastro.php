
<?php

    function MyAutoload($className) {
        $extension =  spl_autoload_extensions();
        require_once (__DIR__ . '/' . $className . $extension);
    }

    function padronizar($data) {
        $data = htmlspecialchars($data);
        return $data;
    }

    spl_autoload_extensions('.class.php'); // quais extensões iremos considerar
    spl_autoload_register('MyAutoload');

    global $conexao;
    $conexao = new Controle;
    

    $erroData = '';
    $erroUrgencia = '';
    $erroSala = '';
    $erroDescricao = '';
    $data = $ugencia = $sala = $descricao = '';



    if(isset($_POST['enviarFormulario'])){

        
        
        if(empty($_POST['tUrgencia'])){
            $erroUrgencia = 'Urgencia não preenchida';
        }
        else{
            $urgencia = $_POST['tUrgencia'];
        }
        
        if($_POST['tSala'] == 'erro'){ //Desculpa não soube um jeito de fazer melhor
            $erroSala = 'Sala não preenchida';
        }
        else{
            $sala = $_POST['tSala'];
        }

        if(empty($_POST['tData'])){
            $erroData = 'Data não preenchida';
        }
        else{
            $data = $_POST['tData'];
        }
        
        if(empty($_POST['tDescricao'])){
            $erroDescricao = 'Descricao não preenchida';
        }
        else{
            $descricao = $_POST['tDescricao'];
        }

        


        if(empty($erroData) & empty($erroUrgencia) & empty($erroSala) & empty($erroDescricao)){
            //Fazer conexão com o bd
             //Controlador de conexão
            
            if(!empty($_POST['Indisponivel'])){
        
                $query = "UPDATE sala SET sala.status = false WHERE numero ='".$sala."'";
                $conexao->insertBD($query);
            
              	 $query = "INSERT INTO problema (descricao, data, urgencia, numero, status) VALUES ('".$descricao."','".$data."','".$urgencia."','".$sala."', false)";                
                $conexao->insertBD($query);
            
            }else{
            
            	$query = "INSERT INTO problema (descricao, data, urgencia, numero, status) VALUES ('".$descricao."','".$data."','".$urgencia."','".$sala."', true)";
            	$conexao->insertBD($query);
            
    
            }
        }

    }

?><!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema - Cadastro de Problemas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
    <body>

        <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <span class="navbar-text">
            <h1>Cinema Top</h1><p>Gerenciamento de Problemas<p>
            </span>
        </div>
        </nav>

        <div style="text-align: center; margin-left:30%">
        <div class="alinhar" style="width:500px;">
     
            <h2>Cadastro de Problemas</h2>
            <div class="alert alert-danger" role="alert">
                * Campos Obrigatórios
            </div>
            <p><font color="#AA0000"></font></p>
	
		<div class="container">
		    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">

		    <label for="cSala">Sala: </label> 

		    <span class="error">

		    <select name="tSala" id="cSala">
		        <option value="erro">--</option>
		        <?php

		            $query = 'SELECT numero, status FROM sala ORDER BY numero';

		            $selecao = $conexao->selectBD($query);

		            while($row = mysqli_fetch_array($selecao)){
		                
		                echo '<option value="'.$row['numero'].'">'.$row['numero'].'</option>';

		            }

		        ?>
		    </select>
		    <font color="#AA0000">* <?php echo $erroSala;?></font></span>
		    <br><br>

		    <label for="tUrgencia">Gravidade: </label> 
		    
		    <input type="radio" name="tUrgencia" id="cBaixa" value="baixa" ><label for="cBaixa">Baixa</label>
		    <input type="radio" name="tUrgencia" id="cMedia" value="media"> <label for="cMedia">Média</label>
		    <input type="radio" name="tUrgencia" id="cUrgente" value="urgente"> <label for="cUrgente">Urgente</label>
		    <span class="error"><font color="#AA0000">* <?php echo $erroUrgencia;?></font></span>

		    <br><br>
		    <label for="Indisponivel">A sala está indisponível?&ensp;</label><input type = "checkbox" id = "Indisponivel" name = "Indisponivel" valor = "true">
		    <br><br>
		    <label for="cData"> Data de início </label>
		    <input type="date" name="tData" id="cData">
		    <span class="error"><font color="#AA0000">* <?php echo $erroData;?></font></span>
		    
		    <br><br>

		    <label for="cDescricao">Descrição:</label>
		    <span class="error"><font color="#AA0000">*<?php echo $erroDescricao;?></font></span>
		    <br>
		    <textarea name="tDescricao" id="cDescricao" cols="40" rows="6"></textarea>
		    
		    <br>
		    <br>
		    <button type="submit" name="enviarFormulario" class="btn btn-outline-dark">Enviar</button>
		    <a href="index.php" class="btn btn-outline-dark" role="button">Voltar</a>
		    
		    </form>
            </div>
            <br>
            
        </div>
        </div>
        
</body>

<style>
	body {
	  background-image: url('background.jpg');
	  opacity: 1;
	  background-repeat: no-repeat;
  	  background-attachment: fixed;
  	  background-size: 100% 100%;
	}
	
	.btn-primary {
	    text-decoration: none ;
	    color: black;
	    background-color: #FFF8DC;
	}
	    
	.btn-primary:hover{
	    background-color: #FFF8DC;
	    opacity: 0.5;
	    color: black;
	}

	h1,h2, p {
	  color:#faf1ca; 
	  font-family: 'Oswald', sans-serif; 
	  line-height: 0.8; 
	  text-align: center; 
	  margin: 0 0 0;
	  text-transform: uppercase;
	}
	h1 {
	  padding-top: 20px ; 
	  padding-bottom: 20px;
	  font-weight: 700;
	  font-size: 25pt;
	  text-align: left;
	  line-height: .2em;
	  
       }
       p {
	  padding-top: 10px ; 
	  padding-bottom: 0px;
	  font-weight: 700;
	  font-size: 10pt;
	  text-align: left;
	  text-transform: uppercase;
       }

	h2 {
	  padding-top: 30px;
	  padding-bottom:10px;
	  font-weight: 600; 
	  font-size: 20pt;
	  text-align: center;
	  line-height: 1em;
	}
	
	.container {
	  color:#black; 
	  max-width:500px;
	  padding:20px;
	  margin:20px auto;
	  border-radius:8px;
	  background:#f9f1f1;
	  text-align: center;
	}
</style>

</html>
