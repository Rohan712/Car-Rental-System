<?php
    session_start();
    include('includes/config.php');
    if(isset($_POST['login'])) {
        $username=$_POST['username'];
        $password=md5($_POST['password']);
        $sql ="SELECT UserName,Password FROM admin WHERE UserName=:username and Password=:password";
        $query= $dbh -> prepare($sql);
        $query-> bindParam(':username', $username, PDO::PARAM_STR);
        $query-> bindParam(':password', $password, PDO::PARAM_STR);
        $query-> execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        if($query->rowCount() > 0) {
            $_SESSION['alogin']=$_POST['username'];
            echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
        } else {
            echo "<script>alert('Invalid Details');</script>";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login-style.css">

    <link rel="apple-touch-icon" sizes="144x144" href="img/account-logo.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/account-logo.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/account-logo.png">
    <link rel="apple-touch-icon" href="img/account-logo.png">
    <link rel="shortcut icon" href="img/account-logo.png">

    <style>
        #cover {
            background-image: url(img/bg-img.jpg);
            background-size: cover;
            height: 100%;
            text-align: center;
            display: flex;
            align-items: center;
            position: relative;
        }

    </style>

</head>

<body class="login-body">
    <div class="login-page">
        <section id="cover" class="min-vh-100">
            <div id="cover-caption">
                <div class="container">
                    <div class="row text-white">
                        <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
                            <h1 class="display-4 py-2 text-truncate font-weight-bold">Admin | Login</h1>
                            <div class="px-2">
                                <form method="post" class="justify-content-center">
                                    <div class="form-group">
                                        <label class="sr-only">Username</label>
                                        <input type="text" placeholder="Username" name="username" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only">Password</label>
                                        <input type="password" placeholder="Password" name="password" class="form-control">
                                    </div>
                                    <button class="btn btn-primary btn-block" name="login" type="submit">LOGIN</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>
