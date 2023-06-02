<?php
require_once("includes/header.php");

if(isset($_POST['delete_btn'])){
    $id_to_delete = mysqli_real_escape_string($conn,$_POST['id_to_delete']);
    $sql = "DELETE FROM recipes WHERE id = $id_to_delete";
    //check if it works 
    if(mysqli_query($conn,$sql)){
        //success
        header('Location: index.php');// header is use to redirect in mysql
    }{
        //failure
        echo 'query error ' . mysql_error($conn);
    }
}

$recipe_id = $_GET['id'];

// Retrieve recipe details from the database
$sql = 'SELECT  title, preptime, description, ingredients, directions, image_data FROM recipes WHERE id = ?';
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $recipe_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="container my-5">
    <?php if($row): ?>
        <?php

            $image_data = $row['image_data'];
            if ($image_data) {
                     $image_path = "./img/{$image_data}";
            } else {
                $image_path = "./images/pexels.jpg";
            }


        ?>
        <div class="row">
            <div class="col-lg-6">
                <img class="img-fluid rounded mb-4"  src="<?php echo $image_path; ?>" alt="">
            </div>
            <div class="col-lg-6">
                <h1 class="mb-4"><?php echo $row['title']; ?></h1>
                <div class="mb-4">
                   <b><i class="far fa-clock"></i> <?php echo $row['preptime']; ?></b> 
                </div>
                <p class="lead mb-4"><?php echo $row['description']; ?></p>
                <h4 class="mb-3">Ingredients:</h4>
                <ul class=" mb-4">
                    <?php foreach(explode(',', $row['ingredients']) as $ing){ ?>
                        <li><?php echo htmlspecialchars($ing); ?></li>
                     <?php } ?>
                </ul>
                <h4 class="mb-3">Instructions:</h4>
                <?php
                     echo $row['directions'];
                  
                ?>
              
                   <!-- delete recipe  using form-->
            <form action="details.php" method = "POST">
                <input type="hidden" name="id_to_delete" value="<?php echo $recipe_id ?>">
                <button  type="submit" name="delete_btn"  class= "btn btn-dark btn-block mt-4 w-100" onclick="return confirmDelete()">Delete this recipe</button>
            </form>
            <?php else: ?>
                 <h5> No such recipe exist! </h5>
             <?php endif; ?>
            </div>
        </div>
    </div>
   
    <script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this recipe?");
     }
    </script>
    </br></br></br></br></br>
    <?php include("./includes/footer.php"); ?>
</body>
</html>
