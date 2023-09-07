<?php
$user = 'root';
$password = '';
$database = 'guvi1';
$servername = 'localhost:3306';
$mysqli = new mysqli($servername, $user, $password, $database);
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location:index.php');
    exit();
} else {
    $s = $_SESSION['login_user'];
}
// Handle form submission for editing and saving
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $ph = $_POST['ph'];
    $dob = $_POST['dob'];

    // Update the data in the database
    $updateQuery = "UPDATE register SET uname='$uname', pass='$pass', ph='$ph', dob='$dob' WHERE email='$email'";
    if ($mysqli->query($updateQuery)) {
        // Redirect back to the profile page after saving
        header("Location: dash.php");
        exit();
    }

} ?>
<?php
// SQL query to select data from database
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>GUVI-TASK</title>
    <link rel="icon" href="guvi15.png" type="image/x-icon">
    <link rel="stylesheet" href="update_details.css">
</head>

<body>
    <style>
        .rounded-input {
            width: 100%;
            /* You can adjust the width as needed */
            padding: 10px;
            /* Reduce the padding to make the input boxes shorter */
            border: 1px solid #ccc;
            border-radius: 8px;
            outline: none;
            transition: border-color 0.3s ease-in-out;
            /* You can adjust the font size as needed */
        }
    </style>
    <section>


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
                <a href="update_details.php">Update Profile</a>
                <a href="index.php">Logout</a>
            </div>

            <img class="rounded-circle image-profile" style="margin-top: 100px; " src="guvi2.png"
                alt="Profile Picture" />
            <div class="profile-card" style="margin-top: 50px;">
                <h1 class="fw-bold ; text-success " style=" text-align: center;">Edit Profile</h1>
                <form method="post" id="profileForm">
                    <div class="table-container">
                        <table style="width:auto;">


                            <?php
                            foreach ($result as $p) { ?>
                                <tr>
                                    <th class="fw-normal"> Username</th>
                                    <td><input class="rounded-input" type="text" name="uname" value="<?= $p['uname']; ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <th class="fw-normal">Email</th>

                                    <td><input class="rounded-input" type="email" name="email" value="<?= $p['email']; ?>"
                                            readonly></td>
                                </tr>

                                <th class="fw-normal">Password</th>
                                <td>
                                    <div class="password-input-container">
                                        <input class="rounded-input" type="text" name="pass" id="pass"
                                            value="<?php echo $p['pass']; ?>">

                                    </div>

                                </td>
                                </tr>


                                <tr>
                                    <th class="fw-normal">Contact</th>
                                    <td><input class="rounded-input" type="text" name="ph" value="<?php echo $p['ph']; ?>">
                                    </td>
                                </tr>



                                <tr>
                                    <th class="fw-normal">DOB</th>
                                    <td><input class="rounded-input" type="date" name="dob"
                                            value="<?php echo $p['dob']; ?>"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center">




                                        <div id="liveAlertPlaceholder"></div>
                                        <button type="submit" class="btn btn-success" id="liveAlertBtn"
                                            style="margin:10px; ">Save</button>


                                    </td>
                                </tr>
                            <?php }
                            ?>
                        </table>
                    </div>
                </form>
            </div>



        </div>
    </section>

    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // When the "Edit Profile" button is clicked
            $('#editProfileButton').click(function () {
                // Toggle visibility of the profile and edit sections
                $('#profileSection').toggle();
                $('#editSection').toggle();
            });
        });

        $(document).ready(function () {
            // Attach a submit event handler to the form
            $('#profileForm').submit(function (e) {
                e.preventDefault(); // Prevent the form from submitting normally

                // Perform an AJAX request to update the data
                $.ajax({
                    url: 'dash.php', // Replace with the URL that handles the update
                    method: 'POST',
                    data: $('#profileForm').serialize(), // Serialize the form data
                    success: function (response) {
                        // Update the content on the page if needed
                        // For example, you can update a success message or indicate that the update was successful
                        $('#saveButton').text('Saved'); // Change the button text
                    },
                    error: function (xhr, status, error) {
                        // Handle errors if necessary
                        console.error(error);
                    }
                });
            });
        });
        $(document).ready(function () {
            // Attach a click event to the logout button
            $('#logoutButton').click(function () {
                // Send an AJAX request to the logout endpoint
                $.ajax({
                    url: 'logout.php', // Replace with your logout endpoint
                    method: 'POST',    // Use POST or GET based on your backend setup
                    success: function (response) {
                        // Redirect to the login page or perform other actions
                        window.location.href = 'index.php'; // Replace with your login page
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
        // JavaScript to open the side navigation bar
        document.getElementById('openNavBtn').addEventListener('click', function () {
            document.getElementById('mySidenav').style.width = '250px';
            document.getElementById('main').style.marginLeft = '250px';
        });

        // JavaScript to close the side navigation bar
        document.getElementById('closeNavBtn').addEventListener('click', function () {
            document.getElementById('mySidenav').style.width = '0';
            document.getElementById('main').style.marginLeft = '0';
        });

    </script>

</body>
<footer>
    <br>
    <br>
</footer>

</html>