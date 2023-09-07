<?php
   session_start();
   
   if(session_destroy()) {
      header("Location:index");
   }
?>
<?php
session_start();
session_unset();
session_destroy();
echo json_encode(['message' => 'Logout successful']);
?>

