
<?php   session_start();  ?>
<?php

require('phpmailer\class.phpmailer.php');
require('phpmailer\PHPMailerAutoload.php');

      if(isset($_SESSION['login_id'])){
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inf";
$user = $_SESSION['login_id'];

date_default_timezone_set("Asia/Calcutta");
$fdate=date("Y-m-d") ;
$ftime= date("H:i:s");

$conn = mysqli_connect($servername, $username, $password, $dbname);

$date = $time = $nop = $event = "";


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);

   return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $date = test_input($_POST["bdate"]);
  $time = test_input($_POST["time"]);
  $nop = test_input($_POST["nop"]);
  $event = test_input($_POST["event"]);
  
$sql = "SELECT * FROM ftable WHERE date='$date' and nop='$nop' and status=1";
$result = mysqli_query($conn,$sql);
$count = mysqli_num_rows($result);
$sql = "SELECT * FROM ftable WHERE time<='$time' and date='$date' and status=1 and nop='$nop'";
$result = mysqli_query($conn,$sql);
$count1 = mysqli_num_rows($result);






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
		
		
if($mon<200)
{	
  
   $msg = "you have a insufficent balance in the wallet";
   echo "<script type='text/javascript'>alert('$msg');</script>";
   include "fbooktable.html";
  exit; 
}








if ($count<11)
{
	
$sql = "SELECT * FROM ftable WHERE date='$date' and email='$user'";
$result = mysqli_query($conn,$sql);
$count = mysqli_num_rows($result);
if($count==0)
{
	
	if($count1<11){
		
		
		
		
		
		
		$sql = "SELECT * FROM ftable WHERE date='$date'";
$result = mysqli_query($conn,$sql);
$count3 = mysqli_num_rows($result);
$count3 = $count%10;
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
		
		
		
		
		
		
		
		
		
		
		
		
		
	$sql = "INSERT INTO ftable (email,date,time,event,nop,bdate,btime,status)
VALUES ('$user', '$date', '$time', '$event', '$nop', '$fdate', '$ftime',1)";





if (mysqli_query($conn, $sql)) {
	
	
	
	
	
	
	
	
	
	
	      $msg = "Your are registered sucessfully and details about worker is send to  your mail-id";
         echo "<script type='text/javascript'>alert('$msg');</script>";
	













	$sql = "INSERT INTO worker (id,email,date,time,cphno)
VALUES ('$id', '$user', '$date', '$time', '$phno1')";
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
$nmoney=$mon-200;

		
$sql = "UPDATE `reg` SET `wallet` = '$nmoney' WHERE `reg`.`email` = '$user'";
  mysqli_query($conn, $sql);
  
	
	
	
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
           $mail->Subject = "Table booked";
            $mail->WordWrap   = 80;
             $content = "<b>you booked a table of type $event <br> number of persons is $nop <br>
			  time is $time
			  <br> Table number INF_T$count1
              worker assigned to ur table is $name <br>
			  His contact number $phno
			   
			  ONLY TWO HOURS IS ALLOCATED TO UR NAME ,AFTER IT IS DEALLOCATED
			  
   			 </b>"; $mail->MsgHTML($content);
             $mail->IsHTML(true);
			 $mail->Send();
		 
		 




	
	include "fservices.html";
	
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 

}


}



}
else{
	$msg = "The tables are not avaliable for this time";
         echo "<script type='text/javascript'>alert('$msg');</script>";
		  include "fbooktable.html";
}
}
	
	else
	{
		$msg = "you are already booked a table on this day ,single user can book a table on paticular day ";
         echo "<script type='text/javascript'>alert('$msg');</script>";
		 include "fbooktable.html"; 
	}
	
}
else{
 $msg = "The selected table is not avaliable";
         echo "<script type='text/javascript'>alert('$msg');</script>";
		 include "fbooktable.html";
}

}
	  }

