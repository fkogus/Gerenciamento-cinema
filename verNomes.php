<?php

    function MyAutoload($className) {
        $extension =  spl_autoload_extensions();
        require_once (__DIR__ . '/' . $className . $extension);
    }
	
    spl_autoload_extensions('.class.php'); // quais extensões iremos considerar
    spl_autoload_register('MyAutoload');
    
    
    $c = new Controle();

    $query = 'SELECT numero, numacentos, status FROM sala ORDER BY numero';

    $selecao = $c->selectBD($query);
    $status = false;

	?>
	<nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <span class="navbar-text">
            <h1>Cinema Top</h1><p>Gerenciamento de Problemas<p>
            </span>
        </div>
        </nav>
	
	<div class="container"><?php
	
    while($linha = mysqli_fetch_array($selecao)){
        
        if($linha['status'] == true){
            $status = 'Disponível';
            $cor = '#009933';
        } 
        else{
            $status = 'Não disponível';
            $cor = '#ff0000';
        }?>

        <div class="list-group" style="display:inline-block">
            <div class="list-group-item" style="display:inline-block">Sala <?=$linha['numero']?> (<?=$linha['numacentos']?> lugares) - <font color=<?php echo $cor ?>><?=$status?></font></div>
        </div>
        <br>
        
	
    <?php } 
	?>
	<br>
	<a href="index.php" class="btn btn-outline-dark" role="button">Voltar</a>
	<div class="container"><?php
	
?>


<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Salas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>

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
	  padding:10px;
	  margin:10px auto;
	  border-radius:8px;
	  background:#f9f1f1;
	  text-align: center;
	}
	.list-group{
	  
	  background:#f9f1f1;
	}
	.list-group-item{
	  border-color: #f9f1f1;
	  background:#f9f1f1;
	  padding-bottom:10px;
	}
	
</style>
</html>
