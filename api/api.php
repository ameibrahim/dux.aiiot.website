<?php
// api.php

include('conn.php');


// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';


// Function to send an email with an attachment
function sendEmailWithAttachment($to, $subject, $message, $attachmentPath) {
    $mail = new PHPMailer(true);

    //Server settings
    $mail->SMTPDebug = 0;//SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'vmercel@gmail.com';                     //SMTP username
    $mail->Password   = 'vmwrxgvxrshodsiy';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;   

    // Sender and recipient email addresses
    $mail->setFrom('vmercel@gmail.com', 'Mercel');
    $mail->addAddress($to);

    // Email subject and body
    $mail->Subject = $subject;
    $mail->Body = $message;

    // Attach the file
    $mail->addAttachment($attachmentPath);

    // Send the email
    if ($mail->send()) {
        return true; // Email sent successfully
    } else {
        return false; // Email sending failed
    }
}

// Function to handle the email instructor action
function emailInstructor($conn, $formData) {
    // Extract data from the form data array
    $instructorEmail = $formData['instructor'];
    $subject = $formData['subject'];
    $message = $formData['message'];
    $attachment = $_FILES['attachment'];

    // Specify the path to store the attachment on the server (adjust this path as needed)
    $attachmentPath = '../uploads/' . $attachment['name'];

    // Move the uploaded attachment to the specified path
    move_uploaded_file($attachment['tmp_name'], $attachmentPath);

    // Send the email with the attachment
    if (sendEmailWithAttachment($instructorEmail, $subject, $message, $attachmentPath)) {
        // Email sent successfully
        $response = array(
            'status' => 'success',
            'message' => 'Email sent successfully'
        );
    } else {
        // Email sending failed
        $response = array(
            'status' => 'error',
            'message' => 'Failed to send email'
        );
    }

    // Delete the attachment file after sending (optional)
    unlink($attachmentPath);

    // Return the response as JSON
    echo json_encode($response);
}


// Function to send an email
function sendEmail($receiverEmail, $message) {
    
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;//SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'vmercel@gmail.com';                     //SMTP username
            $mail->Password   = 'vmwrxgvxrshodsiy';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('vmercel@gmail.com');
            $mail->addAddress($receiverEmail);
            $code = generateRandomString(6);
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'no reply';
            $mail->Body    = $message;

            $mail->send();
            return true; //echo 'Message has been sent';
        } catch (Exception $e) {
            return false; //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
}

// generate a random string
function generateRandomString($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}


function signup($conn, $uid, $name, $email, $phone, $stdNumber, $address, $password, $department, $photoName, $utype)
{
    // Validate the signup data
        // Check if the email already exists in the database
        // $emailCheckQuery = "SELECT * FROM users WHERE email = '$email'";
        // $emailCheckResult = $conn->query($emailCheckQuery);
    
        // if ($emailCheckResult->num_rows > 0) {
        //     // Email already exists, return an error message
        //     $response = array(
        //         'status' => 'error',
        //         'message' => 'Email already exists in the database.'
        //     );
        //     echo json_encode($response);
        //     return;
        // }
    // Check if the email already exists in the database

    // $emailCheckQuery = "SELECT * FROM users WHERE email = '$email'";
    // $emailCheckResult = $conn->query($emailCheckQuery);

    // if ($emailCheckResult->num_rows > 0) {
    //     // Email already exists, return an error message
    //     $response = array(
    //         'status' => 'error',
    //         'message' => 'User already exists in the database.'
    //     );
    //     echo json_encode($response);
    //     return;
    // }else{

    $status = 'Inactive';

    // Insert user data into the database
    $sql = "INSERT INTO users (`uid`, `name`, `email`, `password`, `phone`, `stdnumber`, `address`, `department`, `status`, `photo`, `utype`) 
            VALUES ('$uid', '$name', '$email', '$password', '$phone', '$stdNumber', '$address', '$department', '$status', '$photoName', '$utype')";

    if ($conn->query($sql) === TRUE) {
        $user = array(
            'uid' => $uid,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'stdnumber' => $stdNumber,
            'address' => $address,
            'department' => $department,
            'status' => $status,
            'photo' => $photoName,
            '_status' => 'ok'
        );
      
        // $message = "<html>
        // <head>
        // </head>
        // <body>
        //     <p>Dear <strong>$name</strong>,</p>
        //     <p>This email is to confirm the creation of your account in DUX LMS:</p>
        //     <p>Your password is: <a href='#'>$password</a></p>
        //     <p>You can now login <a href='https://dux.aiiot.website/auth.html'>here</a> </p>
            
        //     <p>Best regards,</p>
        //     <p>Mercel from DUX</p>
        // </body>
        // </html>";

        // sendEmail($email, $message);

        // If signup is successful, store user information in session
        //$_SESSION['user'] = $user;
        echo json_encode($user);
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    } 
// }
    $conn->close();
}

function generateRandomToken($length = 32) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $token = '';
    $maxIndex = strlen($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $token .= $characters[rand(0, $maxIndex)];
    }
    return $token;
}

// Function to insert a random token into the sessions table
function insertRandomToken($conn, $user_id) {
    // Generate a random token
    $token = generateRandomToken();

    // Set the session expiration time (e.g., 1 hour from now)
    $expirationTime = date('Y-m-d H:i:s', strtotime('+1 hour'));

    // Insert the token into the sessions table
    $insertQuery = "INSERT INTO sessions (userId, token, expiration_time) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("sss", $user_id, $token, $expirationTime);

    if ($stmt->execute()) {
        // Token insertion was successful
        return $token;
    } else {
        // Token insertion failed
        return false;
    }
}



function login($conn, $email, $password)
{
    // Validate the login credentials
    // ...
    // Perform database query to authenticate user
    // ...
    // If authentication is successful, store user information in session

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        $user_id = $row['stdnumber']; // Replace with the actual user ID
        $token = insertRandomToken($conn, $user_id);
        $user = array(
            'uid' => $row['uid'],
            'name' => $row['name'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'stdnumber' => $row['stdnumber'],
            'address' => $row['address'],
            'department' => $row['department'],
            'token' => $token,
            'photo' => $row['photo'],
            'status' => $row['status'],
            'utype' => $row['utype'],
            'state'=>'ok'
        );
        
        // If authentication is successful, store user information in session
        $_SESSION['user'] = $user;

        mysqli_query($conn, "UPDATE users SET status = 'Active' WHERE email = '$email'");
        echo json_encode($user);

    } else {
        $res = array('state' =>'error',
        'message' =>'Invalid email or password.');
        echo json_encode($res);
    }
    

    $conn->close();
}


// Handle the API requests
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $allowedDomains = array('dux.aiiot.website', 'localhost');
    $requestDomain = $_SERVER['HTTP_HOST'];
    
    if (!in_array($requestDomain, $allowedDomains)) {
        $message = 'Unauthorized request from: ' . $_SERVER['HTTP_REFERER'];
        sendEmail('vmercel@outlook.fr', $message);
        // handle unauthorized request
    } else {
        // handle authorized request



    $action = $_POST['action'];

    if ($action === 'login') {
        $email = $_POST['email'];
        $password = $_POST['password'];
        login($conn, $email, $password);
    }elseif($action ==='logout'){
        $email = $_POST['email'];
        mysqli_query($conn, "UPDATE users SET status = 'Inactive' WHERE email = '$email' ");
    } elseif ($action === 'signup') {
        $uid = $_POST['uid'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $stdNumber = $_POST['studentno'];
        $address = $_POST['address'];
        $department = $_POST['department'];
        $password = $_POST['password'];
        $photoName = 'uploads/' . $_POST['photoName'];
        $utype = $_POST['utype'];
        signup($conn, $uid, $name, $email, $phone, $stdNumber, $address, $password, $department, $photoName, $utype);
    }elseif ($action === 'fetchGrades') {
        $studentId = $_POST['studentId'];
        $courseId = $_POST['courseId'];
        $topicId = $_POST['topicId'];
        fetchGrades($conn, $studentId, $courseId, $topicId);
    } elseif ($action === 'saveSection') {
        $courseId = $_POST['courseId'];
        $sectionName = $_POST['sectionName'];
        $topicId = $_POST['topicId'];
        $instructions = $_POST['instructions'];
        $duration = $_POST['duration'];
        $image = $_FILES['image'];
        saveSectionInstructions($conn, $courseId, $topicId, $sectionName, $instructions, $duration, $image);
    }elseif ($action === 'saveSection_noUpload') {
        $courseId = $_POST['courseId'];
        $sectionName = $_POST['sectionName'];
        $topicId = $_POST['topicId'];
        $instructions = $_POST['instructions'];
        $duration = $_POST['duration'];
        $image = $_POST['image'];
        saveSectionInstructions_noUpload($conn, $courseId, $topicId, $sectionName, $instructions, $duration, $image);
    }  elseif ($action === 'updateSection') {
        $sectionId = $_POST['UsectionId'];
        $courseId = $_POST['UcourseId'];
        $sectionName = $_POST['UsectionName'];
        $topicId = $_POST['UtopicId'];
        $instructions = $_POST['Uinstructions'];
        $duration = $_POST['Uduration'];
        $image = $_FILES['Uimage'];
        updateSectionInstructions($conn, $sectionId, $courseId, $topicId, $sectionName, $instructions, $duration, $image);
    }elseif ($action === 'deleteSection') {
        $courseId = $_POST['courseId'];
        $sectionName = $_POST['sectionName'];
        $topicId = $_POST['topicId'];
        deleteSectionInstructions($conn, $courseId, $topicId, $sectionName);
    }  elseif($action === 'saveGrades'){
        $studentId=$_POST['studentId'];
        $courseId= $_POST['courseId'];
        $topic =$_POST['topic'] ;
        $score = floatval($_POST['score']);
        $ac = floatval($_POST["ac"]);
        $te = floatval($_POST['te']);
        $pe = floatval($_POST["pe"]);
        $total = floatval($_POST['total']);
        
        //insertOrUpdateGrade($conn, 'STD020', 'C003', 'Lecture 3', 20, 60.0, 6.5, 30, 20);
        insertOrUpdateGrade($conn, $studentId, $courseId, $topic, $score, $ac, $pe, $te,$total);
    } elseif($action ==='fetchIds'){
        $courseId = $_POST['courseId'];
        fetchIdsFromSections($conn, $courseId=null);
    } elseif($action==='fetchInstructions'){
        $topicId = $_POST['topicId'];
        $courseId = $_POST['courseId'];
        getInstructionsByTopicID($topicId, $courseId, $conn);
    } elseif($action ==='subscribeToCourse'){
        $studentId = $_POST['studentId'];
        $courseId = $_POST['courseId'];
        subscribeToCourse($conn, $studentId, $courseId);
    }  elseif($action ==='unsubscribeFromCourse'){
        $studentId = $_POST['studentId'];
        $courseId = $_POST['courseId'];
        unsubscribeFromCourse($conn, $studentId, $courseId);
    } elseif($action ==='fetchCourses'){
        $studentId = $_POST['studentId'];
        fetchCourses($conn, $studentId);
    }elseif($action ==='fetchCoursesTeacher'){
        $studentId = $_POST['studentId'];
        fetchCoursesTeacher($conn, $studentId);
    } elseif($action==='fetchApprovedCourses'){
        $studentId = $_POST['studentId'];
        fetchApprovedCourses($conn, $studentId);
    } elseif($action ==='fetchCoursesForUser'){
        $studentId = $_POST['studentId'];
        fetchCoursesForUser($studentId, $conn);
    }elseif($action ==='fetchCoursesForUserTeacher'){
        $studentId = $_POST['studentId'];
        fetchCoursesForUserTeacher($studentId, $conn);
    }elseif($action ==='fetchCoursesForUserAdmin'){
        $studentId = $_POST['studentId'];
        fetchCoursesForUserAdmin($studentId, $conn);
    } elseif($action ==='fetchTopicsForCourse'){
        $courseId = $_POST['courseId'];
        fetchTopicsForCourse($courseId,$conn);
    } elseif($action ==='fetchTopicsForCourseS'){
        $courseId = $_POST['courseId'];
        fetchTopicsForCourseS($courseId,$conn);
    } elseif($action === 'getCourses'){
        getCourses($conn);
    } elseif($action ==='getCoursesTeacher'){
        $teacherId = $_POST['teacherId'];
        getCoursesTeacher($conn, $teacherId);
    } elseif($action === 'getPhaseById'){
        $courseId = $_POST['courseId'];
        $topicId = $_POST['topicId'];
        getPhaseById($conn,$courseId, $topicId);
    } elseif($action === 'getPhaseInfo'){
        $sectionId = $_POST['sectionId'];
        getPhaseInfo($conn, $sectionId);
    } elseif($action === 'fixSchedules'){
        $courseId = $_POST['courseId'];
        $schedules = $_POST['schedules'];
        insertOrUpdateSchedules($conn, $courseId, $schedules);
    } elseif($action === 'getScheduleByCourse'){
        $courseId = $_POST['courseId'];
        getScheduleByCourse($conn, $courseId);
    }elseif($action === 'sendMessage'){
        $userId = $_POST['userId'];
        $message = $_POST['message'];
        $courseId = $_POST['courseId'];
        saveOrRetrieveMessages($conn, $userId, $message, $courseId); 
    }elseif($action ==='saveAPIKey'){
        $userId = $_POST['userId'];
        $apiKey = $_POST['apiKey'];
        saveAPIKey($conn, $userId, $apiKey);
    }elseif($action ==='getAPIKey'){
        $userId = $_POST['userId'];
        getAPIKey($conn, $userId);
    }elseif($action === 'get_all_messages'){
        $stdNumber = $_POST['stdNumber'];
        get_all_messages($conn, $stdNumber);
    }elseif($action === 'fetchTimetableData'){
        $studentId = $_POST['studentId'];
        fetchTimetableData($conn, $studentId);
    }elseif($action ==='createMessage'){
        $studentId = $_POST['studentId'];
        $to = $_POST['to'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $attachment = $_POST['attachment'];
        createMessage($conn, $studentId, $to, $subject, $message, $attachment);
    }elseif($action ==='statusChange'){
        $messageId = $_POST['messageId'];
        changeMessageStatus($conn, $messageId);
    }elseif($action === 'fetchTextbooks'){
        $courseId = $_POST['courseId'];
        fetchTextbooks($conn, $courseId);
    }elseif($action ==='uploadTextbook'){
        $courseId = $_POST['selectedCourseId'];
        $file = $_FILES['bookFile'];
        uploadTextbook($conn, $file, $courseId);
    }elseif($action === 'deleteTextbook'){
        $courseId = $_POST['courseId'];
        $textbookName = $_POST['textbookName'];
        deleteTextbook($conn, $courseId, $textbookName);
    }elseif($action === 'fetchWebresources'){
        $courseId = $_POST['courseId'];
        fetchWebresources($conn, $courseId);
    }elseif($action ==='saveWebresource'){
        $courseId = $_POST['courseId'];
        $webresource = $_POST['webresource'];
        saveWebresource($conn, $webresource, $courseId);
    }elseif($action === 'deleteWebresource'){
        $courseId = $_POST['courseId'];
        $webresourceName = $_POST['webresourceName'];
        deleteWebresource($conn, $courseId, $webresourceName);
    }elseif($action === 'createCourse'){
        $formData = $_POST;
        createCourse($conn, $formData);
    }elseif($action === 'fetchCourseAndLectureDetails'){
        $courseId = $_POST['courseId'];
        fetchCourseAndLectures($conn, $courseId);
    }elseif($action === 'editCourse'){
        $formData = $_POST;
        updateCourseAndLectures($conn, $formData);
    }elseif($action ==='getResponseOrigin'){
        $courseId = $_POST['courseId'];
        getResponseOrigin($conn, $courseId);
    }elseif($action === 'saveResources'){
        $courseId = $_POST['courseId'];
        $selectedResources = $_POST['selectedResources'];
        saveResources($conn, $courseId, $selectedResources);
    }elseif($action === 'getPureCourses'){
        getPureCourses($conn);
    }elseif($action === 'updateApiKeys'){
        updateApiKeys($conn, $_POST['studentId'], $_POST['coursesToUpdate']);
    }elseif($action === 'deleteApiKeys'){
        deleteApiKeys($conn,  $_POST['coursesToDeleteApiKey']);
    }elseif($action === 'fetchBaseSettings'){
        $courseId = $_POST['courseId'];
        fetchBaseSettings($conn, $courseId);
    }elseif($action === 'fetchSemesterGrades'){
        $studentId = $_POST['studentId'];
        $courseId = $_POST['courseId'];
        processGrades($conn, $studentId, $courseId);
    }elseif($action === 'saveWeights'){
        $formData = $_POST;
        saveWeights($conn, $formData);
    }elseif($action === 'fetchClassGrades'){
        $courseId = $_POST['courseId'];
        $selectedField = $_POST['selectedField'];
        fetchClassGrades($conn, $courseId, $selectedField);
    } elseif ($action === 'fetchStudentsForCourse') {
        $courseId = $_POST['courseId'];
        fetchStudentsForCourse($conn, $courseId);
    }elseif ($action === 'fetchCourseList') {
        $courseId = $_POST['courseId'];
        fetchCourseList($conn, $courseId); 
    }elseif($action === 'fetchLectureScores'){
        $studentId = $_POST['studentId'];
        $courseId = $_POST['courseId'];
        $topicId = $_POST['topicId'];
        fetchLectureScores($conn, $studentId, $courseId, $topicId);
    }elseif ($action==='updateCourseCreatedBy'){
        $courseId = $_POST['courseId'];
        $stdNumber = $_POST['stdNumber'];
        updateCourseCreatedBy($conn, $courseId, $stdNumber);
    }elseif ($action==='getStudentsRequestList'){
        $myId = $_POST['teacherId'];
        $courseId = $_POST['courseId'];
        getStudentsRequestList($conn, $myId, $courseId);
    }elseif ($action==='updateApprovalStatus'){
        $studentId = $_POST['studentId'];
        $approvalStatus =$_POST['approvalStatus'];
        $courseId = $_POST['courseId'];
        updateApprovalStatus($conn, $studentId, $courseId, $approvalStatus);
    }elseif ($action === 'getGeneralApiKey'){
        getGeneralApiKey($conn);
    }elseif ($action === 'getInstructorList'){
        $studentId = $_POST['studentId'];
        getInstructorList($conn, $studentId);
    }elseif ($action === 'getstudentsList'){
        $studentId = $_POST['studentId'];
        getInstructorList($conn, $studentId);
    }elseif ($action === 'emailInstructor') {
        emailInstructor($conn, $_POST);
    }elseif ($action === 'uploadTempFile'){
        $stdNumber = $_POST['stdNumber']; // Assuming 'stdNumber' is passed in the POST data
        $file = $_FILES['file']; // Access the uploaded file data
        $result = uploadTempFile($conn, $stdNumber, $file);
        // Return a JSON response
        echo json_encode($result);
    }elseif ($action ==='checkExamStatus'){
        $studentId = $_POST['studentId'];
        $courseId = $_POST['courseId'];
        $examType = $_POST['examType'];
        checkExamStatus($conn, $studentId, $courseId, $examType);
    }elseif ($action ==='updateExamStatus'){
        $studentId = $_POST['studentId'];
        $courseId = $_POST['courseId'];
        $examType = $_POST['examType'];
        $status = $_POST['status'];
        updateExamStatus($conn, $studentId, $courseId, $examType, $status);
    }elseif ($action ==='saveQuestionBank'){
        $questionBank = $_POST['questionBank'];
        $courseId = $_POST['courseId'];
        $topicId = $_POST['topicId'];
        saveQuestionBank($conn, $courseId, $topicId, $questionBank);
    }elseif ($action ==='getQuestionBank'){
        $courseId = $_POST['courseId'];
        $topicId = $_POST['topicId'];
        getQuestionBank($conn, $courseId, $topicId);
    }elseif ($action ==='getAdminDashboardData'){
        $studentId = $_POST['teacherId'];
        getAdminDashboardData($conn, $studentId);
    }elseif ($action === 'validateSession'){
        $token = $_POST['token'];
        validateSession($conn, $token);
        
    }elseif ($action === 'updateUserProfile'){
     $name = "jeries";
     $phone = "098654";
     $address = "lefkosa";
     $photo = $_FILES["photo"];
     $photoName="jery.jpg";
     $email="vmercel@gmail.com";
     updateUserProfile($conn, $email, $name, $address, $phone, $photo, $photoName);
    } else {
        echo 'Invalid action';
    }
}
}
function uploadPhoto($file) {
   
    $uploadDir = '../uploads/';
  
    if (!file_exists($uploadDir) && !mkdir($uploadDir, 0777, true)) {
        return false;
    }

    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $maxSize = 5000000;

    $fileName = basename($file['name']);
    $targetFilePath = $uploadDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

 
    if (in_array($file['type'], $allowedTypes)) {
    
        if ($file['size'] <= $maxSize) {
         
            if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
                return $targetFilePath;
            } else {
                return false; 
            }
        } else {
            return false;
        }
    } else {
        return false; 
    }
}

