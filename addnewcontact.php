<?php
    include("include/db_connect.php");
    session_start();
    $contact_id = $_SESSION['id'];

    $name =$sex =$home_address =$phone_no ="";
    $phone_noerr="";

    if(isset($_POST['save_contact'])){
        $name = $_POST['name'];
        $sex = $_POST['sex'];
        $home_address = $_POST['home_address'];
    

        if( !(empty($_POST['phone_no'])) ){
        
            $phone_no = $_POST['phone_no'];
    
            $query = "select * from contacts  where phone_no = '$phone_no'";
            $result = mysqli_query($conn, $query);
            $count = mysqli_num_rows($result);
            if($count > 0 ){
                $phone_noerr = "Phone Number is already Exist!";
            }else{
                $phone_no = $_POST['phone_no'];
            }

        }

        if(empty($phone_noerr)){
        
            //Insert data in Database
            $insert = "INSERT INTO `contacts` (`ID`, `name`, `sex`, `home_address`, `phone_no`, `phonebook_user_id`) VALUES (NULL, '$name', '$sex', '$home_address ', '$phone_no', '$contact_id')";
           
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
        <title>Phonebook | Login</title>
        <?php include('headinfo.php'); ?>
        <style>
            h4.panel-title{
                font-weight: : bold;
            }
        </style>
</head>
    <body>
        <div class="container-fluid bg">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12"></div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
             <form class="form-container" action="" method="POST">
                <h1>New Contact</h1>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" type="Text" value="<?php echo $name; ?>" class="form-control" id="name" placeholder=" Last Name  First Name  Middle Name" required>
                    </div>  
                    <div class="form-group">
                        <label for="sex">Sex</label>
                        <select name="sex" class="form-control" required>Sex
                            <option value="<?php echo $sex; ?>"><?php echo $sex; ?></option>
                            <option value="female">Female</option>
                            <option value="male">Male</option>
                        </select>
                        </div>
                     <div class="form-group">
                        <label for="home_address">Home Address</label>
                        <input name="home_address" value="<?php echo $home_address; ?>" type="Text" class="form-control" id="home_address" placeholder=" Ho.#  Barangay  City/Municiplity  State  Zipcode" required>
                    </div>
                    <div class="form-group">
                        <label for="phone_no">Phone No.</label>
                        <input name="phone_no" type="Text" value="<?php echo $phone_no; ?>" class="form-control" id="phone_no" placeholder=" Enter your Phone no." required>
                        <span style="color:red;"><?php echo $phone_noerr; ?></span>
                    </div>
                    <button name="save_contact" type="submit" class="btn btn-success btn-block">Save Contact</button>
                    <a href="index.php" class="signuplink">Cancel</a>
                    
                    
            </form>            
    <body>
</html>