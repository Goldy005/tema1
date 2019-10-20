<?php 
/*
    Nombre:Shajinder Singh
    Curso: 2DAW DUAL
    Proyecto:loteria

*/

//clase
    class App{

        
        //constructor
        public function __construct(){
            session_start();
            $_SESSION['apuestaAlmacen'] = array();
        }

        //página princiapl
        public function index(){
            require "loteria.html";
        }

        //métodp para almacenar y eliminar los números selecionados.
        public function toggle(){
            
            $numero = $_GET['number'];

            
            //si están seleccionados los borra.
            if(isset($_SESSION['apuesta'][$numero])){
                unset($_SESSION['apuesta'][$numero]);
                //si están seleccionados los almacena 
            }else{
                $_SESSION['apuesta'][$numero]=$numero;
            }

            $_SESSION['numerosSelecionados']=sizeof($_SESSION['apuesta']);
            
            header('Location: /loteria/loteria.php?method=index');
        }

        //metódo para reiniciar la apuesta, almacena la apuesta
        public function flush(){

            //solo alamacena si están seleccionados 6 números
            if(sizeof($_SESSION['apuesta']) == 6 ){

                array_push($_SESSION['apuestaAlmacen'],$_SESSION['apuesta']);
                unset($_SESSION['apuesta']);
                $_SESSION['message'] = "Apuesta almacenada correctamente";

            }else{
                $_SESSION['message'] = "Error la apuesta debe tener selecionados por lo mínimo 6 números.";
            }

            
            header('Location: /loteria/loteria.php?method=index');

        }
        
    }

    //main

        $app = new App();

        if(isset($_GET['method'])){
            $method = $_GET['method'];
        }else{
            $method = "index";
        }

        if(method_exists($app,$method)){
            $app->$method();
        }else{
            exit('3');
            die('metodo no encontrado.');
        }
?>