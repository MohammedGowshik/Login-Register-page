<?php

$username = $_POST['username'];
$email  = $_POST['email'];
$userpassword = $_POST['userpassword'];
$conformpassword = $_POST['conformpassword'];




if (!empty($username) || !empty($email) || !empty($userpassword) || !empty($conformpassword) )
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "project-1";


$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT email From registerpage Where email = ? Limit 1";
  $INSERT = "INSERT Into registerpage(username , email ,userpassword, conformpassword )values(?,?,?,?)";

     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssss", $username,$email,$userpassword,$conformpassword);
      $stmt->execute();
      echo "Registred sucessfully";
     } else {
      echo "This email is already register.Try another email Id!";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>
