<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
include_once'./config/database.php';
$table='model';
$data=json_decode(file_get_contents('php://input'));
$id=$data->id;
$query='select car.name as car,model.name as model,variant.name as variant ,type.name as type ,model.picture as picture from '.$table.'join car on model.car=car.id join variant on model.variant=variant.id join type on car.type=type.id where model.car=:id ';
$stmt=$pdo->prepare($query);
$stmt->bindParam(':id',$id);
if($stmt->execute())
{
    $cars=$stmt->fetchAll(PDO::FETCH_OBJ);
    echo json_encode(['cars'=>$cars]);

}
else
{
    $response['message']='Error occured';
    echo json_encode($response);
}
?>