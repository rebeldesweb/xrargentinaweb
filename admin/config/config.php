<?php

  session_start();

  function autocarga($clase)
  {
    require_once 'classes/'.$clase.'.php';
    if (!isset($_SESSION['login'])){
        header('location: formLogin.php?error=2');
    }
  }

  spl_autoload_register('autocarga');
