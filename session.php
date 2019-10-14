<?php

Class Act{

    public function __construct(){
        session_start();
    }

    public function login(){
        $nombre = "";
        require "login.html";
    }

    public function auth(){
        //tomar nombre, y meter en session
        //reenviar a home
        //header('Location: /index.php?method?=home')
        if(empty($_POST['nombre'])){
            header('Location: /session.php?method=login');
        }else{
            $_SESSION['nombre']=$_POST['nombre'];
            header('Location: /session.php?method=home');
        }
    }

    public function home(){
        require "home.html";
    }

    public function new(){
        
    }
}

$app = new Act();

if(isset($_GET['method'])){
    $method = $_GET['method'];
}else{
    $method = 'login';
}

if(method_exists($app,$method)){
    $app->$method();
}else{
    exit('3');
    die('metodo no encontrado');
}