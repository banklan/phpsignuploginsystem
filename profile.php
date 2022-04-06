<?php
    session_start();
    // $username = $_SESSION['name'];
    if(isset($_SESSION['logged_in'])){
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
    <title>PHP Login System | My Profile</title>
</head>
<body>
    <?php include_once('nav.php') ?>
    <div class="container">
        <div class="row justify-content-center mt-10">
            <div class="col-12 col-md-10 mt-5">
                <div class="display-2 text-center pt-6"><?= $_SESSION['name']  ?> profile page</div>
                <div class="mt-5 text-center">
                    <a href="logout.php" class="btn-lg btn btn-warning">Logout</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
    }else{
        header('Location: login.php');
    }
?>