function updateUserProfile($conn, $email, $name, $address, $phone, $photo, $photoName) {

    if ($photoName) {
        $sql = "UPDATE users SET name = ?, address = ?, phone = ?, photo = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $name, $address, $phone, $photoName, $email);
    } else {
        $sql = "UPDATE users SET name = ?, address = ?, phone = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $address, $phone, $email);
    }

    if ($stmt->execute()) {
        $stmt->close();

       
    }

    if (empty($email) || empty($name) || empty($address) || empty($phone)) {
        return false; 
    }

    if ($photo !== null && isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $photo = uploadPhoto($_FILES['photo']);
        if (!$photo) {
            return false; 
        }
    }
}

// Function to insert or update grade data
function insertOrUpdateGrade($conn, $studentId, $courseId, $topic, $score, $accuracy, $promptEfficiency, $timeEfficiency, $total)
{

    //HANDLE MID TERM AND FINAL EXAMS FIRST
        // Check if the studentId and courseId already exist in the semester_grades table
        $query = "SELECT * FROM semester_grades WHERE studentId = '$studentId' AND courseId = '$courseId'";
        $result = mysqli_query($conn, $query);
        
        if (mysqli_num_rows($result) > 0) {
            // Student and course combination already exists in the table
            $row = mysqli_fetch_assoc($result);
            
            // Update values based on topic
            if (($topic === 'Lecture 9' || $topic === 'Mid Term Exam') && isset($row['midTerm'])) {
                // Update midTerm if already exists
                $updateQuery = "UPDATE semester_grades SET midTerm = $total WHERE studentId = '$studentId' AND courseId = '$courseId'";
                mysqli_query($conn, $updateQuery);
            } else if (($topic === 'Lecture 14' || $topic === 'Final Exam') && isset($row['finalExam'])) {
                // Update finalExam if already exists
                $updateQuery = "UPDATE semester_grades SET finalExam = $total WHERE studentId = '$studentId' AND courseId = '$courseId'";
                mysqli_query($conn, $updateQuery);
            } else {
                // Insert new row based on topic
                $updateColumn = $topic === 'Mid Term Exam' ? 'midTerm' : 'finalExam';
                $updateQuery = "UPDATE semester_grades SET $updateColumn = $total WHERE studentId = '$studentId' AND courseId = '$courseId'";
                mysqli_query($conn, $updateQuery);
            }
        } else {
            // Insert new row with studentId, courseId, and appropriate field based on topic
            $updateColumn = $topic === 'Mid Term Exam' ? 'midTerm' : 'finalExam';
            $insertQuery = "INSERT INTO semester_grades (studentId, courseId, $updateColumn) VALUES ('$studentId', '$courseId', $total)";
            mysqli_query($conn, $insertQuery);
        }



    // Retrieve existing data for the student and course
    $sql = "SELECT * FROM grades WHERE studentId = '$studentId' AND courseId = '$courseId'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        // Data already exists, update the arrays
        $row = $result->fetch_assoc();
        $topics = unserialize($row['topics']);
        $scores = unserialize($row['scores']);
        $accuracies = unserialize($row['accuracy']);
        $promptEfficiencies = unserialize($row['promptEfficiency']);
        $timeEfficiencies = unserialize($row['timeEfficiency']);
        $totals = unserialize($row['total']);
        // Check if the topic exists in the array
        $topicIndex = array_search($topic, $topics);
        // echo "TOPIC INDEX: ".$topicIndex;
        // echo "\n SCORES: ".json_encode($scores);
        // echo "\n TOPICS: ".json_encode($topics);
        // echo "\n AC: ".json_encode($accuracies);
        // echo "\n PE: ".json_encode($promptEfficiencies);
        // echo "\n TE: ".json_encode($timeEfficiencies);
        // echo "\n TOT: ".json_encode($totals);

        if ($topicIndex !== false) {
            // Topic already exists, update the score at the corresponding index
            $scores[$topicIndex] = $score;
            $accuracies[$topicIndex] = $accuracy;
            $promptEfficiencies[$topicIndex] = $promptEfficiency;
            $timeEfficiencies[$topicIndex] = $timeEfficiency;
            $totals[$topicIndex] = $total;
        } else {
            // Topic does not exist, add it to the arrays
            $topics[] = $topic;
            $scores[] = $score;
            $accuracies[] = $accuracy;
            $promptEfficiencies[] = $promptEfficiency;
            $timeEfficiencies[] = $timeEfficiency;
            $totals[] = $total;
        }

        // Update the dateModified field with the current datetime
        $dateModified = date('Y-m-d H:i:s');

        // Update the data in the grades table
        $topicsSerialized = serialize($topics);
        $scoresSerialized = serialize($scores);
        $accuracySerialized = serialize($accuracies);
        $promptEfficiencySerialized = serialize($promptEfficiencies);
        $timeEfficiencySerialized = serialize($timeEfficiencies);
        $totalSerialized = serialize($totals);

        $sql = "UPDATE grades SET topics = '$topicsSerialized', scores = '$scoresSerialized', dateModified = '$dateModified', accuracy='$accuracySerialized', promptEfficiency='$promptEfficiencySerialized', timeEfficiency='$timeEfficiencySerialized', total='$totalSerialized' 
                WHERE studentId = '$studentId' AND courseId = '$courseId'";


        // $sql = "UPDATE grades SET dateModified = '$dateModified' WHERE studentId = '$studentId' AND courseId = '$courseId'";
        if ($conn->query($sql) === TRUE) {
            // Calculate the average score
            $averageScore = array_sum($scores) / count($scores);

            // Update the total field with the average score
            //$sql = "UPDATE grades SET promptEfficiency = '$averageScore' WHERE studentId = '$studentId' AND courseId = '$courseId'";
            //$conn->query($sql);

            echo "Warning!, You are allowed to take the Quiz only once.";
        } else {
            echo "Error updating grade data: " . $conn->error;
        }
    } else {
        // Data does not exist, insert a new record
        $topics = array($topic);
        $scores = array($score);
        $accuracies = array($accuracy);
        $promptEfficiencies = array($promptEfficiency);
        $timeEfficiencies = array($timeEfficiency);
        $totals = array($total);
        $topicsSerialized = serialize($topics);
        $scoresSerialized = serialize($scores);
        $accuracySerialized = serialize($accuracies);
        $promptEfficiencySerialized = serialize($promptEfficiencies);
        $timeEfficiencySerialized = serialize($timeEfficiencies);
        $totalSerialized = serialize($totals);
        $dateModified = date('Y-m-d H:i:s');
        $sql = "INSERT INTO grades (studentId, courseId, topics, scores, dateModified, accuracy, promptEfficiency, timeEfficiency, total) 
                VALUES ('$studentId', '$courseId', '$topicsSerialized', '$scoresSerialized', '$dateModified', '$accuracySerialized', '$promptEfficiencySerialized', '$timeEfficiencySerialized', '$totalSerialized')";

        if ($conn->query($sql) === TRUE) {
            echo "Grade data inserted successfully.";
        } else {
            echo "Error inserting grade data: " . $conn->error;
        }
    }

    $conn->close();
}




