<?php
//Include config file
require_once 'config.php';

//Define variables and initialize with empty values
$id1 = $name = $address = $sdt = "";
$id1 = $_GET["id"];
if(isset($_GET["id"]) && !empty($_GET["id"])){
   $sql = 'SELECT * FROM khachhang WHERE idKhachHang = ?';
   $stmt = mysqli_stmt_init($link);
   mysqli_stmt_prepare($stmt,$sql);
   mysqli_stmt_bind_param($stmt,"s",$_GET['id']);
   if(mysqli_stmt_execute($stmt)){
     $result1 = mysqli_stmt_get_result($stmt);
     while($row = mysqli_fetch_array($result1)){
        $id1 = $row["idKhachHang"];
        $name = $row["TenKhachHang"];
        $address = $row["DiaChi"];
        $sdt = $row["SodienThoai"];
     }
   }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
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
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="form-group <?php echo (!empty($salary_err)) ? 'has-error' : ''; ?>">
                            <label>id Khach Hang</label>
                            <input type="text" name="id" class="form-control" value="<?php echo $id1; ?>">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group ">
                            <label>Họ và Tên</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label>Địa Chỉ</label>
                            <textarea name="address" class="form-control" value="<?php echo $address; ?>"></textarea>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label>Sdt</label>
                            <input type="text" name="sdt" class="form-control" value="<?php echo $sdt; ?>">
                            <span class="help-block"></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

