<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
include_once'./config/database.php';

$table='model';
$car=$_POST['car'];
$name=$_POST['name'];
$variant=$_POST['variant'];
if($_FILES['picture'])
{
    $picture=$_FILES['picture'];
    $imgpath='picture/'.$picture['name'];
    move_uploaded_file($picture['tmp_name'],$imgpath);
    $query='update '.$table.' set car=:car,name=:name,variant=:variant,picture=:picture where id=:id';
    $stmt=$pdo->prepare($query);
    $stmt->bindParam('car',$car);
    $stmt->bindParam(':name',$name);
    $stmt->bindParam(':variant',$variant);
    $stmt->bindParam(':picture',$imgpath);
    $stmt->bindParam(':id',$id);
    if($stmt->execute())
    {
        $response['message']='Model updated';
        echo json_encode($response);

    }
    else
    {
        $response['message']='error occured';
        echo json_encode($response);
    }
}
else{
   $query='update '.$table.' set car=:car,name=:name,variant=:variant where id=:id';
   $stmt=$pdo->prepare($query);
   $stmt->bindParam('car',$car)
   $stmt->bindParam(':name',$name);
   $stmt->bindParam(':variant',$variant);
   $stmt->bindParam(':id',$id);
   if($stmt->execute())
   {
        $repsonse['message']='model updated';
        echo json_encode($response);
   }
   else
   {
        $response['message']='error occured';
        echo json_encode($response);
   }

}

?>