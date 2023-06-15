<?php
session_start();
// se connecter à la base de données avec PDO MySQL
include 'functions.php';
$pdo = pdo_connect_mysql();

// on définie la page sur sur home (home.php) par défaut
$page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'home';

// afficher la page demandé
include $page . '.php';
?>