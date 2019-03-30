<?php   session_start();  ?>
<?php

require('phpmailer\class.phpmailer.php');
require('phpmailer\PHPMailerAutoload.php');
  if(isset($_SESSION['login_id'])){
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inf";
$user= $_SESSION['login_id'];
$conn = mysqli_connect($servername, $username, $password, $dbname);
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);

   return $data;
}
 $mon = test_input($_POST["money"]);
 
  $name = test_input($_POST["name"]);
   $number = test_input($_POST["num"]);
   $sql = "SELECT * FROM reg WHERE email = '$user'";
$result5 = mysqli_query($conn, $sql);
if (mysqli_num_rows($result5) > 0) {
	$array = array();
    while($row = mysqli_fetch_assoc($result5)) {
		
		 $array[] = $row;
		 
        		}
		
					$realmon=$array[0]['wallet'];
			
		}
$nmoney=$mon + $realmon;		
		
$sql = "UPDATE `reg` SET `wallet` = '$nmoney' WHERE `reg`.`email` = '$user'";
  mysqli_query($conn, $sql);
  
  
  
  $sql = "INSERT INTO `payment` (`email`, `name`, `number`, `amount`) VALUES ('$user', '$name', '$number', '$mon')";
  if(mysqli_query($conn, $sql))
  {
	  
	  
	  
	  
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
          $mail->AddAddress("$user");
           $mail->Subject = "WALLET MONEY UPDATED";
            $mail->WordWrap   = 80;
             $content = "<b>Your wallet money was updated <br>
			      you added money through CARD-NO $number <br>
				  OWNER CARD NAME $name <br>
			  your previous wallet balance was $realmon <br>
			  The money u added in to wallet is $mon <br>
			  The updated wallet balance is $nmoney  <br>
			   
			   INFINITY INN(feel the class)
			  
   			 </b>"; $mail->MsgHTML($content);
             $mail->IsHTML(true);
			 $mail->Send();
		 
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
  }
 
    $msg = "Money Added To ur Cart";
   echo "<script type='text/javascript'>alert('$msg');</script>";
   include "fservices.html";
  }
  
  