<?php

    include ("include/db_connect.php");
    $delete_id = '';
    if(isset($_POST['delete'])){
        $delete_id = $_GET['delete_id'];
    

        // sql to delete a record
        $sql = "Delete from contacts where ID = '$delete_id'"  ;

        if (mysqli_query($conn, $sql)) {
            header('location: index.php');
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    }
    

    if(isset($_POST['no'])){
        header('location: index.php');
    }

    mysqli_close($conn);
?>