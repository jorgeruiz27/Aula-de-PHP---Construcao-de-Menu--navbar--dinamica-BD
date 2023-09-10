<?php 
// Arquivo referente a configuração do sistema
    define("HOST", "localhost");
    define("USER", "root");
    define("PASS", "");
    define("BASE", "aula07");
    try
    {
        $conn = new PDO("mysql:host=".HOST.";dbname=".BASE,USER,PASS);
    }catch(PDOException $ex)
    {
        die("Erro de Conexão: ".$ex->getMessage());
    }
?>