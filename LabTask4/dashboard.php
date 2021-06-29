<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
   <?php
    session_start();
    include("Header.php");
    
    if(isset($_SESSION['username']))
    {
    ?>
    <section>
     <nav>
    <ul>
      <li><a href="Profile.php">View Profile</a></li>
      <li><a href="EditProfile.php">Edit Profile</a></li>
      <li><a href="UploadPicture.php">Upload Profile Picture</a></li>
      <li><a href="UploadFile.php">Upload Lecture</a></li>
      <li><a href="ChangePassword.php">Change Password</a></li>
      <li><a href="UpNotice.php">Upload Notice</a></li>
      <li><a href="Logout.php">Logout</a></li>
    </ul>
  </nav>   
  <article>
     <?php
      echo "<h1> Welcome ".$_SESSION['username']."</h1>";
      ?>
      
  </article>
      
  </section>
   <?php
    }
    else{
        header('location: login.php');
    }
    include("Footer.php");
    ?>
    
</body>
</html>