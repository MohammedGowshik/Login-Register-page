<?php

$username = $_POST['username'];
$email  = $_POST['email'];
$userpassword = $_POST['userpassword'];


if (!empty($username) || !empty($email) || !empty($userpassword) )
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "Project-1";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT email From  loginpage Where email = ? Limit 1";
  $INSERT = "INSERT Into loginpage (username , email ,userpassword)values(?,?,?)";

     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sss", $username,$email,$userpassword);
      $stmt->execute();
      echo "Login sucessfully";
     } else {
      echo "This email is already used by a user.Try another email Id!";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>
