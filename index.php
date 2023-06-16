<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.boostrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper {
            width: 650px;
            margin: 0 auto;
        }

        .page-header h2 {
            margin-top: 0;
        }

        table tr td:last-child a {
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle = "tooltip"]').tooltip();
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Employees Deatils</h2>
                        <a href="create.php" class = "btn btn-success pull-right">
                            Add New Employee
                        </a>
                    </div>
                    <?php
                    //Include config file
                    require_once 'config.php';
                    //Attempt select query execution
                    $sql = "SELECT * FROM khachhang";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0 ){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>id</th>";
                                        echo "<th>name</th>";
                                        echo "<th>address</th>";
                                        echo "<th>sdt</th>";
                                        echo "<th>#</th>";
                                    echo "</tr>"; 
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>". $row['idKhachHang']."</td>";
                                        echo "<td>". $row['TenKhachHang']."</td>";
                                        echo "<td>". $row['DiaChi']."</td>";
                                        echo "<td>". $row['SodienThoai']."</td>";
                                        echo "<td>";
                                            // echo "<a href='read.php?id=". $row['idKhachHang']. "' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='update1.php?id=". $row['idKhachHang']. "' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete1.php?id=". $row['idKhachHang']. "' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                            echo "</table>";
                            //Free result set
                            mysqli_free_result($result);
                           
                        }else{
                            echo "<p class = 'lead'> <em> No records were found.</em></p>";
                        }
                    }else{
                        echo "ERROR: could not able to execute $sql." .mysqli_error($link);
                    }
                    // Close connection
                    mysqli_close($link);
                    
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>