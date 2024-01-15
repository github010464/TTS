<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "tt_modal";

    //data source
    $dsn = "mysql:host=$hostname;dbname=$database";

    //PDO instance
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
?>