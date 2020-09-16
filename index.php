<?php
    //open connection to mysql db
define('hostname','127.0.0.1'); 
define('username','root'); 
define('password',''); 
define('db','test');
//header('Content-Type: application/json');
   $connection = mysqli_connect(hostname,username,password,db) or die("Error " . mysqli_error($connection));
    
    $search = $_GET['code'];

    //fetch table rows from mysql db
    $sql = "SELECT * FROM barcode WHERE barcodename like '%$search%'";
    $result = mysqli_query($connection, $sql) or die("Error in Selecting " . mysqli_error($connection));

    //create an array

    $emparray = array();
    $status = "status";
    $message = "message";

    if (mysqli_num_rows($result)>0) {
    # code...
    $row = mysqli_fetch_row($result);
    $name = $row[2];
    $poster = $row[3];
    $duration = $row[4];
    $rating = $row[5];
    $released = $row[6];
    $genre = $row[7];
    $price = $row[8];
    $director = $row[9];
    $code = "Ticket response:";
    
    array_push($emparray, 

        array("name"=>$name,"poster"=>$poster,"duration"=>$duration,"rating"=>$rating,
        "released"=>$released,"genre"=>$genre,"price"=>$price,
        "director"=>$director));
    }
    $json = ["name"=>$name,"poster"=>$poster,"duration"=>$duration,"rating"=>$rating,
        "released"=>$released,"genre"=>$genre,"price"=>$price,
        "director"=>$director];

    

    if (!$sql) {
          echo json_encode(array(null,$status=>0,$message=>"failed"));
    } else {
        // echo json_encode(array($emparray,$status=>1,$message=>"success"));
        echo json_encode($json);
    }
    //close the db connection
    mysqli_close($connection);
?>