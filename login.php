<?php
    session_start();
    $_SESSION['user']='';
    $_SESSION['userid']='';
    include "auth/connection.php";
    $conn= connect();
    $m= '';
    if(isset($_POST['submit'])){
        $uName= mysqli_real_escape_string($conn, $_POST['uname']);
        $pass= mysqli_real_escape_string($conn, $_POST['pass']);
        
        $sql= "SELECT * FROM users_info WHERE u_name='$uName' and password='$pass'";
        $res= $conn->query($sql);

        if(mysqli_num_rows($res)==1){
            $user= mysqli_fetch_assoc($res);
            $id= $user['id'];
            $sq= "UPDATE users_info SET last_login_time=current_timestamp() WHERE id='$id'";
            $conn->query($sq);
            $_SESSION['user']= $user['name'];
            $_SESSION['userid']= $user['id'];
            header('Location: dashboard.php');
        }
        else{
            $m= 'Credentials mismatch!';
        }
    }
?>


<html>
    <head>
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <link type="text/css" rel="stylesheet" href="css/login.css">
    </head>
    <body>
        <div class="logo">

        </div>
        <form method="POST">
            <div class="box bg-img">
                <div class="content">
                        <h2>Log<span> In</span></h2>
                    <div class="forms">
                        <p style="color: red; padding: 20px;"><?php if($m!='') echo $m; ?></p>
                        <div class="user-input">
                            <input name="uname" type="text" class="login-input" placeholder="Username" id="name" required>
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="pass-input">
                            <input name="pass" type="password" class="login-input" placeholder="Password" id="my-password" required>
                            <span class="eye" onclick="myFunction()">
                              <i id="hide-1" class="fas fa-eye-slash"></i>
                              <i id="hide-2" class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>

                    <button class="login-btn" type="submit" name="submit">Sign In</button>
                    <p class="new-account">Not a user? <a href="register.php">Sign Up now!</a></p>
                    <br>

                    <p class="f-pass">
                        <a href="#">forgot password?</a>
                    </p>

                </div>
            </div>
        </form>
        <script src="https://kit.fontawesome.com/c0078485ae.js" crossorigin="anonymous"></script>
    </body>
</html>

<script>
    function myFunction() {
        var x = document.getElementById("my-password");
        var y = document.getElementById("hide-1");
        var z = document.getElementById("hide-2");

        if (x.type === "password") {
            x.type = "text";
            y.style.display = "block";
            z.style.display = "none";
        } else {
            x.type = "password";
            y.style.display = "none";
            z.style.display = "block";
        }
    }

</script>