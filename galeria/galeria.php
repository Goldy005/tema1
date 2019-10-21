<?php
/*
    Nombre:Shajinder Singh
    Curso: 2DAW DUAL
    Proyecto:Galeria

*/
    class App
    {
        public function __construct(){
            session_start();
        }

        public function index(){
            require "galeria.html";
        }

        public function upload(){
        
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        //comprueba si imagen
            
        }

    }

    $app = new App();
    
    if(isset($_GET['method'])){
        $method = $_GET['method'];

    }else{
        $method = 'index';
    }

    if(method_exists($app,$method)){
        $app->$method();
    }else{
        exit('3');
        die('Método no encontrado.');
    }
    
?>