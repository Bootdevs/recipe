<?php
require_once "database.php";// require_once is used to import another php file id the file isnt found or there is an error the rest of the code wont be executed
?>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");// header is used to redirect the user to anther page 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
     <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-...">
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-..."></script>
    <!-- font icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark navbar-dark ">
  <div class="container-fluid">
    <a class="navbar-brand" href="./index.php"><img src="./images/icon.png" alt="" width="50" height="50"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar"> <div class="navbar-toggler-icon"></div></button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
        <li class="nav-item">
          <a class="nav-link" href="./index.php">Breakfast</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./lunch.php">Lunch</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./dessert.php">Dessert</a>
        </li>
      </ul>
   
      <!-- Modal -->
   
      <div class="d-flex" >
        <button class="btn btn-outline-light " type="submit" data-bs-toggle="modal" data-bs-target="#exampleModal" >New Recipe</button>

<div class="modal fade  bg-success text-light" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content bg-dark">
      <div>
        <h5 class="modal-title" >Create and save your new recipe </h5>
      </div>
      <div class="modal-body">
         <form class="modal-form" method="POST" action="./includes/add.php" enctype="multipart/form-data">
            <label>Title (no symbols included):</label>
            <input type="text" name="title" required pattern="[A-Za-z ]+">
           <label>Preparation time (ex. 01:30):</label>
            <input type="text" name="preptime" pattern="[0-9]{2}:[0-9]{2}">
          <label>Description:</label>
          <input type="text" name="description" required minlength="25" >
          <label>Ingredients (comma separated):</label>
          <input type="text" name="ingredients" required>
          <label>Directions:</label>
          <textarea class="direction" type="text" name="directions" required  minlength="60" ></textarea>
          <label>Image (png, jpg, jpeg):</label>
          <input type="file" name="image_data" accept=".png,.jpg,.jpeg">
          <label>Meal type:</label>
          <select name="meal_type" required>
            <option value="breakfast">Breakfast</option>
            <option value="lunch">Lunch</option>
            <option value="dessert">Dessert</option>
          </select>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-success">Save</button>
              </div>
            </form>
          </div>
        </div>
     </div>
   </div>
  </div>  
  <a class="btn btn-outline-light logout "  href="./includes/logout.php">Log out</a>                                                                   
      </div>
    </div>
   
  </div>

</head>
</nav>

<body>

</br></br></br>
