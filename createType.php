<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
include_once'./config/database.php';

$table='model';
//$data=json_decode(file_get_contents('php://input'));
$name=$_POST['name'];
$car=$_POST['car'];
$picture=$_FILES['picture'];
$variant=$_POST['variant'];
$imgpath='pictures/'.$picture['name'];
move_uploaded_file($picture['tmp_name'],$imgpath);
$query='insert into '.$table.' (name,car,variant,picture) values (:name,:car,:variant,:picture)';
$stmt=$pdo->prepare($query);
$stmt->bindParam(':name',$name);
$stmt->bindParam(':car',$car);
$stmt->bindParam(':variant',$variant);
$stmt->bindParam(':picture',$imgpath);
if($stmt->execute())
{
    $response['message']='Model created';
    echo json_encode($response);
}
else
{   
    $response['message']='error occured';
    echo json_encode($response);
}

?>