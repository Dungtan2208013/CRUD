<?php 
//Process delete operation after confirmation

use JetBrains\PhpStorm\ExpectedValues;

if(isset($_GET["id"]) && !empty($_GET["id"])){
    //Include config file
    require_once 'config.php';
    
    //Prepare a select statement
    $sql = "DELETE FROM khachhang WHERE idKhachHang = ?";
    $stmt = mysqli_stmt_init($link);
    if(mysqli_stmt_prepare($stmt, $sql)){
        //Set parameters
        // $param_id = trim($_GET["id"]);
        mysqli_stmt_bind_param($stmt, "s", $_GET["id"]);
        //Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            header("location: index.php");
            exit();
        }else{
            echo "vui lòng thử lại sau.";
        }
    }

    //Close statement
    // mysqli_stmt_close($stmt);

    //close connection
    mysqli_close($link);
}else{
    if(empty(trim($_GET["id"]))){
        header("location: error.php");
        exit();
    }
}
?>


