<!--  -->

<nav class="navbar navbar-expand-lg navbar-dark bg-primary" style="padding: 14px 10px; margin-bottom:15px">
    <a class="navbar-brand" style="padding-left: 20px" href="index.php">PhpLoginSystem</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php
                if(isset($_SESSION['logged_in'])){ ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="home.php">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="profile.php">Profile</a>
                    </li>
                <?php } ?>
            <?php
                if(!isset($_SESSION['logged_in'])){ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="signup.php">SignUp</a>
                    </li>
                <?php }; ?>
            <?php
                if(isset($_SESSION['logged_in'])){ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                <?php }; ?>
        </ul>
    </div>
</nav>