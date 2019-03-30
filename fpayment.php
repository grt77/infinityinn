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
</nav><br><br><br>
<div class="container">
    <div class='row'>
	<div class="col-sm-4 col-sm-offset-2 column-in-center" >
		  <form class="form-horizontal" action="payment.php" method="post">
		   <div class='form-group'>
              <div class='form-group required'>
                <label class='control-label' name='money'>Enter Amount To Add</label>
                <input class='form-control' placeholder="Enter Amount" type='text' name='money' required>
              </div>
            </div>
		  
            <div class='form-group'>
              <div class='form-group required'>
                <label class='control-label'>Name on Card</label>
                <input class='form-control' placeholder="Enter name" type='text' name='name' required>
              </div>
            </div>
			
			 
            <div class='form-group'>
				<div class='form-group required'>                
				<label class='control-label'>Card Number</label>
                <input autocomplete='off' class='form-control' placeholder="Enter correct card number" name='num' type='text' required>
              </div>
            </div>
            <div class='form-group'>
				<div class='form-group required' style="width:40%;float:left;">                
				<label class='control-label'>CVV</label>
                <input autocomplete='off' placeholder="For eg.,311" class='form-control' type='text'
				required>
              </div>
              <div class='form-group expiration required' size="4" style="width:30%;display:inline-block;float:right;">
                <label class='control-label'>Expiration</label>
                <input class='form-control card-expiry-month' style="text-align:center;" placeholder='YYYY' type='text' required>
              </div>
              <div class='form-group expiration required' size="2" style="width:20%;display:inline-block;float:right;">
                <label class='control-label'> </label>
                <input class='form-control card-expiry-year' style="text-align:center;" placeholder='MM' type='text' required>
              </div>
			  
			  <br>
			 
            </div><br><br>
            <div class='form-group'>
              <div class='form-group text-center'>
                <button class="btn btn-primary btn-default" style="font-size:15px;padding-left:50px;padding-right:50px;" type='submit'>ADD TO CART</button>
              </div>
            </div>
            <div class='form-row'>
              <div class='col-md-12 error form-group hide'>
                <div class='alert-danger alert'>
                  Please correct the errors and try again.
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class='col-md-4'></div>
    </div>
</div>
<br><br><br><br><br><br>
<div class="footer">
  <h1 style="text-align:center;font-family:Calibri;font-size:40px;color:#000000;">Contact</h1>
  <p style="font-size:20px;font-family:Calibri;">Email: sluvvy@gmail.com &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Mobile: +918886032772</p>
</div>
<script>


</body>
</html>
