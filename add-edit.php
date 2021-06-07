<?php

include "connection.php";
$id=$_GET["id"];
$lat=$_GET["lat"];
$lng=$_GET["lng"];
$name=$_GET["name"];
$artist=$_GET["artist"];
$songId=$_GET["songId"];

$command="SELECT * FROM songs WHERE lat=? AND lng=?";
$stmt=$pdo->prepare($command);
$params=[$lat,$lng];
$success=$stmt->execute($params);

if($success){
    if($stmt->rowCount()==0){
        //$command="INSERT into songs (lat,long,song_id,song_name,song_artist) VALUES (?,?,?,?,?)";
        $command="INSERT into songs (id,lat,lng,song_id,song_name) VALUES (?,?,?,?,?)";
        $stmtTwo=$pdo->prepare($command);
        //$paramsTwo=[$id,$lat,$songId,$lng,$name,$artist];
        $paramsTwo=[$id,$lat,$lng,$songId,$name];
        $successTwo=$stmtTwo->execute($paramsTwo);
        if($successTwo){
            echo "Added Successfully";
        }
        else{
            echo "SQL Failed";
        }
    }
    else{
        $row=$stmt->fetch();
        $id=$row["id"];
        $command="UPDATE songs SET song_id=?, song_name=? WHERE id=?";
        $stmt2=$pdo->prepare($command);
        $params=[$songId,$name,$id];
        $success2=$stmt2->execute($params);
        if($success2){
            echo "Edited Successfully";
        }
        else{
            echo "SQL Failed";
        }
    }
}
else{
    echo "SQL Failed";
}