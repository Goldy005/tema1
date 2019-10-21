<?php
/*
    Nombre:Shajinder Singh
    Curso: 2DAW DUAL
    Proyecto:Calculadora

*/
class App{

    //constructor
    public function __construct(){
        session_start();
    }

    //pagina principal
    public function index(){
        require "calculadora.html"; 
    }

    //metodo calcular la operaciones

    public function calcular(){

        $dato1Valido = true;
        $dato2Valido = true;
        $resultado = 0;

        //historial que almacena todas las operaciones
        if(!isset($_SESSION['historial'])){
            $_SESSION['historial'] = array();
        }

        //si los datos pasados no son númericos, se le asigna el mensaje de error
        //por cada error

        if(!is_numeric($_POST['opt1']) && !is_numeric($_POST['opt2'])){
            $dato1Valido = false;
            $_SESSION['message'] = "Error el primer operador y el segundo no es válido.";
        
        }else if(!is_numeric($_POST['opt1'])){
            $dato1Valido = false;
            $_SESSION['message'] = "Error el primer dato no es númerico.<br/>";

        }else if(!is_numeric($_POST['opt2'])){
            $dato2Valido = false;
            $_SESSION['message'] = "Error el segundo dato no es númerico.<br/>";
        }

        //si el dato es válido, se realiza la operación dependiendo si es suma,resta ...

        if($dato1Valido == true && $dato2Valido == true ){
            
            if($_POST['opt'] == 'suma'){

                $resultado = $_POST['opt1']+$_POST['opt2'];
                $_SESSION['message']="EL resultado de la operación es $resultado";
                $operacion = $_POST['opt1'] . " + " .  $_POST['opt2'] . " =  " . $resultado ;
                array_push($_SESSION['historial'],$operacion);


            }else if($_POST['opt'] == 'resta'){

                $resultado = $_POST['opt1']-$_POST['opt2']; 
                $_SESSION['message']="EL resultado de la operación es $resultado"; 
                $operacion = "$_POST[opt1] - $_POST[opt2] = $resultado";
                array_push($_SESSION['historial'],$operacion);

            }else if($_POST['opt'] == 'multiplicacion'){
                
                $resultado = $_POST['opt1']*$_POST['opt2'];
                $_SESSION['message']="EL resultado de la operación es $result2";
                $operacion = "$_POST[opt1] * $_POST[opt2] = $resultado";
                array_push($_SESSION['historial'],$operacion);

            }else if($_POST['opt'] == 'division'){
                if($_POST['opt2'] == 0){
                    $_SESSION['message']="Al dividir por 0 el resultado es infinto.";

                }else{
                
                    $resultado = $_POST['opt1']/$_POST['opt2'];
                    $_SESSION['message']="EL resultado de la operación es $resultado";
                    $operacion = "$_POST[opt1] /  $_POST[opt2] = $resultado";
                    array_push($_SESSION['historial'],$operacion);

                }
            }else{
                $_SESSION['message']="Error el operador selecionado es incorrecto.";
            }
        }
            //se almacena los valores introducidos por el usuario.
            $_SESSION['opt1'] = $_POST['opt1'];
            $_SESSION['opt2'] = $_POST['opt2'];
            $_SESSION['opt'] = $_POST['opt'];

            //pagina principal
        header('Location: /calculadora/calculadora.php?method=index');
    }

}

 //main
    $app = new App();

    if(isset($_GET['method'])){
        $method = $_GET['method'];
    }else{
        //metodo por defecto
        $method = "index";
    }

    if(method_exists($app,$method)){
        $app->$method();
    }else{
        exit('3');
        die('metodo no encontrado.');
    }
?>