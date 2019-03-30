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
      <<div class="collapse navbar-collapse" id="myNavbar">
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
$sql = "SELECT * FROM reg WHERE email = '$user'";
$result5 = mysqli_query($conn, $sql);
if (mysqli_num_rows($result5) > 0) {
	$array = array();
    while($row = mysqli_fetch_assoc($result5)) {
		
		 $array[] = $row;
		 
        		}
		
					$fname=$array[0]['fname'];
					$lname=$array[0]['lname'];
					$email=$array[0]['email'];
					$aadhar=$array[0]['aadhar'];
					$phno=$array[0]['phno'];
					$mon=$array[0]['wallet'];
			
		}




echo "<div class='row'>";
 echo "<div class='col-sm-4' style='background-color:lavender;'><h4>FIRST NAME<h4></div>";
 
echo "<div class='col-sm-8' style='background-color:lavenderblush;'><h4>$fname<h4></div>";
echo "</div>";



echo "<div class='row'>";
 echo "<div class='col-sm-4' style='background-color:lavender;'><h4>LAST NAME<h4></div>";
 
echo "<div class='col-sm-8' style='background-color:lavenderblush;'><h4>$lname<h4></div>";
echo "</div>";


echo "<div class='row'>";
 echo "<div class='col-sm-4' style='background-color:lavender;'><h4>EMAIL-ID<h4></div>";
 
echo "<div class='col-sm-8' style='background-color:lavenderblush;'><h4>$email<h4></div>";
echo "</div>";


echo "<div class='row'>";
 echo "<div class='col-sm-4' style='background-color:lavender;'><h4>AADHAR-NUMBER<h4></div>";
 
echo "<div class='col-sm-8' style='background-color:lavenderblush;'><h4>$aadhar<h4></div>";
echo "</div>";


echo "<div class='row'>";
 echo "<div class='col-sm-4' style='background-color:lavender;'><h4>PHONE NUMBER<h4></div>";
 
echo "<div class='col-sm-8' style='background-color:lavenderblush;'><h4>$phno<h4></div>";
echo "</div>";

echo "<div class='row'>";
 echo "<div class='col-sm-4' style='background-color:lavender;'><h4>WALLET MONEY<h4></div>";
 
echo "<div class='col-sm-8' style='background-color:lavenderblush;'><h4>$mon/-<h4></div>";
echo "</div>";

  }
  ?>


<br>
<br>
<br>
<nav class="navbar navbar-inverse">
  <ul class="nav navbar-nav">
  <li><a href="fchangefirst.html">CHANGE FIRST NAME</a></li>
    <li><a href="fchangelast.html">CHANGE LAST NAME </a></li>
    <li><a href="fchangephno.html">CHANGE PHONENUMBER</a></li>
    <li><a href="fchangepwd.html">CHANGE PASSWORD</a></li>
  </ul>
 
</nav>




<br><br><br><br><br><br>
<div class="footer">
  <h1 style="text-align:center;font-family:Calibri;font-size:40px;color:#000000;">Contact</h1>
  <p style="font-size:20px;font-family:Calibri;">Email: sluvvy@gmail.com &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Mobile: +918886032772</p>
</div>
<script>
</form>

</body>
</html>
