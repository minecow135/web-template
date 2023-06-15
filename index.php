<?php
session_start();

// Include functions
include 'functions.php';

require "include/discord.php";
require "include/discordconfig.php";

$pdo = pdo_connect_mysql();

// connect to the database using PDO MySQL
// Page is set to home (home.php) by default, so when the visitor visits that will be the page they see.
$page = isset($_GET['page']) && file_exists('pages/' . $_GET['page'] . '.php') ? $_GET['page'] : 'home';
// Include and show the requested page
include 'pages/' . $page . '.php';
