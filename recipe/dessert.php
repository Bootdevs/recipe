<?php
require_once("includes/header.php");

$user_id = $_SESSION['user_id']; 

$sql = 'SELECT id,title, preptime, description, image_data FROM recipes WHERE user_id = ? AND meal_type = "dessert" ORDER BY created_at';
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

?>



<div class="container   d-flex justify-content-center">
    <div class="row justify-content-center ">
        <?php if (mysqli_num_rows($result) >=  3): ?>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <?php
                     $image_data = $row['image_data'];
                     if ($image_data) {
                          $image_path = "./img/{$image_data}";
                    } else {
                         $image_path = "./images/pexels.jpg";
                     }
                ?>
        <div class="col-xl-4 col-lg-6 col-md-8 col-sm-12 mb-4 ">
            <div class="card  px-4 py-4 w-100 card-sm">
                
                <img class="card-img-top" src="<?php echo $image_path; ?>" >
                <span  class="badge bg-secondary" style="position: absolute;  right: 5px; transform: translate(-50%, -5%); font-size:15px; "><i class="far fa-clock"></i> <?php echo $row['preptime']; ?></span>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['title']; ?></h5>
                    <p class="card-text"><?php echo $row['description']; ?></p>
                </div>
                <div class="card-footer">
                    <a href="details.php?id=<?php echo $row['id']?>"><button class="btn btn-outline-dark " >Details</button> </a>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
        <?php  elseif (mysqli_num_rows($result) == 2): ?>
       
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <?php
                     $image_data = $row['image_data'];
                     if ($image_data) {
                          $image_path = "./img/{$image_data}";
                    } else {
                         $image_path = "./images/default.jpg";
                     }
                ?>
        <div class="col-xl-6 col-lg-6 col-md-10 col-sm-12 mb-4 ">
            <div class="card  px-4 py-4 w-100 card-sm">
                
                <img class="card-img-top" src="<?php echo $image_path; ?>" >
                <span class="badge bg-secondary" style="position: absolute;  right: 5px; transform: translate(-50%, -5%); font-size:15px; "><i class="far fa-clock"></i> <?php echo $row['preptime']; ?></span>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['title']; ?></h5>
                    <p class="card-text"><?php echo $row['description']; ?></p>
                </div>
                <div class="card-footer">
                    <a href="details.php?id=<?php echo $row['id']?>"><button class="btn btn-outline-dark " >Details</button> </a>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
        <?php  elseif (mysqli_num_rows($result) == 1): ?>
       
       <?php while($row = mysqli_fetch_assoc($result)): ?>
           <?php
                $image_data = $row['image_data'];
                if ($image_data) {
                     $image_path = "./img/{$image_data}";
               } else {
                    $image_path = "./images/default.jpg";
                }
           ?>
   <div class="col-xl-8 col-lg-8 col-md-10 col-sm-12 mb-4 ">
       <div class="card  px-4 py-4 w-100 card-sm">
           
           <img class="card-img-top" src="<?php echo $image_path; ?>">
           <span  class="badge bg-secondary" style="position: absolute;  right: 5px; transform: translate(-50%, -5%); font-size:15px; "><i class="far fa-clock"></i> <?php echo $row['preptime']; ?></span>
           <div class="card-body">
               <h5 class="card-title"><?php echo $row['title']; ?></h5>
               <p class="card-text"><?php echo $row['description']; ?></p>
           </div>
           <div class="card-footer">
                 <a href="details.php?id=<?php echo $row['id']?>"><button class="btn btn-outline-dark " >Details</button> </a>
            </div>
       </div>
   </div>
   <?php endwhile; ?>
   <?php else: ?>
            <div class="col-12">
                <p style="font-size : 30px">No recipes found.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
</br></br></br></br></br>

<?php include("./includes/footer.php");?>


