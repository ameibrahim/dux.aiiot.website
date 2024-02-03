<?php
    
     include ("conn.php");

     $name = $_POST['name'];
     $phone = $_POST['phone'];
     $address = $_POST['address'];
     $photoName = $_POST['photoName'];
     $email = $_POST['email'];
     $isPhoto = $_POST['isPhoto'];

     $photoNames = "uploads/".$photoName;


    if ($isPhoto == "true") {
        $sql = "UPDATE users SET name = ?, address = ?, phone = ?, photo = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $name, $address, $phone, $photoNames, $email);
    } else {
        $sql = "UPDATE users SET name = ?, address = ?, phone = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $address, $phone, $email);
    }
    
    if($stmt->execute()){
        $stmt->close(); 
    }

    $query = "SELECT * FROM `users` WHERE email = 'vmercel@gmail.com'";
    $result = $conn->query($query);

    if($result){
            $userDetails = mysqli_fetch_all($result, MYSQLI_ASSOC);
            echo json_encode($userDetails);
    }

?>