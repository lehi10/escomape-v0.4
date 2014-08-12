<?php
session_start();
if(isset($_SESSION['id']))
  header("Location:vista/".$_SESSION['tipo_usuario']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>ESCOMAPE</title>
  <link rel="stylesheet" href="css/login.css">
</head>
<body>
  
<center>
<br>
	<img src="img/logo.png"  width="400">
</center>
  <form method="post" action="vista/v_verifica.php" class="login">
    <p>
      <label for="login">ID:</label>
      <input type="text" name="login" id="login" placeholder="id">
    </p>

    <p>
      <label for="password">Contraseña:</label>
      <input type="password" name="password" id="password" placeholder="pass">
    </p>

    <p class="login-submit">
      <button type="submit" class="login-button">Entrar</button>
    </p>

    <p class="forgot-password"><a href="index.html">Olvidaste tu contraseña?</a></p>
  </form>

  <section class="about">
    <p class="about-links">
      <a href="http://www.escomape.com/" target="_parent">Escomape.com</a>
      <a href="https://www.facebook.com/escomape" target="_parent">Facebook</a>
    </p>
    <p class="about-author">
      &copy; 2014 <a href="https://www.facebook.com/CorporacionOasis" target="_blank">Oasis Group</a> 
      </p>      
  </section>
</body>
</html>
