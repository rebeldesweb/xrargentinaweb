<?php
  session_start();//COMIENZA LA SESION
  if (!isset($_SESSION['login'])) {//SI NO EXISTE LA SESSION LOGIN..
    header('location:formLogin.php?error=2');
  }
?>
