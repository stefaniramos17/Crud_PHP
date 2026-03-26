<?php

    $dbname = 'crud_php';
    $host = 'localhost:4308';
    $dbuser = 'root';
    $dbpass = '';

    try{
        $db = new PDO("mysql:dbname=".$dbname.";host=".$host, $dbuser, $dbpass);
    } catch(PDOException $e){
        echo "Erro na conexão" . $e->getMessage();
        exit();
    }

    define('BASE_URL', 'http://localhost/crud_php/')

?>