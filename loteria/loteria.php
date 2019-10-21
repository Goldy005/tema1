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
        }

        //página principal
        public function index(){
            require "loteria.html";
        }

        //métodp para almacenar y eliminar los números selecionados.
        public function toggle(){
            
            $numero = $_GET['number'];

            if(!isset($_SESSION['apuestaAlmacen'])){
                $_SESSION['apuestaAlmacen'] = array();
            }
            
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
            if(sizeof($_SESSION['apuesta']) >= 6 ){

                array_push($_SESSION['apuestaAlmacen'],$_SESSION['apuesta']);

                if(sizeof($_SESSION['apuesta']) == 6 ){
                    $numeroApuesta = 1;
                    $_SESSION['message2'] = "Se ha realizado una apuesta.";
                    unset($_SESSION['apuesta']);

                }else if(sizeof($_SESSION['apuesta']) > 6){

                    //función para calcular el factorial
                    function fact($numero){
                        $fact = 1;
                        for($i=1;$i<=$numero;$i++){
                            $fact = $fact*$i;
                        }
                        return $fact;
                    }

                    //calculamos apuesta 
                    $numApt = sizeof($_SESSION['apuesta']);
                    //N.Apuestas = n!/(m! * (n-m)!) = n! / (6! * (n-6)!)
                    $n_apuestas = fact($numApt) / (fact(6) * (fact($numApt - 6 )));
                    $_SESSION['message2'] = "Has realizado $n_apuestas número de apuestas";
                    unset($_SESSION['apuesta']);
                }

            }else{
                $_SESSION['message2'] = "Error la apuesta debe tener selecionados por lo mínimo 6 números.";
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