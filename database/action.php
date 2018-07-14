<?php

include('db_conf.php');

if(isset($_POST['reminder']))
{
    $txt = mysqli_real_escape_string($connection, $_POST['reminder']);
    $child_id = mysqli_real_escape_string($connection, $_POST['child_id']);
    
    $query1 = "UPDATE Childrens_213 SET Reminder='" . $txt . "' where Child_ID=" . $child_id;
    mysqli_query($connection, $query1);
}

//Close DB connection
mysqli_close($connection);

?>