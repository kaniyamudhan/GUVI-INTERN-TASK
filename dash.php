
<?php
$user = 'root';
$password = '';
$database = 'guvi1';
$servername='localhost:3306';
$mysqli = new mysqli($servername, $user, $password, $database);
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
session_start();
if (!isset($_SESSION['loggedin'])) 
{
	header('Location:index.php');
	exit();
}
else
{
	$s=$_SESSION['login_user'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $ph = $_POST['ph'];
    $dob = $_POST['dob'];


    $updateQuery = "UPDATE register SET uname='$uname', pass='$pass', ph='$ph', dob='$dob' WHERE email='$email'";
    if ($mysqli->query($updateQuery)) {
      
        header("Location: dash.php");
        exit();
    }

}?><?php

$sql = "SELECT * FROM register where email='$s'";
$result = $mysqli->query($sql);
//$rows=$result;
$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>GUVI-TASK</title>
<link rel="icon" href="guvi15.png" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="dash.css">
</head>
<body>
        

    <div class="container">
   
    <a id="logoutButton" class="logout-button" href="index.php">Logout</a>
    <span style="font-size:20px;cursor:pointer" id="openNavBtn">&#9776; </span>
    <div id="mySidenav" class="sidenav">
    <a href="#" id="closeNavBtn" class="closebtn">&times;</a>

    
        <span style="font-size:15px;cursor:pointer; position: absolute; top: 50px; left: 20px;" id="openNavBtn">
            <span style="color: white; font-weight: bold;">Dashboard</span>
        </span>
    <br>
    <a href="dash.php">Home</a>
    <a href="update_details.php" >Update Profile</a>
    <a href="index.php">Logout</a>

</div>
<div>

    <img class="rounded-circle image-profile"  style="margin-top: 100px; " src="guvi2.png" alt="Profile Picture" />
</div>

        <div class="profile-card" style="margin-top: 50px;" >
        
        <h1 class="fw-bold ; text-success " style=" text-align: center;">User Profile</h1>
            <form method="post" id="profileForm">
                <div class="table-container" >
                    <table class="responsive-table">

                    
                       <?php
                       foreach($result as $p){  ?>

                        <tr>
                            <th class="fw-normal "> Username:</th>
                            <td style="color:black; margin-right: 900px;"><?=  $p['uname']; ?></td>
                        </tr>
                        <tr>
                            <th class="fw-normal">Email:</th>
                            <td style="color:black";><?php echo $p['email']; ?></td>
                        </tr>
                        <tr>
                        <tr>
                        <tr>
                        <tr>
    <th class="fw-normal">Password:</th>
    <td style="color:black";>
    <div class="password-input-container">
    <?php echo $p['pass']; ?>
    
</div>

    </td>
</tr>


<tr>
    <th class="fw-normal">Contact:</th>
    <td style="color:black";><?php echo $p['ph']; ?>
</tr>


                        
                        <tr>
                            <th class="fw-normal">DOB:</th>
                            <td style="color:black";><?php echo $p['dob']; ?></td>
                        </tr>
                        <tr>
                           
                                
                                
                                
                            </td>
                        </tr>
                       <?php }
                       ?>
                    
                </div>
            </form></table>
        </div>

       

    </div>
                       </div>
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

    $('#editProfileButton').click(function() {
        
        $('#profileSection').toggle();
        $('#editSection').toggle();
    });
});

$(document).ready(function() {
   
    $('#profileForm').submit(function(e) {
        e.preventDefault(); 

       
        $.ajax({
            url: 'dash.php', 
            method: 'POST',
            data: $('#profileForm').serialize(),
            success: function(response) {
                $('#saveButton').text('Saved');
            },
            error: function(xhr, status, error) {
           
                console.error(error);
            }
        });
    });
});
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    // When the "Edit Profile" button is clicked
    $('#editProfileButton').click(function() {
        // Toggle visibility of the profile and edit sections
        $('#profileSection').toggle();
        $('#editSection').toggle();
    });
});

$(document).ready(function() {
    // Attach a submit event handler to the form
    $('#profileForm').submit(function(e) {
        e.preventDefault(); // Prevent the form from submitting normally

        // Perform an AJAX request to update the data
        $.ajax({
            url: 'dash.php', // Replace with the URL that handles the update
            method: 'POST',
            data: $('#profileForm').serialize(), // Serialize the form data
            success: function(response) {
                // Update the content on the page if needed
                // For example, you can update a success message or indicate that the update was successful
                $('#saveButton').text('Saved'); // Change the button text
            },
            error: function(xhr, status, error) {
                // Handle errors if necessary
                console.error(error);
            }
        });
    });
});
$(document).ready(function() {
    // Attach a click event to the logout button
    $('#logoutButton').click(function() {
        // Send an AJAX request to the logout endpoint
        $.ajax({
            url: 'logout.php', // Replace with your logout endpoint
            method: 'POST',    // Use POST or GET based on your backend setup
            success: function(response) {
                // Redirect to the login page or perform other actions
                window.location.href = 'index.php'; // Replace with your login page
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
});// JavaScript to toggle the side navigation bar
document.getElementById('openNavBtn').addEventListener('click', function() {
    toggleNav();
});

document.getElementById('closeNavBtn').addEventListener('click', function() {
    toggleNav();
});

// Function to toggle the navigation bar
function toggleNav() {
    var sideNav = document.getElementById('mySidenav');
    var mainContent = document.getElementById('main');

    if (sideNav.style.width === '250px') {
        sideNav.style.width = '0';
        mainContent.style.marginLeft = '0';
    } else {
        sideNav.style.width = '250px';
        mainContent.style.marginLeft = '250px';
    }
}

</script>

</body>
<footer>
    <br>
    <br>
</footer>
</html>
