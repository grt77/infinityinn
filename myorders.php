<!DOCTYPE html>
<html>
<head>
  <title>Infinity Inn.,</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <style>
  body {
    position: relative; 
  }
  #section1 {height:300px;color: #fff; background-color: #ffffff;}
  #section2 {height:300px;color: #fff; background-color: #ffffff;}
  #section8 {height:300px;color: #fff; background-color: #ffffff;}
  #section3 {height:200px;color: #fff; background-color: #ffffff;}
  
  .column-in-center{
    float: none;
    margin: 0 auto;
  }
  .footer {
   left: 0;
   bottom: 0;
   width: 100%;
   background-color:#d8ffd6;
   text-align: center;
   color:#000000;
  }
  </style>
</head>
<body>
<div class="page-header text-center" style="margin-bottom:0;font-family:HelvLight Medium;">
  <h1 style="font-weight:bold;">INFINITY INN.,</h1>
  <h4>Bed and Breakfast!</h4> 
</div>

<nav class="navbar navbar-inverse">
  <div class="container-fluid"
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>    
		  <span class="icon-bar"></span>  
      </button>
    </div>
    <div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="fservices.html">SERVICES</a></li>
		  <li><a href="gallery.html">GALLERY</a></li>
		  <li><a href="fpayment.php">ADD MONEY TO WALLET</a></li>
		 </ul>
          <ul class="nav navbar-nav navbar-right">
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">ACCOUNT<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li  class="list-group-item"><a href="myaccount.php">MY PROFILE</a></li>
              <li  class="list-group-item"><a href="myorders.php">MY ORDERS</a></li>
              <li  class="list-group-item"><a href="logout.php">LOGOUT</a></li></ul>
          </li>
    </ul>
   
      </div>
    </div>
  </div>
</nav>  


<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
<?php
  if(isset($_SESSION['login_id'])){
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inf";
$user= $_SESSION['login_id'];
$conn = mysqli_connect($servername, $username, $password, $dbname);
$sql = "SELECT * FROM ftable WHERE email = '$user'";
$result5 = mysqli_query($conn, $sql);
echo "<div class='row'>";
echo "<h3>";echo "<p class='text-center'>ABOUT TABLES INFO </p>";echo "</h3>";

 echo "<div class='col-sm-2' style='background-color:lavender;'><h4>EVENT<h4></div>";
  echo "<div class='col-sm-2' style='background-color:lavender;'><h4>NO OF PERSONS<h4></div>";
   echo "<div class='col-sm-2' style='background-color:lavender;'><h4>DATE<h4></div>";
    echo "<div class='col-sm-2' style='background-color:lavender;'><h4>TIME<h4></div>";
	 echo "<div class='col-sm-2' style='background-color:lavender;'><h4>BOOKED DATE<h4></div>";
	  echo "<div class='col-sm-2' style='background-color:lavender;'><h4>BOOKED TIME<h4></div>";

echo "</div>";
if (mysqli_num_rows($result5) > 0) {
	$array = array();
	
	



    while($row = mysqli_fetch_assoc($result5)) {
		
		 $array[] = $row;
}}
		 $i=mysqli_num_rows($result5) ;
		 
        		for($y=0;$y<$i;$y++)
				{
					
					$event=$array[$y]['event'];
					
					$type=$array[$y]['nop'];
					$date=$array[$y]['date'];
					$time=$array[$y]['time'];
					$bdate=$array[$y]['bdate'];
					$btime=$array[$y]['btime'];
			
		





echo "<div class='row'>";

echo "<div class='col-sm-2' style='background-color:white;'><h4>$event<h4></div>";
echo "<div class='col-sm-2' style='background-color:white;'><h4>$type<h4></div>";
echo "<div class='col-sm-2' style='background-color:white;'><h4>$date<h4></div>";
echo "<div class='col-sm-2' style='background-color:white;'><h4>$time<h4></div>";
echo "<div class='col-sm-2' style='background-color:white;'><h4>$bdate<h4></div>";
echo "<div class='col-sm-2' style='background-color:white;'><h4>$btime<h4></div>";
 

echo "</div>";




  }
   
  }
  ?>


<br>
<br>
<br>

<?php

