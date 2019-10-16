<?php 

    class App{

        public function __construct(){
            session_start();
        }

        public function index(){
            require "loteria.html";
        }

        public function toggle(){
            
            $numero = $_GET['number'];

            if(isset($_SESSION['apuesta'][$numero])){
                unset($_SESSION['apuesta'][$numero]);
            }else{
                $_SESSION['apuesta'][$numero]=$numero;
            }

            $_SESSION['numerosSelecionados']=sizeof($_SESSION['apuesta']);
            header('Location: /loteria/loteria.php?method=index');
        }

        }
        

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