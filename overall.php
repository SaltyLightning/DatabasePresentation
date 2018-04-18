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
    $sql = "SELECT * from overall_stats ORDER BY Hero";
    $overall_stats = $conn->query($sql);
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
        .good{

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
        <!--            --><?php
        //            echo $_SESSION['str'];
        //            echo "<br>";
        //            echo $_SESSION['sql'];
        //            ?>
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
                    <th scope="col">Eliminations per game</th>
                    <th scope="col">Elim/Death ratio</th>
                    <th scope="col">Final Blows Percentage</th>
                    <th scope="col">Healing per game</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $overall;
                foreach ($overall_stats as $hero){
                    $hname = $hero["Hero"];
                    $elims = $hero["Elims"];
                    $deaths = $hero["E:D_Ratio"];
//                    $final_blows = number_format((float) $hero["final_blows"], '.', '');
                    $final_blows = number_format((float) $hero["Final_Blows"] * 100, 2, ".", '');
                    $healing = $hero["Healing"];
                    if(!isset($hname)){
                        $overall["hero"] = $hero["hero"];
                        $overall["elims"] = $hero["elims"];
                        $overall["deaths"] = $hero["deaths"]     ;
                        $overall["final_blows"] = $hero["final_blows"];
                        $overall["healing"] = $hero["healing"];
                        continue;
                    }
//                    $sql = "SELECT friendly_name from hero_friendly WHERE api_name = \"$hname\"";
//                    $temp = $conn->query($sql);
//                    if (!isset($temp)) {
//                        $hname = "error";
//                    } else {
//                        $row = $temp->fetch_array();
//                        $hname = $row[0];
//                    }
//
//
//                    if ($elims >= $overall_stats["Elims"])
//                        $ecc = "127,255,0";
//                    else
//                        $ecc = "205,92,92";
//                    if ($final_blows >= ($overall_stats["Final_Blows"] * 100))
//                        $fcc = "127,255,0";
//                    else
//                        $fcc = "205,92,92";
//                    if ($healing >= $overall_stats["Healing"])
//                        $hcc = "127,255,0";
//                    else
//                        $hcc = "205,92,92";
//                    echo "<tr style='background-color: rgba($cc, 0.5)'>";
                    echo "<tr>";
                    echo "<td>$hname <img src='images/icons/$hname.png' class='hicons'></td>";
                    echo "<td>$elims</span></td>";
                    echo "<td>$deaths</td>";
                    echo "<td>$final_blows%</td>";
                    echo "<td>$healing</td>";
                    echo "</tr>";
                }
                //                $hname =  "Overall";
                //                $elims = $overall["elims"];
                //                $deaths = $overall["deaths"];
                //                $final_blows = $overall["final_blows"];
                //                $healing = $overall["healing"];
                //                echo "<tr>";
                //                echo "<td>$hname <img src='images/icons/$hname.png' class='hicons'></td>";
                //                echo "<td>$elims</td>";
                //                echo "<td>$deaths</td>";
                //                echo "<td>$final_blows%</td>";
                //                echo "<td>$healing</td>";
                //                echo "</tr>";
                ?>
                </tbody>
            </table>
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

