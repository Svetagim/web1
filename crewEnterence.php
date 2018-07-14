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

        <nav aria-label="breadcrumb" dir="rtl">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">ילדי וקבוצות הגן</li>
            </ol>
        </nav>
        
    </header>
    <main>
         <div class="card-deck" id="groups-list">
         </div>
                <a href="#">
                    <section id="continue">
                        <h3>כל הילדים</h3>
                        <i class="fas fa-arrow-circle-down"></i>
                    </section>
                </a>
        <section class="kids">
            <?php
                    $query = "SELECT * FROM Childrens_213";
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
                            echo '<a href="#"><img src="images/PlusIcon_Small_Gray.png"></a>';
                        }
                    }
                    //Release returned data
                    mysqli_free_result($result);

                    //Close DB connection
                    mysqli_close($connection);
            ?>
            
        </section>
    </main>
</div>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<script src="includes/javascript.js"></script>

</body>
</html>