<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
include_once'./config/database.php';

$table='car';
$query='select * from '.$table.' where id=:id';
$stmt=$pdo->prepare($query);
$stmt->bindParam(':id',$id);
if($stmt->execute())
{
    $car=$stmt->fetch();
    echo json_encode(['car'=>$car]);
}
else
{
    $response['message']='error occured';
    echo json_encode($response);
}
?>