function fetchGrades($conn, $studentId, $courseId, $topicId)
{
    
    // Lets get the topic name
    $sql0 = mysqli_query($conn, "SELECT lectureTitle FROM lectures WHERE lectureId = '$topicId' and courseId = '$courseId'");
    $narr = mysqli_fetch_assoc($sql0);
    $topicName = $topicId;// 
    $displayTopicName = $narr['lectureTitle'];

    $sql = "SELECT topics, scores, dateModified, accuracy, promptEfficiency, timeEfficiency, total FROM grades WHERE studentId = '$studentId' AND courseId = '$courseId'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $topics = unserialize($row['topics']);
        $index = array_search($topicName, $topics);

if ($index === false){
    echo json_encode(null);
} else{
        $scores = unserialize($row['scores']);
        $dateModified = $row['dateModified'];
        $ac = unserialize($row['accuracy']);
        $pe = unserialize($row['promptEfficiency']);
        $te = unserialize($row['timeEfficiency']);
        $total = unserialize($row['total']);

        $data = array(
            'topics' => $displayTopicName, //$topics[$index],
            'scores' => $scores[$index],
            'dateModified' => $dateModified,
            'accuracy' => $ac[$index],
            'promptEfficiency' => $pe[$index],
            'timeEfficiency' => $te[$index],
            'total' => $total[$index]
        );

        echo json_encode($data);
}

    } else {
        echo json_encode(null);
    }

    $conn->close();
}



//SAVE INSTRUCTIONS
function saveSectionInstructions($conn, $courseId, $topicId, $sectionName, $instructions, $duration, $image)
{
    $targetDir = '../coursefiles/'; // Directory where the images will be stored
    $targetFile = $targetDir . basename($image['name']);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the uploaded file is an image
    $check = getimagesize($image['tmp_name']);
    if ($check === false) {
        echo json_encode(['success' => false, 'message' => 'Invalid image file.']);
        return;
    }

    // Check if the file already exists
    // if (file_exists($targetFile)) {
    //     echo json_encode(['success' => false, 'message' => 'File already exists.']);
    //     return;
    // }

    // Check the file size (limit it to 5MB in this example)
    if ($image['size'] > 5242880) {
        echo json_encode(['success' => false, 'message' => 'File size exceeds the limit.']);
        return;
    }

    // Allow only specific file formats (you can modify this as needed)
    if ($imageFileType !== 'gif' && $imageFileType !== 'jpg' && $imageFileType !== 'jpeg' && $imageFileType !== 'png' && $imageFileType !== 'mp4') {
        echo json_encode(['success' => false, 'message' => 'Only JPG, JPEG, and PNG files are allowed.']);
        return;
    }

    // Move the uploaded file to the target directory
    if (move_uploaded_file($image['tmp_name'], $targetFile)) {
        // Save the instructions and other details in the database
        // Get the next section ID
        $sql = "SELECT COUNT(*) + 1 AS next_section_id FROM sections";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $next_section_id = $row['next_section_id'];

        // Store the next section ID in the $sectionId variable
        $sectionId = 'PH' . $next_section_id;


        $instructionsJSON = json_encode($instructions);

        // Prepare the SQL statement to insert the instructions into the sections table
        $sql = "INSERT INTO sections (sectionId, courseId, topicId, sectionName, instructions, duration, image) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssis", $sectionId, $courseId, $topicId, $sectionName, $instructionsJSON, $duration, $targetFile);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Instructions saved successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to save instructions in the database.']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to upload the image.']);
    }

    $conn->close();
}

//SAVE INSTRUCTIONS WITHOUT IMAGE 
function saveSectionInstructions_noUpload($conn, $courseId, $topicId, $sectionName, $instructions, $duration, $image)
{
    
    $targetFile = $image;
    


    // Move the uploaded file to the target directory
    if ( $targetFile) {
        // Save the instructions and other details in the database
        // Get the next section ID
        $sql = "SELECT COUNT(*) + 1 AS next_section_id FROM sections";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $next_section_id = $row['next_section_id'];

        // Store the next section ID in the $sectionId variable
        $sectionId = 'PH' . $next_section_id;


        $instructionsJSON = json_encode($instructions);

        // Prepare the SQL statement to insert the instructions into the sections table
        $sql = "INSERT INTO sections (sectionId, courseId, topicId, sectionName, instructions, duration, image) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssis", $sectionId, $courseId, $topicId, $sectionName, $instructionsJSON, $duration, $targetFile);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Instructions saved successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to save instructions in the database.']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to upload the image.']);
    }

    $conn->close();
}

//DELETE SECTION INSTRUCTIONS
function deleteSectionInstructions($conn, $courseId, $topicId, $sectionName) {

    // Prepare DELETE query
    $sql = "DELETE FROM sections WHERE courseId = ? AND topicId = ? AND sectionName = ?";
  
    $stmt = $conn->prepare($sql);
  
    // Bind parameters
    $stmt->bind_param("sss", $courseId, $topicId, $sectionName);
  
    if($stmt->execute()) {
      echo json_encode(['success' => true, 'message' => 'Instructions deleted successfully']); 
    } else {
      echo json_encode(['success' => false, 'message' => 'Failed to delete instructions']);
    }
  
    $stmt->close();
    $conn->close();
  
  }

//UPDATE SECTION INSTRUCTION
function updateSectionInstructions($conn, $sectionId, $courseId, $topicId, $sectionName, $instructions, $duration, $image)
{
    $targetDir = '../coursefiles/'; // Directory where the images will be stored
    $targetFile = $targetDir . basename($image['name']);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the uploaded file is an image
    $check = getimagesize($image['tmp_name']);
    if ($check === false) {
        echo json_encode(['success' => false, 'message' => 'Invalid image file.']);
        return;
    }

    // Check the file size (limit it to 5MB in this example)
    if ($image['size'] > 5242880) {
        echo json_encode(['success' => false, 'message' => 'File size exceeds the limit.']);
        return;
    }

    // Allow only specific file formats (you can modify this as needed)
    if ($imageFileType !== 'gif' && $imageFileType !== 'jpg' && $imageFileType !== 'jpeg' && $imageFileType !== 'png' && $imageFileType !== 'mp4') {
        echo json_encode(['success' => false, 'message' => 'Only JPG, JPEG, and PNG files are allowed.']);
        return;
    }

    // Move the uploaded file to the target directory
    if (move_uploaded_file($image['tmp_name'], $targetFile)) {
        // Save the instructions and other details in the database

        $instructionsJSON = json_encode($instructions);

        // Prepare the SQL statement to update the instructions in the sections table
        $sql = "UPDATE sections SET courseId=?, topicId=?, sectionName=?, instructions=?, duration=?, image=? WHERE sectionId=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssiss", $courseId, $topicId, $sectionName, $instructionsJSON, $duration, $targetFile, $sectionId);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Instructions saved successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to save instructions in the database.']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to upload the image.']);
    }

    $conn->close();
}

  

// FETCH INSTRUCTIONS
function getInstructionsByTopicID($topicId, $courseId, $conn) {
    $query = "SELECT * FROM sections WHERE topicId = '$topicId' AND courseId = '$courseId'";
    $result = mysqli_query($conn, $query);

    // Create an array to store the fetched instructions
    $instructions = array();

    // Iterate over the result set and populate the $instructions array
    while ($row = mysqli_fetch_assoc($result)) {
        // Decode the instructions array from JSON format
        $instructionMessages = json_decode($row['instructions']);

        $instruction = array(
            'message1' => $row['sectionName'],
            'image' => $row['image'],
            'duration' => $row['duration']
        );

        // Dynamically populate the instruction messages
        for ($i = 0; $i < count($instructionMessages); $i++) {
            $messageKey = 'message' . ($i + 2); // Increment the message key dynamically
            $instruction[$messageKey] = $instructionMessages[$i];
        }

        // Add the instruction to the $instructions array
        $instructions[] = $instruction;
    }

    // Sort the instructions array so that any of its elements whose 'message1' key is 'Quiz' should be the last element in the instructions array
    $quizInstructions = array();
    $otherInstructions = array();
    foreach ($instructions as $instruction) {
        if ($instruction['message1'] === 'Quiz') {
            $quizInstructions[] = $instruction;
        } else {
            $otherInstructions[] = $instruction;
        }
    }
    $instructions = array_merge($otherInstructions, $quizInstructions);

    // Convert the $instructions array to JSON format
    $instructionsJson = json_encode($instructions);

    // Close the database connection
    mysqli_close($conn);

    // Return the instructions as JSON response
    header('Content-Type: application/json');
    echo $instructionsJson;
    exit; // Terminate the script after echoing the JSON response
}


// FETCH INSTRUCTIONS

    function getPhaseInfo($conn, $sectionId) {
        // Query to fetch a single row from the sections table where sectionId is $sectionId
        $query = "SELECT * FROM sections WHERE sectionId='$sectionId'";
    
        // Execute the query and fetch the result
        $result = mysqli_query($conn, $query);
    
        // Fetch the single row
        $row = mysqli_fetch_assoc($result);
    
        // Echo the JSON encoded array of field names and field data
        echo json_encode($row);
    }


