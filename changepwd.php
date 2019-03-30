<?php   session_start();  ?>
<?php
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
$name = test_input($_POST["name"]);


$sql = "UPDATE `reg` SET `pwd` = '$name' WHERE `reg`.`email` = 'gattupalliravi1@gmail.com'";
 if(mysqli_query($conn, $sql))
 {
	  session_destroy();   // function that Destroys Session 
  header("Location:flogin.html");
 }
  }