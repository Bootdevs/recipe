<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {// $_SERVER['REQUEST_METHOD']  is used access the current script
  
    if (isset($_POST['remember'])) {
        $cookie_name = 'remember_me';
        $cookie_value = serialize(array($_POST['email'], $_POST['password'])); // Store the user's email and password in an array
        setcookie($cookie_name, $cookie_value, time() + (86400 * 2), '/'); // Set the cookie to expire in 2 days
    }
    
    
}
if(isset($_POST["submit"])){
    require("database.php");
    //assigning var to input fields
    $email = $_POST['email'];
    $password = $_POST['password'];

    //error handling
    if(empty($email) || empty($password)){
        header("Location: ../login.php?error=emptyfields");
       exit();
    }else{
        $sql=" SELECT * FROM users WHERE email = ?";// using email cause we cant display password
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location: ../login.php?error= sql error");
            exit();
         
        }else{
            mysqli_stmt_bind_param($stmt,"s",$email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);//getting results from data base
            //check if var result is empty or not
            if($row = mysqli_fetch_assoc($result)){
                $passCheck = password_verify($password,$row["password"]);
                if($passCheck == false){
                    header("Location: ../login.php?error=wrongpassword");
                    exit();
                
                }elseif($passCheck == true){  
                    session_start();
                    $_SESSION['user_id'] = $row["id"];
                    
                    header("Location: ../index.php");
                    exit();
                                
                }else{ 
                   header("Location: ../login.php?error=wrongpassword");
                   exit();
                }
            }else{
                header("Location:../login.php?error=nouser");
                exit();
         }
       } 
    }
}else{
    header("Location:../login.php?error=access forbidden");
    exit();
}  

?>