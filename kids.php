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
<body id="kids_page">
    <div class="container-fluid">
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
                
                    <?php
                        if(isset($_GET['Child_ID']))
                        {
                            $Child_ID = mysqli_real_escape_string($connection, $_GET['Child_ID']);
                            $Child_Name = mysqli_real_escape_string($connection, $_GET['Cname']);
                            $query = "SELECT * FROM Childrens_213 WHERE Child_ID=" . $Child_ID . " LIMIT 1;";
                            $result = mysqli_query($connection, $query);
                            if(!$result) {
                                die("DB query: " + $query + " - failed.");
                            }
                            else{
                                if(mysqli_num_rows($result) < 1){
                                    echo '<div class="alert alert-danger" role="alert">מספר מזהה לא נמצא</div>';
                                }
                                else{
                                    $row = mysqli_fetch_assoc($result);
                                    $query = "SELECT * FROM Groups_213 WHERE Group_ID=" . $row['Group_ID'] . " LIMIT 1;";
                                    $result2 = mysqli_query($connection, $query);
                                    if(!$result2) {
                                        die("DB query: " + $query + " - failed.");
                                    }
                                    else{
                                        $row2 = mysqli_fetch_assoc($result2);
                                        echo '<li class="breadcrumb-item"><a href="groups.php?groupId=' . $row2["Group_ID"] . '&groupName=' . $row2["name"] . '">'
                                            . $row2["name"] . '</a></li>';
                                        echo '<li class="breadcrumb-item active" aria-current="page">' . $Child_Name . '</li>';
                                        echo '</ol></nav>
                                            <div class="card text-center">
                                              <div class="card-header">
                                                <img src="' . $row["pic"] . '">
                                              </div>
                                              <div class="card-body">
                                                <h5 class="card-title"><b>' . $row["FirstName"] . '</b></h5>
                                                <p class="card-text">
                                                    יש לטפל: 
                                                    <span id="reminder">';
                                                if($row["Reminder"] == NULL) {echo 'אין';} else { echo $row["Reminder"]; }
                                        echo '      </span>
                                                <br>
                                                אנא בחר\י אפשרות
                                                </p>
                                                <a href="#" class="btn btn-success">פרטים אישיים</a>
                                                  <a href="#" class="btn btn-success">חוזים ותשלומים</a>
                                                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#treatment_box">לטיפול</button>
                                              </div>
                                            </div>';
                                    }
                                    //Release returned data
                                    mysqli_free_result($result2);

                                    //Close DB connection
                                    mysqli_close($connection);
                                }
                            }
                        }
                        else
                        {
                            echo "<script>alert('Sorry. Something went wrong :( ');</script>";
                        }
                    ?>
                
<!-- Treatment box -->
<!-- Modal -->
<div class="modal fade" id="treatment_box" tabindex="-1" role="dialog" aria-labelledby="treatment_box" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="treatment_boxTitle">נושאים לטיפול</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="" method="post" autocomplete ="on" id="reminder_form">
          <div class="modal-body" id="modal-body">
            <p>המערכת זיהתה כי טרם הוזנה פעילות זחילה. זחילה לראשונה אמורה להתבצע בגילאי 7-9 חודשים. מומלץ לעדכן את ההורים ולהמשיך לעקוב</p>
            <p>?מה ברצונך לעשות</p>
            <!-- Here enters json data from reminders.json -->
              <input type="hidden" value="<?php echo $_GET['Child_ID']; ?>" name="child_id" id="child_id">
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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.rtlcss.com/bootstrap/v4.0.0/js/bootstrap.min.js" integrity="sha384-54+cucJ4QbVb99v8dcttx/0JRx4FHMmhOWi4W+xrXpKcsKQodCBwAvu3xxkZAwsH" crossorigin="anonymous"></script>
<script src="includes/javascript.js"></script>

        <script>
            $(function() {
                $("#reminder_form").submit(function() {
                    var txt = $("input:radio[name='reminder']:checked").val();
                    var child_id = $("#child_id").val();
                    var dataString = 'child_id=' + child_id + '&reminder=' + txt;
                    
                    console.log(dataString);
                    $.ajax({
                        type: "POST",
                        url: "database/action.php",
                        data: dataString,
                        cache: true,
                        success: function(html){
                            $('#reminder').html(txt);
                            $('#treatment_box').modal('hide');
                        }
                    });
                    return false;
                });
            });
        </script>

</body>
</html>