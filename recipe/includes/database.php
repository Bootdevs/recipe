
<?php 



$dbHost = "localhost";//but if it is a web sever we need to change it to the web sever host
$dbUser =  "shaun";//username
$dbpass = "test1234";//db password for online sever db password for hosting
$dbname = "recipe";//database name

//data base connection
$conn = mysqli_connect($dbHost,$dbUser,$dbpass,$dbname );//i in mysql means improved 
if(!$conn){
    die("Database connection failed!");//when not cnnected database connection failed is printed out in screen    
}


?>


