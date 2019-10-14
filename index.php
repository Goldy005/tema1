<?php

class App
{
    public $nombre;
    public $apellido;

    public function __construct($nombre,$apellido){
        echo "Creando una App";
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }

    public function FunctionName(Type $var = null){
        #code...
    }


    public function saludar(){
        echo "Hola, me llamo $this->nombre";
        //this.nombre >>>>>> this->nombre;
        //atributos y métodos de objeto;
        // $objeto -> atributo
        //$objeto --> metodo()
        //atributos de clase: estáticos
        //funciones de clase:estáticas
        //Clase:attributoEstátoco
        //Clase:metodoEstático()
        //Clase::constante
    }

    public function vista(){
        require('vista.php');
    }
}

$app = new App('Rafa','Cabeza');

if(isset($_GET['method'])){
    $method = $_GET['method'];
}else{
    $method = 'saludar';
}

if(method_exists($app,$method)){
    $app->$method();
}else{
    exit('3');
    die('metodo no encontrado');
}
//$app ->poo();
//App::poo();//método estático
//$app->saludar();//
//echo App::class;