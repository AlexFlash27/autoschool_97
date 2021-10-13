<?php

if(isset($_POST['id'])){

$connect = new PDO('mysql:dbname=yii2test;host=localhost;','root', 'root');

$query = 'DELETE FROM events WHERE id=:id';

$statement = $connect->prepare($query);

$statement->execute(
    [
        ':id' => $_POST['id']
    ]
);
}