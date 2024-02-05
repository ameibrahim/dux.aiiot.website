<?php
    
    include ("conn.php");

    $query = "SELECT apiKey FROM `users` WHERE email = 'vmercel@gmail.com'";
    $result = $conn->query($query);

    if($result){
        $userDetails = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo json_encode($userDetails);
    }

?>