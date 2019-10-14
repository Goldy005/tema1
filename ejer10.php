<?php

Class App{

    public $nombre;


    public function __construct($nombre){
        $this->nombre = $nombre;
        session_start();
    }

    public function formulario(){
        if(isset($_COOKIE['nombre'])){
            $nombre=$_COOKIE['nombre'];
        } else{
            $nombre="";
        }
        require "formulario.html";
    }

    public function respuesta(){
        if(isset($_POST['nombre'])){
            setcookie('nombre',$_POST['nombre']);
            echo "$nombre se quien eres";
        } else{
            echo "no se quien eres";
        }
    }
}
$app = new App("");

if(isset($_GET['method'])){
    $method = $_GET['method'];
}else{
    $method = 'formulario';
}

if(method_exists($app,$method)){
    $app->$method();
}else{
    exit('3');
    die('metodo no encontrado');
}