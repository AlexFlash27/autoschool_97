<?php

//$connect = new PDO('mysql:dbname=yii2test;host=localhost;','root', 'root');

if(isset($_POST['start']))
{
    $connect = new PDO('mysql:dbname=yii2test;host=localhost;','root', 'root');

    $query = "INSERT IGNORE INTO events(start, end) VALUES (:start, :end)";

    $statement = $connect->prepare($query);

    $statement->execute(
        [
            ":start" => $_POST['start'],
            ":end" => $_POST['end'],
        ]
    );
}
