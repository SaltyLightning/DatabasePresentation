<?php
/**
 * Created by PhpStorm.
 * User: Xay
 * Date: 4/14/2018
 * Time: 10:25 AM
 */
session_start();
if (isset($_SESSION['name'])){
    $servername = "localhost:3306";
    $username = "root";
    $password = "";
    $dbname = "overwatch";
// Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $name = $_SESSION['name'];
// Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "SELECT * from general_stats WHERE tag = \"$name\" ORDER BY hero";
    if (isset($_POST["last"])){
        echo "here";
        $sql = "SELECT * from general_stats WHERE tag = \"$name\" AND date >= ".
         "date >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY
          AND date < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY " .
            "ORDER BY hero";
    }
    $heroes = $conn->query($sql);
    if ($heroes->num_rows !== 0) {
        // echo "New record created successfully\n";
    } else {
//        header("Location: details.php");
        $heros[0]["hero"] = "Not found";
        $heros[0]["winrate"] = $name;

    }
}
else{
    $heroes[0]["hero"] = "Not found";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Overstatted</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        /* Remove the navbar's default margin-bottom and rounded borders */
        .navbar {
            margin-bottom: 0;
            border-radius: 0;
        }

        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
        .row.content {height: 2000px}

        /* Set gray background color and 100% height */
        .sidenav {
            padding-top: 20px;
            background-color: #f1f1f1;
            height: 100%;
        }

        /* Set black background color, white text and some padding */
        footer {
            background-color: #555;
            color: white;
            padding: 15px;
        }

        /* On small screens, set height to 'auto' for sidenav and grid */
        @media screen and (max-width: 767px) {
            .sidenav {
                height: auto;
                padding: 15px;
            }
            .row.content {height:auto;}
        }
        .hicons{
            height: 30px;
            width: 30px;
        }
    </style>
<!--    <link href="main.css" rel="stylesheet">-->
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Overstatted</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <!--                <li class="active"><a href="#">Home</a></li>-->
                <!--                <li><a href="#">About</a></li>-->
                <!--                <li><a href="#">Projects</a></li>-->
                <!--                <li><a href="#">Contact</a></li>-->
            </ul>
            <ul class="nav navbar-nav navbar-right">
<!--                <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>-->
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid text-center">
    <div class="row content">
<!--        <p>-->
<!--<!--            --><?php
//
//                echo $_SESSION['str'];
//                echo "<br>";
//                echo $_SESSION['sql'];
////                ?>
<!--        </p>-->
        <div class="col-sm-2 sidenav">
            <p><a href="suggestions.php">Suggestions</a></p>
            <p><a href="heroes.php">Hero Stats</a></p>
            <p><a href="details.php">Winrate Details</a></p>
            <p><a href="overall.php">Overall Stats</a></p>
<!--            <p><a href="clear.php">Clear</a></p>-->
        </div>
        <div class="col-sm-8 text-left">
            <table class="table table-dark">
                <thead>
                <tr>
                    <th scope="col">Hero</th>
                    <th scope="col">Games Played</th>
                    <th scope="col">Wins</th>
                    <th scope="col">Losses</th>
                    <th scope="col">Winrate</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $overall;
                    foreach ($heroes as $hero){
                        $hname = $hero["hero"];
                        $games = $hero["games_played"];
                        $wins = $hero["wins"];
                        $losses = $hero["losses"];
                        $winrate = $hero["winrate"];
                        if(!isset($hname)){
                            $overall["games"] = $games;
                            $overall["wins"] = $wins;
                            $overall["losses"] = $losses;
                            $overall["winrate"] = $winrate;
                            continue;
                        }
                        $sql = "SELECT friendly_name from hero_friendly WHERE api_name = \"$hname\"";
                        $temp = $conn->query($sql);
                        if (!isset($temp)) {
                            $hname = "error";
                        } else {
                            $row = $temp->fetch_array();
                            $hname = $row[0];
                        }
                        if ($winrate > 50)
                            $cc = "127,255,0";
                        else
                            $cc = "205,92,92";
                        echo "<tr style='background-color: rgba($cc, 0.5)'>";
                            echo "<td>$hname <img src='images/icons/$hname.png' class='hicons'></td>";
                            echo "<td>$games</td>";
                            echo "<td>$wins</td>";
                            echo "<td>$losses</td>";
                            echo "<td>$winrate%</td>";
                        echo "</tr>";
                    }
                        $hname =  "Overall";
                        $games = $overall["games"];
                        $wins = $overall["wins"];
                        $losses = $overall["losses"];
                        $winrate = $overall["winrate"];
                        echo "<tr>";
                        echo "<td>$hname <img src='images/icons/$hname.png' class='hicons'></td>";
                        echo "<td>$games</td>";
                        echo "<td>$wins</td>";
                        echo "<td>$losses</td>";
                        echo "<td>$winrate%</td>";
                        echo "</tr>";
                ?>
                </tbody>
            </table>
<!--            <form action="details.php" method="post">-->
<!--                    <div class="col-12 col-md-3">-->
<!--                        <button name="last" type="submit" class="btn btn-block btn-lg btn-primary">View last week</button>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </form>-->
        </div>
<!--        <div class="col-sm-2 sidenav">-->
<!--            <div class="well">-->
<!--                <p>ADS</p>-->
<!--            </div>-->
<!--            <div class="well">-->
<!--                <p>ADS</p>-->
<!--            </div>-->
        </div>
    </div>
</div>

<footer class="container-fluid text-center">
    <p></p>
</footer>

</body>
</html>

