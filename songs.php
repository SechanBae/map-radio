<?php
include "connection.php";

$songs=[];
$command="SELECT * from songs";
$stmt=$pdo->prepare($command);
$success=$stmt->execute();
if($success){
    while($row=$stmt->fetch()){
        $song=[
            "id"=>$row["id"],
            "lat"=>$row["lat"],
            "lng"=>$row["lng"],
            "song_id"=>$row["song_id"],
            "song_name"=>$row["song_name"]
        ];
        
        array_push($songs,$song);
    }
}
else{
    array_push($songs,"Failed");
    
}

echo json_encode($songs);