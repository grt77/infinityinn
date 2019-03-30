<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inf";

$conn = mysqli_connect($servername, $username, $password, $dbname);
$dob =$phno = $fname = $lname = $email = $password = $aadhar = $gender = "";


 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $fname = test_input($_POST["fname"]);
  $lname = test_input($_POST["lname"]);
  $email = test_input($_POST["email"]);
  $password = test_input($_POST["psw"]);
  $aadhar = test_input($_POST["aad"]);
  $phno = test_input($_POST["phno"]);
  $gender = test_input($_POST["gender"]);
  $dob = test_input($_POST["age"]);
 
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);

   return $data;
}


$sql = "INSERT INTO reg (fname, lname, email, pwd, aadhar, phno, gender, bdate)
VALUES ('$fname', '$lname', '$email', '$password', '$aadhar', '$phno', '$gender', $dob)";

if (mysqli_query($conn, $sql)) {
	      $msg = "Your are registered sucessfully";
         echo "<script type='text/javascript'>alert('$msg');</script>";
		 include "home.html";
} else {
    $msg = "you entered email is already registered";
         echo "<script type='text/javascript'>alert('$msg');</script>";
		 include "freg.html";
}

mysqli_close($conn);


?>