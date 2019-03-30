<?php   session_start();  ?>
<?php
      if(!isset($_SESSION['login_id'])) // If session is not set then redirect to Login Page
       {
           header("Location:flogin.html");  
       }

       else
      {
          header("Location:fservices.html");
        }		  
?>
