<?php
    include ('include/db_connect.php');

    $update_id=  $_GET['update_id'];

    $update = "select * from contacts where id = '$update_id'";
    
    $sql = mysqli_query($conn, $update);

    $result = mysqli_fetch_array($sql);



?>
<?php 
	$cell_phone_number_err='';
	$profile_tmp='';
	if (isset($_POST['update_contact'])) {
		$id = $_POST['id'];
		
		$name = $_POST['name'];
		$sex= $_POST['sex'];
		$home_address = $_POST['home_address'];
		$phone_no = $_POST['phone_no'];
		
		$update_contact = "UPDATE `contacts` SET `name`='$name',`sex`='$sex',`home_address`='$home_address',`phone_no`='$phone_no' where id='$id'";
       
        if (mysqli_query($conn, $update_contact)) {
            //header("location: update.php?update_id=".$update_id);
			echo "<script>alert('Record Updated!')</script>";
		} else {
            echo 0;
		}
		
		
		mysqli_close($conn);
	}
 ?>

 <!DOCTYPE html>
<html lang="en">
<head>
        <title>Phonebook | Homepage</title>
        <?php include('headinfo.php'); ?>
        
</head>
<body>
        <div class="container-fluid bg">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12"></div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
             <form class="form-container" action="update.php?update_id=<?php echo $_GET['update_id'] ?>" method="post">
                <h1>Update Contact</h1>
                <input type="hidden" name="id" value="<?php echo $result[0]; ?>">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" type="text" value="<?php echo $result[1] ?>" class="form-control" id="name" placeholder=" Last Name  First Name  Middle Name" autofocus>
                    </div>  
                    <div class="form-group">
                        <label for="sex">Sex</label>
                        <select name="sex" class="form-control">Sex
                            <option value="<?php echo $result[2] ?>"><?php echo $result[2] ?></option>
                            <option value="female">Female</option>
                            <option value="male">Male</option>
                        </select>
                        </div>
                     <div class="form-group">
                        <label for="home_address">Home Address</label>
                        <input name="home_address" type="Text" value="<?php echo $result[3] ?>" class="form-control" id="home_address" placeholder=" Ho.#  Barangay  City/Municiplity  State  Zipcode">
                    </div>
                    <div class="form-group">
                        <label for="phone_no">Phone No.</label>
                        <input name="phone_no" type="Text" value="<?php echo $result[4] ?>"class="form-control" id="phone_no" placeholder=" Enter your Phone no.">
                    </div>
                    <button name="update_contact" type="submit" class="btn btn-success btn-block">Update Contact</button>
                    <a href="index.php" class="signuplink">Cancel</a>
                    
                    
            </form>            
    <body>
</html>