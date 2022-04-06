<?php
    session_start();
    include 'db_conn.php';
    if(!isset($_SESSION['logged_in'])){
        $fname = $email = $pswd = $c_pswd = '';
        $fname_err = $email_err = $pswd_err = $cpswd_err = '';
        $reg_error = '';
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $fname  = $_POST['fullname']; 
            $email  = $_POST['email']; 
            $pswd  = $_POST['password']; 
            $c_pswd  = $_POST['c_password']; 
            
            if(empty($fname)){
                $fname_err = 'Fullname is required';
            }
            elseif(empty($email)){
                $email_err = 'Email required';
            }
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $email_err = 'Enter valid email address!';
            }
            if(empty($pswd)){
                $pswd_err = 'Password is required!';
            }elseif(strlen($pswd) < 5 || strlen($pswd) > 20 ){
                $pswd_err = 'Password length should be between 5 and 20 characters!';
            }
            if(empty($c_pswd)){
                $cpswd_err = 'Confirmed Password is required!';
            }elseif($pswd !== $c_pswd){
                $cpswd_err = 'Password and Confirmed Password do not match!';
            }else{
                // everything fine, check if user exist and if not, insert
                $email  = mysqli_real_escape_string($con,$_POST['email']); 
                $stmt = $con->prepare('SELECT id from users WHERE email = ?');
                $stmt->bind_param('s', $email);
                if($stmt->execute()){
                    $user = $stmt->get_result()->fetch_assoc();
                    if($user){
                        $reg_error = 'Email already taken!';
                    }else{
                        $fname  = mysqli_real_escape_string($con,$_POST['fullname']); 
                        $email  = mysqli_real_escape_string($con,$_POST['email']); 
                        $pswd  = mysqli_real_escape_string($con,$_POST['password']); 
                        $hashed_pswd = password_hash($pswd, PASSWORD_BCRYPT);
                        $stmt = $con->prepare('INSERT INTO users (full_name, email, password) values (?,?,?)');
                        $stmt->bind_param('sss', $fname, $email, $hashed_pswd);
                        if($stmt->execute()){
                            header('Location: login.php?msg=You have been registered successfully. You can now login.');
                        }else{
                            $reg_error = 'An error occured! Please try again later!';
                        }
                    }
                }
            }
        }
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
    <title>PHP Login System | Signup</title>
</head>
<body>
    <?php include_once('nav.php') ?>
    <div class="container">
        <div class="row justify-content-center justify-align-center">
            <div class="col-12 col-md-8 mt-5">
            <?php if(!empty($reg_error)){ ?>
                <div class="alert alert-danger"><?= $reg_error ?></div>
            <?php }; ?>
            <div class="card">
                <div class="card-header text-white bg-primary text-center">
                    <h5 class="card-title display-4">Sign Up</h5>
                </div>
                <div class="card-body px-5">
                    <form method="post" class="rounded" action="">
                        <div class="form-group row mt-3">
                            <label for="exampleFullname" class="col-md-3 col-form-label">Fullname</label>
                            <div class="col-sm-9">
                                <input type="fullname" name="fullname" class="form-control" placeholder="Enter Fullname" id="exampleFullname" value="<?= $fname ?>">
                                <?php if(isset($fname_err)){ ?>
                                    <div class="error-text mt-1"><?= $fname_err ?></div>
                                <?php }; ?>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label for="exampleInputEmail" class="col-md-3 col-form-label">Email address</label>
                            <div class="col-md-9">
                                <input type="email" name="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" value="<?= $email ?>" placeholder="Enter Email Address">
                                <?php if(isset($email_err)){ ?>
                                    <div class="error-text mt-1"><?= $email_err ?></div>
                                <?php }; ?>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label for="exampleInputPassword1" class="col-md-3 col-form-label">Password</label>
                            <div class="col-md-9">
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Password" value="<?= $pswd ?>">
                                <?php if(isset($pswd_err)){ ?>
                                    <div class="error-text mt-1"><?= $pswd_err ?></div>
                                <?php }; ?>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label for="exampleInputPassword2" class="col-md-3 col-form-label">Confirm Password</label>
                            <div class="col-md-9">
                                <input type="password" name="c_password" class="form-control" id="exampleInputPassword2" placeholder="Confirm Password">
                                <?php if(isset($cpswd_err)){ ?>
                                    <div class="error-text mt-1"><?= $cpswd_err ?></div>
                                <?php }; ?>
                            </div>
                        </div>
                        <div class="form-group text-center mt-5">
                            <input type="submit" name="register" value="Register" style="width: 50%" class="btn btn-lg btn-primary">
                        </div>
                        <div class="text-center mt-3">
                            Already a member? <a href="login.php">Login</a>
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