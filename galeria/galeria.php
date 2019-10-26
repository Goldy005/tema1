<?php
/*
    Nombre:Shajinder Singh
    Curso: 2DAW DUAL
    Proyecto:Galeria

*/

//clase
    class App
    {

        //variables
        const FOLDER_PATH = 'imagenes/';

        //constructor
        public function __construct(){
            session_start();
            
        }

        //página principal
        public function index(){

            // $folderPath = "imagenes/";
            //función glob te filtra tipo 
            $files = glob(App::FOLDER_PATH . "*.{jpg,jpeg,gif,bmp,png}",GLOB_BRACE);
            require "galeria.html";

        }

        //método upload (hay crear una carpeta de imagenes en el directorio path)
        public function upload(){

            $target_dir = App::FOLDER_PATH;
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            if(file_exists($target_file)){
                $_SESSION['message'] = "La imagen ya existe en la galeria.";
            }else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                $_SESSION['message'] = "La página solo acepta las imagenes con el formato jpg,png,jpeg y gif.";
            }else if ($_FILES["fileToUpload"]["size"] > 1000000) {
                $_SESSION['message'] = "La imagen excede el límite de 1MB.";
            }else{
                
                move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file);
                $_SESSION['message'] = "La imagen se ha subido correctamente.";
            }

            header('Location: /galeria/galeria.php?method=index');
        }

        //metodo que muestra  la vista con la imagen y butón para borrar y volver. 
        public function show(){

            $_SESSION['file'] = $_GET['file'];
            require "imagen.html";

        }

        //botón borrar
        public function delete(){
            
            $file = $_GET['file'];
            $dirDelete = App:: FOLDER_PATH . $file;

            //función para borrar el archivo.
            if(unlink($file)){
                $_SESSION['message'] = "Se ha borrado la foto correctamente.";
            }else{
                $_SESSION['message'] = "Error al eliminar la foto.";
            }
            header('Location: /galeria/galeria.php?method=index');

        }

    }

    //main
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