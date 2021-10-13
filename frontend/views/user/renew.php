<?php

$connect = new PDO('mysql:dbname=yii2test;host=localhost;','root', 'root');

if(isset($_POST['id']))
{
    $query = 'UPDATE events SET start=:start, end=:end WHERE id=:id';

    $statement = $connect->prepare($query);

    $statement->execute(

        array(
            ':id' => $_POST['id'],
            ':start' => $_POST['start'],
            ':end' => $_POST['end'],
        )
    );
}