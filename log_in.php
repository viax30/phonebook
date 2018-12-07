<?php 
    include("include/db_connect.php");
    session_start();
    

    $email ="";
    $password ="";
    $err ="";
    if(isset($_POST['login'])){

        $email = $_POST['email'];
        $password = $_POST['password'];
        $query = "select * from phonebook_user where Email = '$email'  AND password = PASSWORD('$password')";
        
        $result=mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        if($count == 1 ){
            $_SESSION['name'] =  $row['Name'];
            $_SESSION['id'] = $row['ID'];
            header('location: index.php');
        }else{
            echo "<script>alert(Invalid Username/Password)</script>";
        }
        
    }
    mysqli_close($conn);

?>














<!DOCTYPE html>
<html lang="en">
<head>
        <title>Phonebook | Login</title>
        <?php include('headinfo.php'); ?>
</head>
<body>  
    <div class="container-fluid bg">
        <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12"></div>
        <div class="col-md-4 col-sm-4 col-xs-12">
             <form class="form-container" action="" method="post">
             <img class="img" src="bootstrap-3.3.7/images/images.jpeg"/>
                    <h1>Sign in</h1>
                    <div class="form-group">
                        <label for="email_address">Email address</label>
                        <input name="email" type="email" value="<?php echo $email; ?>" class="form-control" id="email_address" placeholder=" Enter Email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input name="password" type="password" value="<?php echo $password; ?>" class="form-control" id="password" placeholder=" Enter Password">
                    </div>
                    <button name="login" type="submit" class="btn btn-success btn-block">Let me in</button>
                    <a href="signup.php" class="signuplink">Sign up here..</a>
                    </form>
        </div>
    <div class="col-md-4 col-sm-4 col-xs-12"></div>
    </div>
</div>
</body>
</html>