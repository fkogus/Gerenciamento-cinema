<?php

class Controle{

    private $connection;
    public $conn;

    public function __construct(){
        $this->connection = new Connection();
        $this->conn = $this->connection->getInstance();
    }

    public function insertBD($query){
        if(mysqli_query($this->conn, $query)){
            return true;
        }
        else return false;
    }

    public function deleteBD($query){
        if(mysqli_query($this->conn, $query)){
            return true;
        }
        else return false;
    }

    public function selectBD($query){
        if($selecao = mysqli_query($this->conn, $query)){
            return $selecao;
        }
        else return 'erro';
    }    

}

?>