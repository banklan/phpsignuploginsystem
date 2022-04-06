<?php
    session_start();
    include 'db_conn.php';
    $submit = filter_input(INPUT_POST, 'submit_btn', FILTER_SANITIZE_STRING);
    if(isset($submit)){
        $uname  = $_POST['email']; 
        $pswd  = $_POST['password']; 
        if(empty($uname) && empty($pswd)){
            header('Location: login.php?error=Email and Password fields are required');
        }else if(empty($uname)){
            header('Location: login.php?error=Email is required');
        }else if(empty($pswd)){
            header('Location: login.php?error=Password is required');
        }else{
            // everything fine, log in
            if($stmt = $con->prepare('SELECT id, full_name, password FROM users WHERE email = ?')){
                // bind params
                $stmt->bind_param('s', $uname);
                $stmt->execute();
                $rez = $stmt->get_result(); //or $stmt->get_result()->fetch_assoc()
                $user = $rez->fetch_assoc();
                if($user){// if user exist, verify password
                    if(password_verify($pswd, $user['password'])){
                        // authenticated, logged in
                        // print_r($user);
                        // echo($user);
                        // session_regenerate_id();
                        $_SESSION['logged_in'] = true;
                        $_SESSION['id'] = $user['id'];
                        $_SESSION['name'] = $user['full_name'];
                        // echo($_SESSION['name']);
                        header('Location: home.php');
                    }else{
                        header('Location: login.php?error=Incorrect Username or Password');
                    }
                }else{
                    header('Location: login.php?error=User not found');
                }
                $stmt->close();
            }
        }
    }
    


