<?php
    session_start();
    error_reporting(0);
    include('includes/config.php');
    if(strlen($_SESSION['alogin'])==0) {	
        header('location:index.php');
    }
    else {
        if(isset($_REQUEST['eid'])) {
            $eid=intval($_GET['eid']);
            $status="2";
            $sql = "UPDATE tblbooking SET Status=:status WHERE  id=:eid";
            $query = $dbh->prepare($sql);
            $query -> bindParam(':status',$status, PDO::PARAM_STR);
            $query-> bindParam(':eid',$eid, PDO::PARAM_STR);
            $query -> execute();
            echo "<script>alert('Booking Successfully Cancelled');</script>";
            echo "<script type='text/javascript'> document.location = 'email/email.php?status=0'; </script>";
        }
        if(isset($_REQUEST['aeid'])) {
            $aeid=intval($_GET['aeid']);
            $status=1;
            $sql = "UPDATE tblbooking SET Status=:status WHERE  id=:aeid";
            $query = $dbh->prepare($sql);
            $query -> bindParam(':status',$status, PDO::PARAM_STR);
            $query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
            $query -> execute();
            echo "<script>alert('Booking Successfully Confirmed');</script>";
             echo "<script type='text/javascript'> document.location = 'email/email.php?status=1'; </script>";
        }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

    <title>New Bookings</title>

    <!-- Font awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
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
                        <h2 class="page-title">Booking Details</h2>

                        <div class="card">
                            <div class="card-title">Bookings Info</div>
                            <div class="card-body">
                                <div id="print">
                                    <table border="1" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">

                                        <tbody>

                                            <?php 
$bid=intval($_GET['bid']);
									$sql = "SELECT tblusers.*,tblbrands.BrandName,tblvehicles.VehiclesTitle,tblbooking.FromDate,tblbooking.ToDate,tblbooking.VehicleId as vid,tblbooking.Status,tblbooking.PostingDate,tblbooking.id,tblbooking.BookingNumber,
DATEDIFF(tblbooking.ToDate,tblbooking.FromDate) as totalnodays,tblvehicles.PricePerDay
									  from tblbooking join tblvehicles on tblvehicles.id=tblbooking.VehicleId join tblusers on tblusers.EmailId=tblbooking.userEmail join tblbrands on tblvehicles.VehiclesBrand=tblbrands.id where tblbooking.id=:bid";
$query = $dbh -> prepare($sql);
$query -> bindParam(':bid',$bid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>
                                            <h3 style="text-align:center; color:red">#<?php echo htmlentities($result->BookingNumber);?> Booking Details </h3>

                                            <tr>
                                                <th colspan="4" style="text-align:center;color:blue">User Details</th>
                                            </tr>
                                            <tr>
                                                <th>Booking No.</th>
                                                <td>#<?php echo htmlentities($result->BookingNumber);?></td>
                                                <th>Name</th>
                                                <td><?php echo htmlentities($result->FullName);?></td>
                                            </tr>
                                            <tr>
                                                <th>Email Id</th>
                                                <td><?php echo htmlentities($result->EmailId);?></td>
                                                <th>Contact No</th>
                                                <td><?php echo htmlentities($result->ContactNo);?></td>
                                            </tr>
                                            <tr>
                                                <th>Address</th>
                                                <td><?php echo htmlentities($result->Address);?></td>
                                            </tr>

                                            <tr>
                                                <th colspan="4" style="text-align:center;color:blue">Booking Details</th>
                                            </tr>
                                            <tr>
                                                <th>Vehicle Name</th>
                                                <td><?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?></td>
                                                <th>Booking Date</th>
                                                <td><?php echo htmlentities($result->PostingDate);?></td>
                                            </tr>
                                            <tr>
                                                <th>From Date</th>
                                                <td><?php echo htmlentities($result->FromDate);?></td>
                                                <th>To Date</th>
                                                <td><?php echo htmlentities($result->ToDate);?></td>
                                            </tr>
                                            <tr>
                                                <th>Total Days</th>
                                                <td><?php echo htmlentities($tdays=$result->totalnodays);
                                                    if($tdays==0){$tdays=1;} ?></td>
                                                <th>Rent Per Days</th>
                                                <td><?php echo htmlentities($ppdays=$result->PricePerDay);?></td>
                                            </tr>
                                            <tr>
                                                <th colspan="3" style="text-align:center">Grand Total</th>
                                                <td><?php echo htmlentities($tdays*$ppdays);?></td>
                                            </tr>
                                            <tr>
                                                <th>Booking Status</th>
                                                <td><?php 
if($result->Status==0)
{
echo htmlentities('Not Confirmed yet');
} else if ($result->Status==1) {
echo htmlentities('Confirmed');
}
 else{
 	echo htmlentities('Cancelled');
 }
										?></td>
                                            </tr>

                                            <?php if($result->Status==0){ ?>
                                            <tr>
                                                <td style="text-align:center" colspan="4">
                                                    <a href="bookig-details.php?aeid=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to Confirm this booking?')" class="btn btn-primary"> Confirm Booking</a>

                                                    <a href="bookig-details.php?eid=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to Cancel this Booking?')" class="btn btn-danger"> Cancel Booking</a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <?php $cnt=$cnt+1; }} ?>

                                        </tbody>
                                    </table>
                                    <form method="post">
                                        <input name="Submit2" type="submit" class="txtbox4" value="Print" onClick="return f3();" style="cursor: pointer;" />
                                    </form>

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
    <script language="javascript" type="text/javascript">
        function f3() {
            window.print();
        }

    </script>
</body>

</html>
<?php } ?>
