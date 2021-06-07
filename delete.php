<?php

include "connection.php";

$lat=$_GET["lat"];
$lng=$_GET["lng"];

$command="DELETE FROM songs WHERE lat=? AND lng=?";
$stmt=$pdo->prepare($command);
$params=[$lat,$lng];
$success=$stmt->execute($params);

if($success){
    if($stmt->rowCount()==0){
        echo "Song doesn't exist in this location";
    }
    else{

        echo "Deleted Successfully";
    }
}
else{
    echo "SQL Failed";
}