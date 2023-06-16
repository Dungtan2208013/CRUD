<?php
//Include config file 
require_once 'config.php';

//Define variables and initialize with empty values

$id=$name = $address = $sdt = "";
$id_err = $name_err = $address_err = $sdt_err = "";

//Processing from data when form is submitted

if ($_SERVER["REQUEST_METHOD"] == "POST") {
//validate idkhachhang
    $input_id = trim($_POST["id"]);
    if (empty($input_id)) {
        $id_err = "vui lòng nhập id.";
    } elseif (!ctype_digit($input_id)) {
        $id_err = "Please enter a positive integer value.";
    } else {
        $id = $input_id;
    }


    //validate name
    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter a name.";
    }elseif(!filter_var(trim($_POST["name"]), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z'-.\s ]+$/")))){
        $name_err = 'Please enter a valid name.';
      
    }else{
        $name = $input_name;
    }

    //vailidate address
    $input_address = trim($_POST["address"]);
    if (empty($input_address)) {
        $address_err = 'Please enter an address.';
    } else {
        $address = $input_address;
    }

    //validate salary
    $input_sdt = trim($_POST["sdt"]);
    if (empty($input_sdt)) {
        $sdt_err = "vui lòng nhập sdt.";
    } elseif (!ctype_digit($input_sdt)) {
        $sdt_err = "Please enter a positive integer value.";
    } else {
        $sdt = $input_sdt;
    }

    //check input errors before inserting in database
    if ( empty($id_err) && empty($name_err) && empty($address_err) && empty($sdt_err) ) {
        //Prepare an insert statement
        $sql = "INSERT INTO khachhang (name, address, sdt) VALUES (?,?,?,?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            //Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss",$param_id, $param_name, $param_address, $param_sdt);
            //set parameters
            $param_id = $id;
            $param_name = $name;
            $param_address = $address;
            $param_sdt = $sdt;

            //Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                //records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else {
                echo "something went wrong. Please try again later.";
            }
        }
        //close statement
        // mysqli_stmt_close($stmt);
    }
    // close connection 
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper {
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this from and submit to add employee records tho the database</p>
                    <form action="index.php" method="post">
                    <div class="form-group <?php echo (!empty($id_err)) ? 'has-error' : ''; ?>">
                            <label>Id khách hàng</label>
                            <input type="text" name="id" class="form-control" value = "<?php echo $id; ?>">
                            <span class="help-block"><?php echo $id_err; ?></span   >
                        </div>
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Họ Và Tên</label>
                            <input type="text" name="name" class="form-control" value = "<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                            <label>Địa Chỉ</label>
                            <textarea  name="address" class="form-control"><?php echo $address; ?></textarea> 
                            <span class="help-block"><?php echo $address_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($sdt_err)) ? 'has-error' : ''; ?>">
                            <label>Sdt</label>
                            <input type="text" name="sdt" class="form-control" value = "<?php echo $sdt; ?>">
                            <span class="help-block"><?php echo $sdt_err; ?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value= "Submit">
                        <a href="index.php" class= "btn btn-default">Thoát</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>