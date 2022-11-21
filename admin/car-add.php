<?php
    session_start();
    error_reporting(0);
    include('includes/config.php');
    if(strlen($_SESSION['alogin'])==0) {	
        header('location:index.php');
    }
    else { 
        if(isset($_POST['submit'])) {
            $vehicletitle=$_POST['vehicletitle'];
            $brand=$_POST['brandname'];
            $vehicleoverview=$_POST['vehicalorcview'];
            $priceperday=$_POST['priceperday'];
            $fueltype=$_POST['fueltype'];
            $seatingcapacity=$_POST['seatingcapacity'];
            $vimage1=$_FILES["img1"]["name"];
            $vimage2=$_FILES["img2"]["name"];
            $vimage3=$_FILES["img3"]["name"];
            $vimage4=$_FILES["img4"]["name"];
            $vimage5=$_FILES["img5"]["name"];
           
            move_uploaded_file($_FILES["img1"]["tmp_name"],"img/vehicleImages/".$_FILES["img1"]["name"]);
            move_uploaded_file($_FILES["img2"]["tmp_name"],"img/vehicleImages/".$_FILES["img2"]["name"]);
            move_uploaded_file($_FILES["img3"]["tmp_name"],"img/vehicleImages/".$_FILES["img3"]["name"]);
            move_uploaded_file($_FILES["img4"]["tmp_name"],"img/vehicleImages/".$_FILES["img4"]["name"]);
            move_uploaded_file($_FILES["img5"]["tmp_name"],"img/vehicleImages/".$_FILES["img5"]["name"]);

            $sql="INSERT INTO tblvehicles(VehiclesTitle,VehiclesBrand,VehiclesOverview,PricePerDay,FuelType,SeatingCapacity,Vimage1,Vimage2,Vimage3,Vimage4,Vimage5) VALUES(:vehicletitle,:brand,:vehicleoverview,:priceperday,:fueltype,:seatingcapacity,:vimage1,:vimage2,:vimage3,:vimage4,:vimage5)";
            
            $query = $dbh->prepare($sql);
            $query->bindParam(':vehicletitle',$vehicletitle,PDO::PARAM_STR);
            $query->bindParam(':brand',$brand,PDO::PARAM_STR);
            $query->bindParam(':vehicleoverview',$vehicleoverview,PDO::PARAM_STR);
            $query->bindParam(':priceperday',$priceperday,PDO::PARAM_STR);
            $query->bindParam(':fueltype',$fueltype,PDO::PARAM_STR);
            $query->bindParam(':seatingcapacity',$seatingcapacity,PDO::PARAM_STR);
            $query->bindParam(':vimage1',$vimage1,PDO::PARAM_STR);
            $query->bindParam(':vimage2',$vimage2,PDO::PARAM_STR);
            $query->bindParam(':vimage3',$vimage3,PDO::PARAM_STR);
            $query->bindParam(':vimage4',$vimage4,PDO::PARAM_STR);
            $query->bindParam(':vimage5',$vimage5,PDO::PARAM_STR);
            $query->execute();
            $lastInsertId = $dbh->lastInsertId();
            if($lastInsertId) {
                $msg="Car added Successfully.";
            }
            else {
                $error="Something went wrong. Please try again";
            }

        }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Add Car</title>
    <!-- Font awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Bootstrap file input -->
    <link rel="stylesheet" href="css/fileinput.min.css">
    <!-- Admin Style -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include('includes/header.php');?>
    <div class="main-content">
        <?php include('includes/leftbar.php');?>
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-title">Add A Car</h2>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                                    <div class="card-title" style="margin-left: 20px;font-weight: bold">Basic Info</div>
                                    <div class="card-body">
                                        <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Select Brand<span style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <select class="selectpicker" name="brandname" required>
                                                        <option value=""> Select </option>
                                                        <?php $ret="select id,BrandName from tblbrands";
$query= $dbh -> prepare($ret);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
foreach($results as $result)
{
?>
                                                        <option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->BrandName);?></option>
                                                        <?php }} ?>
                                                    </select>
                                                </div>
                                                <label class="col-sm-2 control-label">Name<span style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="vehicletitle" class="form-control" required>
                                                </div>

                                            </div>

                                            <div class="hr-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Overview<span style="color:red">*</span></label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" name="vehicalorcview" rows="3" required></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Price Per Day(₹)<span style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="priceperday" class="form-control" required>
                                                </div>
                                                <label class="col-sm-2 control-label">Select Fuel Type<span style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <select class="selectpicker" name="fueltype" required>
                                                        <option value=""> Select </option>
                                                        <option value="Petrol">Petrol</option>
                                                        <option value="Diesel">Diesel</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Seating Capacity<span style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="seatingcapacity" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="hr-dashed"></div>


                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <h4><b>Upload Images</b></h4>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <div class="col-sm-4">
                                                    Image 1 <span style="color:red">*</span><input type="file" name="img1" required>
                                                </div>
                                                <div class="col-sm-4">
                                                    Image 2<span style="color:red">*</span><input type="file" name="img2" required>
                                                </div>
                                                <div class="col-sm-4">
                                                    Image 3<span style="color:red">*</span><input type="file" name="img3" required>
                                                </div>
                                                <div class="col-sm-4">
                                                    Image 4<span style="color:red">*</span><input type="file" name="img4" required>
                                                </div>
                                                <div class="col-sm-4">
                                                    Image 5<input type="file" name="img5">
                                                </div>
                                            </div>
                                            <div class="hr-dashed"></div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="col-sm-8 col-sm-offset-2">
                                                            <button class="btn btn-success" name="submit" type="submit">Save</button>
                                                            <button class="btn btn-danger" type="reset">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Loading Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/fileinput.js"></script>
</body>

</html>
<?php } ?>
