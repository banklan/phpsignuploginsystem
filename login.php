<?php
    session_start();
    if(!isset($_SESSION['logged_in'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Nunito|Lato:100,300,400,700|Open+Sans:400,600|Raleway:300,400|Work+Sans:200|Dancing+Script|Fondamento|Lobster|Pacifico|Poiret+One|Righteous&&family=Arimo&family=Barlow:wght@200;300;400&family=Berkshire+Swash&family=Karla:wght@200;300;400;600&family=Mulish:wght@300;400;600&family=Noto+Sans+TC:wght@100;400&family=Open+Sans:ital,wght@0,300;0,400;1,600&family=Oxygen:wght@300;400&family=PT+Sans&family=Titillium+Web:wght@200;300;400&display=swap|Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="styles/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="styles/styles.css">
    <title>PHP Login System | Login</title>
</head>
<body>
    <?php include_once('nav.php') ?>
    <div class="container">
        <div class="row justify-content-center justify-align-center">
            <div class="col-12 col-md-5 mt-5">
            <?php if(isset($_GET['msg'])){ ?>
                <div class="alert alert-success px-1" role="alert">
                    <?=$_GET['msg'] ?>
                </div>
            <?php } ?>
            <div class="card">
                <div class="card-header text-white bg-primary text-center">
                    <h5 class="card-title display-4">Login</h5>
                </div>
                <div class="card-body">
                    <form method="post" class="rounded" action="auth.php">
                        <?php if(isset($_GET['error'])){ ?>
                            <div class="alert alert-danger" role="alert">
                                <?=$_GET['error'] ?>
                            </div>
                        <?php } ?>
                        <div class="form-group mt-3">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Email Address">
                        </div>
                        <div class="form-group mt-3">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Password">
                        </div>
                        <div class="form-group text-center mt-3">
                            <input type="submit" name="submit_btn" value="Login" class="btn btn-lg btn-block btn-primary">
                            <!-- <button type="submit" class="btn btn-lg btn-block btn-primary">Login</button> -->
                        </div>
                        <div class="text-center mt-3">
                            Not a member? <a href="signup.php">Sign Up</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="script/jquery.js"></script>
    <script src="script/bootstrap/popper.js"></script>
    <script src="script/bootstrap/bootstrap.min.js"></script>
</body>
</html>
<?php
    }else{
        header('Location: home.php');
    }
?>