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

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $fdate = test_input($_POST["fdate"]);
  $tdate = test_input($_POST["tdate"]);
 
 
 
 
 $start = strtotime($fdate);
$end = strtotime($tdate);

$dateDiff  = ceil(abs($end - $start) / 86400);
  


  
  $nop = test_input($_POST["nop"]);
  $sql = "SELECT * FROM singlebed WHERE date='$fdate' and status=1 and type='single'";
  $result = mysqli_query($conn,$sql);
  $count = mysqli_num_rows($result);
  
  
  $sql = "SELECT * FROM reg WHERE email = '$user'";
$result5 = mysqli_query($conn, $sql);
if (mysqli_num_rows($result5) > 0) {
	$array = array();
    while($row = mysqli_fetch_assoc($result5)) {
		
		 $array[] = $row;
		 
        		}
					$phno1=$array[0]['phno'];
					$mon=$array[0]['wallet'];
			
		}
				
if($mon<(1500*($dateDiff+1)))
{	
  
   $msg ="you have a insufficent balance in the wallet";
   echo "<script type='text/javascript'>alert('$msg');</script>";
   include "fbooksingle.html";
  exit; 
}

if ($count<25)
{
	
$sql = "SELECT * FROM singlebed WHERE date='$fdate' and email='$user'";
$result = mysqli_query($conn,$sql);
$count = mysqli_num_rows($result);
$tcount=$count;
if($count==0)
{
   
   
   
 $sql = "SELECT * FROM singlebed WHERE date='$fdate'";
$result = mysqli_query($conn,$sql);
$count3 = mysqli_num_rows($result);
$count3 = $count3%10;

$count3 = $count3+1;


$sql = "SELECT * FROM workers WHERE sno='$count3'";
$result4 = mysqli_query($conn, $sql);
if (mysqli_num_rows($result4) > 0) {
	$array = array();
    while($row = mysqli_fetch_assoc($result4)) {
		
		 $array[] = $row;
		 
        		}
				$name=$array[0]['name'];
				$phno=$array[0]['phno'];
				$id=$array[0]['id'];
		}


$sql = "INSERT INTO fsinglebed (email,fdate,tdate,nop,status)
VALUES ('$user', '$fdate', '$tdate', '$nop', 1)";
if(mysqli_query($conn, $sql))
{ 
}		
$sql = "INSERT INTO singlebed (email,date,status,type)
VALUES ('$user', '$fdate', 1, 'single')";
mysqli_query($conn, $sql);   
$stop_date = new DateTime($fdate);   
for ($i=0;$i<$dateDiff;$i++)
{


 
$stop_date->modify('+1 day');
$s=$stop_date->format('Y-m-d ');

$sql = "INSERT INTO singlebed (email,date,status,type)
VALUES ('$user', '$s', 1, 'single')";
mysqli_query($conn, $sql);

}
  $msg = "Your are registered sucessfully and details about worker is send to  your mail-id";
         echo "<script type='text/javascript'>alert('$msg');</script>";
		  
		  // sending mail
		  
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
           $mail->Subject = "Room booked";
            $mail->WordWrap   = 80;
             $content = "<b>you booked a room of single bed room  <br> number of persons is $nop <br>
			 
			     from $fdate to $tdate <br>
				 Room no is INF$count3<br>
              worker assigned to ur table is $name <br>
			  His contact number $phno<br>
			   
			   INFINITY INN(feel the class)
			  
   			 </b>"; $mail->MsgHTML($content);
             $mail->IsHTML(true);
			 $mail->Send();
		 
		 
		 
		 
		 
		 
		 
		 
$sql = "INSERT INTO bworker (id,email,fdate,tdate,cphno,number)
VALUES ('$id', '$user', '$fdate', '$tdate', '$phno1', '$count3')";
if (mysqli_query($conn, $sql)) {
	
	   $sql = "SELECT * FROM reg WHERE email = '$user'";
$result5 = mysqli_query($conn, $sql);
if (mysqli_num_rows($result5) > 0) {
	$array = array();
    while($row = mysqli_fetch_assoc($result5)) {
		
		 $array[] = $row;
		 
        		}
		
					$realmon=$array[0]['wallet'];
			
		}
$nmoney=$mon-(1500*($dateDiff+1));		

		
$sql = "UPDATE `reg` SET `wallet` = '$nmoney' WHERE `reg`.`email` = '$user'";
  mysqli_query($conn, $sql);
  include"fservices.html";
}
	else{
	$msg = "The rooms are not avaliable for this date";
         echo "<script type='text/javascript'>alert('$msg');</script>";
		  include "fbooksingle.html";
}
}

		 
		 
		 else
	{
		$msg = "you are already booked a room on this day ,single user can book a room on paticular day ";
         echo "<script type='text/javascript'>alert('$msg');</script>";
		 include "fbooksingle.html"; 
	}
	
}
		 
		 
		 else{
 $msg = "The selected room is not avaliable";
         echo "<script type='text/javascript'>alert('$msg');</script>";
		 include "fbooksingle.html";
}

}
 
 
 
 
 

   
   
   
	  }
		
		
		
		
		
		
		
		
		