//SUBSCRIBE OR UNSUBSCRIBE FROM COURSE
// Function to subscribe to a course
function subscribeToCourse($conn, $studentId, $courseId) {
    $query = "INSERT INTO subscriptions (`studentId`, `courseId`, `status`) VALUES ('$studentId', '$courseId', 'Subscribed')";
    $result = mysqli_query($conn, $query);

    if ($result) {
                    // Prepare the query
                    $stmt2 = $conn->prepare("SELECT name, email FROM users WHERE stdnumber=?");
                    // Bind parameters
                    $stmt2->bind_param("s", $studentId);
                    // Execute the query
                    $stmt2->execute();
                    // Bind result variables
                    $stmt2->bind_result($name,$email);
                    // Fetch the result
                    $stmt2->fetch();
                    // Close the statement
                    $stmt2->close();
                    // Close the connection
                    $conn->close();
                    // Call the sendEmail function
                    sendEmail($email, 'Dear '.$name.'<br> Your subscription request to the course '.$courseId.' has been sent to the Instructor. Please wait for the confirmation of your subscription. <br><br> Mercel from DUX.');
        
        $response = array('success' => true, 'message' => 'Subscribed to the course successfully');
    } else {
        $response = array('success' => false, 'message' => 'Failed to subscribe to the course');
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

// Function to unsubscribe from a course
function unsubscribeFromCourse($conn, $studentId, $courseId) {
    $query = "DELETE FROM `subscriptions` WHERE `studentId`= '$studentId' AND `courseId` = '$courseId'";
    $result = mysqli_query($conn, $query);

    if ($result) {

                    // Prepare the query
                    $stmt2 = $conn->prepare("SELECT name, email FROM users WHERE stdnumber=?");
                    // Bind parameters
                    $stmt2->bind_param("s", $studentId);
                    // Execute the query
                    $stmt2->execute();
                    // Bind result variables
                    $stmt2->bind_result($name,$email);
                    // Fetch the result
                    $stmt2->fetch();
                    // Close the statement
                    $stmt2->close();
                    // Close the connection
                    $conn->close();
                    // Call the sendEmail function
                    sendEmail($email, 'Dear '.$name.'<br>You have successfully ubsubscribed from the course '.$courseId.'. <br><br> Mercel from DUX.');
        

        $response = array('success' => true, 'message' => 'Unsubscribed from the course successfully');
    } else {
        $response = array('success' => false, 'message' => 'Failed to unsubscribe from the course');
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

// Function to fetch the list of courses
// function fetchCourses($conn) {
//     $query = "SELECT * FROM courses";
//     $result = mysqli_query($conn, $query);

//     // Create an array to store the fetched courses
//     $courses = array();

//     // Iterate over the result set and populate the $courses array
//     while ($row = mysqli_fetch_assoc($result)) {
//         $course = array(
//             'id' => $row['courseId'],
//             'name' => $row['courseName']
//         );

//         // Add the course to the $courses array
//         $courses[] = $course;
//     }

//     // Convert the $courses array to JSON format
//     $coursesJson = json_encode($courses);

//     // Close the database connection
//     mysqli_close($conn);

//     // Return the courses as JSON response
//     header('Content-Type: application/json');
//     echo $coursesJson;
// }
// function fetchCourses($conn, $studentId) {
//     $query = "SELECT
//     courses.courseId,
//     courses.courseName,
//     subscriptions.studentId,
//     users.email,
//     users.name
// FROM
//     courses
// LEFT JOIN
//     subscriptions
// ON
//     courses.courseId = subscriptions.courseId
//     AND subscriptions.studentId = '$studentId'
// LEFT JOIN
//     users
// ON
//     courses.createdBy = users.stdNumber;";
    
//     $result = mysqli_query($conn, $query);

//     // Create an array to store the fetched courses
//     $courses = array();

//     // Iterate over the result set and populate the $courses array
//     while ($row = mysqli_fetch_assoc($result)) {
//         $status = ($row['studentId'] == $studentId) ? "Subscribed" : "Not Subscribed";
//         $course = array(
//             'id' => $row['courseId'],
//             'name' => $row['courseName'],
//                         'tname' => $row['name'],
//             'temail' => $row['email'],
//             'status' => $status
//         );

//         // Add the course to the $courses array
//         $courses[] = $course;
//     }

//     // Convert the $courses array to JSON format
//     $coursesJson = json_encode($courses);

//     // Close the database connection
//     mysqli_close($conn);

//     // Return the courses as JSON response
//     header('Content-Type: application/json');
//     echo $coursesJson;
// }


function fetchCourses($conn, $studentId) {
    // Determine the current semester based on the current date
    $currentDate = date('Y-m-d');
    $currentSemester = '';
    
    // Determine the current semester based on your academic calendar
    // For example, you may need to check the month and day to determine the semester
    // You can modify this logic as per your academic calendar
    // Example logic for Fall (September 1st to December 31st), Spring (January 1st to April 30th), and Summer (May 1st to August 31st):
    $month = date('m', strtotime($currentDate));
    if ($month >= 1 && $month <= 4) {
        $currentSemester = 'Spring';
    } elseif ($month >= 5 && $month <= 8) {
        $currentSemester = 'Summer';
    } else {
        $currentSemester = 'Fall';
    }

    // Modify your SQL query to include the current semester constraint
    $query = "SELECT
        courses.courseId,
        courses.courseName,
        courses.courseSemester,  -- Add this line
        subscriptions.studentId,
        users.email,
        users.name
    FROM
        courses
    LEFT JOIN
        subscriptions
    ON
        courses.courseId = subscriptions.courseId
        AND subscriptions.studentId = '$studentId'
    LEFT JOIN
        users
    ON
        courses.createdBy = users.stdNumber
    WHERE
        courses.courseSemester = '$currentSemester';";  // Add this line

    $result = mysqli_query($conn, $query);

    // Create an array to store the fetched courses
    $courses = array();

    // Iterate over the result set and populate the $courses array
    while ($row = mysqli_fetch_assoc($result)) {
        $status = ($row['studentId'] == $studentId) ? "Subscribed" : "Not Subscribed";
        $course = array(
            'id' => $row['courseId'],
            'name' => $row['courseName'],
            'tname' => $row['name'],
            'temail' => $row['email'],
            'status' => $status
        );

        // Add the course to the $courses array
        $courses[] = $course;
    }

    // Convert the $courses array to JSON format
    $coursesJson = json_encode($courses);

    // Close the database connection
    mysqli_close($conn);

    // Return the courses as JSON response
    header('Content-Type: application/json');
    echo $coursesJson;
}



function fetchCoursesTeacher($conn, $studentId) {
    // $query = "SELECT courses.courseId, courses.courseName, subscriptions.studentId
    //           FROM courses
    //           LEFT JOIN subscriptions ON courses.courseId = subscriptions.courseId
    //                                     AND subscriptions.studentId = '$studentId'
    //                                     AND courses.createdBy='$studentId'";
    
    $query = "SELECT courseId, courseName, createdBy FROM courses WHERE createdBy = '$studentId'";
    $result = mysqli_query($conn, $query);

    // Create an array to store the fetched courses
    $courses = array();

    // Iterate over the result set and populate the $courses array
    while ($row = mysqli_fetch_assoc($result)) {
        $status = ($row['createdBy'] == $studentId) ? "Assigned" : "Not Assigned";
        $course = array(
            'id' => $row['courseId'],
            'name' => $row['courseName'],
            'status' => $status
        );

        // Add the course to the $courses array
        $courses[] = $course;
    }

    // Convert the $courses array to JSON format
    $coursesJson = json_encode($courses);

    // Close the database connection
    mysqli_close($conn);

    // Return the courses as JSON response
    header('Content-Type: application/json');
    echo $coursesJson;
}

function fetchApprovedCourses($conn, $studentId) {
    $query = "SELECT courses.courseId, courses.courseName, subscriptions.studentId, subscriptions.approval
              FROM courses
              LEFT JOIN subscriptions ON courses.courseId = subscriptions.courseId
                                        AND subscriptions.studentId = '$studentId'";
    $result = mysqli_query($conn, $query);

    // Create an array to store the fetched courses
    $courses = array();

    // Iterate over the result set and populate the $courses array
    while ($row = mysqli_fetch_assoc($result)) {
        $status = ($row['studentId'] == $studentId && $row['approval'] == 'Approved') ? "Approved" : "Not Approved";
        $course = array(
            'id' => $row['courseId'],
            'name' => $row['courseName'],
            'status' => $status
        );

        // Add the course to the $courses array
        $courses[] = $course;
    }

    // Convert the $courses array to JSON format
    $coursesJson = json_encode($courses);

    // Close the database connection
    mysqli_close($conn);

    // Return the courses as JSON response
    header('Content-Type: application/json');
    echo $coursesJson;
}

function fetchCoursesForUser($studentId, $conn) {
    $query = "SELECT subscriptions.courseId, courses.courseName FROM subscriptions
    INNER JOIN courses ON subscriptions.courseId = courses.courseId
    WHERE subscriptions.studentId = '$studentId'
    AND subscriptions.approval = 'Approved'";
    $result = mysqli_query($conn, $query);
    $courses = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $course = array(
            'id' => $row['courseId'],
            'name' => $row['courseName']
        );
    
        $courses[] = $course;
    }
    
    $response = array(
        'success' => true,
        'courses' => $courses
    );
    
    mysqli_close($conn);
    
    header('Content-Type: application/json');
    echo json_encode($response);
}    

function fetchCoursesForUserTeacher($studentId, $conn) {
    // $query = "SELECT subscriptions.courseId, courses.courseName FROM subscriptions
    // INNER JOIN courses ON subscriptions.courseId = courses.courseId
    // WHERE subscriptions.studentId = '$studentId'
    // AND courses.createdBy = '$studentId'";
    $query = "SELECT courseId, courseName, createdBy FROM courses WHERE createdBy = '$studentId'";
    $result = mysqli_query($conn, $query);
    $courses = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $course = array(
            'id' => $row['courseId'],
            'name' => $row['courseName']
        );
    
        $courses[] = $course;
    }
    
    $response = array(
        'success' => true,
        'courses' => $courses
    );
    
    mysqli_close($conn);
    
    header('Content-Type: application/json');
    echo json_encode($response);
}  

function fetchCoursesForUserAdmin($studentId, $conn) {
    $query = "SELECT subscriptions.courseId, courses.courseName FROM subscriptions
    INNER JOIN courses ON subscriptions.courseId = courses.courseId
    WHERE subscriptions.studentId = '$studentId'";
    $result = mysqli_query($conn, $query);
    $courses = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $course = array(
            'id' => $row['courseId'],
            'name' => $row['courseName']
        );
    
        $courses[] = $course;
    }
    
    $response = array(
        'success' => true,
        'courses' => $courses
    );
    
    mysqli_close($conn);
    
    header('Content-Type: application/json');
    echo json_encode($response);
}  
// fetching courses generally for the admin's dropdown:
    function getCourses($conn) {
        // Query to fetch unique courseId from sections table
        $query = "SELECT DISTINCT courseId FROM sections";
    
        // Execute the query and fetch the result
        $result = mysqli_query($conn, $query);
    
        // Initialize an empty array to store the course data
        $courses = array();
    
        // Loop through the result and get the corresponding courseName from courses table
        while ($row = mysqli_fetch_assoc($result)) {
            $courseId = $row['courseId'];
            $query2 = "SELECT courseName FROM courses WHERE courseId='$courseId'";
            $result2 = mysqli_query($conn, $query2);
            $row2 = mysqli_fetch_assoc($result2);
            $courseName = $row2['courseName'];
            $course = array("courseId" => $courseId, "courseName" => $courseName);
            array_push($courses, $course);
        }
    
        // Echo the JSON encoded array of courseId and courseName
        echo json_encode($courses);
    }

    function getCoursesTeacher($conn, $teacherId) {
        // Query to fetch unique courseId from sections table that match the createdBy value
        $query = "SELECT DISTINCT s.courseId, c.courseName FROM sections s INNER JOIN courses c ON s.courseId = c.courseId WHERE c.createdBy = '$teacherId'";
      
        // Execute the query and fetch the result
        $result = mysqli_query($conn, $query);
      
        // Initialize an empty array to store the course data
        $courses = array();
      
        // Loop through the result and fetch the courseId and courseName
        while ($row = mysqli_fetch_assoc($result)) {
          $courseId = $row['courseId'];
          $courseName = $row['courseName'];
          $course = array("courseId" => $courseId, "courseName" => $courseName);
          array_push($courses, $course);
        }
      
        // Echo the JSON-encoded array of courseId and courseName
        echo json_encode($courses);
      }

function fetchTopicsForCourse($courseId, $conn) {
    // $query = "SELECT topicId, MAX(sectionName) AS sectionName, id
    // FROM sections
    // WHERE courseId = '$courseId'
    // GROUP BY topicId
    // ORDER BY id";

    $query = "SELECT lectureId, lectureTitle FROM lectures WHERE courseId='$courseId' ";

    $result = mysqli_query($conn, $query);

    $topics = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $topic = array(
            'id' => $row['lectureId'],
            'name' => $row['lectureTitle']
        );

        $topics[] = $topic;
    }

    $response = array(
        'success' => true,
        'topics' => $topics
    );

    mysqli_close($conn);

    header('Content-Type: application/json');
    echo json_encode($response);
}



function fetchTopicsForCourseS($courseId, $conn) {
    // $query = "SELECT topicId, MAX(sectionName) AS sectionName, id
    // FROM sections
    // WHERE courseId = '$courseId'
    // GROUP BY topicId
    // ORDER BY id";


    // $query = "SELECT lectures.lectureId, lectures.lectureTitle, schedules.date FROM lectures JOIN schedules ON lectures.lectureId = schedules.topicId WHERE schedules.courseId = lectures.courseId AND schedules.courseId = '$courseId' AND schedules.date IS NOT NULL AND schedules.date != '' AND STR_TO_DATE(schedules.date, '%Y-%m-%d %H:%i:%s') <= NOW()";

    $query = "SELECT lectures.lectureId, lectures.lectureTitle, schedules.date 
          FROM lectures 
          JOIN schedules ON lectures.lectureId = schedules.topicId 
          WHERE schedules.courseId = lectures.courseId 
          AND schedules.courseId = '$courseId' 
          AND schedules.date IS NOT NULL 
          AND schedules.date != '' 
          AND STR_TO_DATE(schedules.date, '%Y-%m-%d %H:%i:%s') <= DATE_ADD(NOW(), INTERVAL 1 DAY)";

    $result = mysqli_query($conn, $query);

    $topics = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $topic = array(
            'id' => $row['lectureId'],
            'name' => $row['lectureTitle']
        );

        $topics[] = $topic;
    }

    $response = array(
        'success' => true,
        'topics' => $topics
    );

    mysqli_close($conn);

    header('Content-Type: application/json');
    echo json_encode($response);
}


function getPhaseById($conn, $courseId, $topicId) {
    // Query to fetch unique sectionId and corresponding sectionName for the given topicId
    $query = "SELECT DISTINCT sectionId, sectionName FROM sections WHERE topicId='$topicId' AND courseId = '$courseId'";

    // Execute the query and fetch the result
    $result = mysqli_query($conn, $query);

    // Initialize an empty array to store the section data
    $sections = array();

    // Loop through the result and add the section data to the array
    while ($row = mysqli_fetch_assoc($result)) {
        $sectionId = $row['sectionId'];
        $sectionName = $row['sectionName'];
        $section = array("sectionId" => $sectionId, "sectionName" => $sectionName);
        array_push($sections, $section);
    }

    // Echo the JSON encoded array of sectionIds and sectionNames
    echo json_encode($sections);
}


// Function to insert or update schedules
function insertOrUpdateSchedules($conn, $courseId, $schedules)
{
    foreach ($schedules as $schedule) {
        $topicId = $schedule['topicId'];
        $date = $schedule['date'];

        // Check if the row with the given scheduleId and topicId already exists in the schedules table
        $query = "SELECT * FROM schedules WHERE  topicId = ? AND courseId = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $topicId, $courseId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            // If the row exists, update the date
            $updateQuery = "UPDATE schedules SET date = ? WHERE topicId = ? AND courseId =?";
            $stmt = $conn->prepare($updateQuery);
            $stmt->bind_param("sss", $date, $topicId, $courseId);
            $stmt->execute();
        } else {
            $scheduleId = generateUniqueScheduleId($conn);
            // If the row does not exist, insert a new row
            $insertQuery = "INSERT INTO schedules (scheduleId, courseId, topicId, date) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($insertQuery);
            $stmt->bind_param("ssss", $scheduleId, $courseId, $topicId, $date);
            $stmt->execute();
        }
    }
}

// Function to generate unique scheduleId
function generateUniqueScheduleId($conn)
{
    // Get the row count from the schedules table
    $query = "SELECT COUNT(*) as count FROM schedules";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $rowCount = $row['count'];

    // Generate the unique scheduleId
    $scheduleId = 'SCH' . ($rowCount + 1);

    return $scheduleId;
}



function getScheduleByCourse($conn, $courseId)
{
    // Fetch schedule data for the selected courseId (replace with your actual query)
    $query = "SELECT topicId, date FROM schedules WHERE courseId = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $courseId);
    $stmt->execute();
    $result = $stmt->get_result();
    $scheduleData = $result->fetch_all(MYSQLI_ASSOC);

    // Return the schedule data as JSON response
    echo json_encode($scheduleData);
}


