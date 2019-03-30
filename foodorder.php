<?php   session_start();  ?>
<?php
require('phpmailer\class.phpmailer.php');
require('phpmailer\PHPMailerAutoload.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inf";
$user= $_SESSION['login_id'];
$date=date("Y-m-d") ;
$time= date("H:i:s");


$conn = mysqli_connect($servername, $username, $password, $dbname);

            $sql = "SELECT * FROM orderfood WHERE email='$user' and status=2";
$result4 = mysqli_query($conn, $sql);
if (mysqli_num_rows($result4) >0) {
	$array = array();
    while($row = mysqli_fetch_assoc($result4)) {
		
		 $array[] = $row;
		 
        		}
				$food=$array[0]['food'];
				
				$bill=$array[0]['totalbill'];
				$name=$array[0]['worker'];
		}
		           $sql = "SELECT * FROM workers WHERE name='$name'";
$result4 = mysqli_query($conn, $sql);
if (mysqli_num_rows($result4) >0) {
	$array = array();
    while($row = mysqli_fetch_assoc($result4)) {
		
		 $array[] = $row;
		 
        		}
				
				$phno=$array[0]['phno'];
				$id=$array[0]['id'];
		}
		
		   $sql = "SELECT * FROM reg WHERE email = '$user'";
$result5 = mysqli_query($conn, $sql);
if (mysqli_num_rows($result5) > 0) {
	$array = array();
    while($row = mysqli_fetch_assoc($result5)) {
		
		 $array[] = $row;
		 
        		}
		
					$realmon=$array[0]['wallet'];
			
		}
		
$nmoney=$realmon-$bill;

		
  $sql = "UPDATE `reg` SET `wallet` = '$nmoney' WHERE `reg`.`email` = '$user'";
  mysqli_query($conn, $sql);
  
		$sql = "UPDATE `orderfood` SET `status` = 1 WHERE `orderfood`.`email` = '$user' and `orderfood`.`date` = '$date'";
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
          $mail->AddAddress("$user");
           $mail->Subject = "FOOD ORDER BOOKED";
            $mail->WordWrap   = 80;
             $content = "<b>you ordered food <br> $food <br>
			  time is $time <br>date is $date
			  <br> Worker assigned $name<br>
              worker phno $phno <br>
			  <br>
			  total bill is $nmoney</b>";
			   
			  
			  
   			  $mail->MsgHTML($content);
             $mail->IsHTML(true);
			 $mail->Send();
		 
	$error = "You placed the order ,information is send to ur email";
echo "<script type='text/javascript'>alert('$error');</script>";
		 	 
		 
include "fservices.html";		 
		 
		 
		 
		 
		 
		 
		 
		 
		 

	   
 
