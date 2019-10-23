<?php
/*
    Nombre:Shajinder Singh
    Curso: 2DAW DUAL
    Proyecto:Galeria

*/
    class App
    {
        const FOLDER_PATH = 'imagenes/';

        public function __construct(){
            session_start();
            
        }

        public function index(){
            // $folderPath = "imagenes/";
            $files = glob(App::FOLDER_PATH . "*.{jpg,jpeg,gif,bmp,png}",GLOB_BRACE);
            require "galeria.html";
        }

        public function upload(){

            $target_dir = App::FOLDER_PATH;
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file);

            header('Location: /galeria/galeria.php?method=index');
        }

        public function show(){

            $_SESSION['file'] = $_GET['file'];
            require "imagen.html";
        }

        public function delete(){
            
            $file = $_GET['file'];
            $dirDelete = App:: FOLDER_PATH . $file;
            unlink($file);
            header('Location: /galeria/galeria.php?method=index');

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