function saveUserMessage($conn, $userId, $message, $courseId) {
    // Prepare the SQL statement to insert the user's message into the classroomchat table
    $sql = "INSERT INTO classroomchat (courseId, userId, message, datetime) 
            VALUES (?, ?, ?, NOW())";
    
    // Prepare the SQL statement using prepared statements to prevent SQL injection
    $stmt = $conn->prepare($sql);
    
    // Bind the values to the prepared statement
    $stmt->bind_param("sss", $courseId, $userId, $message);
    
    // Execute the prepared statement
    $stmt->execute();
    
    // Check if the execution was successful
    if ($stmt->affected_rows > 0) {
      // Get the inserted message ID
      $messageId = $stmt->insert_id;
      
      // Prepare the SQL statement to retrieve the entire message history for the specific courseId
      $sql = "SELECT c.*, u.name, u.photo 
              FROM classroomchat AS c
              INNER JOIN users AS u ON c.userId = u.uid
              WHERE c.courseId = ?
              ORDER BY c.datetime ASC";
      
      // Prepare the SQL statement using prepared statements
      $stmt = $conn->prepare($sql);
      
      // Bind the courseId to the prepared statement
      $stmt->bind_param("s", $courseId);
      
      // Execute the prepared statement
      $stmt->execute();
      
      // Get the result set
      $result = $stmt->get_result();
      
      // Fetch the message history
      $messageHistory = array();
      while ($row = $result->fetch_assoc()) {
        $messageHistory[] = array(
          'id' => $row['id'],
          'message' => $row['message'],
          'datetime' => $row['datetime'],
          'user' => array(
            'id' => $row['userId'],
            'name' => $row['name'],
            'photo' => $row['photo']
          )
        );
      }
      
      // Prepare the response array
      $response = array(
        'success' => true,
        'messageHistory' => $messageHistory
      );
      
      // Retrieve the set of active logged-in users
      $sql = "SELECT id, name, photo 
              FROM users 
              WHERE status = 'Active'";
      
      // Execute the SQL statement
      $result = $conn->query($sql);
      
      if ($result) {
        // Fetch the logged-in user objects
        $loggedInUsers = array();
        while ($row = $result->fetch_assoc()) {
          $loggedInUsers[] = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'photo' => $row['photo']
          );
        }
        
        // Add the logged-in users to the response
        $response['loggedInUsers'] = $loggedInUsers;
      }
    } else {
      // Prepare the response in case of an error
      $response = array(
        'success' => false,
        'message' => 'Failed to save message.'
      );
    }
    
    // Convert the response to JSON format
    $jsonResponse = json_encode($response);
    
    // Set the response header to indicate JSON content
    header('Content-Type: application/json');
    
    // Echo the JSON response
    echo $jsonResponse;
  }


  function saveOrRetrieveMessages($conn, $userId, $message, $courseId) {
    // Check if $message exists
    if ($message !== 'init') {
      // Prepare the SQL statement to insert the user's message into the classroomchat table
      $sql = "INSERT INTO classroomchat (courseId, userId, message, datetime) 
              VALUES (?, ?, ?, NOW())";
  
      // Prepare the SQL statement using prepared statements to prevent SQL injection
      $stmt = $conn->prepare($sql);
  
      // Bind the values to the prepared statement
      $stmt->bind_param("sss", $courseId, $userId, $message);
  
      // Execute the prepared statement
      $stmt->execute();
  
      // Check if the execution was successful
      if ($stmt->affected_rows > 0) {
        // Get the inserted message ID
        $messageId = $stmt->insert_id;
      } else {
        // Prepare the response in case of an error
        $response = array(
          'success' => false,
          'message' => 'Failed to save message.'
        );
  
        // Convert the response to JSON format
        $jsonResponse = json_encode($response);
  
        // Set the response header to indicate JSON content
        header('Content-Type: application/json');
  
        // Echo the JSON response
        echo $jsonResponse;
  
        return;
      }
    }
  
    // Prepare the SQL statement to retrieve the entire message history for the specific courseId
    $sql = "SELECT c.*, u.name, u.photo 
            FROM classroomchat AS c
            INNER JOIN users AS u ON c.userId = u.uid
            WHERE c.courseId = ?
            ORDER BY c.datetime ASC";
  
    // Prepare the SQL statement using prepared statements
    $stmt = $conn->prepare($sql);
  
    // Bind the courseId to the prepared statement
    $stmt->bind_param("s", $courseId);
  
    // Execute the prepared statement
    $stmt->execute();
  
    // Get the result set
    $result = $stmt->get_result();
  
    // Fetch the message history
    $messageHistory = array();
    while ($row = $result->fetch_assoc()) {
      $messageHistory[] = array(
        'id' => $row['id'],
        'message' => $row['message'],
        'datetime' => $row['datetime'],
        'user' => array(
          'id' => $row['userId'],
          'name' => $row['name'],
          'photo' => $row['photo']
        )
      );
    }
  
    // Prepare the response array
    $response = array(
      'success' => true,
      'messageHistory' => $messageHistory
    );
  
    // Retrieve the set of active logged-in users
    $sql = "SELECT id, name, photo 
            FROM users 
            WHERE status = 'Active'";
  
    // Execute the SQL statement
    $result = $conn->query($sql);
  
    if ($result) {
      // Fetch the logged-in user objects
      $loggedInUsers = array();
      while ($row = $result->fetch_assoc()) {
        $loggedInUsers[] = array(
          'id' => $row['id'],
          'name' => $row['name'],
          'photo' => $row['photo']
        );
      }
  
      // Add the logged-in users to the response
      $response['loggedInUsers'] = $loggedInUsers;
    }
  
    // Convert the response to JSON format
    $jsonResponse = json_encode($response);
  
    // Set the response header to indicate JSON content
    header('Content-Type: application/json');
  
    // Echo the JSON response
    echo $jsonResponse;
  }




  function saveAPIKey($conn, $userId, $apiKey) {
      // Prepare the SQL statement to update the 'apiKey' field in the 'users' table
      $sql = "UPDATE users SET apiKey = ? WHERE uid = ?";
  
      // Prepare and execute the SQL statement
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ss", $apiKey, $userId);
      $result = $stmt->execute();
  
      // Check if the update was successful
      if ($result) {
          echo json_encode(array('success' => true));
      } else {
          echo json_encode(array('success' => false));
      }
  }
  
  function getAPIKey($conn, $userId) {
      // Prepare the SQL statement to retrieve the 'apiKey' field from the 'users' table
      $sql = "SELECT apiKey FROM users WHERE uid = ?";
  
      // Prepare and execute the SQL statement
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $userId);
      $stmt->execute();
      $stmt->bind_result($apiKey);
      $stmt->fetch();
  
      // Return the retrieved API key as a JSON response
      echo json_encode(array('apiKey' => $apiKey));
  }
  

//FETCHING MESSAGES 




    function get_all_messages($conn, $stdNumber) {
        try {
            //get the user
            $sql1 = mysqli_query($conn, "SELECT * FROM users WHERE stdNumber = '$stdNumber'");
            $res1 = mysqli_fetch_assoc($sql1);
            $user_email = $res1['email'];
    // Fetch all messages for the user
    $all_messages_query = "SELECT * FROM messages WHERE recipient_email = '$user_email' OR is_common = 1 OR sender_email = '$user_email' ORDER BY sent_at DESC";
    $all_messages_result = mysqli_query($conn, $all_messages_query);
    $all_messages = mysqli_fetch_all($all_messages_result, MYSQLI_ASSOC);
  
    // Fetch all sent messages by the user
    $sent_messages_query = "SELECT * FROM messages WHERE sender_email = '$user_email' ORDER BY sent_at DESC";
    $sent_messages_result = mysqli_query($conn, $sent_messages_query);
    $sent_messages = mysqli_fetch_all($sent_messages_result, MYSQLI_ASSOC);
  
    // Fetch all unread messages for the user
    $unread_messages_query = "SELECT * FROM messages WHERE recipient_email = '$user_email' AND is_read = FALSE ORDER BY sent_at DESC";
    $unread_messages_result = mysqli_query($conn, $unread_messages_query);
    $unread_messages = mysqli_fetch_all($unread_messages_result, MYSQLI_ASSOC);
  
    // Fetch all read messages for the user
    $read_messages_query = "SELECT * FROM messages WHERE recipient_email = '$user_email' AND is_read = TRUE ORDER BY read_at DESC";
    $read_messages_result = mysqli_query($conn, $read_messages_query);
    $read_messages = mysqli_fetch_all($read_messages_result, MYSQLI_ASSOC);  
            // Construct messages array in the desired format
            $messages = [];
            foreach ($all_messages as $message) {
                $messages[] = array(
                    'id' => $message['id'],  // Assuming 'id' is the column name in your database
                    'from' => $message['sender_email'],
                    'subject' => $message['subject'],
                    'body' => $message['body'],
                    'is_read' => $message['is_read']
                );
            }
    
            // Build the response object
            $response = array(
                'messages' => $messages,
                'sent_messages' => $sent_messages ? $sent_messages : [],
                'unread_messages' => $unread_messages ? $unread_messages : [],
                'read_messages' => $read_messages ? $read_messages : [],
                'owner' => $user_email
            );
    
            // Encode the response object as a JSON string and output it
            header('Content-Type: application/json');
            echo json_encode($response);
        } catch (Exception $e) {
            // Handle any exceptions or errors
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(array('error' => 'An error occurred.'));
        }
    }



    function fetchTimetableData($conn, $studentId) {
        // Fetch the timetable data from the database
        $query = "SELECT courses.courseName, schedules.date, subscriptions.studentId, lectures.lectureTitle FROM courses, schedules, subscriptions, lectures WHERE courses.courseId = subscriptions.courseId AND subscriptions.studentId = '$studentId' AND schedules.topicId = lectures.lectureId AND subscriptions.courseId = schedules.courseId AND schedules.courseId=lectures.courseId AND schedules.date IS NOT NULL AND schedules.date <> ''";
        $result = mysqli_query($conn, $query);
      
        // Check for errors
        if (!$result) {
          echo 'Failed to fetch timetable data: ' . mysqli_error($conn);
          exit();
        }
      
        // Build an array of timetable data
        $timetableData = array();
        while ($row = mysqli_fetch_assoc($result)) {
          $courseName = $row['courseName'];
          $lectureTitle = $row['lectureTitle'];
          $date = $row['date'];
          $timetableData[$courseName][] = array(
            'lectureTitle' => $lectureTitle,
            'date' => $date
          );
        }
      
        // Echo the timetable data as JSON
        echo json_encode($timetableData);
      
        // Close the database connection
        mysqli_close($conn);
      }
 
      
      function createMessage($conn, $studentId, $to, $subject, $message, $attachment) {
        // Fetch the sender email from the users table using $studentId
        $senderEmail = '';
        $query = "SELECT email FROM users WHERE stdnumber = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $studentId);
        $stmt->execute();
        $stmt->bind_result($senderEmail);
        $stmt->fetch();
        $stmt->close();
      
        // Move the uploaded attachment to the uploads directory
        $attachmentPath = '';
        if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
          $attachmentTmpName = $_FILES['attachment']['tmp_name'];
          $attachmentName = $_FILES['attachment']['name'];
          $attachmentPath = '../uploads/' . $attachmentName;
          move_uploaded_file($attachmentTmpName, $attachmentPath);
        }
      
        // Prepare and execute the query to insert the message into the messages table
        $query = "INSERT INTO messages (sender_email, recipient_email, subject, body, attachment, sent_at, is_common, is_read, read_at) VALUES (?, ?, ?, ?, ?, NOW(), 0, 0, NULL)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssss", $senderEmail, $to, $subject, $message, $attachmentPath);
        $stmt->execute();
        $stmt->close();
      
        // Return a success message or any other response as needed
        $response = array(
            'status' => 'success',
            'message' => 'Message Sent Successfully.'
        );

        // Encode the response object as a JSON string and output it
        header('Content-Type: application/json');
        echo json_encode($response);
      }


// EMAIL INBOX CHANGE STATUS WHEN USER READS MESSAGE
function changeMessageStatus($conn, $messageId) {
    // Prepare and execute the query to update the is_read field for the given message ID
    $query = "UPDATE messages SET is_read = 1 WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $messageId);
    $stmt->execute();
    $stmt->close();
  
    echo "Message status changed successfully";
  }

// Assuming you already have a database connection stored in $conn

function fetchTextbooks($conn, $courseId) {
    $response = array();

    // Fetch the textbooks for the selected course using prepared statement
    $stmt = $conn->prepare("SELECT textBooks FROM courses WHERE courseId = ?");
    $stmt->bind_param("s", $courseId);
    $stmt->execute();
    $stmt->bind_result($textBooks);

    // Fetch result and populate response array
    if ($stmt->fetch()) {
        $textBooksArray = json_decode($textBooks, true); // Decode the JSON and convert to an associative array
        if (is_array($textBooksArray)) {
            $response = $textBooksArray;
        }
    }

    $stmt->close();
    echo json_encode($response); // Echo the JSON-encoded response directly
}







// Assuming you have established a database connection and stored it in the $conn variable

function uploadTextbook($conn, $file, $courseId) {
    // Specify the target directory
    $targetDirectory = '../uploads/';
  
    // Create the target directory if it doesn't exist
    if (!file_exists($targetDirectory)) {
      mkdir($targetDirectory, 0777, true);
    }
  
    // Generate a unique filename for the uploaded file
    $filename = basename($file['name']);
    $targetFile = $targetDirectory . $filename;
  
    // Move the file to the target directory
    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
      // File moved successfully
  
      // Fetch the existing textbooks array for the given course
      $query = "SELECT textBooks FROM courses WHERE courseId = ?";
      $stmt = $conn->prepare($query);
      $stmt->bind_param("s", $courseId);
      $stmt->execute();
      $stmt->bind_result($textBooks);
      $stmt->fetch();
      $stmt->close();
  
      if ($textBooks === null) {
        $textBooks = array($filename);
      } else {
        $textBooks = json_decode($textBooks);
        $textBooks[] = $filename;
      }
  
      // Update the textbooks array in the database
      $textBooksJson = json_encode($textBooks); // Store the JSON-encoded array in a variable
      $query = "UPDATE courses SET textBooks = ? WHERE courseId = ?";
      $stmt = $conn->prepare($query);
      $stmt->bind_param("ss", $textBooksJson, $courseId);
      $stmt->execute();
      $stmt->close();
  
      $response = array(
        'status' => 'success',
        'message' => 'File uploaded successfully.'
      );
  
      echo json_encode($response);
    } else {
      // Failed to move the file
  
      $response = array(
        'status' => 'error',
        'message' => 'Failed to move the uploaded file.'
      );
  
      echo json_encode($response);
    }
  }
  
  function deleteTextbook($conn, $courseId, $textbookName) {
    // Get the textbooks for the course.
    $sql = 'SELECT textBooks FROM courses WHERE courseId = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $courseId);
    $stmt->execute();
    $result = $stmt->get_result();
  
    // If the textbooks array is empty, return an error.
    if ($result->num_rows === 0) {
      return json_encode([
        'status' => 'error',
        'message' => 'Course not found.'
      ]);
    }
  
    // Decode the textbooks array from JSON.
    $textbooks = json_decode($result->fetch_assoc()['textBooks'], true);
  
    // Remove the textbookName from the array.
    $index = array_search($textbookName, $textbooks);
    if ($index !== false) {
      array_splice($textbooks, $index, 1);
  
      // Update the textBooks field in the database.
      $updatedTextbooks = json_encode($textbooks);
      $sql = 'UPDATE courses SET textBooks = ? WHERE courseId = ?';
      $stmt = $conn->prepare($sql);
      $stmt->bind_param('ss', $updatedTextbooks, $courseId);
      $stmt->execute();
      
                // Delete the textbook file from the directory.
        $textbooksDirectory = '../uploads'; // Update this with the actual directory path
        $filePath = $textbooksDirectory . '/' . $textbookName;
        if (file_exists($filePath)) {
            unlink($filePath); // This deletes the file
        }
  
      return json_encode([
        'status' => 'success',
        'message' => 'Textbook deleted successfully.'
      ]);
    } else {
      return json_encode([
        'status' => 'error',
        'message' => 'Textbook not found in the list.'
      ]);
    }
}






