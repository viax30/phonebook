<?php 

    include('include/db_connect.php');
    $name = $email = $password = $confirm_password = '';
    $name_err = $email_err = $password_err = $confirm_password_err='';
if(isset($_POST['signup'])){
    $name =  $_POST['name'];
     // Validate email
    
    $email =  $_POST['email'];

    $sql = "select * from phonebook_user where Email = '$email'";
    $result = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($result);
    

    if($count == 1) {
        $email_err = "This email is already taken.";
    }else {
        
        $email = trim($_POST["email"]);
    }
   
    $password = trim($_POST['password']);
    if( !(empty($_POST['password'])) && strlen(trim($_POST['password'])) < 6 ){
        $password_err = " Password must not less than 6 characters ";
    }else{
        $password = trim($_POST['password']);
    }

    if( !(empty($_POST['password'])) ){
        $confirm_password = trim($_POST['confirm_password']);
        if( $password != $confirm_password){
            $confirm_password_err = "Password not match";
        }
    }  

    if(empty($email_err) && empty($password_err) && empty($confirm_password_err) ){
        
        //Insert data in Database
        
        $insert = "INSERT INTO `phonebook_user` (`ID`, `Name`, `Email`, `Password`) VALUES (NULL, '$name', '$email', PASSWORD('$confirm_password') )";
       
        if(mysqli_query($conn, $insert)){
            echo"<script>alert('New Record Saved!');</script>";
        }else{
            echo "Error: " . $insert . "<br>" . mysqli_error($conn);
        }
    }

}
?>























<!DOCTYPE html>
<html lang="en">
<head>
        <title>Phonebook | Signup</title>
        <?php include('headinfo.php'); ?>
</head>
<body>  
    <div class="container-fluid bg">
        <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12"></div>
        <div class="col-md-4 col-sm-4 col-xs-12">

             <form data-toggle="validator" class="form-container" action="" method="post">
                    <h1>Sign up</h1>
                    <div class="form-group">
                        <label for="inputName" class="control-label">Name</label>
                        <input type="name" value="<?php echo $name; ?>" name="name" class="form-control"  placeholder=" Name" required autofocus>
                        <div class="help-block with-errors"><?php echo $name_err; ?></div>
                    </div>
                    <div class="form-group">
                        <label  for="inputEmail" class="control-label">Email address</label>
                        <input type="email" name="email" value="<?php echo $email; ?>" id="inputEmail" data-error="Bruh, that email address is invalid" class="form-control" placeholder=" Email" required>
                        <div class="help-block with-errors"><?php echo $email_err; ?></div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="control-label">Password</label>
                        <input type="password" value="<?php echo $password; ?>" name="password" data-minlength="6" class="form-control" id="inputPassword" placeholder="Password" required>
                        <div class="help-block"><?php echo $password_err; ?></div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" class="control-label">Confirm Password</label>
                        <input type="password" value="<?php echo $confirm_password; ?>" name="confirm_password" placeholder=" Confirm password"  class="form-control"  id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Whoops, these don't match" required>
                        <div class="help-block with-errors"><?php echo $confirm_password_err; ?></div>
                    </div>
                    <button type="submit"  name="signup" class="btn btn-success btn-block">Sign up</button>
                    <a href="log_in.php" class="signuplink">Log in..</a>
                    </form>
        </div>
    <div class="col-md-4 col-sm-4 col-xs-12"></div>
    </div>
    <script>
        $('#myForm').validator();
    </script>
</div>
</body>
</html>