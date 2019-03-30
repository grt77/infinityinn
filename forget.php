<?php
require('phpmailer\class.phpmailer.php');
require('phpmailer\PHPMailerAutoload.php');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inf";


   if($_SERVER["REQUEST_METHOD"] == "POST") {
       
      
	  
	  
      $myusername = $_POST['email'];
$conn = mysqli_connect($servername, $username, $password, $dbname);// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM reg WHERE email='$myusername'";
$result = mysqli_query($conn,$sql);
      	 
      
      
      $count = mysqli_num_rows($result);
	  if($count == 0)
	  {$error = "The entered email is Invalid ";
       echo "<script type='text/javascript'>alert('$error');</script>";
       include "fforget.html";
	    exit;
	  }
      
		
      if($count == 1) {
   		while($row = mysqli_fetch_array($result)) {
         $pass = $row['pwd'];
		$pass=rand(10000,10999);
	
		
$sql = "UPDATE `reg` SET `pwd` = '$pass' WHERE `reg`.`email` = 'gattupalliravi1@gmail.com'";
  mysqli_query($conn, $sql);
  
       
         $mail = new PHPMailer();
         $mail->IsSMTP();
         $mail->SMTPDebug = 0;
         $mail->SMTPAuth = TRUE;
         $mail->SMTPSecure = "tls";
          $mail->Port     = 587;  
          $mail->Username = "gattupalliraviteja007@gmail.com";
         $mail->Password = "fgjmjllortq1";
          $mail->Host     = "smtp.gmail.com";
         $mail->Mailer   = "smtp";
          $mail->SetFrom("infinityinn@gmail.com", "INFINITY-INN");
          $mail->AddAddress("$myusername");
           $mail->Subject = "The password for your INFINITY-INN account";
            $mail->WordWrap   = 80;
             $content = "<b>$pass</b>"; $mail->MsgHTML($content);
             $mail->IsHTML(true);
if(!$mail->Send()) {
echo "Problem sending email.";
include "fforget.html";
}
else 
{

 $error = "The password is sent to your email";
echo "<script type='text/javascript'>alert('$error');</script>";
include "flogin.html";
	  }}
	  }
   }