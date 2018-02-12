<?php
if ((isset($_POST['submit']) && (count($_POST) > 0))){
    $connect = new mysqli("localhost","root","","image");
    $j = 0;     // For indexing uploaded img.
    $file_path ="uploads/"; // Path for uploaded images
    for($i=0;$i< count($_FILES['file']['name']);$i++){ //get individual element from []
        $valid_img_types = ["jpg","jpeg","png","gif"]; //valid extension files
        $ext = explode('.',basename($_FILES['file']['name'][$i])); //explode file name from dot(.) basename()function returns the filename from a path.
        $file_extension = end($ext); //end is Output the value of the current and the last element in an array: and we are Store extensions in the variable.
        $file_path = $file_path.md5(uniqid()).".".$ext[count($ext)-1]; // Set the file path with a new name of image.uniqid Generate a unique ID
        $j++;      // Increment the number of uploaded images according to the files in array.
        if(($_FILES['file']['size'][$i] < 500000)&& in_array($file_extension,$valid_img_types)){  //500kb file can be uploaded
// file move to db
            if($connect === false){
                die("ERROR: Could not connect. " . $connect->connect_error);
            }

// Attempt insert query execution
            $sql = "INSERT INTO img (path) VALUES ('$file_path')";
            if($connect->query($sql) === true){
                echo $j."Records inserted successfully.";
            } else{
                echo "ERROR: Could not able to execute $sql. " . $connect->error;
            }

// Close connection
// file move to folder

              if(move_uploaded_file($_FILES['file']['tmp_name'][$i],$file_path)){ //file moved to upload folder
                  echo $j. ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
              } else {     //  If File Was Not Moved.
                  echo $j. ').<span id="error">please try again!.</span><br/><br/>';
              }
        } else {     //   If File Size And File Type Was Incorrect.
            echo $j. ').<span id="error">Invalid file Size or Type</span><br/><br/>';
              }

        }
    $connect->close();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="multi.css">
    <title>Multiple</title>
</head>
<body>

<div id="maindiv">
    <div id="formdiv">
        <h2>Multiple Image Upload Form</h2>
        <form enctype="multipart/form-data" action="multi.php" method="post">
            <p>Image Size Should Be Less Than 500KB</p>
            <div id="filediv"><input name="file[]" type="file" id="file"/></div>
            <input type="button" id="add_more" class="upload" value="Add More Files"/>
            <input type="submit" value="Upload File" name="submit" id="upload" class="upload"/>
        </form>
    </div>
</div>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/multi.js"></script>
</body>
</html>