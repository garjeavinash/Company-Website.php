<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
include_once'./config/database.php';

$table='car';
//$data=json_decode(file_get_contents('php://input'));
$name=$_POST['name'];
$type=$_POST['type'];
$picture=$_FILES['picutre'];
$picloc='pictures/'.$picture['name'];
move_uploaded_file($picture['tmp_name'],$picloc);
$query='insert into '.$table.' (name,type,picture) values (:name,:type,:picture)';
$stmt=$pdo->prepare($stmt);
$stmt->bindParam(':name',$name);
$stmt->bindParam(':type',$type);
$stmt->bindParam(':picture',$picloc);
if($stmt->execute())
{
    $response['message']='car created';
    echo json_encode($response);
}
else
{
    $response['message']='error occured';
    echo json_encode($response);
}
?>