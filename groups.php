<?php
    include('database/db_conf.php');
?>

<!DOCTYPE html>
<html lang="he">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.0.0/css/bootstrap.min.css" integrity="sha384-P4uhUIGk/q1gaD/NdgkBIl3a6QywJjlsFJFk7SPRdruoGddvRVSwv5qFnvZ73cpz" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="includes/style2.css">
    <title>PaotOn</title>
</head>
<body id="groups_page" class="container-fluid">
    <header>
        <section class="userName">
            <p>
                שלווה<i class="fas fa-user"></i>
                <br><u>גננת</u>
            </p>
        </section>
        <a href="index.html" id="logo"></a>
        <nav class="navbar navbar-expand-lg navbar-light bg-light" dir="rtl">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">ראשי <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">קבוצות הגן</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">יצירת שאלון</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">עדכונים אנונימיים</a>
                    </li>
                    <li class="nav-item">
                        <form class="form-inline my-2 my-lg-0" id="top_search_bar">
                            <input class="form-control mr-sm-2" type="search" placeholder="חיפוש" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <nav aria-label="breadcrumb" dir="rtl">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="crewEnterence.php">ילדי וקבוצות הגן</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $_GET['groupName']?></li>
            </ol>
        </nav>
        <section class="kids">
            <?php
                if(isset($_GET['groupId']))
                {
                    $group_id = mysqli_real_escape_string($connection, $_GET['groupId']);
                    $query = "SELECT * FROM Childrens_213 WHERE Group_ID=" . $group_id . " Order By Child_ID;";
                    $result = mysqli_query($connection, $query);
                    if(!$result) {
                        die("DB query: " + $query + " - failed.");
                    }
                    else{
                        if(mysqli_num_rows($result) < 1){
                            echo '<div class="alert alert-warning" role="alert">קבוצה ריקה מילדים</div>';
                            echo '<a href="#" id="center_plus"><img src="images/PlusIcon_Small_Gray.png"></a>';
                        }
                        else{
                            while($row = mysqli_fetch_assoc($result)) {
                                echo '<a href="kids.php?Child_ID=' . $row["Child_ID"] . '&Cname=' . $row["FirstName"] . '"><img src="' . $row["pic"] . '"><h5>' . $row["FirstName"] . '</h5></a>';
                            }
                            echo '<a href="#" data-toggle="modal" data-target="#addnewchild_box"><img src="images/PlusIcon_Small_Gray.png"></a>';
                        }
                    }
                    //Release returned data
                    mysqli_free_result($result);
                }
                else
                {
                    echo "Sorry. Something went wrong :(";
                }
            ?>
            
        </section>
            <!-- Add a new child box -->
            <!-- Modal -->
            <div class="modal fade" id="addnewchild_box" tabindex="-1" role="dialog" aria-labelledby="addnewchild_box" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="addnewchild_boxTitle">הוספת ילד/ה חדש/ה</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                    <form action="database/imageUpload.php" enctype="multipart/form-data" method="post" autocomplete ="on" id="addchild_form" class="addchild_form">
                      <div class="modal-body" id="modal-body">
                        <p>בבקשה מלאו את הפריטים הבאים</p>
                        <input type="text" class="form-control" id="fname" name="fname" placeholder="שם פרטי">
                        <input type="text" class="form-control" id="lname" name="lname" placeholder="שם משפחה">
                        <input type="text" class="form-control" id="address" name="address" placeholder="כתובת מגורים">
                        <input type="text" class="form-control" id="city" name="city" placeholder="עיר">
                        <input type="date" class="form-control" id="bdate" name="bdate" placeholder="תאריך לידה">
                        <select class="form-control" id="group" name="group">
                        <?php 
                        $query = "SELECT * FROM Groups_213";
                        $result = mysqli_query($connection, $query);
                        if(!$result) {
                            die("DB query: " + $query + " - failed.");
                        }
                        else{
                            while($row = mysqli_fetch_assoc($result)) {
                                echo '<option value=' . $row['Group_ID'] . '>' . $row['name'] . '</option>';
                            }
                        }
                        //Release returned data
                        mysqli_free_result($result);

                        //Close DB connection
                        mysqli_close($connection);    
                        
                        ?>
                        </select>
                        <div class="preview"></div>
                        <label for="pic">תמונה</label>
                        <input type="file" class="form-control-file" id="pic" name="pic">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ביטול</button>
                        <input type="submit" class="btn btn-success" value="אישור">
                      </div>
                    </form>
                </div>
              </div>
            </div>
            <!-- END Treatment box -->
    </main>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.rtlcss.com/bootstrap/v4.0.0/js/bootstrap.min.js" integrity="sha384-54+cucJ4QbVb99v8dcttx/0JRx4FHMmhOWi4W+xrXpKcsKQodCBwAvu3xxkZAwsH" crossorigin="anonymous"></script>
<script src="includes/javascript.js"></script>

</body>
</html>