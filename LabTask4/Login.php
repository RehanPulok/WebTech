<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<style>
        body{
          margin: auto;
          width: 30%;
          padding: 20px;

        }
        .make-it-center{
          margin: auto;
          width: 50%;
        }
        .error{
        	color: red;
        }
        .required:after {
          content:"*";
          color: red;
        }
    </style>
</head>
<body>
<?php
    include("Header.php");
    
    ?>

<?php
$userErr = $passErr = "";
$username = $password = ""; 
$errCount = 0;
    session_start();
    
    

	if(isset($_POST['submit']))
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if (empty($_POST["username"])) {
	    $userErr = "Username is required";
	    $errCount = $errCount + 1;	
	  } else {
	    $username = check_input($_POST["username"]);

	    if (strlen($username) <2 ) {
	    	$userErr = "Minimum 2 characters required";
	    	$errCount = $errCount + 1;	
	    }

	    
	    if (!preg_match("/^[a-zA-Z_\-.]*$/", $username)) {
	    	$userErr = "Username can contain alpha numeric characters, period, dash or underscore only!";
	    	$username ="";
	    	$errCount = $errCount + 1;	
	    }

	  }

  if (empty($_POST["password"])) {
    $passErr = "Password is required";
    $errCount = $errCount + 1;	
  } else {
    $password = check_input($_POST["password"]);
  }

  	if (strlen($password) <8 ) {
	    	
	    	$passErr = "Minimum 8 characters required";
	    	$errCount = $errCount + 1;	
	    }

    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[%$#@]).+$/", $password)) {
    	
	    	$passErr .= " Password must contain atleast a digit, a lower case and an upper case letter, atleast one of the [%$#@] and no space.";
	    	$password ="";
	    	$errCount = $errCount + 1;	
	    }

    if ($errCount < 1){
        $_SESSION['flag'] = true;
        $_SESSION['username']=$_POST['username'];
        $_SESSION['password']=$_POST['password'];

        $strJsonFileContents = file_get_contents("data.json");
        

        $arra = json_decode($strJsonFileContents);
        
        $user_found = false;
        foreach($arra as $item) {
            if ($username === $item->username){
                $user_found = true;
               
                if ($password === $item->password){
                    if(isset($_POST['rembr'])){
                        $_COOKIE['username']=$_POST['username'];
                        $_COOKIE['password']=$_POST['password'];
                    setcookie("username",$_POST['username'],time()+50);
                    setcookie("password",$_POST['password'],time()+50);
                    
                    
                    header('Location: dashboard.php');
                    }
                    else{
                        header('Location: dashboard.php');
                    }
                    
                    
                }else{
                    $passErr .= "Password Wrong!";
                }
            }
        }
        if (!$user_found){
            echo $userErr .= "No account found!";
        }

    }

}
    }
    



  function check_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
    

?>

<div class="donor-info make-it-center">
<fieldset>
<legend> <b> Login</b></legend>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  <label>Username:</label> 
  <input type="text" name="username" value="<?php echo $username;?>">
  <span class="error">* <?php echo $userErr;?></span>
  <br><br>
  <label>Password:</label>  
  <input type="password" name="password" value="<?php echo $password;?>">
  <span class="error">* <?php echo $passErr;?></span>
  <br><br>
  <input type="checkbox" id="rembr" name="rembr" value="True">
  <label for="rembr"> Remember Me</label>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
  <span>Forgot Password?</span>

</form>
</fieldset>
</div>
<?php
    include("Footer.php");
    ?>


</body>
</html>