// Assuming you already have a database connection stored in $conn

function fetchWebresources($conn, $courseId) {
    $response = array();

    // Fetch the web resources for the selected course using prepared statement
    $stmt = $conn->prepare("SELECT specifiedSources FROM courses WHERE courseId = ?");
    if (!$stmt) {
        // Handle preparation error
        echo json_encode([
            'status' => 'error',
            'message' => 'Preparation error.'
        ]);
        return;
    }
    $stmt->bind_param("s", $courseId);
    $stmt->execute();
    $stmt->bind_result($webResources);

    // Fetch result and populate response array
    if ($stmt->fetch()) {
        $webResourcesArray = json_decode($webResources, true); // Decode the JSON and convert to an associative array
        if (is_array($webResourcesArray)) {
            $response = $webResourcesArray;
        }
    }

    $stmt->close();
    echo json_encode($response); // Echo the JSON-encoded response directly
}







function saveWebresource($conn, $webresource, $courseId) {
    // Fetch the existing specifiedResources JSON string for the given course
    $sql = 'SELECT specifiedSources FROM courses WHERE courseId = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $courseId);
    $stmt->execute();
    $result = $stmt->get_result();

    // If the specifiedResources field is empty, initialize an empty array
    $webResourcesArray = $result->num_rows === 0 ? array() : json_decode($result->fetch_assoc()['specifiedSources'], true);

    // Append the new webresource to the array
    $webResourcesArray[] = $webresource;

    // Encode the array back to JSON
    $webResourcesJson = json_encode($webResourcesArray);

    // Update the specifiedResources field in the database
    $sql = 'UPDATE courses SET specifiedSources = ? WHERE courseId = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $webResourcesJson, $courseId);
    $stmt->execute();
    $stmt->close();

    $response = array(
        'status' => 'success',
        'message' => 'Web resource saved successfully.'
    );

    echo json_encode($response);
}

// saveWebresource($conn, 'Wiki', 'C003');
  
  
function deleteWebresource($conn, $courseId, $webresourceName) {
    // Get the specifiedResources for the course.
    $sql = 'SELECT specifiedSources FROM courses WHERE courseId = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $courseId);
    $stmt->execute();
    $result = $stmt->get_result();

    // If the specifiedResources field is empty, return an error.
    if ($result->num_rows === 0) {
        return json_encode([
            'status' => 'error',
            'message' => 'Course not found.'
        ]);
    }

    // Decode the specifiedResources array from JSON.
    $webresources = json_decode($result->fetch_assoc()['specifiedSources'], true);

    // Remove the webresourceName from the array.
    $index = array_search($webresourceName, $webresources);
    if ($index !== false) {
        array_splice($webresources, $index, 1);

        // Update the specifiedResources field in the database.
        $updatedWebresources = json_encode($webresources);
        $sql = 'UPDATE courses SET specifiedSources = ? WHERE courseId = ?';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $updatedWebresources, $courseId);
        $stmt->execute();
        $stmt->close();

        return json_encode([
            'status' => 'success',
            'message' => 'Web resource deleted successfully.'
        ]);
    } else {
        return json_encode([
            'status' => 'error',
            'message' => 'Web resource not found in the list.'
        ]);
    }
}


  
function createCourse($conn, $formData) {
    // Get the course code and name from the form data.
    $courseCode = $formData['courseCode'];
    $courseName = $formData['courseName'];
    $courseSemester = $formData['courseSemester'];
    $stdNumber = $formData['stdNumber'];

    // Get the array of lectures from the form data.
    $lectures = $formData['lectures'];

    // Check if the course code already exists in the database.
    $checkSql = 'SELECT COUNT(*) as count FROM courses WHERE courseId = ?';
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param('s', $courseCode);
    $checkStmt->execute();
    $result = $checkStmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['count'] > 0) {
        // Course code already exists, return an error message.
        $response = array(
            'status' => 'error',
            'message' => 'Course already exists in the system.'
        );
    } else {
        // Course code doesn't exist, proceed with creating the course.
        $insertSql = 'INSERT INTO courses (courseId, courseName, courseSemester, createdBy) VALUES (?, ?, ?, ?)';
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param('ssss', $courseCode, $courseName, $courseSemester, $stdNumber);
        $insertStmt->execute();

        // Insert each lecture into the lectures table.
        foreach ($lectures as $index => $lectureTitle) {
            // Lecture index starts from 1, so increment it by 1
            $lectureId = 'Lecture ' . ($index + 1);

            $insertSql = 'INSERT INTO lectures (lectureId, lectureTitle, courseId) VALUES (?, ?, ?)';
            $insertStmt = $conn->prepare($insertSql);
            $insertStmt->bind_param('sss', $lectureId, $lectureTitle, $courseCode);
            $insertStmt->execute();
        }

        // Return a success message.
        $response = array(
            'status' => 'success',
            'message' => 'Course created successfully!'
        );
    }

    // Encode and echo the response.
    echo json_encode($response);
}
  
  
function fetchCourseAndLectures($conn, $courseId) {
    $response = array();

    // Fetch course name from courses table
    $sql = 'SELECT courseName FROM courses WHERE courseId = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $courseId);
    $stmt->execute();
    $stmt->bind_result($courseName);
    $stmt->fetch();
    $stmt->close(); // Close the statement after fetching course name

    // Fetch lectures for the course from lectures table
    $lectures = array();
    $sql = 'SELECT lectureTitle FROM lectures WHERE courseId = ?';
    $stmt2 = $conn->prepare($sql);
    $stmt2->bind_param('s', $courseId);
    $stmt2->execute();
    $stmt2->bind_result($lectureTitle);
    while ($stmt2->fetch()) {
        $lectures[] = $lectureTitle;
    }
    $stmt2->close(); // Close the second statement after fetching lectures

    $checkstate = array();

    // Loop through each lecture and check if it exists in sections
    foreach ($lectures as $lecture) {
        $sql = 'SELECT COUNT(*) FROM sections WHERE sectionName = ?';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $lecture);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count > 0) {
            // If lecture exists in sections, append 'ok' to checkstate
            $checkstate[] = 'ok';
        } else {
            // If lecture does not exist in sections, append 'ko' to checkstate
            $checkstate[] = 'ko';
        }
    }

    // Construct formData object
    $formData = array(
        'courseCode' => $courseId,
        'courseName' => $courseName,
        'lectures' => $lectures,
        'checkState' => $checkstate,
        'action' => 'populateForm' // An identifier for jQuery to differentiate responses
    );
    error_log("formData: " . json_encode($formData));

    // Return the JSON-encoded formData object
    echo json_encode($formData);
}



function updateCourseAndLectures($conn, $formData) {
    $courseCode = $formData['courseCode'];
    $courseName = $formData['courseName'];
    $lectures = $formData['lectures'];

    // Update the course name in the courses table
    $sql = 'UPDATE courses SET courseName = ? WHERE courseId = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $courseName, $courseCode);
    $stmt->execute();

    // Delete existing lectures for the course
    $sql = 'DELETE FROM lectures WHERE courseId = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $courseCode);
    $stmt->execute();

    // Insert updated lectures into the lectures table
    foreach ($lectures as $index => $lectureTitle) {
        // Lecture index starts from 1, so increment it by 1
        $lectureId = 'Lecture ' . ($index + 1);

        $sql = 'INSERT INTO lectures (lectureId, lectureTitle, courseId) VALUES (?, ?, ?)';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $lectureId, $lectureTitle, $courseCode);
        $stmt->execute();
    }

    // Return a JSON encoded response
    $response = array(
        'status' => 'success',
        'message' => 'Course updated successfully!'
    );

    echo json_encode($response);
}


// Include database connection and other required dependencies

function getResponseOrigin($conn, $courseId) {
    $sql = 'SELECT responseOrigin FROM courses WHERE courseId = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $courseId);
    $stmt->execute();
    $stmt->bind_result($responseOrigin);
    $stmt->fetch();
    $stmt->close();

    // Return the response as an associative array
    echo json_encode(array('responseOrigin' => $responseOrigin));
}


// Include database connection and other required dependencies

function saveResources($conn, $courseId, $selectedResources) {
    // Update the responseOrigin field in the courses table
    $responseOrigin = json_encode($selectedResources);
    $sql = 'UPDATE courses SET responseOrigin = ? WHERE courseId = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $responseOrigin, $courseId);
    $stmt->execute();
    $stmt->close();

    // Return a JSON encoded response
    $response = array(
        'status' => 'success',
        'message' => 'Resources saved successfully!'
    );

    echo json_encode($response);
}



// FETCH COURSES FOR POPULATING ADMIN DASHBOARD
function getPureCourses($conn) {
    $courses = array();

    $sql = 'SELECT courseId, courseName, apiKey FROM courses';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $courses[] = $row;
    }

    echo json_encode($courses);
}

// UPDATE COURSES TABLE WITH API KEY

function updateApiKeys($conn, $studentId, $coursesToUpdate) {
    $sqlFetchApiKey = 'SELECT apiKey FROM users WHERE stdnumber = ?';
    $stmtFetchApiKey = $conn->prepare($sqlFetchApiKey);
    $stmtFetchApiKey->bind_param('s', $studentId);
    $stmtFetchApiKey->execute();
    $stmtFetchApiKey->bind_result($apiKey);
    $stmtFetchApiKey->fetch();
    $stmtFetchApiKey->close();

    $sqlUpdateApiKey = 'UPDATE courses SET apiKey = ? WHERE courseId IN (' . implode(',', array_fill(0, count($coursesToUpdate), '?')) . ')';
    $stmtUpdateApiKey = $conn->prepare($sqlUpdateApiKey);
    $params = array_merge([$apiKey], $coursesToUpdate);
    $stmtUpdateApiKey->bind_param(str_repeat('ss', count($params)/2), ...$params);
    $stmtUpdateApiKey->execute();
    $stmtUpdateApiKey->close();

    $response = array(
        'status' => 'success',
        'message' => 'API Keys updated successfully!'
    );

    echo json_encode($response);
}

function deleteApiKeys($conn,  $coursesToDeleteApiKey) {
    $sqlDeleteApiKey = 'UPDATE courses SET apiKey = NULL WHERE courseId IN (' . implode(',', array_fill(0, count($coursesToDeleteApiKey), '?')) . ')';
    $stmtDeleteApiKey = $conn->prepare($sqlDeleteApiKey);
    $params = array_merge([], $coursesToDeleteApiKey);
    $stmtDeleteApiKey->bind_param(str_repeat('s', count($params)), ...$params);
    $stmtDeleteApiKey->execute();
    $stmtDeleteApiKey->close();

    $response = array(
        'status' => 'success',
        'message' => 'API Keys deleted successfully!'
    );

    echo json_encode($response);
}




function fetchBaseSettings($conn, $courseId) {
    $response = array();

    // Fetch responseOrigin, specifiedSources, and textBooks from the database
    $query = "SELECT responseOrigin, specifiedSources, textBooks FROM courses WHERE courseId = '$courseId' ";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $responseOrigin = json_decode($row['responseOrigin'], true); // Decode the list string
        $specifiedSources = json_decode($row['specifiedSources'], true); // Decode the list string
        $textBooks = json_decode($row['textBooks'], true); // Decode the list string

        if (in_array('chatGPT', $responseOrigin)) {
            $response['chatGPT'] = 'chatGPT';
        }

        if (in_array('webResources', $responseOrigin)) {
            $response['webResources'] = $specifiedSources;
        }

        if (in_array('textbooks', $responseOrigin)) {
            $response['textbooks'] = $textBooks;
        }

        // Close the database connection
        mysqli_close($conn);
    } else {
        // Handle database query error
        $response['error'] = "Database query error.";
    }

    // Send JSON response
    $res = array('responseOrigin' => $response, 'status'=>'success', 'message'=>'All origins sourced');
    header('Content-Type: application/json');
    echo json_encode($res);
}

