<?php

class Connection{

    public static $instance;

    public function __construct() {
        //vazio
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = mysqli_connect("localhost", "root","","cinema");

            if(!self::$instance){
                die("A conexão falhou: " .mysqli_connect_error());
            }

        }
 
        return self::$instance;
    }

    public static function close(){
        mysqli_close(self::$instance);
    }


}

?>