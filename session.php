<?php
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) 
{
	header('Location:index.php');
	exit();
}
else
{
	$s=$_SESSION['login_user'];
}

$query = "SELECT * FROM login WHERE ID='$s'";
    $query_run = mysqli_query($db, $query);
	if(mysqli_num_rows($query_run) > 0){
	$row = mysqli_fetch_assoc($query_run);
	$dept=$row['ID'];
	}


?>