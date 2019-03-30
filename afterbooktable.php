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
          <li><a href="#section1">ABOUT</a></li>
          <li><a href="#section2">SERVICES</a></li>
          <li><a href="#section3">SETTINGS</a></li>
		  <li><a href="#section6">GALLERY</a></li>
		 </ul>
          <ul class="nav navbar-nav navbar-right">
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">ACCOUNT<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li  class="list-group-item"><a href="#section51">MY PROFILE</a></li>
              <li  class="list-group-item"><a href="#section52">MY ORDERS</a></li>
             
			  <li  class="list-group-item"><a href="fpayment.php">ADD MONEY TO WALLET</a></li>
			   <li  class="list-group-item"><a href="#section53">LOGOUT</a></li>
            </ul>
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



 echo "<h3>YOU BOOKED A TABLE ,THE TABLE DETAILS ADDED YOUR MY-ORDERS</h3>";
 



echo '<br>';
echo '<br>';
echo '<br>';
echo '<br>';
echo '<br>';



 
echo "<h4>YOUR ASSIGNED WAITER-DETAILS TO THE TABLE IS SENT TO UR MAIL</h4>";

  }

  
  ?>


<br>
<br>
<br>



<br><br><br><br><br><br>
<div class="footer">
  <h1 style="text-align:center;font-family:Calibri;font-size:40px;color:#000000;">Contact</h1>
  <p style="font-size:20px;font-family:Calibri;">Email: sluvvy@gmail.com &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Mobile: +918886032772</p>
</div>
<script>
</form>

</body>
</html>
