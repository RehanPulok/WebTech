<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
</head>
<body>
   <?php
    session_start();
    include("Header.php");
    
    if(isset($_SESSION['username'])){
        session_destroy();
        header("location: Login.php");
        
    }
    include("Footer.php");
    ?>
    
</body>
</html>