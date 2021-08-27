<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
include_once'./config/database.php';
$table='car';
$data=json_decode(file_get_contents('php://input'));
$id=$data->id;
$query='select * from '.$table.' where type=:id';
$stmt=$pdo->prepare($query);
$stmt->bindParam(':id',$id);
if($stmt->execute())
{
    $cars=$stmt->fetchAll(PDO::FETCH_OBJ);
    echo json_encode(['cars'=>$cars]);

}
else
{
    $response['message']='error occured';
    echo json_encode($response);
}
