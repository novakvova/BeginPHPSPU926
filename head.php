<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <title>Головна сторінка</title>
</head>
<body>
<h1>Hello PHP</h1>

<?php
$a=23;
$b="23";
//$c=45;
echo "a = ". $a."<br>";
if($a==$b) //===
{
    echo "a == b";
}
?>

