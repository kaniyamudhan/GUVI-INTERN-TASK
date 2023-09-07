<?php
   session_start();
   
   if(session_destroy()) {
      header("Location:index");
   }
?>
<?php
// logout.php

// Start or resume the session
session_start();

// Perform any necessary logout actions
// For example: clearing session data
session_unset();
session_destroy();

// Return a response indicating success
echo json_encode(['message' => 'Logout successful']);
?>

