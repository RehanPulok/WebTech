<!DOCTYPE HTML>
<html>

<head>
    <style>
        .error {
            color: #FF0000;
        }

    </style>
    <link link rel="stylesheet" href="style.css">

</head>

<body>

    <?php
// define variables and set to empty values
$nameErr = $emailErr = $websiteErr = $dobErr = $genderErr = $degreeErr = $bloodErr = "";
$name = $email = $website = $comment = $dob = $gender = $degree =$blood = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = ($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
      $name = "";
    }
      else if(str_word_count($name)<2){
          $nameErr = "Ivalid name. Please type your full name";
      }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = ($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
      $email = "";
    }
  }
    
  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = ($_POST["website"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
      $websiteErr = "Invalid URL";
      $website = "";
    }
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = ($_POST["comment"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = ($_POST["gender"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

    <h2>PHP Form Validation Example</h2>
    <p><span class="error">* required field</span></p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <fieldset style= "width: 300px">
        <legend>Name</legend>
        <input type="text" name="name" value="<?php echo $name;?>">
        <span class="error">* <?php echo $nameErr;?></span>
        </fieldset>
        <br>
        <fieldset style= "width: 300px">
        <legend>E-mail:</legend> 
        <input type="text" name="email" value="<?php echo $email;?>">
        <span class="error">* <?php echo $emailErr;?></span>
        </fieldset>
        <br>
        <fieldset style= "width: 300px">
        <legend>Website</legend>        
        <input type="text" name="website" value="<?php echo $website;?>">
        <span class="error"><?php echo $websiteErr;?></span>
        </fieldset>
        <br>
        <fieldset style= "width: 300px">
        <legend>Comment</legend> 
        <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
        <br>
        </fieldset>
        <fieldset style= "width: 300px">
        <legend>Gender</legend> 
        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
        <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other
        <span class="error">* <?php echo $genderErr;?></span>
        </fieldset>
        <br>
        <fieldset style= "width: 300px">
        <legend>Degree</legend> 
        <input type="checkbox" name="degree" <?php if (isset($degree) && $degree=="ssc") echo "checked";?> value="ssc">SSC
        <input type="checkbox" name="degree" <?php if (isset($degree) && $degree=="hsc") echo "checked";?> value="hsc">HSC
        <input type="checkbox" name="degree" <?php if (isset($degree) && $degree=="bsc") echo "checked";?> value="bsc">BSc
        <input type="checkbox" name="degree" <?php if (isset($degree) && $degree=="msc") echo "checked";?> value="msc">MSc
        <span class="error">* <?php echo $degreeErr;?></span>
        </fieldset>
        <br>
        <fieldset style= "width: 300px">
        <legend>Blood Group</legend> 
	    <select name="blood">
		<option <?php if (isset($blood) && $blood=="blank") echo "blank";?> value="blank">Select</option>
		<option <?php if (isset($blood) && $blood=="AB+") echo "AB+";?> value="AB+">AB+</option>
		<option <?php if (isset($blood) && $blood=="AB-") echo "AB-";?> value="AB-">AB-</option>
		<option <?php if (isset($blood) && $blood=="A+") echo "A+";?> value="A+">A+</option>
		<option <?php if (isset($blood) && $blood=="A-") echo "A-";?> value="A-">A-</option>
		<option <?php if (isset($blood) && $blood=="B+") echo "B+";?> value="B+">B+</option>
		<option <?php if (isset($blood) && $blood=="B-") echo "B-";?> value="B-">B-</option>
		<option <?php if (isset($blood) && $blood=="O+") echo "O+";?> value="O+">O+</option>
		<option <?php if (isset($blood) && $blood=="O-") echo "O-";?> value="O-">O-</option>
	    </select>		
	    <span class="error" >* <?php echo $bloodErr;?></span>
        </fieldset>
        <br>
        <br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
echo "<br>";
echo $comment;
echo "<br>";
echo $gender;
echo "<br>";
echo $degree;
echo "<br>";
echo $blood;
?>

</body>

</html>
