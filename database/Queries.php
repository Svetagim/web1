<?php

include('db_conf.php');
//    $query1_5 = "INSERT INTO Groups(Group_ID, name) value (4,'kids2')";
//    $result = mysqli_query($connection, $query1_5);
//    if(!$result) {
//        die("DB query failed. 1_5");
//    }
    
//    $query2 = "INSERT INTO Childrens(FirstName, LastName, Address, City, BirthDate, Reminder, Group_ID) value ('test','test','hashnaim','rishon','2018-07-14','test',1)";
//    $result = mysqli_query($connection, $query2);
//    if(!$result) {
//        die("DB query failed. 2");
//    }
    
    $query3 = "SELECT * FROM Groups_213 Order by Group_ID";
    $result = mysqli_query($connection, $query3);
    if(!$result) {
        die("DB query failed. 3");
    }
    while($row = mysqli_fetch_assoc($result)) {
        echo '<h5 style="color:red;">' . $row["Group_ID"] . '<h5>';
        echo '<h5 style="color:red;">' . $row["name"] . '<h5>';
    }