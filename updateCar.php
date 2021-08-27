<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
include_once'./config/database.php';

$table='car';
$name=$_POST['name'];
$type=$_POST['type'];
if($_FILES['picture'])
{
    $picture=$_FILES['picture'];
    $imgpath='picture/'.$picture['name'];
    move_uploaded_file($picture['tmp_name'],$imgpath);
    $query='update '.$table.' set name=:name,type=:type,picture=:picture where id=:id';
    $stmt=$pdo->prepare($query);
    $stmt->bindParam(':name',$name);
    $stmt->bindParam(':type',$type);
    $stmt->bindParam(':picture',$imgpath);
    $stmt->bindParam(':id',$id);
    if($stmt->execute())
    {
        $response['message']='Car updated';
        echo json_encode($response);

    }
    else
    {
        $response['message']='error occured';
        echo json_encode($response);
    }
}
else{
   $query='update '.$table.' set name=:name,type=:type where id=:id';
   $stmt=$pdo->prepare($query);
   $stmt->bindParam(':name',$name);
   $stmt->bindParam(':type',$type);
   $stmt->bindParam(':id',$id);
   if($stmt->execute())
   {
        $repsonse['message']='car updated';
        echo json_encode($response);
   }
   else
   {
        $response['message']='error occured';
        echo json_encode($response);
   }

}

?>