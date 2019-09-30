<?php

if(isSet($_REQUEST['lista'])){
    $lista = $_REQUEST['lista'];
}else{
    $lista = array();
}

if(isSet($_REQUEST['nuevo'])){
    $nuevo = $_REQUEST['nuevo'];
    $lista[] =$nuevo;
}
require "ejercicio7vista.php";