$sql = "SELECT * FROM orderfood WHERE email = '$user'";
$result5 = mysqli_query($conn, $sql);
echo "<h3>";echo "<p class='text-center'>ABOUT FOOD INFO </p>";echo "</h3>";

 echo "<div class='col-sm-3' style='background-color:lavender;'><h4>FOOD ORDERED<h4></div>";
  echo "<div class='col-sm-3' style='background-color:lavender;'><h4>DATE <h4></div>";
   echo "<div class='col-sm-3' style='background-color:lavender;'><h4>TOTAL BILL<h4></div>";
    echo "<div class='col-sm-3' style='background-color:lavender;'><h4>WORKER ASSIGNED<h4></div>";
	 
	 

echo "</div>";



if (mysqli_num_rows($result5) > 0) {
	$array = array();
	
	



    while($row = mysqli_fetch_assoc($result5)) {
		
		 $array[] = $row;
}}
		 $i=mysqli_num_rows($result5) ;
		 
        		for($y=0;$y<$i;$y++)
				{
					
					$food=$array[$y]['food'];
					
					$date=$array[$y]['date'];
					$name=$array[$y]['worker'];
					$bill=$array[$y]['totalbill'];
					$sql = "SELECT * FROM workers WHERE name = '$name'";
                    $result6 = mysqli_query($conn, $sql);
					  while($row1 = mysqli_fetch_assoc($result6)) {
		
		                  $array1[] = $row1;
                     }
			
					 $wphno=$array1[0]['phno'];
								
		

                    



echo "<div class='row'>";

echo "<div class='col-sm-3' style='background-color:white;'><h4>$food<h4></div>";
echo "<div class='col-sm-3' style='background-color:white;'><h4>$date<h4></div>";
echo "<div class='col-sm-3' style='background-color:white;'><h4>$bill<h4></div>";
echo "<div class='col-sm-3' style='background-color:white;'><h4>$name($wphno)<h4></div>";

echo "</div>";




				}




















?>




<?php

$sql = "SELECT * FROM bworker WHERE email = '$user'";
$result5 = mysqli_query($conn, $sql);
echo "<h3>";echo "<p class='text-center'>ABOUT ROOM INFO </p>";echo "</h3>";

 echo "<div class='col-sm-3' style='background-color:lavender;'><h4>ROOM NUMBER<h4></div>";
  echo "<div class='col-sm-3' style='background-color:lavender;'><h4>FROM DATE <h4></div>";
   echo "<div class='col-sm-3' style='background-color:lavender;'><h4>TO DATE<h4></div>";
    echo "<div class='col-sm-3' style='background-color:lavender;'><h4>WORKER ASSIGNED<h4></div>";
	 
	 

echo "</div>";



if (mysqli_num_rows($result5) > 0) {
	$array = array();
	
	



    while($row = mysqli_fetch_assoc($result5)) {
		
		 $array[] = $row;
}}
		 $i=mysqli_num_rows($result5) ;
		 
        		for($y=0;$y<$i;$y++)
				{
					
					$number=$array[$y]['number'];
					
					$fdate=$array[$y]['fdate'];
					$tdate=$array[$y]['tdate'];
					$id=$array[$y]['id'];
					$sql = "SELECT * FROM workers WHERE id = '$id'";
                    $result6 = mysqli_query($conn, $sql);
					  while($row1 = mysqli_fetch_assoc($result6)) {
		
		                  $array1[] = $row1;
                     }
			
					 $wname=$array1[0]['name'];
					 $wphno=$array1[0]['phno'];			
		

                    



echo "<div class='row'>";

echo "<div class='col-sm-3' style='background-color:white;'><h4>INF$number<h4></div>";
echo "<div class='col-sm-3' style='background-color:white;'><h4>$tdate<h4></div>";
echo "<div class='col-sm-3' style='background-color:white;'><h4>$fdate<h4></div>";
echo "<div class='col-sm-3' style='background-color:white;'><h4>$wname($wphno)<h4></div>";

echo "</div>";




				}




















?>









<br><br><br><br><br><br>
<div class="footer">
  <h1 style="text-align:center;font-family:Calibri;font-size:40px;color:#000000;">Contact</h1>
  <p style="font-size:20px;font-family:Calibri;">Email: sluvvy@gmail.com &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Mobile: +918886032772</p>
</div>
<script>
</form>

</body>
</html>
