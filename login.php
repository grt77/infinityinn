<?php
   
   session_start();
   $servername = "localhost";
$username = "root";
$password = "";
$dbname = "inf";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(isset($_SESSION['login_id']))   // Checking whether the session is already there or not if 
                              // true then header redirect it to the home page directly 
{
    echo '<script type="text/javascript"> window.open("floginses.php","_self");</script>';
 }

   if($_SERVER["REQUEST_METHOD"] == "POST") {
       
      
      $myusername = $_POST['email'];
      $mypassword = $_POST['pass']; 
      
      $sql = "SELECT * FROM reg WHERE email = '$myusername' and pwd = '$mypassword'";
      $result = mysqli_query($conn,$sql);
      	 
      
      
      $count = mysqli_num_rows($result);
      
		
      if($count == 1) {
         
         $_SESSION['login_id'] = $myusername;
		 echo $_SESSION['login_id'];         
          echo '<script type="text/javascript"> window.open("floginses.php","_self");</script>';     
      }else {
         $error = "Your Login Name or Password is invalid";
		 echo "<script type='text/javascript'>alert('$error');</script>";
		 include "flogin.html";
      }
   }