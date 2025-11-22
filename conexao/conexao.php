<?php
    $servername = "localhost";
    $username = "root"; 
    $password = ""; 
    $dbname = "minitask"; 

    $conn = new mysqli($servername, $username, $password, $dbname);

    if($conn->connect_error){
        die("Conexão falhou");    
    }
?>