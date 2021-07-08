<?php

       
    function MyAutoload($className) {
    
        $extension =  spl_autoload_extensions();
        require_once (__DIR__ . '/' . $className . $extension);
    }


    spl_autoload_extensions('.class.php'); // quais extensões iremos considerar
    spl_autoload_register('MyAutoload');

   	 ?>
	<nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <span class="navbar-text">
            <h1>Cinema Top</h1><p>Gerenciamento de Problemas<p>
            </span>
        </div>
        </nav>
	
	<div class="container"><?php
   
   function deletaproblema($ID){
   	    $c = new Controle();
	    //recupera o num da sala e status do problema
	    $query = "SELECT numero, status FROM problema WHERE id='".$ID."'"; 		
	    $selecao = $c->selectBD($query);
	    $linha = mysqli_fetch_array($selecao);
	    
	    if($linha['status'] == false){
	    
	    	//se o problema deixa a sala indisponível
	    	//é necessario observar se a sala tem outros problemas que a deixam indisponível
	    	$query = "SELECT id, status FROM problema WHERE numero='".$linha['numero']."'";
	    	$selecao = $c->selectBD($query);
	    	
	    	$salaStatus = true;
	    	while($lin = mysqli_fetch_array($selecao)){
	    		if($lin['id'] != $ID && $lin['status'] == false){
	    		//há um problema que tambem deixa a sala indisponivel
	    		//nesse caso a solucao desse problema nao altera o status da sala
	    			$salaStatus = false;
	    			break;
	    		}
	    	//se não há nenhum outro problema que deixa a sala indisponível, a sala passsa a ficar disponível
	    	}
	    	//altera o status da sala se $salaStatus for verdadeiro
	    	if($salaStatus == true){
	    		$query = "UPDATE sala SET sala.status = true WHERE numero ='".$linha['numero']."'";
                	$c->insertBD($query);
	    	}	
	    		
	    }
	    
	    //se ele nao afeta a disponibilidade basta remover
	    $sql="DELETE FROM problema WHERE id =".$ID."";   
	    $c->deleteBD($sql);
	    
	 
	     ?>
	     <div class="alert alert-success" role="alert">
  			Problema removido com sucesso!
  		</div>
	      <?php
   		
   	     //<script>window.location="remocao.php"</script><?php
    }
    

    if(isset($_GET['id'])) //Undefined index aqui
   {
   	$id = intval($_GET['id']);
    	deletaproblema($id);
   }  
    
   
	
    $c = new Controle();
    $query = 'SELECT id, descricao, data, urgencia, numero, status FROM problema ORDER BY numero';
        
    $selecao = $c->selectBD($query);
        
    while($linha = mysqli_fetch_array($selecao)){
	$indisp = "Este problema deixa a sala indisponível.";
	
    ?>
    <div class="list-group" style="display:inline-block">
    	<div class="list-group-item" style="display:inline-block">
		Problema <?=$linha['id']?> [<?=$linha['urgencia']?>]
		<br>
		Sala: <?=$linha['numero']?> (Data de Início: <?=$linha['data']?>)
		<br>
		<?=$linha['descricao']?> 
		<br>
		<?php if(!$linha['status']){
    			?>
			<font color="red">  
			<b>Este problema deixa a sala indisponível.</b>
			</font>  
		<?php
    		}
		?>
		<br>
		<br>
		<input type="button" class="btn btn-outline-dark btn-sm" value="Remover" name-"remover" id="rem" 
		onclick="return deleteqry(<?php echo $linha['id'] ?>);"/>
    	</div>
    </div>
    <br>
    	
	
    <?php    
    } 
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
    <title>Lista de Problemas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<script>
		function deleteqry(id)
		{ 
		  if(confirm("Tem certeza que deseja remover este problema?")==true)
		  	window.location="remocao.php?id="+id;
		  return false;
		}
	</script>
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
	  
	  max-width: 300px;
	  background:#f9f1f1;
	}
	.list-group-item{
	  border-width: 0px 0em 1px 0; /* top right bottom left */
	  max-width: 300px;
	  border-color: #313639;
	  background:#f9f1f1;
	  padding-bottom:10px;
	}
</style>
</html>
