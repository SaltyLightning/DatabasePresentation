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
    $sql = "SELECT AVG(winrate), catagory FROM general_stats INNER JOIN hero_friendly ON api_name = hero ".
        "WHERE tag = \"$name\" GROUP BY Catagory ORDER BY AVG(winrate) DESC";

    $best_cat = $conn->query($sql);
    if ($best_cat->num_rows !== 0) {
        // echo "New record created successfully\n";
    } else {
//        header("Location: details.php")
    }

    $sql = "SELECT friendly_name, winrate, catagory  FROM general_stats INNER JOIN hero_friendly ON api_name = hero ".
        "WHERE tag = \"$name\" AND games_played >= 5 AND winrate = " .
        "(SELECT MAX(winrate) FROM general_stats WHERE tag = \"$name\" AND games_played >= 5)";

    $best_hero = $conn->query($sql);
    if ($best_hero->num_rows !== 0) {
        // echo "New record created successfully\n";
    } else {
//        header("Location: details.php")
    }
    $sql = "SELECT sr FROM player ".
        "WHERE tag = \"$name\"";
    $sr = $conn->query($sql);
    $sr = $sr->fetch_array()[0];
    $sql = "SELECT rank, sr FROM ranks ".
        "WHERE sr > $sr ORDER BY ranks.sr ASC";

    $rank_stats = $conn->query($sql);
//    echo $sr;
//    if ($best_hero->num_rows !== 0) {
//        // echo "New record created successfully\n";
//    } else {
////        header("Location: details.php")
//    }
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
        .row.content {height: 450px}

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
    <?php
        $best_cat = $best_cat->fetch_array();
        $cat = $best_cat[1];
        $avg = number_format((float) $best_cat[0], 2, '.', '');
        $best_hero = $best_hero->fetch_array();
        $hero = $best_hero[0];
        if ($cat === $best_hero[2]){
            $is_cat = "is ";
        }
        else
            $is_cat = "is not ";
        $hwr = number_format((float) $best_hero[1], 2, '.', '');
        $rank_stats = $rank_stats->fetch_array();
        $dist = $rank_stats[1] - $sr;
        $rank = $rank_stats[0];
        if ($avg > 50)
            $num_games = ceil(($dist / 20) / ($avg / 100));
        else{
            $dist = $sr - ($rank_stats[1] - 500);
            $num_games = ceil(($dist / 20) / ($avg / 100));
        }
        if ($sr >= 4000){
            $mess = "you're already a grandmaster.";

        }
        else {
            if ($avg > 50) {
                $mess = "you will reach the next rank ($rank) in $num_games games";
            } else {
                $mess = "you will not reach the next rank ($rank) (<50% winrate). In fact, you will derank in $num_games games.";
            }
        }


        if ($hwr > 50)
            $num_games = ceil(($dist / 20) / ($hwr / 100));
        else{
            $dist = $sr - ($rank_stats[1] - 500);
            $num_games = ceil(($dist / 20) / ($hwr / 100));
        }
        if ($sr >= 4000){
            $mess2 = "you're already a grandmaster.";
        }
        else {
            if ($hwr > 50) {
                $mess2 = "you will reach the next rank ($rank) in $num_games games";
            }
            else {
                $mess2 = "you will not reach the next rank ($rank) (<50% winrate). In fact, you will derank in $num_games games.";
            }
    }

    ?>
        <div class="col-sm-2 sidenav">
            <p><a href="suggestions.php">Suggestions</a></p>
            <p><a href="heroes.php">Hero Details</a></p>
            <p><a href="details.php">Overall Details</a></p>
            <p><a href="team.php">Team</a></p>
            <p><a href="clear.php">Clear</a></p>
        </div>
        <div class="col-sm-8 text-left">
            <h1>Suggestions</h1>
            <?php
            echo "<h3>You should be focusing on $cat. It is your highest winrate category at $avg%</h3>";

            echo "<h3>Your best hero is $hero (winrate: $hwr%), which $is_cat in your highest winrate category</h3>";

            echo "<h3>If you played you best catagory at you current level, $mess</h3>";

            echo "<h3>If you played you best hero at you current level, $mess2</h3>";


            ?>
        </div>

    </div>
</div>
</div>

<footer class="container-fluid text-center">
    <p></p>
</footer>

</body>
</html>

