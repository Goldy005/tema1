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
?>
<!Doctype HTML>
<html>
    <head>
        <title></title>
    </head>
    <body>
    <h1>Lista de jugador</h1>
    <?php
        foreach($lista as $key => $jugador){
            echo "<li>$jugador</li>";
        }
    ?>
    <form action='' method='get'>
    <!--usar foreach para construir una lista ul>-->
    <?php
        foreach($lista as $key => $jugador){
            echo '<input type="hidden" name="lista[]" value="' . $jugador . '">';
        }
    ?>
    <!--lista de lo que ya existe-->

    <label for="nuevo">Nuevo jugador:</label>
    <input type="text" name="nuevo" value=""/>
    <br/>
    <input type="submit">
    </form>
    </body>
</html>