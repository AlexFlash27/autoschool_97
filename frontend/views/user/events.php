<?php
/*header('Content-Type: application/json');
$pdo = new PDO('mysql:dbname=yii2test;host=localhost;','root', 'root');

//Выберите события календаря
$rowsSQL = $pdo->prepare('SELECT * FROM events');
$rowsSQL -> execute();

$result = $rowsSQL->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($result);*/
$connect = new PDO('mysql:dbname=yii2test;host=localhost;','root', 'root');

$data = array();

$statement = $connect->prepare('SELECT * FROM events ORDER BY id');

$statement->execute();

$result = $statement->fetchAll();

foreach ($result as $row)
{
    $data[] = array(
        'id' => $row['id'],
        'start' => $row['start'],
        'end' => $row['end'],
    );
}

echo json_encode($data);


