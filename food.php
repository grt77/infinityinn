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
 
	
    .myDiv {
    position: relative;
    z-index: 1;
}

.myDiv:before {
    content: "";
    position: absolute;
    z-index: -1;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background: url("dinecrop.jpg");
    opacity: .1;
}
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
  .dropdown-menu>li>a {
    display: block;
    padding: 0px 10px;
    clear: both;
    font-weight: 400;
    line-height: 1.42857143;
    color: #333;
    white-space: nowrap;
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
             <ul class="dropdown-menu">
             <li  class="list-group-item"><a href="myaccount.php">MY PROFILE</a></li>
              <li  class="list-group-item"><a href="myorders.php">MY ORDERS</a></li>
              <li  class="list-group-item"><a href="logout.php">LOGOUT</a></li>
            </ul>
          </li>
    </ul>
          </li>
    </ul>
      </div>
    </div>
  </div>
</nav>


<?php   session_start();  ?>
<?php
require('phpmailer\class.phpmailer.php');
require('phpmailer\PHPMailerAutoload.php');

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
					$phno1=$array[0]['phno'];
					$mon=$array[0]['wallet'];
			
		}
if(isset($_SESSION['login_id'])){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
             
 
	   $order[]=$_POST['order1'];
	   $order[]=$_POST['order2']; 
	   $order[]=$_POST['order3'];
	   $order[]=$_POST['order4'];
	   $order[]=$_POST['order5'];
	   $order[]=$_POST['order6'];
	   $order[]=$_POST['order7'];
	   $order[]=$_POST['order8'];
	   $order[]=$_POST['order9'];
	   $order[]=$_POST['order10'];
	   $order[]=$_POST['order11'];
	   
	   
	   $name[]="Chicken Dum Biryani";
	   $name[]="Egg Fried Rice";
	   $name[]="Paneer Rice";
	   $name[]="palak paneer";
	   $name[]="Cashew Nut curry";
	   $name[]="Butter chicken Pizza";
	   $name[]="Chocolate Milkshake";
	   $name[]="Boneless chicken Biriyani";
	   $name[]="Masala Dosa";
	   $name[]="Sambhar Idly";
	   $name[]="Special Chicken Biriyani";
	   $food="";
        
        $cost[]=250;$cost[]=130;$cost[]=170;$cost[]=75;$cost[]=98;$cost[]=200;$cost[]=75;$cost[]=210;$cost[]=50;$cost[]=45;$cost[]=175;		
	   $tcost=$order[0]*250+$order[1]*130+$order[2]*170+$order[3]*75+$order[4]*98+$order[5]*200+$order[6]*75+$order[7]*210+$order[8]*50+
	   $order[9]*45+$order[10]*175;
	   echo "<div class='row'>";
echo "<h3>";echo "<p class='text-center'>ABOUT ORDER INFO </p>";echo "</h3>";

 echo "<div class='col-sm-3' style='background-color:lavender;'><h4>FOOD ITEM<h4></div>";
  echo "<div class='col-sm-3' style='background-color:lavender;'><h4>QUANTITY<h4></div>";
   echo "<div class='col-sm-3' style='background-color:lavender;'><h4>EACH ONE COST<h4></div>";
    echo "<div class='col-sm-3' style='background-color:lavender;'><h4>TOTAL COST<h4></div>";
	 echo "</div>";
	   
	   
	  $in=0;
	   for($i=0;$i<11;$i++)
	   {
		   if($order[$i]!=0)
		   {
			  $in=1; 
              $food.=$name[$i];
              $food.="(";
               $food.=$order[$i];
               $food.=")";			   
       			  
			   echo "<div class='row'>";

echo "<div class='col-sm-3' style='background-color:lavenderblush;'><h4>$name[$i]<h4></div>";
echo "<div class='col-sm-3' style='background-color:lavenderblush;'><h4>$order[$i]<h4></div>";
echo "<div class='col-sm-3' style='background-color:lavenderblush;'><h4>$cost[$i]/-<h4></div>";
$temp=$cost[$i]*$order[$i];
echo "<div class='col-sm-3' style='background-color:lavenderblush;'><h4>$temp/-</h4></div>";

 

echo "</div>";


         
           
	   }}
	   
	  echo "<br>";
	   echo "<br>";
	  
 		

	
}}
if($in==0)
{
	   $msg = "select the food items ";
   echo "<script type='text/javascript'>alert('$msg');</script>";
   exit;
}
else{
	echo "<div class='row'>";
       echo "<div class='col-sm-3' style='background-color:white;'><h4><h4></div>";
       echo "<div class='col-sm-3' style='background-color:white;'><h4><h4></div>";
	   echo "<div class='col-sm-3' style='background-color:white;'><h4>TOTAL ITEMS COST<h4></div>";
	   echo "<div class='col-sm-3' style='background-color:white;'><h4>$tcost/-<h4></div>";
	   echo "</div>";
	   
	   $gst=12*$tcost/100;
 echo "<div class='row'>";
       echo "<div class='col-sm-3' style='background-color:white;'><h4><h4></div>";
       echo "<div class='col-sm-3' style='background-color:white;'><h4><h4></div>";
	   echo "<div class='col-sm-3' style='background-color:white;'><h4>GST(12%)<h4></div>";
	   echo "<div class='col-sm-3' style='background-color:white;'><h4>$gst/-<h4></div>";
	   
	   echo "</div>";
	   $net=$gst+$tcost;
	    echo "<div class='row'>";
       echo "<div class='col-sm-3' style='background-color:white;'><h4><h4></div>";
       echo "<div class='col-sm-3' style='background-color:white;'><h4><h4></div>";
	   echo "<div class='col-sm-3' style='background-color:white;'><h4>NET AMOUNT<h4></div>";
	   echo "<div class='col-sm-3' style='background-color:white;'><h4>$net/-<h4></div>";
	   
	   echo "</div>";
	   
	   
	   if($mon<$net)
	   {
		   echo "<div class='container'>";
  
           echo "<center><a href='foodorder.html' class='btn btn-info' role='button'>you have insufficent balance</a></center>";
 
              echo "</div>";
			
			  
}

else{

         $fdate=date("Y-m-d") ;
		 $sql = "SELECT * FROM orderfood WHERE date='$fdate' and status=1";
           $result = mysqli_query($conn,$sql);
         $count = mysqli_num_rows($result);
		 $count=$count+1;
		  $count=$count%10;
           $sql = "SELECT * FROM workers WHERE sno='$count'";
$result4 = mysqli_query($conn, $sql);
if (mysqli_num_rows($result4) >=0) {
	$array = array();
    while($row = mysqli_fetch_assoc($result4)) {
		
		 $array[] = $row;
		 
        		}
				$nam=$array[0]['name'];
				
				$phno=$array[0]['phno'];
				$id=$array[0]['id'];
		}
		
		
		$sql ="DELETE FROM `orderfood` WHERE status=2 and email='$user'";
		                        	mysqli_query($conn, $sql);
	
       
		$sql = "INSERT INTO orderfood (email,food,totalbill,date,worker,status)
             VALUES ('$user', '$food', '$net', '$fdate', '$nam', 2)";

	           	mysqli_query($conn, $sql);
		
		
	echo"<center><textarea rows='4' cols='50' name='id' >";
       echo"  ENTER  YOUR ADDRESS HERE ";
echo "</textarea>";
		
		
		
	      echo "<div class='container'>";
  
            echo "<center><a href='foodorder.php' class='btn btn-info' role='button'>Proceed for payment</a></center>";
 
              echo "</div>";
			  
}

}

 ?>













<div class="footer">
  <h1 style="text-align:center;font-family:Calibri;font-size:40px;:#000000;">Contact</h1>
  <p style="font-size:20px;font-family:Calibri;">Email: sluvvy@gmail.com &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Mobile: +918886032772</p>
</div>
<script>


</body>
</html>



















