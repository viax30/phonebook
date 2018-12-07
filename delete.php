<?php

    include ("include/db_connect.php");
    $delete_id = $_GET['delete_id'];
    echo $delete_id;

    // sql to delete a record
    $sql = "Delete from contacts where ID = '$delete_id'"  ;

    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
?>
<div class="modal" id="delete_id" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <form action="delete.php?delete_id=<?php echo  $contact_id; ?>" method="post">
        <input type="hidden" name="delete_id" value="<?php echo  $contact_id; ?>">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="delete_id" onclick="$('#delete_id').fadeOut();">&times;</button>
                <h4 class="modal-title"><strong>Delete!!!</strong></h4>
            </div>
            <div class="modal-body">
                <p><span class="glyphicon glyphicon-info-sign alert-info"></span>&nbsp;&nbsp;Are you sure you want to delete ?</p>
            </div>
            <div class="modal-footer">
                <button type="submit" name="delete"   class="btn btn-primary" ><span class="glyphicon glyphicon-ok"></span> Yes</button>
                <button type="button" onclick="$('#delete_contact_id').fadeOut();" class="btn btn-danger" ><span class="glyphicon glyphicon-remove"></span> No</button>
            </div>
        </div>
        </form>
    </div>
</div>
