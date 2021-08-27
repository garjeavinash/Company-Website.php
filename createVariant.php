<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
include_once'./config/database.php';

$table='variant';
$data=json_decode(file_get_contents('php://input'));
$name=$data->name;
$query='insert into '.$table.' (name) values (:name)';
$stmt=$pdo->prepare($query);
$stmt->bindParam(':name',$name);
if($stmt->execute())
{
    $response['message']='type created';
    echo json_encode($response);
}
else
{
    $response['message']='error occured';
    echo json_encode($response);
}

?>