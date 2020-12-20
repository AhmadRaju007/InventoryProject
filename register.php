<?php
    include 'auth/connection.php';
    $conn= connect();
    $m='';
    if(isset($_POST['submit'])){
        $name= $_POST['name'];
        $uName= $_POST['uname'];
        $email= $_POST['email']?$_POST['email']:'';
        $pass= $_POST['pass'];
        $rPass= $_POST['r_pass'];
        if($pass===$rPass){
            $sq= "INSERT INTO users_info(name, u_name, email, password) VALUES('$name', '$uName', '$email', '$pass')";
            if($conn->query($sq)===true){
                header('Location: login.php');
            }
            else{
                $m='Connection not established!';
            }
        }
        else {
            $m= "Passwords don't match!";
        }
    }

?>

<html>
    <head>
        <title>Registration Form </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link type="text/css" rel="stylesheet" href="css/style.css">
        <link type="text/css" rel="stylesheet" href="css/register.css">
    </head>
    <body>
        <form method="POST" action="register.php">
            <div class="container reg">

                <span><?php if($m!='') echo $m; ?></span>
                <h1> Registration form</h1>
                <hr>
                <div>
                    <label>Your Name<span>*</span></label>
                    <input name="name" id="name" type="text" placeholder="Enter Your Name" required>
                </div>
                <div>
                    <label>Your Userame<span>*</span></label>
                    <input name="uname" id="uname" type="text" placeholder="Enter Your Userame" onchange="checkUsername(this.value); checkUser(this.value);" required>
                    <small id="checktext"></small>
                    <small id="checkuser"></small>
                </div>
                <div>
                    <label>Your Email</label>
                    <input name="email" id="email" type="text" placeholder="Enter Your Email">
                </div>
                <div>
                    <label>Password<span>*</span></label>
                    <input name="pass" id="pass" type="password" placeholder="Enter Your Password" required>
                </div>
                <div>
                    <label>Repeat Password<span>*</span></label>
                    <input name="r_pass" id="rpass" type="password" placeholder="Confirm your password" required>
                </div>
                <div style="text-align: center">
                    <p><span>***</span>By creating an account you agree to our Terms & Conditions.</p>
                </div>
                <div style="text-align: center; padding: 20px;">
                    <input type="submit" class="btn btn-success" value="Submit" name="submit">
                </div>

                <div style="text-align: center">
                    <p>Already have an account? <a href="login.php">Sign in</a></p>
                </div>
            </div>
        </form>
    </body>
    <script type="text/javascript" src="js/script.js"></script>
</html>


<script>
    $(document).ready(function(){
        $('.reg').css('color', '#ffce00');
        //document.getElementsByClassName('reg')[0].style.color='#ffce00';
    });
    /*window.onload= function(){
          document.getElementsByClassName('reg')[0].style.color='#ffce00';
    };
    *?
     */
</script>
