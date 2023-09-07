
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