function processGrades($conn, $studentId, $courseId) {
    // Fetch weights from weights table
    $weightsQuery = "SELECT weeklyScores, midTerm, finalExam FROM weights WHERE courseId = '$courseId' ";
    $weightsResult = mysqli_query($conn, $weightsQuery);
    $weightsRow = mysqli_fetch_assoc($weightsResult);

    $gradesQuery = "SELECT midTerm, finalExam FROM semester_grades WHERE courseId = '$courseId' AND studentId = '$studentId' ";
    $gradesResult = mysqli_query($conn, $gradesQuery);
    $gradesRow = mysqli_fetch_assoc($gradesResult);
    
    $w1 = 0.01*$weightsRow['weeklyScores'];
    $w2 = 0.01*$weightsRow['midTerm'];
    $w3 = 0.01*$weightsRow['finalExam'];
    
    // Calculate v1
    // $totalQuery = "SELECT AVG(total) AS avgTotal FROM grades WHERE courseId = '$courseId' AND studentId = '$studentId'";
    // $totalResult = mysqli_query($conn, $totalQuery);
    // $totalRow = mysqli_fetch_assoc($totalResult);
    
    // Fetch the serialized array from the database
    $query = "SELECT total FROM grades WHERE courseId = ? AND studentId = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $courseId, $studentId);
    $stmt->execute();
    $stmt->bind_result($totalSerialized);
    $stmt->fetch();

    // Deserialize the serialized array
    $totalArray = unserialize($totalSerialized);

    // Calculate the average of the values
    $average = nestedArraySum($totalArray) / count($totalArray);


    $v1 = $w1 * $average;
    
    // Fetch midterm and final exam scores from semester_grades table

    
    $v2 = $w2 * $gradesRow['midTerm'];
    $v3 = $w3 * $gradesRow['finalExam'];
    
    // Calculate v4
    $v4 = $v1 + $v2 + $v3;
    
    // Determine v5 and v6
    if ($v4 < 50) {
        $v5 = 'failed';
        $v6 = 'FF';
    } elseif ($v4 < 60) {
        $v5 = 'average';
        $v6 = 'CC';
    } elseif ($v4 < 80) {
        $v5 = 'good';
        $v6 = 'BB';
    } else {
        $v5 = 'Excellent';
        $v6 = 'AA';
    }
    
    // Create and echo the JSON response
    $response = array(
        'weekly_score' => $v1,
        'midterm_score' => $v2,
        'exam_score' => $v3,
        'total_score' => $v4,
        'remark' => $v5,
        'letter_grade' => $v6
    );
    
    echo json_encode($response);
}


function fetchLectureScores($conn, $studentId, $courseId, $topicId) {
    // Initialize the response array
    $response = array();

    // Retrieve existing data for the student and course
    $sql = "SELECT * FROM grades WHERE studentId = '$studentId' AND courseId = '$courseId'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        // Data already exists, update the arrays
        $row = $result->fetch_assoc();
        $topics = unserialize($row['topics']);
        $scores = unserialize($row['scores']);
        $accuracies = unserialize($row['accuracy']);
        $promptEfficiencies = unserialize($row['promptEfficiency']);
        $timeEfficiencies = unserialize($row['timeEfficiency']);
        $totals = unserialize($row['total']);

        // Check if the topic exists in the array
        $topicIndex = array_search($topicId, $topics);

        if ($topicIndex !== false) { 
            // Topic already exists, update the score at the corresponding index
            $score = $scores[$topicIndex];
            $accuracy = $accuracies[$topicIndex];
            $promptEfficiency = $promptEfficiencies[$topicIndex];
            $timeEfficiency = $timeEfficiencies[$topicIndex];
            $total = $totals[$topicIndex];

            // Populate the response array
            $response = array(
                'accuracy' => $accuracy,
                'promptEfficiency' => $promptEfficiency,
                'timeEfficiency' => $timeEfficiency,
                'Total' => $total,
                'status' => 'ok',
            );
        } else {
            // Topic does not exist
            $response = array(
                'accuracy' => 'not done',
                'promptEfficiency' => 'not done',
                'timeEfficiency' => 'not done',
                'Total' => 'not done',
                'status' => 'ok',
            );
        }
    } else {
        // No data found for the student and course
        $response = array(
            'accuracy' => 'not done',
            'promptEfficiency' => 'not done',
            'timeEfficiency' => 'not done',
            'Total' => 'not done',
            'status' => 'Error',
        );
    }

    // Convert the response array to JSON and echo it
    echo json_encode($response);
}



function nestedArraySum($array) {
    $sum = 0;
    foreach ($array as $element) {
        if (is_array($element)) {
            $sum += nestedArraySum($element); // Recursively call the function for nested arrays
        } else {
            $sum += $element; // Add the element to the sum
        }
    }
    return $sum;
}

function saveWeights($conn, $formData) {
    // Extract form data
    $weeklyScores = $_POST['weekly_evaluation'];
    $midTerm = $_POST['midterm_exam'];
    $finalExam = $_POST['final_exam'];
    $courseId = $_POST['courseWTS']; // Replace with the actual course ID

    // Check if courseId exists in the database
    $checkStmt = $conn->prepare("SELECT COUNT(*) FROM weights WHERE courseId = ?");
    $checkStmt->bind_param("s", $courseId);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    $count = $checkResult->fetch_row()[0];
    $checkStmt->close();

    if ($count > 0) {
        // Update existing record
        $updateStmt = $conn->prepare("UPDATE weights SET weeklyScores = ?, midTerm = ?, finalExam = ? WHERE courseId = ?");
        $updateStmt->bind_param("ddds", $weeklyScores, $midTerm, $finalExam, $courseId);
        if ($updateStmt->execute()) {
            echo "Weights updated successfully.";
        } else {
            echo "Error updating weights: " . $updateStmt->error;
        }
        $updateStmt->close();
    } else {
        // Insert new record
        $insertStmt = $conn->prepare("INSERT INTO weights (courseId, weeklyScores, midTerm, finalExam) VALUES (?, ?, ?, ?)");
        $insertStmt->bind_param("sddd", $courseId, $weeklyScores, $midTerm, $finalExam);
        if ($insertStmt->execute()) {
            echo "Weights saved successfully.";
        } else {
            echo "Error inserting weights: " . $insertStmt->error;
        }
        $insertStmt->close();
    }
}


function fetchClassGrades($conn, $courseId, $selectedField) {
    // Define the lecture IDs array
    $lectureIds = [
        'Lecture 1', 'Lecture 2', 'Lecture 3', 'Lecture 4',
        'Lecture 5', 'Lecture 6', 'Lecture 7', 'Lecture 8',
        'Mid Term Exam', 'Lecture 9', 'Lecture 10', 'Lecture 11',
        'Lecture 12', 'Final Exam'
    ];

    // Fetch students for the selected courseId
    $studentsQuery = "SELECT * FROM grades WHERE courseId = ?";
    $stmt = $conn->prepare($studentsQuery);
    $stmt->bind_param("s", $courseId);
    $stmt->execute();
    
    if ($stmt === false) {
        die('Error executing students query: ' . $conn->error);
    }

    $result = $stmt->get_result();

    // Prepare an array to store the data for each student
    $data = [];

    while ($row = $result->fetch_assoc()) {
        // Fetch student details from the users table
        $studentId = $row["studentId"];
        $studentQuery = "SELECT name, photo FROM users WHERE stdnumber = ?";
        $stmt2 = $conn->prepare($studentQuery);
        $stmt2->bind_param("s", $studentId);
        $stmt2->execute();
        $studentResult = $stmt2->get_result();
        $studentData = $studentResult->fetch_assoc();

        // Create an array to store student data with default values for all 14 columns
        $studentArray = [
            "name" => $studentData["name"],
            "photo" => "../".$studentData["photo"],
        ];

        // Initialize all columns with "NA"
        for ($i = 1; $i <= 14; $i++) {
            $studentArray["column" . $i] = "NA";
        }

        // Process and populate data columns based on topics array
        $topics = unserialize($row["topics"]);
        $values = unserialize($row[$selectedField]);

        foreach ($topics as $topicIndex => $topic) {
            // Find the corresponding column index based on the lecture ID
            $lectureIdIndex = array_search($topic, $lectureIds);
            
            if ($lectureIdIndex !== false) {
                // Store the data value in the corresponding column
                $studentArray["column" . ($lectureIdIndex + 1)] = isset($values[$topicIndex]) ? $values[$topicIndex] : "NA";
            }
        }

        // Add the student data to the main data array
        $data[] = $studentArray;
    }

    echo json_encode($data);
}


function fetchStudentsForCourse($conn, $courseId) {
    // Initialize the response array
    $response = array();
    $students = array();

    // Query to fetch student data for the given courseId
    $query = "SELECT * FROM grades WHERE courseId = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $courseId);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            // Fetch student name from the 'users' table based on stdnumber
            $studentId = $row["studentId"];
            $studentQuery = "SELECT * FROM users WHERE stdnumber = ?";
            $stmt2 = $conn->prepare($studentQuery);
            $stmt2->bind_param("s", $studentId);
            $stmt2->execute();
            $studentResult = $stmt2->get_result();
            $studentData = $studentResult->fetch_assoc();

            // Build an array for each student
            $studentArray = array(
                "id" => $studentData["stdnumber"],
                "name" => $studentData["name"],
                // Add other fields as needed
            );

            $students[] = $studentArray;
        }

        $response["students"] = $students;
        echo json_encode($response);
    } else {
        // Handle the error case
        $response["error"] = "Failed to fetch student data.";
        echo json_encode($response);
    }
}


function fetchCourseList($conn, $courseId) {
    // Prepare the SQL statement to select from semester_grades
    $sql = "SELECT sg.*, u.name FROM semester_grades sg
            INNER JOIN users u ON sg.studentId = u.stdnumber
            WHERE sg.courseId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $courseId);
    $stmt->execute();
    $result = $stmt->get_result();
  
    // Create an array to hold the course list
    $courseList = [];
  
    // Fetch each row and process the data
    while ($row = $result->fetch_assoc()) {
      // Calculate the grand total
      $total = $row['total'];
      $midTerm = $row['midTerm'];
      $finalExam = $row['finalExam'];
      $grandTotal = 0.2 * $total + 0.4 * $midTerm + 0.4 * $finalExam;
  
      // Add the data to the course list array
      $courseList[] = [
        'Serial Number' => count($courseList) + 1,
        'Name' => $row['name'],
        'Student ID' => $row['studentId'],
        'Weekly' => $total,
        'Midterm' => $midTerm,
        'Final Exam' => $finalExam,
        'Grand Total' => $grandTotal
      ];
    }
  
    // Return the course list as an associative array
    echo json_encode($courseList);
}

function updateCourseCreatedBy($conn, $courseId, $stdNumber)
{
    // Validate inputs as needed

    // Prepare and execute the SQL update query
    $sql = "UPDATE courses SET createdBy = ? WHERE courseId = ?";
    
    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        // Handle the error if the prepared statement fails
        echo json_encode(array("status" => "error", "message" => "Failed to prepare statement."));
    }
    
    // Bind parameters and execute the statement
    $stmt->bind_param("ss", $stdNumber, $courseId);
    $result = $stmt->execute();
    
    if ($result === false) {
        // Handle the error if the update query fails
        echo json_encode(array("status" => "error", "message" => "Failed to update course."));
    }
    
    // Close the statement
    $stmt->close();
    
    echo json_encode(array("status" => "success", "message" => "Course: ".$courseId." for teacher: ".$stdNumber." updated successfully."));
}

// to display instructors in students' dropdown for messaging
function getInstructorList($conn, $searchId) {
    $result = [];

    $query = "SELECT subscriptions.courseId, courses.createdBy, users.uid, users.name, users.email FROM subscriptions JOIN courses ON courses.courseId = subscriptions.courseId JOIN users ON users.stdNumber = courses.createdBy WHERE subscriptions.studentId = ?;";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $searchId);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $result[] = $row;
        }
    }
    $result = array_unique($result, SORT_REGULAR);
    echo json_encode($result);
}







function getStudentsRequestList($conn, $myId, $courseId ) {
    
    // Prevent SQL injection by using prepared statements
    $sql = "SELECT subscriptions.courseId, subscriptions.studentId, subscriptions.approval, users.stdNumber, users.name FROM subscriptions INNER JOIN users ON subscriptions.studentId = users.stdNumber 
    INNER JOIN courses ON subscriptions.courseId = courses.courseId WHERE courses.courseId = '$courseId' AND courses.createdBy ='$myId' AND users.utype = 'student'";
    // AND courses.createdBy = ?";
    
    // Prepare the statement
    // $stmt = $conn->prepare($sql);
    
    // if ($stmt) {
    //     // Bind the parameters
    //     $stmt->bind_param("s", $myId); // Bind both courseId and myId
        
    //     // Execute the query
    //     if ($stmt->execute()) {
    //         // Get the result set
    //         $result = $stmt->get_result();
            
    //         // Fetch data as an associative array
    //         $data = [];
    //         while ($row = $result->fetch_assoc()) {
    //             $data[] = $row;
    //         }
            
    //         // Set the content type header to indicate JSON response
    //         header('Content-Type: application/json');
            
    //         // Output the data as JSON
    //         echo json_encode($data);
            
    //         // Close the statement
    //         $stmt->close();
    //     } else {
    //         // Handle query execution error
    //         echo json_encode(['error' => "Error executing the query: " . $stmt->error]);
    //     }
    // } else {
    //     // Handle statement preparation error
    //     echo json_encode(['error' => "Error preparing statement: " . $conn->error]);
    // }
    
    $result = mysqli_query($conn,$sql);
    
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // Set the content type header to indicate JSON response
    header('Content-Type: application/json');
    
    // Output the data as JSON
    echo json_encode($data);
    
}


