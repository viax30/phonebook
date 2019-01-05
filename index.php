<?php 
    include ("include/db_connect.php");
    session_start();
    $name= $id ='';
    if(!(isset($_SESSION['name']))){

        header('location: log_in.php');
    }else{
        $name = $_SESSION['name'];
    }

    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
    }

    
?>




<!DOCTYPE html>
<html lang="en">
<head>
        <title>Phonebook | Homepage</title>
        <?php include('headinfo.php'); ?>
</head>
<style>
    table{
        color:white;
        margin-top: 30px;
    }
</style>
<body>
        <div class="containercoverphoto">
        <form action="logout.php" method="POST" > 
        <button type="submit" name="logout" style="float: right;" class="btn btn-info "> logout</button>
        </form>
        <img class="coverphoto" src="bootstrap-3.3.7/images/10.jpg" alt="Cinque Terre" width="1000" height="300"/>
        <div class="center"><h1>Welcome  <?php echo $name; ?></h1></div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <div class="col-sm-2 col-sm-offset-10">
                        <a class="btn btn-info btn-block" href="addnewcontact.php"><span class="glyphicon glyphicon-save"> Add new Contact</span></a>
                    </div>
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                    <th>Name</th>
                                    <th>Sex</th>
                                    <th>Mobile/Phone #</th>
                                    <th>Home Address</th>
                                    <th colspan="2">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM `contacts` where phonebook_user_id = ". $id; 

                            if ($result=mysqli_query($conn,$sql))
                            {
                            // Fetch one and one row
                            while ($row=mysqli_fetch_row($result))
                            
                            {
                            ?>  
                            <tr>
                                <td><?php echo $row[1] ?></td>
                                <td><?php echo $row[2] ?></td>
                                <td><?php echo $row[3] ?></td>
                                <td><?php echo $row[4] ?></td>
                                <td><a href="update.php?update_id=<?php echo $row[0] ?>" class="btn btn-primary btn-block" >Update</a></td>
                                <td><a href="?delete_id=<?php echo $row[0] ?>"class="btn btn-danger btn-block" >Delete</a></td>
                                
                            </tr>
                            <?php
                              }
                            // Free result set
                            mysqli_free_result($result);
                          
                          }



                            ?>
                            
                        </tbody>
                    </table>
                
                </div>


            </div>
        </div>

<div class="modal" id="modal_delete" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <form action="delete.php?delete_id=<?php echo  $_GET['delete_id']; ?>" method="post">
        <input type="hidden" name="modal_delete" value="<?php echo  $_GET['delete_id']; ?>">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="modal_delete" name="no" onclick="$('#modal_delete').fadeOut();">&times;</button>
                <h4 class="modal-title"><strong>Delete!!!</strong></h4>
            </div>
            <div class="modal-body">
                <p><span class="glyphicon glyphicon-info-sign alert-info"></span>&nbsp;&nbsp;Are you sure you want to delete ?</p>
            </div>
            <div class="modal-footer">
                <button type="submit" name="delete"   class="btn btn-primary" ><span class="glyphicon glyphicon-ok"></span> Yes</button>
                <button type="submit" name="no" onclick="$('#modal_delete').fadeOut();" class="btn btn-danger" ><span class="glyphicon glyphicon-remove"></span> No</button>
            </div>
        </div>
        </form>
    </div>
</div>

<?php if(isset($_GET['delete_id'])){ ?>

    <script type='text/javascript'>
        $('#modal_delete').fadeIn();
        
        window.onclick = function(event) {
            if (event.target == modal) {
                $('#modal_delete').fadeOut();
            }
        }
    </script>
<?php } ?>
</body>
</html>