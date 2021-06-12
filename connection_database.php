<?php
require_once "config.php";
try {
    $myPDO = new PDO(DB_DRIVER.":host=".DB_HOST.";dbname=".DB_NAME,
        DB_USER, DB_PASSWORD,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES ".DB_CHARSET));
    //seedAuto($myPDO);

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit();
}

function seedAuto($myPDO)
{
    for ($i=1; $i<=100;$i++) {
        $name = "Собака ".$i;
        $image = "tigra.jpg";
        $myPDO = new PDO('mysql:host=localhost;dbname=db_spu926', 'root', '');
        $sql = "INSERT INTO `animals` (`name`, `image`) VALUES (?, ?);";
        $myPDO->prepare($sql)->execute([$name, $image]);
    }
}