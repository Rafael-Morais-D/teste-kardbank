<?php 

    $host = "mysql:host=localhost;dbname=teste_kardbank;port=3306";
    $user = "root";
    $pass = "";

    try {
        $db = new PDO($host,$user,$pass);
    } catch (PDOException $e) {
        print "Erro: " . $e->getMessage() . "<br/>";
        die();
    }

?>