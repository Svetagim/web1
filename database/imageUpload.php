<?php
    include('db_conf.php');

    if(isset($_POST['fname']))
    {
        $query = "SELECT MAX(Child_ID) AS maxId FROM Childrens_213";
        $result = mysqli_query($connection, $query);
        if(!$result) {
            die("DB query: " + $query + " - failed.");
        }
        else{
            $row = mysqli_fetch_assoc($result);
            $childId = $row['maxId'] + 1;   
        }
        $fname = mysqli_real_escape_string($connection, $_POST['fname']);
        $lname = mysqli_real_escape_string($connection, $_POST['lname']);
        $address = mysqli_real_escape_string($connection, $_POST['address']);
        $city = mysqli_real_escape_string($connection, $_POST['city']);
        $bdate = mysqli_real_escape_string($connection, $_POST['bdate']);
        $group = mysqli_real_escape_string($connection, $_POST['group']);

        $target = "images/"; 
        $target = $target . "baby" . $childId . ".png"; 
        $pic=($_FILES['pic']['name']);

        $query1 = "INSERT INTO Childrens_213 (Child_ID,FirstName,LastName,Address,City,BirthDate,pic,Group_ID) values (" . $childId . ",'" . $fname . "','" . $lname . "','" . $address . "','" . $city . "','" . $bdate . "','" . $target . "','" . $group . "')";
        mysqli_query($connection, $query1);

        if(move_uploaded_file($_FILES['pic']['tmp_name'],$target))
        {
            header("Location: ../crewEnterence.php");
        }
    }
?>