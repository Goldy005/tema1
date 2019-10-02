<?php
  if(isset($_POST['nombre'])){
      setcookie('nombre',$_POST['nombre']);
      $nombre=$_POST['nombre'];
  } else{
      $nombre="";
  }
?>
<html>
  <head></head>
  <body>
  <form action="cookie.php" method="post">
    <label for="nombre">Nombre</label>
    <input type='text' name="nombre" value="<?php echo $nombre?>"/>
    <input type="submit"/>
  </form>
  </body>
</html>