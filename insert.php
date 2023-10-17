<html>
  <head>
  <script src="jquery-3.3.1.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
  </head>
</html>



<?php 
include("config.php");


if (isset($_POST['reg']))
	{
	  $uname = $_POST['uname'];
	  $email = $_POST['email'];
	  $pass = $_POST['pass'];
	  $ph = $_POST['ph'];
	  $dob = $_POST['dob'];
	 
	
	$query="INSERT INTO register (uname ,email,pass,ph,dob) VALUES ('$uname', '$email','$pass','$ph','$dob')";

			  
		if ($db->query($query) === TRUE) 
			{	
	
	?>
			<script>

swal.fire({
icon: 'success',
                title: 'Resgistered',
                text: 'Successfully Resgistered'
}).then(function() {
    window.location = "index.php";
});
        </script>
		<?php
	}
	
	
	else 
			{
			echo "<script>alert('Already Registered');window.location.href='index.php';</script>";
			  
			}
	  
	}
?>