function updateApprovalStatus($conn, $studentId, $courseId, $approvalStatus) {
    // Prepare the UPDATE statement
    $stmt = $conn->prepare('UPDATE subscriptions SET approval = ? WHERE studentId = ? AND courseId = ?');
    $stmt->bind_param('sss', $approvalStatus, $studentId, $courseId);
  
    // Execute the statement
    if ($stmt->execute()) {
        
            // Prepare the query
            $stmt2 = $conn->prepare("SELECT name, email FROM users WHERE stdnumber=?");
            // Bind parameters
            $stmt2->bind_param("s", $studentId);
            // Execute the query
            $stmt2->execute();
            // Bind result variables
            $stmt2->bind_result($name,$email);
            // Fetch the result
            $stmt2->fetch();
            // Close the statement
            $stmt2->close();
            // Close the connection
            $conn->close();
            // Call the sendEmail function
            sendEmail($email, 'Dear '.$name.'<br>The approval status of your course '.$courseId.' has been updated. <br><br> Mercel from DUX.');
        
        
        
      $response = array(
        'status' => 'success',
        'message' => 'Approval status updated successfully.'
      );
    } else {
      $response = array(
        'status' => 'error',
        'message' => 'Error updating approval status.'
      );
    }
  
    // Echo the JSON-encoded response
    echo json_encode($response);
  }


  function getGeneralApiKey($conn) {
    // Assuming you have already established a database connection ($conn)

    // Query to fetch apiKey from the users table where stdNumber is 'STD020'
    $query = "SELECT apiKey FROM users WHERE stdNumber = 'STD020'";

    // Execute the query
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Check if a row is found
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $apiKey = $row['apiKey'];
            $response = array(
                'apiKey' => $apiKey,
                'status' => 'success',
                'message' => 'API Key fetched successfully'
            );
            echo json_encode($response);
        } else {
            // No matching record found
            $response = array(
                'apiKey' => null,
                'status' => 'error',
                'message' => 'No matching record found for stdNumber STD020'
            );
            echo json_encode($response);
        }
    } else {
        // Error in executing the query
        $response = array(
            'apiKey' => null,
            'status' => 'error',
            'message' => 'Error executing the query: ' . mysqli_error($conn)
        );
        echo json_encode($response);
    }
}



function uploadTempFile($conn, $stdNumber, $file) {
    // Check if a file was uploaded
    if (!isset($_FILES['file'])) {
        return ['error' => 'No file uploaded'];
    }

    $tempDirectory = '../temp/'; // Path to your temporary directory
    $uploadedFile = $_FILES['file'];
    $fileName = $uploadedFile['name'];
    $filePath = $tempDirectory . $fileName;
    $savePath = 'temp/'.$fileName;

    // Move the uploaded file to the temporary directory
    if (!move_uploaded_file($uploadedFile['tmp_name'], $filePath)) {
        return ['error' => 'Failed to move uploaded file'];
    }

    // Insert the file URL into the database
    $sql = "INSERT INTO tempfiles (stdNumber, file_url) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $stdNumber, $savePath); // Assuming 'stdNumber' is a string, adjust the type accordingly

    if ($stmt->execute()) {
        return ['success' => 'File uploaded and URL saved in the database','fileName'=>$fileName];
    } else {
        return ['error' => 'Failed to save URL in the database'];
    }
}

function updateExamStatus($conn, $studentId, $courseId, $examType, $status) {
    // Prepare the SQL statement
    if ($examType === 'Mid Term Exam') {
        $sql = "SELECT mstatus FROM semester_grades WHERE studentId = ? AND courseId = ?";
    } else {
        $sql = "SELECT fstatus FROM semester_grades WHERE studentId = ? AND courseId = ?";
    }

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $studentId, $courseId);
    $stmt->execute();
    
    if ($examType === 'Mid Term Exam') {
        $stmt->bind_result($currentStatus);
    } else {
        $stmt->bind_result($currentStatus);
    }

    $stmt->fetch();
    $stmt->close();

    // Check the priority of the current status and the new status
    $statusPriority = ['NA', 'Started', 'Done'];
    $currentStatusIndex = array_search($currentStatus, $statusPriority);
    $newStatusIndex = array_search($status, $statusPriority);

    if ($newStatusIndex > $currentStatusIndex) {
        // Prepare the SQL statement for update
        if ($examType === 'Mid Term Exam') {
            $updateSql = "UPDATE semester_grades SET mstatus = ? WHERE studentId = ? AND courseId = ?";
        } else {
            $updateSql = "UPDATE semester_grades SET fstatus = ? WHERE studentId = ? AND courseId = ?";
        }

        // Prepare and execute the update SQL statement
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param('sss', $status, $studentId, $courseId);
        $result = $updateStmt->execute();
        $updateStmt->close();

        if ($result) {
            $response = array(
                'status' => 'success',
                'message' => 'Exam status updated successfully.'
            );
        } else {
            $response = array(
                'status' => 'error',
                'message' => 'Failed to update exam status.'
            );
        }
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'You can take the exam only  once.'
        );
    }

    // Echo the JSON-encoded response
    echo json_encode($response);
}



function checkExamstatus($conn, $studentId, $courseId, $examType) {
    // Prepare the SQL statement
    if ($examType === 'Mid Term Exam') {
        $sql = "SELECT mstatus FROM semester_grades WHERE studentId = ? AND courseId = ?";
    } else {
        $sql = "SELECT fstatus FROM semester_grades WHERE studentId = ? AND courseId = ?";
    }

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $studentId, $courseId);
    $stmt->execute();
    
    if ($examType === 'Mid Term Exam') {
        $stmt->bind_result($currentStatus);
    } else {
        $stmt->bind_result($currentStatus);
    }

    $stmt->fetch();
    $stmt->close();

    $response = array(
        'state' => 'success',
        'status' => $currentStatus
    );

    echo json_encode($response);
}



function saveQuestionBank($conn, $courseId, $topicId, $questionBank) {
    $fileName = $courseId . ' ' . $topicId . '.json';
    $filePath = '../exams/' . $fileName;

    if (!file_exists('exams')) {
        mkdir('exams');
    }

    $file = fopen($filePath, 'w');

    if ($file === false) {
        throw new Exception('Failed to open file for writing');
    }

    if (fwrite($file, json_encode($questionBank)) === false) {
        throw new Exception('Failed to write to file');
    }

    fclose($file);
}



function getQuestionBank($conn, $courseId, $topicId) {
    $fileName = $courseId . ' ' . $topicId . '.json';
    $filePath = '../exams/' . $fileName;

    if (!file_exists($filePath)) {
        throw new Exception('File not found');
    }

    $file = fopen($filePath, 'r');

    if ($file === false) {
        throw new Exception('Failed to open file for reading');
    }

    $questionBank = json_decode(fread($file, filesize($filePath)), true);

    fclose($file);

    $res = array(
        'status' => 'success',
        'content' => $questionBank
    );

    echo json_encode($res);
}


function getAdminDashboardData($conn, $studentId) {
    // Initialize counts
    $courses = 0;
    $students = 0;
    $unread_messages = 0;
    $online_students = 0;
    $requests = 0;

    // Calculate $courses
    $coursesQuery = "SELECT COUNT(courseId) AS courseCount FROM courses WHERE createdBy = ?";
    $stmt = $conn->prepare($coursesQuery);
    $stmt->bind_param("s", $studentId);
    $stmt->execute();
    $result = $stmt->get_result();
    $coursesData = $result->fetch_assoc();
    $courses = $coursesData['courseCount'];

    // Calculate $students, $online_students, and $requests
    $coursesQuery = "SELECT courseId FROM courses WHERE createdBy = ?";
    $stmt = $conn->prepare($coursesQuery);
    $stmt->bind_param("s", $studentId);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $courseId = $row['courseId'];

        // Calculate $students
        $studentsQuery = "SELECT COUNT(studentId) AS studentCount FROM subscriptions WHERE courseId = ?";
        $stmt2 = $conn->prepare($studentsQuery);
        $stmt2->bind_param("s", $courseId);
        $stmt2->execute();
        $studentsResult = $stmt2->get_result();
        $studentsData = $studentsResult->fetch_assoc();
        $students += $studentsData['studentCount'];

        // Calculate $online_students
        $onlineQuery = "SELECT COUNT(studentId) AS onlineCount FROM subscriptions WHERE courseId = ? AND approval = 'Approved'";
        $stmt3 = $conn->prepare($onlineQuery);
        $stmt3->bind_param("s", $courseId);
        $stmt3->execute();
        $onlineResult = $stmt3->get_result();
        $onlineData = $onlineResult->fetch_assoc();
        $online_students += $onlineData['onlineCount'];

        // Calculate $requests
        $requestsQuery = "SELECT COUNT(studentId) AS requestCount FROM subscriptions WHERE courseId = ? AND approval = 'Not Approved'";
        $stmt4 = $conn->prepare($requestsQuery);
        $stmt4->bind_param("s", $courseId);
        $stmt4->execute();
        $requestsResult = $stmt4->get_result();
        $requestsData = $requestsResult->fetch_assoc();
        $requests += $requestsData['requestCount'];
    }

    // Create and echo the JSON array
    $statusCounts = [
        "status" => "success",
        "courses" => $courses,
        "students" => $students,
        "unread_messages" => $unread_messages,
        "online_students" => $online_students,
        "requests" => $requests
    ];

    echo json_encode($statusCounts);
}


function validateSession($conn, $token) {
    // Implement your session token validation logic here
    // Check if the provided token is valid in your database

    // Example validation query
    $validationQuery = "SELECT * FROM sessions WHERE token = ?";
    $stmt = $conn->prepare($validationQuery);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Token is valid
        echo json_encode(['status' => 'success', 'message' => 'Session token is valid']);
    } else {
        // Token is not valid
        echo json_encode(['status' => 'error', 'message' => 'Invalid session token']);
    }
}




// Example usage assuming you have a database connection ($conn) already established



// $selectedCourses = ["C003","C004"];
// $stdNumber = "1001";
// foreach ($selectedCourses as $courseId) {
//     $updateSql = "UPDATE courses SET createdBy = '$stdNumber' WHERE courseId = '$courseId'";
//     if ($conn->query($updateSql) === TRUE) {
//         // Course updated successfully
//         // You can handle success or error as needed
//     } else {
//         // Handle the error if the update fails
//         echo "Error updating course: " . $conn->error;
//     }
// }


//fetchBaseSettings($conn, 'C003');
//  insertOrUpdateGrade($conn, 'STD020', 'C004', 'Mid Term Exam', 20, 40.0, 18, 30,25);
//fetchGrades($conn, 'STD020', 'C003', 'Lecture 1');
//  processGrades($conn, 'STD020', 'C003');
//  fetchClassGrades($conn, 'C004', 'accuracy');
// fetchCourseList($conn, 'C003');
// fetchLectureScores($conn, 'STD020', 'C003', 'Lecture 1');
// signup('Maxwel', 'max@email.com', '2354', 'STD987', 'address', 'department', "['selectedCourses','COURSE2']", 'uploads/sample.jpg')
// updateCourseCreatedBy($conn, $courseId='C003', $stdNumber='STD020');
// fetchApprovedCourses($conn, $studentId='STD020');

// getStudentsRequestList($conn, 'STD020','C004');
// fetchCoursesTeacher($conn, 'STD020');



// $emailPasswordPairs = [
//     ['zohre.serttas@neu.edu.tr', 'CkrNPP'],
//     ['fahriye.altinay@neu.edu.tr', 'HtnBws'],
//     ['sezer.kanbul@neu.edu.tr', 'jOItK6'],
//     ['delal.bozyel@neu.edu.tr', 'RJmUHl'],
//     ['ihsan.calis@neu.edu.tr', '3ucDvW'],
//     ['rifat.resatoglu@neu.edu.tr', '18U5J1'],
//     ['umran.dal@neu.edu.tr', 'sKgFSm'],
//     ['sila.gurler@neu.edu.tr', 'nqzG3R'],
//     ['yusuf.suicmez@neu.edu.tr', 'wS8gwR'],
//     ['gulsen.ozduran@neu.edu.tr', 'z0PtxD'],
//     ['huseyin.guneralp@neu.edu.tr', 'BldfYi'],
//     ['serkadhasan.isikoren@neu.edu.tr', 'nnPB1R'],
//     ['gulsum.asiksoy@neu.edu.tr', 'EIqrCf'],
//     ['salih.gucel@neu.edu.tr', 'dXDvIc'],
//     ['ikenna.uwanuakwa@neu.edu.tr', 'SBCfPW'],
//     ['farhad.bolouri@neu.edu.tr', 'QCzKQN'],
//     ['ammar.kayssoun@neu.edu.tr', 'b98dmt'],
//     ['abidemi.somoye@neu.edu.tr', 'Tif30g'],
//     ['fezile.ozdamli@neu.edu.tr', '5poffP'],
//     ['omid.mirzaei@neu.edu.tr', 'xCPhSz'],
//     ['ozlem.yamak@neu.edu.tr', 'IJ7Kir'],
//     ['nesrin.menemenci@neu.edu.tr', 'Ugg7R7'],
//     ['deniz.seyrekintas@neu.edu.tr', 'JkuDtx'],
//     ['oshan.ulusan@neu.edu.tr', '2j6mfH'],
//     ['havva.arslangazi@neu.edu.tr', 'H9IbUW'],
//     ['gloria.manyeruke@neu.edu.tr', 'zKKkMv'],
//     ['emrah.ruh@neu.edu.tr', 'vV1a49'],
//     ['ilker.gelisen@neu.edu.tr', 'FtHomQ']
// ];

// function updateUsersByEmailPasswordPairs($con, $emailPasswordPairs) {
//     // Prepare and execute the SQL update query for each email-password pair
//     foreach ($emailPasswordPairs as $pair) {
//         $email = $pair[0];
//         $password = $pair[1];
        
//         $sql = "UPDATE users SET email = ? WHERE password = ?";
        
//         $stmt = $con->prepare($sql);
//         $stmt->bind_param("ss", $email, $password);
        
//         if ($stmt->execute()) {
//             echo "Updated user with email $email for password $password.<br>";
//         } else {
//             echo "Failed to update user with email $email for password $password.<br>";
//         }
        
//         $stmt->close();
//     }
// }
// updateUsersByEmailPasswordPairs($conn, $emailPasswordPairs);



// getGeneralApiKey($conn);
// sendEmail($receiverEmail = 'vmercel@gmail.com', $message='blablabla');
// login($conn, $email='vmercel@gmail.com', $password='pp');
// fetchTextbooks($conn,'C004');
// fetchTopicsForCourse('C004', $conn);
// updateExamStatus($conn, 'STD020', 'C004', 'Mid Term Exam', 'Started');
// checkExamstatus($conn, 'STD020', 'C004', 'Mid Term Exam');
// getQuestionBank($conn, 'C003', 'Mid Term Exam');
// getCourses($conn);
// getAdminDashboardData($conn, $studentId='STD020');
?>
