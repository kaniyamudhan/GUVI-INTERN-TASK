<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
$user = 'root';
$password = '';
$database = 'guvi';
$servername = 'localhost:3306';
$mysqli = new mysqli($servername, $user, $password, $database);
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location:index.php');
    exit();
} else {
    $s = $_SESSION['login_user'];
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

} ?>
<?php
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
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            outline: none;
            transition: border-color 0.3s ease-in-out;
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
    $('#profileForm').submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: 'dash.php',
            method: 'POST',
            data: $('#profileForm').serialize(),
            success: function (response) {
                // Check the response from the server, assuming the response is a JSON object
                var data = JSON.parse(response);
                
                // Check if the update was successful
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Profile Updated Successfully!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error Updating Profile',
                        text: 'An error occurred while updating your profile. Please try again later.'
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
});

        $(document).ready(function () {
    
            $('#editProfileButton').click(function () {
    
                $('#profileSection').toggle();
                $('#editSection').toggle();
            });
        });

        $(document).ready(function () {
    $('#profileForm').submit(function (e) {
        e.preventDefault();

        Swal.fire({
            title: 'Do you want to save the changes?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Save',
            denyButtonText: `Don't save`,
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire('Saved!', '', 'success')
                $.ajax({
                    url: 'dash.php',
                    method: 'POST',
                    data: $('#profileForm').serialize(),
                    success: function (response) {
                        var data = JSON.parse(response);
                        if (data.success) {
                            Swal.fire('Saved!', '', 'success');
                        } else {
                            Swal.fire('Error!', 'An error occurred while updating your profile.', 'error');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info');
            }
        });
    });
});

        $(document).ready(function () {
          
            $('#logoutButton').click(function () {
              
                $.ajax({
                    url: 'logout.php',
                    method: 'POST',   
                    success: function (response) {
                     
                        window.location.href = 'index.php'; 
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
      
        document.getElementById('openNavBtn').addEventListener('click', function () {
            document.getElementById('mySidenav').style.width = '250px';
            document.getElementById('main').style.marginLeft = '250px';
        });

    
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
