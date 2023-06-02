<?php


if(isset($_POST["submit"])){
    require("database.php");
    //assigning var to input fields
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpass= $_POST['confirmpassword'];
    //error handling

if(empty($email) || empty($password) || empty($confirmpass)){
    echo
    "<script>
        alert('empty fields');
        document.location.href = ' ../login.php';
    </script>";
}elseif(!preg_match("/^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/",$email)){
    echo
    "<script>
        alert('invalid username');
        document.location.href = ' ../login.php';
    </script>";
}elseif($password !== $confirmpass){
    echo
    "<script>
        alert('passwords do not match');
        document.location.href = ' ../login.php';
    </script>";
}
// checking is user name already exist in database using prepared statement
//prepaid statements are best to use for login and register
else{
    $sql = "SELECT email FROM users WHERE email = ?";
    $stmt = mysqli_stmt_init($conn);//initi means initialized
    //checking if there is an error in connection
    if(!mysqli_stmt_prepare($stmt,$sql)){//prepare the prepared statement 
        header("Location: ../login.php?error=invalidusername&username=sqlerror");
    exit();
        //checking if there is a match and user already exist(if the conn succeeded)
    }else{ 
        //bind to the place holder
        mysqli_stmt_bind_param($stmt,"s",$email);//bind is used for the statement and we binding a string so we use s for integer we use i
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);//store is used to fetch data from db take the executed function and run into var
        $rowCount = mysqli_stmt_num_rows($stmt);// number of matching users ib database
        if($rowCount > 0){
            echo
            "<script>
                 alert('username taken');
                 document.location.href = ' ../login.php';
            </script>";
           
        }else{
            $sql = "INSERT INTO users (email,password) VALUES(?,?)";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql)){//checking if sql statement matching 
                echo
                "<script>
                     alert('Sql Error');
                     document.location.href = ' ../login.php';
                </script>";
            }else{
                //hathing password
                $hashedPass = password_hash($password, PASSWORD_DEFAULT);
                //finishing
                mysqli_stmt_bind_param($stmt,"ss",$email,$hashedPass);
                mysqli_stmt_execute($stmt);
                echo
                "<script>
                     alert('Successfully Registered');
                     document.location.href = 'registered';
                </script>";
            }
        }
    }
 }
 mysqli_stmt_close($stmt);//closing the statement
 mysqli_close($conn);

}





















?>