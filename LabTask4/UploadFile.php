<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Profile Picture</title>
	<style>
        body{
          margin: auto;
          width: 40%;
          padding: 20px;
        }

        .make-it-center{
          margin: auto;
          width: 75%;
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
$imgErr = "";
if(isset($_POST["submit"])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file_to_up"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $mime_type_arr = array('doc', 'pdf');
  if (in_array($imageFileType, $mime_type_arr)) {
      echo $_FILES["image_to_up"]["size"];
  	if ($_FILES["image_to_up"]["size"] > 10000000) {
	  $imgErr .= " Sorry, your file is larger than 10MB";
	  $uploadOk = 0;
	} else {
		if (file_exists($target_file)) {
		  $imgErr .= " Sorry, File already exists.";
		  $uploadOk = 0;
		} else{
			if (move_uploaded_file($_FILES["file_to_up"]["tmp_name"], $target_file)) {
			    echo "<span style='color:green;'>"."The file ". htmlspecialchars( basename( $_FILES["file_to_up"]["name"])). " has been uploaded succesfully.</span>";
			  } else {
			    $imgErr .= "Sorry, there was an problem uploading your file.";
			  }
		}
	}
  } else {
  	$imgErr .= " Sorry, only doc & pdf files are allowed";
	$uploadOk = 0;
  }
}
?>

<div class="make-it-center">
<fieldset>
<legend> <b> Profile Picture</b></legend>
<img src="pp.jpg" alt="pp">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data"> 

  <input type="file" id="file_to_up" name="file_to_up"><br>
  <span class="error"> <?php echo $imgErr;?></span> <br><br>

  <input type="submit" value="Upload Lecture notes" name="submit">
  
</form>
</fieldset>
</div>

</body>
</html>