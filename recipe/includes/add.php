<?php

if(isset($_POST["submit"])){
    require("database.php");
    session_start();
    $user_id = $_SESSION['user_id']; // Replace "user_id" with the name of the session variable that holds the user ID
    
    // Define an array to hold validation errors
    $errors = array();

    // Validate title
    if(!preg_match("/^[A-Za-z ]+$/", $_POST["title"])) {
        $errors['title'] = "Title must contain only letters and spaces.";
    }

    // Validate preptime
    if(!empty($_POST["preptime"]) && !preg_match("/^[0-9]{2}:[0-9]{2}$/", $_POST["preptime"])) {
        $errors['preptime'] = "Preparation time must be in the format 'hh:mm'.";
    }

    // Validate ingredients
    if(!preg_match("/^.+$/", $_POST["ingredients"])) {
        $errors['ingredients'] = "Ingredients must be separated by commas.";
    }

    // Validate image_data
      // Validate image_data
    if(!empty($_FILES['image_data']['name'])) {//check if the file is empty and if not empty
        $allowed_extensions = array('png', 'jpg', 'jpeg');
        $imageExtension = explode(".",$_FILES['image_data']['name']); // separate in between .
        $imageExtension = strtolower(end($imageExtension)); 
        if(!in_array($imageExtension, $allowed_extensions)) {
            $errors['image_data'] = "Only PNG, JPG, and JPEG files are allowed.";
            echo
            "<script>
                alert('Only PNG, JPG, and JPEG files are allowed.. Pls try again.');
                document.location.href = '../index.php';
            </script>";
        }
        else if($_FILES['image_data']['size'] > 100000000){
            echo
            "<script>
                alert('image Size is too large')
                document.location.href = '../index.php';
            </script> ";
        }else{
            $new_file_name = uniqid();
            $new_file_name  .= '.' . $imageExtension;
            move_uploaded_file( $_FILES["image_data"]["tmp_name"], '../img/'. $new_file_name);
        }
    }


    // Validate meal_type
    if(!in_array($_POST["meal_type"], array('breakfast', 'lunch', 'dessert'))) {
        $errors['meal_type'] = "Meal type must be either 'breakfast', 'lunch', or 'dessert'.";
    }

    // If there are no validation errors, insert the form data into the database
    if(empty($errors)) {
        // Prepare the SQL statement
        $sql = "INSERT INTO recipes (user_id, title, preptime, description, ingredients, directions, image_data, meal_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = mysqli_prepare($conn, $sql);
        
        if ($stmt){
            // Bind the parameters with the user input values
            
            mysqli_stmt_bind_param($stmt, "ssssssss", $user_id, $_POST["title"], $_POST["preptime"], $_POST["description"], $_POST["ingredients"], $_POST["directions"], $new_file_name, $_POST["meal_type"]);
            // Execute the statement
            mysqli_stmt_execute($stmt);
            // Save the image to file system if insert is successful
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo
                "<script>
                    alert('Recipe saved successfully!');
                    document.location.href = '../index.php';
                </script>";
            } else {
                echo
                "<script>
                    alert('Error adding recipe. Pls try again.');
                    document.location.href = '../index.php';
                </script>";
            }
            
            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo "<script>alert('Error preparing SQL statement. Pls try again.');</script>";
        }
    }

    mysqli_close($conn);
}
?>